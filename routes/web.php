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

Route::get('/debug-db', function () {
    $users    = \Illuminate\Support\Facades\DB::table('users')->select('id','name','phone_number','role')->get();
    $products = \Illuminate\Support\Facades\DB::table('products')->select('id','user_id','name')->get();
    return response()->json(['users' => $users, 'products' => $products]);
});

Route::get('/fix-passwords-temp', function () {
    $hash = \Illuminate\Support\Facades\Hash::make('password123');
    $now  = now();

    \Illuminate\Support\Facades\DB::table('orders')->delete();
    \Illuminate\Support\Facades\DB::table('products')->delete();
    \Illuminate\Support\Facades\DB::table('users')->delete();

    \Illuminate\Support\Facades\DB::table('users')->insert([
        ['name'=>'Kojo Mensah',    'phone_number'=>'0244111222','password'=>$hash,'role'=>'farmer','location'=>'Takoradi Market Circle','average_rating'=>4.80,'created_at'=>$now,'updated_at'=>$now],
        ['name'=>'Kwesi Appiah',   'phone_number'=>'0244222333','password'=>$hash,'role'=>'farmer','location'=>'Tarkwa',                'average_rating'=>4.50,'created_at'=>$now,'updated_at'=>$now],
        ['name'=>'Ama Serwaa',     'phone_number'=>'0244333444','password'=>$hash,'role'=>'buyer', 'location'=>'Takoradi',             'average_rating'=>0.00,'created_at'=>$now,'updated_at'=>$now],
        ['name'=>'Yaw Boateng',    'phone_number'=>'0244444555','password'=>$hash,'role'=>'buyer', 'location'=>'Tarkwa',               'average_rating'=>0.00,'created_at'=>$now,'updated_at'=>$now],
        ['name'=>'Emmanuel Mensah','phone_number'=>'0244555666','password'=>$hash,'role'=>'driver','location'=>'Takoradi Market Circle','average_rating'=>0.00,'created_at'=>$now,'updated_at'=>$now],
        ['name'=>'Kofi Ansah',     'phone_number'=>'0244666777','password'=>$hash,'role'=>'driver','location'=>'Tarkwa',               'average_rating'=>0.00,'created_at'=>$now,'updated_at'=>$now],
    ]);

    $kojo  = \Illuminate\Support\Facades\DB::table('users')->where('phone_number','0244111222')->value('id');
    $kwesi = \Illuminate\Support\Facades\DB::table('users')->where('phone_number','0244222333')->value('id');

    \Illuminate\Support\Facades\DB::table('products')->insert([
        ['user_id'=>$kojo, 'name'=>'Fresh Habanero Pepper',  'category'=>'Vegetable',   'quantity'=>50, 'price'=>15.00, 'image_path'=>'https://res.cloudinary.com/ecbxhk3w/image/upload/v1783640442/farmlink/products/lzph1vevp9lipswfinqr.jpg','created_at'=>$now,'updated_at'=>$now],
        ['user_id'=>$kojo, 'name'=>'Fresh Tomatoes',         'category'=>'Vegetable',   'quantity'=>100,'price'=>25.00, 'image_path'=>'https://res.cloudinary.com/ecbxhk3w/image/upload/v1783640523/farmlink/products/nezb33oppjmh3kxw3byg.jpg','created_at'=>$now,'updated_at'=>$now],
        ['user_id'=>$kojo, 'name'=>'Garden Eggs',            'category'=>'Vegetable',   'quantity'=>40, 'price'=>12.00, 'image_path'=>'https://res.cloudinary.com/ecbxhk3w/image/upload/v1783640420/farmlink/products/yinpnwbpaowgfnsxbip0.jpg','created_at'=>$now,'updated_at'=>$now],
        ['user_id'=>$kojo, 'name'=>'Kontomire (Taro Leaves)','category'=>'Leafy Green', 'quantity'=>80, 'price'=>8.00,  'image_path'=>'https://res.cloudinary.com/ecbxhk3w/image/upload/v1783640452/farmlink/products/js6sss7rxva2blmzcsbg.jpg','created_at'=>$now,'updated_at'=>$now],
        ['user_id'=>$kojo, 'name'=>'Cabbage Heads',          'category'=>'Vegetable',   'quantity'=>35, 'price'=>15.00, 'image_path'=>'https://res.cloudinary.com/ecbxhk3w/image/upload/v1783640398/farmlink/products/sample_cabbage.jpg','created_at'=>$now,'updated_at'=>$now],
        ['user_id'=>$kwesi,'name'=>'Cassava Sacks',          'category'=>'Root/Tuber',  'quantity'=>20, 'price'=>120.00,'image_path'=>'https://res.cloudinary.com/ecbxhk3w/image/upload/v1783640411/farmlink/products/wwtlqffgg7gmustawwvz.jpg','created_at'=>$now,'updated_at'=>$now],
        ['user_id'=>$kwesi,'name'=>'White Yam',              'category'=>'Root/Tuber',  'quantity'=>30, 'price'=>45.00, 'image_path'=>'https://res.cloudinary.com/ecbxhk3w/image/upload/v1783640531/farmlink/products/hax4ri16u3iss1pxlhj3.jpg','created_at'=>$now,'updated_at'=>$now],
        ['user_id'=>$kwesi,'name'=>'Green Plantain',         'category'=>'Other',       'quantity'=>15, 'price'=>35.00, 'image_path'=>'https://res.cloudinary.com/ecbxhk3w/image/upload/v1783640509/farmlink/products/of0yj2pn0rgadrsvtzqe.jpg','created_at'=>$now,'updated_at'=>$now],
        ['user_id'=>$kwesi,'name'=>'Scotch Bonnet Pepper',   'category'=>'Vegetable',   'quantity'=>60, 'price'=>18.00, 'image_path'=>'https://res.cloudinary.com/ecbxhk3w/image/upload/v1783640478/farmlink/products/cdwin6xxdclixdajy2sq.jpg','created_at'=>$now,'updated_at'=>$now],
        ['user_id'=>$kwesi,'name'=>'Sweet Potatoes',         'category'=>'Root/Tuber',  'quantity'=>25, 'price'=>30.00, 'image_path'=>'https://res.cloudinary.com/ecbxhk3w/image/upload/v1783640519/farmlink/products/pj5lxspgp9rhj22vrrbx.jpg','created_at'=>$now,'updated_at'=>$now],
    ]);

    $users    = \Illuminate\Support\Facades\DB::table('users')->count();
    $products = \Illuminate\Support\Facades\DB::table('products')->count();
    return "Done! $users users + $products products inserted. Login with 0244111222 / password123";
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
