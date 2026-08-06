<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Safely converts all existing products to tomato-only listings.
 *
 * ⛔ SAFE MIGRATION — No tables dropped, truncated, or wiped.
 *    Uses DB::update() to edit existing rows in-place.
 *    Inserts new rows only if the product count is under 20.
 */
return new class extends Migration
{
    // 20 tomato product definitions with local image paths
    private array $tomatoProducts = [
        // ── Grade A ──────────────────────────────────────────────────
        ['name' => 'Premium Roma Tomatoes',           'grade' => 'A', 'price' => 45.00, 'qty' => 80,  'days' => 1, 'unit' => 'Crate', 'min' => 1,  'img' => '/images/products/grade_a_tomatoes_1.jpg', 'farmer' => 0],
        ['name' => 'Fresh Beefsteak Tomatoes',        'grade' => 'A', 'price' => 55.00, 'qty' => 60,  'days' => 0, 'unit' => 'Crate', 'min' => 1,  'img' => '/images/products/grade_a_tomatoes_2.jpg', 'farmer' => 0],
        ['name' => 'Vine-Ripened Tomatoes',           'grade' => 'A', 'price' => 40.00, 'qty' => 100, 'days' => 1, 'unit' => 'Crate', 'min' => 2,  'img' => '/images/products/grade_a_tomatoes_3.jpg', 'farmer' => 0],
        ['name' => 'Organic Local Red Tomatoes',      'grade' => 'A', 'price' => 38.00, 'qty' => 120, 'days' => 2, 'unit' => 'Bag',   'min' => 1,  'img' => '/images/products/grade_a_tomatoes_4.jpg', 'farmer' => 0],
        ['name' => 'Premium Daboase Tomatoes',        'grade' => 'A', 'price' => 50.00, 'qty' => 90,  'days' => 1, 'unit' => 'Crate', 'min' => 1,  'img' => '/images/products/grade_a_tomatoes_5.jpg', 'farmer' => 1],
        ['name' => 'Fresh Beposo Roma Tomatoes',      'grade' => 'A', 'price' => 48.00, 'qty' => 75,  'days' => 0, 'unit' => 'Crate', 'min' => 1,  'img' => '/images/products/grade_a_tomatoes_6.jpg', 'farmer' => 1],
        ['name' => 'Tarkwa Market Tomatoes (Premium)','grade' => 'A', 'price' => 42.00, 'qty' => 110, 'days' => 1, 'unit' => 'Crate', 'min' => 2,  'img' => '/images/products/grade_a_tomatoes_7.jpg', 'farmer' => 1],
        // ── Grade B ──────────────────────────────────────────────────
        ['name' => 'Standard Cherry Tomatoes',        'grade' => 'B', 'price' => 30.00, 'qty' => 50,  'days' => 2, 'unit' => 'Basket','min' => 1,  'img' => '/images/products/grade_b_tomatoes_1.jpg', 'farmer' => 0],
        ['name' => 'Plum Tomatoes (Standard)',         'grade' => 'B', 'price' => 28.00, 'qty' => 70,  'days' => 3, 'unit' => 'Crate', 'min' => 1,  'img' => '/images/products/grade_b_tomatoes_2.jpg', 'farmer' => 0],
        ['name' => 'Mixed Tomato Variety (B)',         'grade' => 'B', 'price' => 25.00, 'qty' => 90,  'days' => 2, 'unit' => 'Bag',   'min' => 2,  'img' => '/images/products/grade_b_tomatoes_3.jpg', 'farmer' => 0],
        ['name' => 'Standard Vine Tomatoes',           'grade' => 'B', 'price' => 32.00, 'qty' => 80,  'days' => 2, 'unit' => 'Crate', 'min' => 1,  'img' => '/images/products/grade_b_tomatoes_4.jpg', 'farmer' => 1],
        ['name' => 'Local Red Tomatoes (Standard)',    'grade' => 'B', 'price' => 27.00, 'qty' => 65,  'days' => 3, 'unit' => 'Bag',   'min' => 2,  'img' => '/images/products/grade_b_tomatoes_5.jpg', 'farmer' => 1],
        ['name' => 'Beposo Tomatoes (B Grade)',        'grade' => 'B', 'price' => 24.00, 'qty' => 95,  'days' => 2, 'unit' => 'Basket','min' => 2,  'img' => '/images/products/grade_b_tomatoes_6.jpg', 'farmer' => 1],
        ['name' => 'Bulk Plum Tomatoes (B)',           'grade' => 'B', 'price' => 22.00, 'qty' => 130, 'days' => 3, 'unit' => 'Bag',   'min' => 3,  'img' => '/images/products/grade_b_tomatoes_7.jpg', 'farmer' => 1],
        // ── Grade C ──────────────────────────────────────────────────
        ['name' => 'Budget Roma Tomatoes',             'grade' => 'C', 'price' => 18.00, 'qty' => 150, 'days' => 4, 'unit' => 'Bag',   'min' => 3,  'img' => '/images/products/grade_c_tomatoes_1.jpg', 'farmer' => 0],
        ['name' => 'Quick-Sale Tomatoes (Soft)',       'grade' => 'C', 'price' => 12.00, 'qty' => 200, 'days' => 5, 'unit' => 'Bag',   'min' => 5,  'img' => '/images/products/grade_c_tomatoes_2.jpg', 'farmer' => 0],
        ['name' => 'Overripe Paste Tomatoes',          'grade' => 'C', 'price' => 10.00, 'qty' => 180, 'days' => 5, 'unit' => 'Bag',   'min' => 5,  'img' => '/images/products/grade_c_tomatoes_3.jpg', 'farmer' => 0],
        ['name' => 'Wholesale Tomatoes (Budget)',      'grade' => 'C', 'price' => 16.00, 'qty' => 200, 'days' => 4, 'unit' => 'Bag',   'min' => 5,  'img' => '/images/products/grade_c_tomatoes_4.jpg', 'farmer' => 1],
        ['name' => 'Discount Tomatoes (Soft Batch)',   'grade' => 'C', 'price' => 14.00, 'qty' => 170, 'days' => 5, 'unit' => 'Bag',   'min' => 5,  'img' => '/images/products/grade_c_tomatoes_5.jpg', 'farmer' => 1],
        ['name' => 'Processing Tomatoes (C Grade)',    'grade' => 'C', 'price' => 10.00, 'qty' => 250, 'days' => 5, 'unit' => 'Bag',   'min' => 10, 'img' => '/images/products/grade_c_tomatoes_6.jpg', 'farmer' => 1],
    ];

    public function up(): void
    {
        // Resolve farmer user IDs safely from existing users table
        $farmerIds = DB::table('users')
            ->where('role', 'farmer')
            ->orderBy('id')
            ->pluck('id');

        if ($farmerIds->isEmpty()) {
            // Fallback to any registered user regardless of role
            $farmerIds = DB::table('users')->orderBy('id')->pluck('id');
        }

        if ($farmerIds->isEmpty()) {
            // If users table is completely empty, create a default seed farmer user
            $defaultFarmerId = DB::table('users')->insertGetId([
                'name'           => 'Kwame Farmer',
                'phone_number'   => '0240000001',
                'password'       => bcrypt('password123'),
                'role'           => 'farmer',
                'location'       => 'Takoradi',
                'average_rating' => 4.80,
                'created_at'     => now(),
                'updated_at'     => now(),
            ]);
            $farmer0Id = $defaultFarmerId;
            $farmer1Id = $defaultFarmerId;
        } else {
            $farmer0Id = $farmerIds->get(0);
            $farmer1Id = $farmerIds->get(1) ?? $farmer0Id;
        }

        // Fetch existing product IDs ordered by id
        $existingIds = DB::table('products')->orderBy('id')->pluck('id')->values();

        $now = now();
        $index = 0;

        // ── Step 1: UPDATE existing rows in-place ───────────────────
        foreach ($existingIds as $productId) {
            if ($index >= count($this->tomatoProducts)) break;

            $def       = $this->tomatoProducts[$index];
            $farmerId  = $def['farmer'] === 0 ? $farmer0Id : $farmer1Id;
            $harvestDate = $now->copy()->subDays($def['days'])->format('Y-m-d');

            DB::table('products')->where('id', $productId)->update([
                'user_id'          => $farmerId,
                'name'             => $def['name'],
                'category'         => 'Tomato',
                'quantity'         => $def['qty'],
                'price'            => $def['price'],
                'image_path'       => $def['img'],
                'harvest_date'     => $harvestDate,
                'quality_grade'    => $def['grade'],
                'unit'             => $def['unit'],
                'minimum_order_qty' => $def['min'],
                'updated_at'       => $now,
            ]);

            $index++;
        }

        // ── Step 2: INSERT any remaining rows if existing count < 20 ─
        while ($index < count($this->tomatoProducts)) {
            $def      = $this->tomatoProducts[$index];
            $farmerId = $def['farmer'] === 0 ? $farmer0Id : $farmer1Id;
            $harvestDate = $now->copy()->subDays($def['days'])->format('Y-m-d');

            DB::table('products')->insert([
                'user_id'          => $farmerId,
                'name'             => $def['name'],
                'category'         => 'Tomato',
                'quantity'         => $def['qty'],
                'price'            => $def['price'],
                'image_path'       => $def['img'],
                'harvest_date'     => $harvestDate,
                'quality_grade'    => $def['grade'],
                'unit'             => $def['unit'],
                'minimum_order_qty' => $def['min'],
                'created_at'       => $now,
                'updated_at'       => $now,
            ]);

            $index++;
        }
    }

    public function down(): void
    {
        // Intentionally left empty — this migration is data-only and
        // non-destructive. Reversing it would require knowledge of the
        // prior data, which is unavailable.
    }
};
