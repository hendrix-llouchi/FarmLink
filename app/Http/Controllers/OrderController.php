<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Rating;
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
        ]);

        try {
            DB::transaction(function () use ($request) {
                // Lock the product for update to prevent race conditions
                $product = Product::lockForUpdate()->findOrFail($request->product_id);

                if ($product->quantity < $request->quantity_ordered) {
                    throw ValidationException::withMessages([
                        'quantity_ordered' => ["The requested quantity exceeds available stock (only {$product->quantity} remaining)."]
                    ]);
                }

                // Deduct stock
                $product->decrement('quantity', $request->quantity_ordered);

                // Create the order
                Order::create([
                    'buyer_id' => auth()->id(),
                    'product_id' => $product->id,
                    'quantity_ordered' => $request->quantity_ordered,
                    'total_price' => $product->price * $request->quantity_ordered,
                    'status' => 'pending',
                ]);
            });
        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw ValidationException::withMessages([
                'quantity_ordered' => ['Failed to place order: ' . $e->getMessage()]
            ]);
        }

        return redirect()->route('buyer.orders.index')->with('message', 'Order placed successfully!');
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
                    'status' => 'delivered'
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
}
