<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderEvent;
use App\Models\User;
use App\Services\OrderWorkflowService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['product.user', 'buyer', 'driver', 'verification', 'events.actor'])->latest();
        foreach (['status', 'verification_status', 'payment_status'] as $filter) {
            if ($request->filled($filter)) $query->where($filter, $request->string($filter));
        }
        if ($request->filled('search')) {
            $term = $request->string('search');
            $query->where(function ($q) use ($term) {
                $q->whereHas('product.user', fn ($x) => $x->where('name', 'like', "%{$term}%"))
                    ->orWhereHas('buyer', fn ($x) => $x->where('name', 'like', "%{$term}%"))
                    ->orWhereHas('driver', fn ($x) => $x->where('name', 'like', "%{$term}%"));
            });
        }
        $orders = $query->paginate(30)->withQueryString();
        $users = User::whereIn('role', ['farmer', 'buyer', 'driver'])->withCount('orders')->latest()->get();
        $stats = [
            'total' => Order::count(),
            'held' => Order::where('payment_status', 'escrow_held')->count(),
            'flagged' => Order::where('verification_status', 'flagged')->where('status', 'processing')->count(),
            'in_transit' => Order::where('status', 'in_transit')->count(),
            'released' => Order::where('payment_status', 'released')->count(),
            'held_amount' => (float) Order::where('payment_status', 'escrow_held')->sum(DB::raw('COALESCE(adjusted_price, total_price)')),
            'released_amount' => (float) Order::where('payment_status', 'released')->sum(DB::raw('COALESCE(adjusted_price, total_price)')),
        ];
        return Inertia::render('AdminDashboard', compact('orders', 'users', 'stats'));
    }

    public function suspend(Request $request, User $user, OrderWorkflowService $workflow)
    {
        $data = $request->validate(['reason' => ['required', 'string', 'max:500'], 'suspended' => ['required', 'boolean']]);
        $user->update(['suspended_at' => $data['suspended'] ? now() : null]);
        $order = Order::where(function ($q) use ($user) {
            $q->where('buyer_id', $user->id)->orWhere('driver_id', $user->id)
                ->orWhereHas('product', fn ($p) => $p->where('user_id', $user->id));
        })->latest()->first();
        if ($order) {
            OrderEvent::create(['order_id' => $order->id, 'actor_id' => auth()->id(), 'actor_role' => 'admin', 'event' => $data['suspended'] ? 'user_suspended' : 'user_reactivated', 'details' => ['user_id' => $user->id, 'reason' => $data['reason']]]);
        }
        return back()->with('message', $data['suspended'] ? 'User suspended.' : 'User reactivated.');
    }
}
