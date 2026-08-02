<?php

namespace App\Http\Controllers;

use App\Models\Product;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
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

        // Calculate total revenue (only summing orders where payment_status is 'released')
        $totalRevenue = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->where('products.user_id', $farmerId)
            ->where('orders.payment_status', 'released')
            ->sum('orders.total_price');

        // Fetch actual pending orders for the dashboard
        $pendingOrdersList = \App\Models\Order::whereHas('product', function ($query) use ($farmerId) {
            $query->where('user_id', $farmerId);
        })
        ->where('orders.status', 'pending')
        ->with(['buyer', 'product'])
        ->latest()
        ->get();

        return Inertia::render('FarmerDashboard', [
            'products' => $products,
            'pendingOrders' => $pendingOrdersList,
            'metrics' => [
                'active_listings' => $activeListings,
                'pending_orders' => $pendingOrders,
                'completed_deliveries' => $completedDeliveries,
                'average_rating' => (float) auth()->user()->average_rating,
                'total_revenue' => (float) $totalRevenue,
            ]
        ]);
    }

    /**
     * Store a new produce listing.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'category'          => ['required', 'string', 'in:Vegetable,Leafy Green,Root/Tuber,Other'],
            'quantity'          => ['required', 'integer', 'min:1'],
            'price'             => ['required', 'numeric', 'min:0.01'],
            'image'             => ['required', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'harvest_date'      => ['nullable', 'date'],
            'quality_grade'     => ['nullable', 'string', 'in:A,B,C'],
            'unit'              => ['nullable', 'string', 'max:50'],
            'minimum_order_qty' => ['nullable', 'integer', 'min:1'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $uploaded = Cloudinary::upload($request->file('image')->getRealPath(), [
                'folder' => 'farmlink/products',
                'transformation' => [
                    'quality' => 'auto',
                    'fetch_format' => 'auto',
                ],
            ]);
            $imagePath = $uploaded->getSecurePath();
        }

        Product::create([
            'user_id'           => auth()->id(),
            'name'              => $request->name,
            'category'          => $request->category,
            'quantity'          => $request->quantity,
            'price'             => $request->price,
            'image_path'        => $imagePath,
            'harvest_date'      => $request->harvest_date,
            'quality_grade'     => $request->quality_grade ?? 'A',
            'unit'              => $request->unit ?? 'Crate',
            'minimum_order_qty' => $request->minimum_order_qty ?? 1,
        ]);

        return redirect()->route('farmer.dashboard')->with('message', 'Listing created successfully!');
    }

    /**
     * Update an existing product listing.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        if ($product->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'name'              => ['required', 'string', 'max:255'],
            'category'          => ['required', 'string', 'in:Vegetable,Leafy Green,Root/Tuber,Other'],
            'quantity'          => ['required', 'integer', 'min:1'],
            'price'             => ['required', 'numeric', 'min:0.01'],
            'image'             => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'harvest_date'      => ['nullable', 'date'],
            'quality_grade'     => ['nullable', 'string', 'in:A,B,C'],
            'unit'              => ['nullable', 'string', 'max:50'],
            'minimum_order_qty' => ['nullable', 'integer', 'min:1'],
        ]);

        $updateData = [
            'name'              => $request->name,
            'category'          => $request->category,
            'quantity'          => $request->quantity,
            'price'             => $request->price,
            'harvest_date'      => $request->harvest_date ?? null,
            'quality_grade'     => $request->filled('quality_grade') ? $request->quality_grade : $product->quality_grade,
            'unit'              => $request->filled('unit') ? $request->unit : $product->unit,
            'minimum_order_qty' => $request->filled('minimum_order_qty') ? $request->minimum_order_qty : $product->minimum_order_qty,
        ];

        if ($request->hasFile('image')) {
            $uploaded = \CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary::upload($request->file('image')->getRealPath(), [
                'folder' => 'farmlink/products',
                'transformation' => [
                    'quality' => 'auto',
                    'fetch_format' => 'auto',
                ],
            ]);
            $updateData['image_path'] = $uploaded->getSecurePath();
        }

        $product->update($updateData);

        return redirect()->route('farmer.dashboard')->with('message', 'Listing updated successfully!');
    }

    /**
     * Remove the specified product listing.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $product->delete();

        return redirect()->route('farmer.dashboard')->with('message', 'Listing deleted successfully!');
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

        // Phase 2: Filter by quality grade
        if ($request->filled('quality_grade')) {
            $query->where('quality_grade', $request->quality_grade);
        }

        // Phase 2: Compute days_since_harvest for each product
        $products = $query->latest()->get()->map(function ($product) {
            $product->days_since_harvest = $product->harvest_date
                ? now()->startOfDay()->diffInDays(\Carbon\Carbon::parse($product->harvest_date)->startOfDay())
                : null;
            return $product;
        });

        return Inertia::render('BuyerBrowse', [
            'products' => $products,
            'filters'  => $request->only(['category', 'location', 'search', 'quality_grade']),
        ]);
    }
}
