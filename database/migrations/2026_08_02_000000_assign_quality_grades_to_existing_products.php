<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Product;
use Illuminate\Support\Carbon;

return new class extends Migration
{
    /**
     * Assign random quality grades and harvest dates to existing products lacking quality_grade.
     */
    public function up(): void
    {
        $grades = ['A', 'B', 'C'];
        $units = ['Crate', 'Bag', 'Kg', 'Basket'];

        $products = Product::whereNull('quality_grade')->get();

        foreach ($products as $index => $product) {
            $product->update([
                'quality_grade'     => $grades[$index % count($grades)],
                'harvest_date'      => $product->harvest_date ?? Carbon::now()->subDays(rand(1, 4))->format('Y-m-d'),
                'unit'              => $product->unit ?? $units[$index % count($units)],
                'minimum_order_qty' => $product->minimum_order_qty ?? rand(1, 5),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No destructive reverse operation
    }
};
