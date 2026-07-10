<?php

use Illuminate\Support\Facades\Route;

use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\NotificationController;

Route::get('/run-seeder-temp-secure', function () {
    \Illuminate\Support\Facades\DB::table('orders')->delete();
    \Illuminate\Support\Facades\DB::table('products')->delete();
    \Illuminate\Support\Facades\DB::table('users')->delete();
    \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'MarketplaceSeeder']);
    return 'Seeder completed successfully with Cloudinary URLs!';
});

Route::get('/fix-passwords-temp', function () {
    $hash = \Illuminate\Support\Facades\Hash::make('password123');
    $now  = now();

    \Illuminate\Support\Facades\DB::table('users')->delete();

    \Illuminate\Support\Facades\DB::table('users')->insert([
        ['name'=>'Kojo Mensah',    'phone_number'=>'0244111222','password'=>$hash,'role'=>'farmer','location'=>'Takoradi Market Circle','average_rating'=>4.80,'created_at'=>$now,'updated_at'=>$now],
        ['name'=>'Kwesi Appiah',   'phone_number'=>'0244222333','password'=>$hash,'role'=>'farmer','location'=>'Tarkwa',                'average_rating'=>4.50,'created_at'=>$now,'updated_at'=>$now],
        ['name'=>'Ama Serwaa',     'phone_number'=>'0244333444','password'=>$hash,'role'=>'buyer', 'location'=>'Takoradi',             'average_rating'=>0.00,'created_at'=>$now,'updated_at'=>$now],
        ['name'=>'Yaw Boateng',    'phone_number'=>'0244444555','password'=>$hash,'role'=>'buyer', 'location'=>'Tarkwa',               'average_rating'=>0.00,'created_at'=>$now,'updated_at'=>$now],
        ['name'=>'Emmanuel Mensah','phone_number'=>'0244555666','password'=>$hash,'role'=>'driver','location'=>'Takoradi Market Circle','average_rating'=>0.00,'created_at'=>$now,'updated_at'=>$now],
        ['name'=>'Kofi Ansah',     'phone_number'=>'0244666777','password'=>$hash,'role'=>'driver','location'=>'Tarkwa',               'average_rating'=>0.00,'created_at'=>$now,'updated_at'=>$now],
    ]);

    $count = \Illuminate\Support\Facades\DB::table('users')->count();
    return "Done! $count users inserted. Login with 0244111222 / password123";
});

Route::get('/', function () {
    if (auth()->check()) {
        $role = auth()->user()->role;
        if ($role === 'farmer') {
            return redirect()->route('farmer.dashboard');
        } elseif ($role === 'buyer') {
            return redirect()->route('buyer.browse');
        } elseif ($role === 'driver') {
            return redirect()->route('driver.dashboard');
        }
    }
    return Inertia::render('Welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Password Reset
    Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
    Route::post('/forgot-password', [AuthController::class, 'sendResetCode'])->name('password.email');
    Route::get('/reset-password', [AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Settings Routes
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/profile', [SettingsController::class, 'updateProfile'])->name('settings.profile.update');
    Route::post('/settings/password', [SettingsController::class, 'updatePassword'])->name('settings.password.update');

    // Notifications Routes
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.read-all');

    // Farmer Routes
    Route::middleware('role:farmer')->group(function () {
        Route::get('/farmer/dashboard', [ProductController::class, 'farmerDashboard'])->name('farmer.dashboard');
        Route::post('/farmer/products', [ProductController::class, 'store'])->name('products.store');
    });

    // Buyer Routes
    Route::middleware('role:buyer')->group(function () {
        Route::get('/buyer/browse', [ProductController::class, 'buyerBrowse'])->name('buyer.browse');
        Route::post('/buyer/orders', [OrderController::class, 'store'])->name('buyer.orders.store');
        Route::get('/buyer/orders', [OrderController::class, 'index'])->name('buyer.orders.index');
        Route::post('/buyer/orders/{id}/rate', [OrderController::class, 'rateOrder'])->name('buyer.orders.rate');
    });

    // Driver Routes
    Route::middleware('role:driver')->group(function () {
        Route::get('/driver/dashboard', [OrderController::class, 'driverIndex'])->name('driver.dashboard');
        Route::post('/driver/orders/{id}/accept', [OrderController::class, 'acceptDelivery'])->name('driver.orders.accept');
        Route::post('/driver/orders/{id}/complete', [OrderController::class, 'completeDelivery'])->name('driver.orders.complete');
    });
});
