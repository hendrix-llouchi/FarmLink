<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderEvent;
use App\Models\Notification;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderWorkflowService
{
    public function record(Order $order, string $event, array $details = [], $actor = null, bool $system = false): void
    {
        $actor = $system ? null : ($actor ?? auth()->user());

        OrderEvent::create([
            'order_id' => $order->id,
            'actor_id' => $actor?->id,
            'actor_role' => $actor?->role ?? ($system ? 'system' : null),
            'event' => $event,
            'details' => $details,
        ]);
    }

    public function refund(Order $order, string $reason, bool $system = false): void
    {
        $product = Product::lockForUpdate()->findOrFail($order->product_id);
        $product->increment('quantity', $order->quantity_ordered);
        $order->update(['workflow_status' => 'cancelled', 'payment_status' => 'refunded']);
        $this->record($order, 'escrow_refunded', ['reason' => $reason, 'stock_restored' => $order->quantity_ordered], null, $system);
        Notification::create([
            'user_id' => $order->buyer_id,
            'message' => "Order #{$order->id} was cancelled and its escrow was refunded. The produce stock was restored.",
            'type' => 'order_update',
        ]);
    }

    public function processDeadlines(): void
    {
        Order::where('payment_status', 'escrow_held')
            ->whereNotNull('flag_deadline_at')
            ->whereNull('flag_buyer_confirmed_at')
            ->where('flag_deadline_at', '<=', now())
            ->select('id')
            ->chunkById(100, function ($orders) {
                foreach ($orders as $pending) {
                    DB::transaction(function () use ($pending) {
                        $order = Order::lockForUpdate()->find($pending->id);
                        if (!$order || $order->payment_status !== 'escrow_held' || $order->flag_buyer_confirmed_at || !$order->flag_deadline_at?->isPast()) {
                            return;
                        }

                        $this->refund($order, 'No decision within the 15-minute window', true);
                    });
                }
            });

        Order::where('workflow_status', 'arrived')
            ->where('payment_status', 'escrow_held')
            ->whereNotNull('arrived_at')
            ->whereNull('buyer_confirmed_at')
            ->where('arrived_at', '<=', now()->subHours((int) config('farmlink.delivery_auto_release_hours', 24)))
            ->select('id')
            ->chunkById(100, function ($orders) {
                foreach ($orders as $pending) {
                    DB::transaction(function () use ($pending) {
                        $order = Order::lockForUpdate()->find($pending->id);
                        if (!$order || $order->workflow_status !== 'arrived' || $order->payment_status !== 'escrow_held'
                            || $order->buyer_confirmed_at || !$order->delivery_photo_path || !$order->arrived_at) {
                            return;
                        }

                        $order->update([
                            'status' => 'delivered',
                            'workflow_status' => 'delivered',
                            'payment_status' => 'released',
                        ]);
                        $this->record($order, 'escrow_auto_released', ['reason' => 'Buyer confirmation window expired'], null, true);
                        Notification::create([
                            'user_id' => $order->product->user_id,
                            'message' => "Escrow for Order #{$order->id} was released after the 24-hour buyer confirmation window.",
                            'type' => 'order_update',
                        ]);
                    });
                }
            });
    }
}
