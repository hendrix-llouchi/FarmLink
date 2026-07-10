<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
use App\Models\Notification;
use App\Services\MomoApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the buyer's orders.
     */
    public function index()
    {
        $orders = Order::where('buyer_id', auth()->id())
            ->with(['product.user', 'buyerRating'])
            ->latest()
            ->get();

        return Inertia::render('MyOrders', [
            'orders' => $orders
        ]);
    }

    /**
     * Store a newly created order in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'quantity_ordered' => ['required', 'integer', 'min:1'],
            'payment_network' => ['required', 'string', 'in:MTN'],
            'payment_number' => ['required', 'string', 'regex:/^[0-9]{10}$/'],
        ]);

        $referenceId = (string) \Illuminate\Support\Str::uuid();
        $order = null;

        try {
            DB::transaction(function () use ($request, $referenceId, &$order) {
                // Lock the product for update to prevent race conditions
                $product = Product::lockForUpdate()->findOrFail($request->product_id);

                if ($product->quantity < $request->quantity_ordered) {
                    throw ValidationException::withMessages([
                        'quantity_ordered' => ["The requested quantity exceeds available stock (only {$product->quantity} remaining)."]
                    ]);
                }

                // Deduct stock
                $product->decrement('quantity', $request->quantity_ordered);

                // Create the order with unpaid status initially
                $order = Order::create([
                    'buyer_id' => auth()->id(),
                    'product_id' => $product->id,
                    'quantity_ordered' => $request->quantity_ordered,
                    'total_price' => $product->price * $request->quantity_ordered,
                    'status' => 'pending',
                    'payment_status' => 'unpaid',
                    'momo_reference' => $referenceId,
                ]);
            });

            // Call the MoMo API collection request (outside DB transaction)
            $momoService = new MomoApiService();
            $momoResult = $momoService->requestToPay(
                $referenceId,
                $order->total_price,
                $request->payment_number,
                (string) $order->id
            );

            if (!$momoResult['success']) {
                // Roll back database changes if API call failed
                DB::transaction(function () use ($order) {
                    $product = Product::lockForUpdate()->findOrFail($order->product_id);
                    $product->increment('quantity', $order->quantity_ordered);
                    $order->delete();
                });

                throw ValidationException::withMessages([
                    'payment_number' => [$momoResult['message'] ?? 'Mobile Money payment initiation failed. Please try again.']
                ]);
            }

            $flashMessage = isset($momoResult['simulated']) 
                ? 'Order initiated! (Simulator Mode: Trigger the webhook callback to confirm payment).'
                : 'Payment request sent! Please check your phone for the MTN MoMo PIN prompt to authorize.';

            return redirect()->route('buyer.orders.index')->with('message', $flashMessage);

        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            if ($order) {
                try {
                    DB::transaction(function () use ($order) {
                        $product = Product::lockForUpdate()->findOrFail($order->product_id);
                        $product->increment('quantity', $order->quantity_ordered);
                        $order->delete();
                    });
                } catch (\Exception $cleanupEx) {
                    \Illuminate\Support\Facades\Log::error('Order cleanup failure: ' . $cleanupEx->getMessage());
                }
            }
            throw ValidationException::withMessages([
                'quantity_ordered' => ['Failed to place order: ' . $e->getMessage()]
            ]);
        }
    }

    /**
     * Display a listing of pending orders that need a driver.
     */
    public function driverIndex()
    {
        $orders = Order::whereNull('driver_id')
            ->where('status', 'pending')
            ->with(['buyer', 'product.user'])
            ->latest()
            ->get();

        $activeTrips = Order::where('driver_id', auth()->id())
            ->whereIn('status', ['processing', 'in_transit'])
            ->with(['buyer', 'product.user'])
            ->latest()
            ->get();

        return Inertia::render('DriverDashboard', [
            'orders' => $orders,
            'activeTrips' => $activeTrips
        ]);
    }

    /**
     * Accept a pending delivery.
     */
    public function acceptDelivery(Request $request, $id)
    {
        try {
            DB::transaction(function () use ($id) {
                // Lock the order for update to prevent concurrent assignment
                $order = Order::lockForUpdate()->findOrFail($id);

                if ($order->driver_id !== null) {
                    throw ValidationException::withMessages([
                        'driver_id' => ['This delivery has already been accepted by another driver.']
                    ]);
                }

                $order->update([
                    'driver_id' => auth()->id(),
                    'status' => 'processing',
                ]);

                // Notify buyer
                Notification::create([
                    'user_id' => $order->buyer_id,
                    'message' => "Your delivery has been accepted by driver " . auth()->user()->name . " for your order of " . $order->quantity_ordered . " " . ($order->product->unit ?? 'item(s)') . " of " . $order->product->name . ".",
                    'type' => 'transport_update',
                ]);

                // Notify farmer
                Notification::create([
                    'user_id' => $order->product->user_id,
                    'message' => "Driver " . auth()->user()->name . " has accepted the delivery request for your product: " . $order->product->name . ".",
                    'type' => 'transport_update',
                ]);
            });
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'order' => ['Failed to accept delivery: ' . $e->getMessage()]
            ]);
        }

        return redirect()->route('driver.dashboard')->with('message', 'Delivery accepted successfully!');
    }

    /**
     * Mark a delivery as in transit (status set to in_transit).
     */
    public function pickupDelivery(Request $request, $id)
    {
        try {
            \Illuminate\Support\Facades\DB::transaction(function () use ($id) {
                $order = Order::lockForUpdate()->findOrFail($id);

                if ($order->driver_id !== auth()->id()) {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'order' => ['You are not assigned as the driver for this order.']
                    ]);
                }

                if ($order->status !== 'processing') {
                    throw \Illuminate\Validation\ValidationException::withMessages([
                        'status' => ['Only processing orders can be marked as in transit.']
                    ]);
                }

                $order->update([
                    'status' => 'in_transit',
                ]);

                // Notify buyer
                Notification::create([
                    'user_id' => $order->buyer_id,
                    'message' => "Your order for " . $order->quantity_ordered . " item(s) of " . $order->product->name . " has been picked up by driver " . auth()->user()->name . " and is now in transit!",
                    'type' => 'order_update',
                ]);
            });
        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'order' => ['Failed to update delivery status: ' . $e->getMessage()]
            ]);
        }

        return redirect()->route('driver.dashboard')->with('message', 'Order picked up and is now in transit!');
    }

    /**
     * Mark a delivery as completed (status set to delivered).
     */
    public function completeDelivery(Request $request, $id)
    {
        try {
            DB::transaction(function () use ($id) {
                $order = Order::lockForUpdate()->findOrFail($id);

                if ($order->driver_id !== auth()->id()) {
                    throw ValidationException::withMessages([
                        'order' => ['You are not assigned as the driver for this order.']
                    ]);
                }

                if (!in_array($order->status, ['processing', 'in_transit'])) {
                    throw ValidationException::withMessages([
                        'status' => ['Only processing or in transit orders can be marked as delivered.']
                    ]);
                }

                $order->update([
                    'status' => 'delivered',
                    'payment_status' => 'released',
                ]);

                // Notify buyer
                Notification::create([
                    'user_id' => $order->buyer_id,
                    'message' => "Your order for " . $order->quantity_ordered . " " . ($order->product->unit ?? 'item(s)') . " of " . $order->product->name . " has been delivered by driver " . auth()->user()->name . "! You can now rate this order.",
                    'type' => 'order_update',
                ]);

                // Notify farmer
                Notification::create([
                    'user_id' => $order->product->user_id,
                    'message' => "Order #" . $order->id . " has been successfully delivered by " . auth()->user()->name . ". Funds of ₵" . number_format($order->total_price, 2) . " have been released to your account.",
                    'type' => 'order_update',
                ]);
            });
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'order' => ['Failed to complete delivery: ' . $e->getMessage()]
            ]);
        }

        return redirect()->back()->with('message', 'Delivery completed successfully!');
    }

    /**
     * Submit a buyer feedback/rating for a delivered order.
     */
    public function rateOrder(Request $request, $id)
    {
        $request->validate([
            'score' => ['required', 'integer', 'min:1', 'max:5'],
            'comment' => ['nullable', 'string', 'max:500'],
        ]);

        try {
            DB::transaction(function () use ($request, $id) {
                $order = Order::lockForUpdate()->findOrFail($id);

                if ($order->buyer_id !== auth()->id()) {
                    throw ValidationException::withMessages([
                        'order' => ['You can only rate orders you purchased.']
                    ]);
                }

                if ($order->status !== 'delivered') {
                    throw ValidationException::withMessages([
                        'order' => ['You can only rate orders that have been successfully delivered.']
                    ]);
                }

                // Check for duplicate rating
                $existingRating = Rating::where('order_id', $order->id)
                    ->where('rater_id', auth()->id())
                    ->first();

                if ($existingRating) {
                    throw ValidationException::withMessages([
                        'order' => ['You have already rated this order.']
                    ]);
                }

                // Create the rating
                Rating::create([
                    'order_id' => $order->id,
                    'rater_id' => auth()->id(),
                    'ratee_id' => $order->product->user_id, // Rate the farmer
                    'score' => $request->score,
                    'comment' => $request->comment,
                ]);

                // Recalculate average_rating for the farmer
                $farmer = $order->product->user;
                $averageRating = Rating::where('ratee_id', $farmer->id)->avg('score') ?: 0.00;
                $farmer->update([
                    'average_rating' => $averageRating
                ]);
            });
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'order' => ['Failed to submit rating: ' . $e->getMessage()]
            ]);
        }

        return redirect()->back()->with('message', 'Thank you for your rating!');
    }

    /**
     * Display a listing of the farmer's received orders.
     */
    public function farmerOrders()
    {
        $farmerId = auth()->id();

        $orders = Order::whereHas('product', function ($query) use ($farmerId) {
            $query->where('user_id', $farmerId);
        })
        ->with(['buyer', 'product', 'driver', 'ratings'])
        ->latest()
        ->get();

        return Inertia::render('FarmerOrders', [
            'orders' => $orders
        ]);
    }

    /**
     * Request transport for a farmer's order.
     */
    public function requestTransport(Request $request, $id)
    {
        $farmerId = auth()->id();
        $order = Order::findOrFail($id);

        // Ensure the order belongs to this farmer's product
        if ($order->product->user_id !== $farmerId) {
            abort(403, 'Unauthorized action.');
        }

        if ($order->transport_requested) {
            throw ValidationException::withMessages([
                'order' => ['Transport has already been requested for this order.']
            ]);
        }

        try {
            DB::transaction(function () use ($order, $farmerId) {
                // Find driver matching the farmer's location, or fall back to the first available driver
                $farmer = auth()->user();
                $driver = \App\Models\User::where('role', 'driver')
                    ->where('location', $farmer->location)
                    ->first();

                // Fallback to any driver if none is matched in location
                if (!$driver) {
                    $driver = \App\Models\User::where('role', 'driver')->first();
                }

                if (!$driver) {
                    throw new \Exception('No driver is currently available on the platform.');
                }

                // Estimate transport cost: flat ₵30.00 base rate + ₵2.00 per quantity
                $estimatedCost = 30.00 + ($order->quantity_ordered * 2.00);

                $order->update([
                    'driver_id' => $driver->id,
                    'transport_requested' => true,
                    'estimated_transport_cost' => $estimatedCost,
                    'status' => 'processing',
                ]);

                // Create notifications
                \App\Models\Notification::create([
                    'user_id' => $order->buyer_id,
                    'message' => "Transport has been requested for your order of " . $order->product->name . ". Driver " . $driver->name . " has been assigned.",
                    'type' => 'transport_update',
                ]);

                \App\Models\Notification::create([
                    'user_id' => $driver->id,
                    'message' => "New delivery job: Pick up " . $order->quantity_ordered . " unit(s) of " . $order->product->name . " from " . $farmer->name . " (📍 " . $farmer->location . ").",
                    'type' => 'transport_update',
                ]);
            });
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'order' => ['Failed to request transport: ' . $e->getMessage()]
            ]);
        }

        return redirect()->back()->with('message', 'Transport request sent and driver assigned successfully!');
    }
}
