<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Show the farmer dashboard.
     */
    public function farmerDashboard(Request $request)
    {
        $farmerId = auth()->id();

        // Fetch farmer's own products
        $products = Product::where('user_id', $farmerId)
            ->latest()
            ->get();

        // Calculate dashboard metrics
        $activeListings = Product::where('user_id', $farmerId)
            ->where('quantity', '>', 0)
            ->count();

        // Count pending orders for the farmer's products
        $pendingOrders = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->where('products.user_id', $farmerId)
            ->where('orders.status', 'pending')
            ->count();

        // Count completed deliveries (driver or general status)
        $completedDeliveries = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->where('products.user_id', $farmerId)
            ->where('orders.status', 'delivered')
            ->count();

        return Inertia::render('FarmerDashboard', [
            'products' => $products,
            'metrics' => [
                'active_listings' => $activeListings,
                'pending_orders' => $pendingOrders,
                'completed_deliveries' => $completedDeliveries,
                'average_rating' => (float) auth()->user()->average_rating,
            ]
        ]);
    }

    /**
     * Store a new produce listing.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'in:Vegetable,Leafy Green,Root/Tuber,Other'],
            'quantity' => ['required', 'integer', 'min:1'],
            'price' => ['required', 'numeric', 'min:0.01'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'user_id' => auth()->id(),
            'name' => $request->name,
            'category' => $request->category,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'image_path' => $imagePath,
        ]);

        return redirect()->route('farmer.dashboard')->with('message', 'Listing created successfully!');
    }

    /**
     * Show the buyer browse listings screen.
     */
    public function buyerBrowse(Request $request)
    {
        $query = Product::with('user');

        // Apply filters
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('location')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('location', 'like', '%' . $request->location . '%');
            });
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->latest()->get();

        return Inertia::render('BuyerBrowse', [
            'products' => $products,
            'filters' => $request->only(['category', 'location', 'search']),
        ]);
    }
}
