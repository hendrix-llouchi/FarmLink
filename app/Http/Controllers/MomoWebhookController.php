<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class MomoWebhookController extends Controller
{
    /**
     * Handle MTN MoMo webhook callback.
     */
    public function handle(Request $request)
    {
        Log::info('MTN MoMo Webhook payload received:', $request->all());

        $externalId = $request->input('externalId');
        $status = $request->input('status');
        $financialTransactionId = $request->input('financialTransactionId');

        if (!$externalId) {
            return response()->json(['message' => 'Missing externalId'], 400);
        }

        try {
            DB::transaction(function () use ($externalId, $status, $financialTransactionId) {
                $order = Order::lockForUpdate()->find($externalId);

                if (!$order) {
                    Log::warning("Order not found for MoMo Webhook externalId: {$externalId}");
                    return;
                }

                if (strtoupper($status) === 'SUCCESSFUL') {
                    if ($order->payment_status !== 'escrow_held') {
                        $order->update([
                            'payment_status' => 'escrow_held',
                        ]);

                        Log::info("Order #{$order->id} payment updated to escrow_held via MoMo Webhook. Transaction: {$financialTransactionId}");

                        Notification::create([
                            'user_id' => $order->product->user_id,
                            'message' => "Payment confirmed! Order #" . $order->id . " from " . $order->buyer->name . " is now in escrow. Please prepare the produce for delivery.",
                            'type' => 'order_update',
                        ]);
                    }
                } else {
                    Log::warning("MoMo Webhook returned unsuccessful status: {$status} for Order #{$order->id}");
                }
            });

            return response()->json(['message' => 'Webhook processed successfully'], 200);
        } catch (\Exception $e) {
            Log::error("Failed to process MoMo Webhook for Order #{$externalId}: " . $e->getMessage());
            return response()->json(['message' => 'Webhook processing error', 'error' => $e->getMessage()], 500);
        }
    }
}
