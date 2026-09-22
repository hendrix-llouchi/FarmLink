<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class SettingsController extends Controller
{
    /**
     * Display settings page.
     */
    public function index()
    {
        return Inertia::render('Settings', [
            'user' => auth()->user(),
        ]);
    }

    /**
     * Update profile details.
     */
    public function updateProfile(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20', 'unique:users,phone_number,' . $user->id],
            'location' => ['required', 'string', 'max:255'],
        ]);

        $user->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'location' => $request->location,
        ]);

        return redirect()->back()->with('message', 'Profile updated successfully!');
    }

    /**
     * Update user password.
     * Invalidates all other active sessions after a successful password change.
     */
    public function updatePassword(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'The provided password does not match your current password.',
            ]);
        }

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        // Invalidate all other active sessions (e.g. stolen session on another device)
        Auth::logoutOtherDevices($request->password);

        return redirect()->back()->with('message', 'Password updated successfully! All other sessions have been signed out.');
    }
}
