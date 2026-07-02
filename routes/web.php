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

Route::get('/', function () {
    if (auth()->check()) {
        $role = auth()->user()->role;
        if ($role === 'farmer') {
            return redirect()->route('farmer.dashboard');
        } elseif ($role === 'buyer') {
            return redirect()->route('buyer.browse');
        }
    }
    return Inertia::render('Welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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
    });
});
