<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Notification;
use App\Models\Verification;
use App\Services\OrderWorkflowService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class VerificationController extends Controller
{
    public function store(Request $request, Order $order, OrderWorkflowService $workflow)
    {
        $data = $request->validate([
            'actual_quantity' => ['required', 'integer', 'min:0', 'max:100000'],
            'actual_grade' => ['required', 'in:A,B,C'],
            'freshness_match' => ['required', 'boolean'],
            'damage_note' => ['nullable', 'string', 'max:1000'],
            'heavy_spoilage' => ['required', 'boolean'],
            'packaging_ok' => ['required', 'boolean'],
            'photos' => ['required', 'array', 'min:2', 'max:5'],
            'photos.*' => ['required', 'image', 'max:4096'],
        ]);

        if ($order->driver_id !== $request->user()->id || $order->status !== 'processing' || $order->payment_status !== 'escrow_held') {
            throw ValidationException::withMessages(['order' => ['Only the assigned driver can verify an order at the farm gate.']]);
        }
        if ($order->verification()->exists()) {
            throw ValidationException::withMessages(['order' => ['This order has already been checked at the farm gate.']]);
        }

        $claimedGrade = $order->product->quality_grade;
        $gradeSteps = ['A' => 0, 'B' => 1, 'C' => 2];
        $hasClaimedGrade = isset($gradeSteps[$claimedGrade]);
        $gradeDrop = $hasClaimedGrade ? $gradeSteps[$data['actual_grade']] - $gradeSteps[$claimedGrade] : 0;
        $gradeMatches = !$hasClaimedGrade || $data['actual_grade'] === $claimedGrade;
        $shortBy = max(0, $order->quantity_ordered - $data['actual_quantity']);
        $onlyMinorDifference = !$data['heavy_spoilage']
            && $data['freshness_match']
            && $data['packaging_ok']
            && empty($data['damage_note'])
            && (($shortBy === 1 && $gradeMatches) || ($shortBy === 0 && $hasClaimedGrade && $gradeDrop === 1));
        $matches = $shortBy === 0 && $gradeMatches && $data['freshness_match']
            && $data['packaging_ok'] && !$data['heavy_spoilage'] && empty($data['damage_note']);
        $outcome = $matches ? 'verified' : ($onlyMinorDifference ? 'verified_minor' : 'flagged');

        DB::transaction(function () use ($order, $data, $claimedGrade, $gradeMatches, $outcome, $gradeDrop, $workflow) {
            $lockedOrder = Order::lockForUpdate()->findOrFail($order->id);
            if ($lockedOrder->driver_id !== auth()->id() || $lockedOrder->status !== 'processing'
                || $lockedOrder->payment_status !== 'escrow_held' || $lockedOrder->verification()->exists()) {
                throw ValidationException::withMessages(['order' => ['This order is no longer ready for verification.']]);
            }

            $photoPaths = [];
            foreach ($data['photos'] as $photo) {
                $photoPaths[] = $photo->store('verifications/pickup', 'public');
            }

            Verification::create([
                'order_id' => $lockedOrder->id,
                'driver_id' => auth()->id(),
                'claimed_quantity' => $lockedOrder->quantity_ordered,
                'actual_quantity' => $data['actual_quantity'],
                'claimed_grade' => $claimedGrade,
                'actual_grade' => $data['actual_grade'],
                'grade_match' => $gradeMatches,
                'freshness_match' => $data['freshness_match'],
                'damage_note' => $data['damage_note'] ?? null,
                'heavy_spoilage' => $data['heavy_spoilage'],
                'packaging_ok' => $data['packaging_ok'],
                'pickup_photos' => $photoPaths,
                'outcome' => $outcome,
                'notes' => $outcome === 'verified_minor'
                    ? $this->minorDifferenceNote($lockedOrder->quantity_ordered, $data['actual_quantity'], $claimedGrade, $data['actual_grade'])
                    : null,
            ]);

            $updates = ['verification_status' => $outcome];
            if ($outcome === 'verified_minor') {
                $unitPrice = (float) $lockedOrder->product->price;
                $updates['adjusted_price'] = max(
                    0,
                    ($unitPrice * $data['actual_quantity'])
                    - (max(0, $gradeDrop) * (float) config('farmlink.grade_step_discount_per_crate', 5) * $data['actual_quantity'])
                );
            } elseif ($outcome === 'flagged') {
                $updates['flag_deadline_at'] = now()->addMinutes((int) config('farmlink.flag_decision_minutes', 15));
            }

            $lockedOrder->update($updates);
            $workflow->record($lockedOrder, $outcome, [
                'actual_quantity' => $data['actual_quantity'],
                'actual_grade' => $data['actual_grade'],
                'freshness_match' => $data['freshness_match'],
                'damage_note' => $data['damage_note'] ?? null,
                'packaging_ok' => $data['packaging_ok'],
                'pickup_photos' => $photoPaths,
            ]);

            if ($outcome === 'flagged') {
                Notification::create([
                    'user_id' => $lockedOrder->buyer_id,
                    'message' => "Order #{$lockedOrder->id} has a major farm-gate mismatch. The driver will call you; respond within 15 minutes to keep the order moving.",
                    'type' => 'order_update',
                ]);
            }
        });

        return back()->with('message', $outcome === 'flagged'
            ? 'Major mismatch recorded. Keep the load at the farm gate and call the buyer.'
            : 'Farm-gate check saved. Ask the farmer to read the handover code to you.');
    }

    public function handover(Request $request, Order $order, OrderWorkflowService $workflow)
    {
        throw ValidationException::withMessages(['order' => ['Only the assigned driver can confirm handover.']]);
    }

    public function driverHandover(Request $request, Order $order, OrderWorkflowService $workflow)
    {
        $data = $request->validate(['dispatch_code' => ['required', 'regex:/^[0-9]{4}$/']]);

        DB::transaction(function () use ($request, $data, $order, $workflow) {
            $lockedOrder = Order::lockForUpdate()->findOrFail($order->id);
            if ($lockedOrder->driver_id !== $request->user()->id) {
                throw ValidationException::withMessages(['order' => ['Only the assigned driver can confirm handover.']]);
            }
            if ($lockedOrder->status !== 'processing' || $lockedOrder->payment_status !== 'escrow_held'
                || !in_array($lockedOrder->verification_status, ['verified', 'verified_minor', 'flagged'], true)
                || !$lockedOrder->verification()->exists()) {
                throw ValidationException::withMessages(['order' => ['The driver must complete the farm-gate check first.']]);
            }
            if (!hash_equals((string) $lockedOrder->dispatch_code, (string) $data['dispatch_code'])) {
                throw ValidationException::withMessages(['dispatch_code' => ['That handover code is not correct.']]);
            }
            if ($lockedOrder->verification_status === 'flagged' && !$lockedOrder->flag_buyer_confirmed_at) {
                throw ValidationException::withMessages(['order' => ['The buyer must confirm the driver’s recorded decision before this load can leave.']]);
            }

            $lockedOrder->update(['status' => 'in_transit', 'handover_confirmed_at' => now()]);
            $workflow->record($lockedOrder, 'handover_confirmed', ['verification_status' => $lockedOrder->verification_status], $request->user());
            $workflow->record($lockedOrder, 'in_transit', ['verification_status' => $lockedOrder->verification_status], $request->user());
            Notification::create([
                'user_id' => $lockedOrder->buyer_id,
                'message' => "Order #{$lockedOrder->id} has passed the farm-gate checks and is now in transit.",
                'type' => 'order_update',
            ]);
        });

        return back()->with('message', 'Handover confirmed. The load is now in transit.');
    }

    public function logBuyerCall(Order $order, OrderWorkflowService $workflow)
    {
        if ($order->driver_id !== auth()->id() || $order->verification_status !== 'flagged'
            || $order->status !== 'processing' || $order->payment_status !== 'escrow_held'
            || !$order->flag_deadline_at || $order->flag_deadline_at->isPast()) {
            throw ValidationException::withMessages(['order' => ['A buyer call can only be logged for your flagged active order.']]);
        }

        $workflow->record($order, 'buyer_called', ['phone_number' => $order->buyer->phone_number]);

        return back()->with('message', 'Buyer call logged.');
    }

    public function decideFlag(Request $request, Order $order, OrderWorkflowService $workflow)
    {
        $data = $request->validate(['decision' => ['required', 'in:bring,reduce,cancel']]);

        DB::transaction(function () use ($order, $data, $workflow) {
            $lockedOrder = Order::lockForUpdate()->findOrFail($order->id);
            if ($lockedOrder->driver_id !== auth()->id() || $lockedOrder->verification_status !== 'flagged'
                || $lockedOrder->status !== 'processing' || $lockedOrder->payment_status !== 'escrow_held'
                || !$lockedOrder->verification()->exists()) {
                throw ValidationException::withMessages(['order' => ['Only the assigned driver can record a decision for a held load.']]);
            }
            if (!$lockedOrder->events()->where('event', 'buyer_called')->exists()) {
                throw ValidationException::withMessages(['order' => ['Call the buyer before recording a decision.']]);
            }
            if (!$lockedOrder->flag_deadline_at || $lockedOrder->flag_deadline_at->isPast()
                || $lockedOrder->flag_buyer_confirmed_at || $lockedOrder->flag_driver_decision_at) {
                throw ValidationException::withMessages(['order' => ['The 15-minute decision window has ended.']]);
            }

            $lockedOrder->update([
                'flag_decision' => $data['decision'],
                'flag_driver_decision_at' => now(),
            ]);
            $workflow->record($lockedOrder, 'buyer_decision', ['decision' => $data['decision']]);

            if ($data['decision'] === 'cancel') {
                $lockedOrder->update(['flag_decided_at' => now()]);
                $workflow->record($lockedOrder, 'verification_trip_cancelled', ['reason' => 'Driver travelled to farm; flagged load was cancelled.', 'settlement_status' => 'pending']);
                $workflow->refund($lockedOrder, 'Buyer declined the flagged load');
            } else {
                Notification::create([
                    'user_id' => $lockedOrder->buyer_id,
                    'message' => "The driver recorded your choice for Order #{$lockedOrder->id}. Confirm it in My Orders before the 15-minute timer expires.",
                    'type' => 'order_update',
                ]);
            }
        });

        return back()->with('message', 'Decision recorded.');
    }

    public function confirmFlag(Request $request, Order $order, OrderWorkflowService $workflow)
    {
        DB::transaction(function () use ($request, $order, $workflow) {
            $lockedOrder = Order::lockForUpdate()->findOrFail($order->id);
            if ($lockedOrder->buyer_id !== $request->user()->id) {
                throw ValidationException::withMessages(['order' => ['Only the buyer can confirm this decision.']]);
            }
            if ($lockedOrder->status !== 'processing' || $lockedOrder->payment_status !== 'escrow_held'
                || $lockedOrder->verification_status !== 'flagged' || !$lockedOrder->verification()->exists()
                || !in_array($lockedOrder->flag_decision, ['bring', 'reduce'], true)
                || !$lockedOrder->flag_deadline_at || $lockedOrder->flag_deadline_at->isPast()
                || $lockedOrder->flag_buyer_confirmed_at) {
                throw ValidationException::withMessages(['order' => ['There is no active decision waiting for your confirmation.']]);
            }

            $updates = [
                'flag_buyer_confirmed_at' => now(),
                'flag_decided_at' => now(),
            ];
            if ($lockedOrder->flag_decision === 'reduce') {
                $updates['adjusted_price'] = $this->adjustedPrice($lockedOrder);
            }
            $lockedOrder->update($updates);
            $workflow->record($lockedOrder, 'buyer_confirmed_flag_decision', ['decision' => $lockedOrder->flag_decision]);
        });

        return back()->with('message', 'Your decision is confirmed. The driver must still enter the handover code.');
    }

    public function confirmReceived(Request $request, Order $order, OrderWorkflowService $workflow)
    {
        DB::transaction(function () use ($request, $order, $workflow) {
            $lockedOrder = Order::lockForUpdate()->findOrFail($order->id);
            if ($lockedOrder->buyer_id !== $request->user()->id || $lockedOrder->status !== 'in_transit'
                || $lockedOrder->workflow_status !== 'arrived' || $lockedOrder->payment_status !== 'escrow_held'
                || !$lockedOrder->delivery_photo_path || !$lockedOrder->arrived_at || !$lockedOrder->verification()->exists()) {
                throw ValidationException::withMessages(['order' => ['Only the buyer can confirm an order that has arrived.']]);
            }

            $lockedOrder->update([
                'status' => 'delivered',
                'workflow_status' => 'delivered',
                'payment_status' => 'released',
                'buyer_confirmed_at' => now(),
            ]);
            $workflow->record($lockedOrder, 'buyer_confirmed');
            $workflow->record($lockedOrder, 'escrow_released', ['amount' => $lockedOrder->adjusted_price ?? $lockedOrder->total_price]);
            Notification::create([
                'user_id' => $lockedOrder->product->user_id,
                'message' => "The buyer confirmed Order #{$lockedOrder->id}. Escrow has been released.",
                'type' => 'order_update',
            ]);
        });

        return back()->with('message', 'Receipt confirmed. Escrow has been released.');
    }

    private function minorDifferenceNote(int $claimed, int $actual, ?string $claimedGrade, string $actualGrade): string
    {
        $differences = [];
        if ($actual < $claimed) {
            $differences[] = ($claimed - $actual) . ' ' . ($claimed - $actual === 1 ? 'unit' : 'units') . ' short';
        }
        if ($actualGrade !== $claimedGrade) {
            $differences[] = "Grade {$claimedGrade} listed, grade {$actualGrade} checked";
        }

        return implode('; ', $differences);
    }

    private function adjustedPrice(Order $order): float
    {
        $verification = $order->verification;
        $gradeSteps = ['A' => 0, 'B' => 1, 'C' => 2];
        $drop = max(0, $gradeSteps[$verification->actual_grade] - $gradeSteps[$verification->claimed_grade]);
        $count = min($verification->actual_quantity, $verification->claimed_quantity);

        return max(0, ($count * (float) $order->product->price)
            - ($drop * (float) config('farmlink.grade_step_discount_per_crate', 5) * $count));
    }
}
