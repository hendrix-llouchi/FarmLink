<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NotificationController extends Controller
{
    /**
     * Display notifications list.
     */
    public function index()
    {
        $notifications = auth()->user()->notifications()
            ->latest()
            ->get();

        return Inertia::render('Notifications', [
            'notifications' => $notifications,
        ]);
    }

    /**
     * Mark a specific notification as read.
     */
    public function markAsRead(Request $request, $id)
    {
        $notification = auth()->user()->notifications()->findOrFail($id);
        
        $notification->update([
            'read_at' => now(),
        ]);

        return redirect()->back()->with('message', 'Notification marked as read.');
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead(Request $request)
    {
        auth()->user()->notifications()
            ->whereNull('read_at')
            ->update([
                'read_at' => now(),
            ]);

        return redirect()->back()->with('message', 'All notifications marked as read.');
    }
}
