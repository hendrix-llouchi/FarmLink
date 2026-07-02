<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
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
            ->with(['product.user'])
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

        return Inertia::render('DriverDashboard', [
            'orders' => $orders
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
}
