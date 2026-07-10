<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class AuthController extends Controller
{
    /**
     * Show the registration view.
     */
    public function showRegister()
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:20', 'unique:users,phone_number'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role' => ['required', 'string', 'in:farmer,buyer,driver'],
            'location' => ['required', 'string', 'max:255'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'location' => $request->location,
            'average_rating' => 0.00,
        ]);

        Auth::login($user);

        return redirect()->route('home')->with('message', 'Registration successful!');
    }

    /**
     * Show the login view.
     */
    public function showLogin()
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => true,
            'status'           => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'phone_number' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('home')->with('message', 'Logged in successfully!');
        }

        throw ValidationException::withMessages([
            'phone_number' => __('The provided credentials do not match our records.'),
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('message', 'Logged out successfully!');
    }

    // ─────────────────────────────────────────────────────────
    // Password Reset (phone-number based, no SMS required)
    // ─────────────────────────────────────────────────────────

    /**
     * Show the forgot password form.
     */
    public function showForgotPassword()
    {
        return Inertia::render('Auth/ForgotPassword');
    }

    /**
     * Generate and store a 6-digit reset code for the given phone number.
     * The code is shown directly on screen (demo/offline mode — no SMS).
     */
    public function sendResetCode(Request $request)
    {
        $request->validate([
            'phone_number' => ['required', 'string'],
        ]);

        $user = User::where('phone_number', $request->phone_number)->first();

        if (! $user) {
            throw ValidationException::withMessages([
                'phone_number' => 'No account found with this phone number.',
            ]);
        }

        // Generate a 6-digit numeric code
        $code = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);

        $user->update([
            'reset_token'            => $code,
            'reset_token_expires_at' => now()->addMinutes(15),
        ]);

        // In production this would be sent via SMS.
        // For demo: return the code in the session status so the UI can show it.
        return back()->with(
            'status',
            "Your reset code is: {$code}. It expires in 15 minutes."
        );
    }

    /**
     * Show the reset password form.
     */
    public function showResetPassword(Request $request)
    {
        return Inertia::render('Auth/ResetPassword', [
            'phone' => $request->query('phone', ''),
        ]);
    }

    /**
     * Validate the reset code and update the user's password.
     */
    public function resetPassword(Request $request)
    {
        $request->validate([
            'phone_number'          => ['required', 'string'],
            'token'                 => ['required', 'string', 'size:6'],
            'password'              => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = User::where('phone_number', $request->phone_number)
                    ->where('reset_token', $request->token)
                    ->first();

        if (! $user) {
            throw ValidationException::withMessages([
                'token' => 'Invalid reset code. Please check and try again.',
            ]);
        }

        if ($user->reset_token_expires_at->isPast()) {
            throw ValidationException::withMessages([
                'token' => 'This reset code has expired. Please request a new one.',
            ]);
        }

        $user->update([
            'password'               => Hash::make($request->password),
            'reset_token'            => null,
            'reset_token_expires_at' => null,
        ]);

        return redirect()->route('login')->with(
            'status',
            'Password reset successfully. You can now log in.'
        );
    }
}
