<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;

class MarketplaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Tomato-only marketplace — 20 listings distributed across 2 farmers.
     */
    public function run(): void
    {
        // 1. Create Farmer Users
        $kojo = User::create([
            'name' => 'Kojo Mensah',
            'phone_number' => '0244111222',
            'password' => bcrypt('password123'),
            'role' => 'farmer',
            'location' => 'Takoradi Market Circle',
            'average_rating' => 4.80,
        ]);

        $kwesi = User::create([
            'name' => 'Kwesi Appiah',
            'phone_number' => '0244222333',
            'password' => bcrypt('password123'),
            'role' => 'farmer',
            'location' => 'Tarkwa',
            'average_rating' => 4.50,
        ]);

        // 2. Create Buyer Users
        $ama = User::create([
            'name' => 'Ama Serwaa',
            'phone_number' => '0244333444',
            'password' => bcrypt('password123'),
            'role' => 'buyer',
            'location' => 'Takoradi',
            'average_rating' => 0.00,
        ]);

        $yaw = User::create([
            'name' => 'Yaw Boateng',
            'phone_number' => '0244444555',
            'password' => bcrypt('password123'),
            'role' => 'buyer',
            'location' => 'Tarkwa',
            'average_rating' => 0.00,
        ]);

        // 3. Create Driver Users
        $emmanuel = User::create([
            'name' => 'Emmanuel Mensah',
            'phone_number' => '0244555666',
            'password' => bcrypt('password123'),
            'role' => 'driver',
            'location' => 'Takoradi Market Circle',
            'average_rating' => 0.00,
        ]);

        $kofi = User::create([
            'name' => 'Kofi Ansah',
            'phone_number' => '0244666777',
            'password' => bcrypt('password123'),
            'role' => 'driver',
            'location' => 'Tarkwa',
            'average_rating' => 0.00,
        ]);

        // 4. Seed Tomato Products — 20 listings (10 per farmer)
        // ─── Farmer 1 (Kojo Mensah) — 10 listings ───────────────────────────

        Product::create([
            'user_id'          => $kojo->id,
            'name'             => 'Premium Roma Tomatoes',
            'category'         => 'Tomato',
            'quantity'         => 80,
            'price'            => 45.00,
            'image_path'       => '/images/products/grade_a_tomatoes_1.jpg',
            'harvest_date'     => now()->subDays(1)->format('Y-m-d'),
            'quality_grade'    => 'A',
            'unit'             => 'Crate',
            'minimum_order_qty' => 1,
        ]);

        Product::create([
            'user_id'          => $kojo->id,
            'name'             => 'Fresh Beefsteak Tomatoes',
            'category'         => 'Tomato',
            'quantity'         => 60,
            'price'            => 55.00,
            'image_path'       => '/images/products/grade_a_tomatoes_2.jpg',
            'harvest_date'     => now()->subDays(0)->format('Y-m-d'),
            'quality_grade'    => 'A',
            'unit'             => 'Crate',
            'minimum_order_qty' => 1,
        ]);

        Product::create([
            'user_id'          => $kojo->id,
            'name'             => 'Vine-Ripened Tomatoes',
            'category'         => 'Tomato',
            'quantity'         => 100,
            'price'            => 40.00,
            'image_path'       => '/images/products/grade_a_tomatoes_3.jpg',
            'harvest_date'     => now()->subDays(1)->format('Y-m-d'),
            'quality_grade'    => 'A',
            'unit'             => 'Crate',
            'minimum_order_qty' => 2,
        ]);

        Product::create([
            'user_id'          => $kojo->id,
            'name'             => 'Organic Local Red Tomatoes',
            'category'         => 'Tomato',
            'quantity'         => 120,
            'price'            => 38.00,
            'image_path'       => '/images/products/grade_a_tomatoes_4.jpg',
            'harvest_date'     => now()->subDays(2)->format('Y-m-d'),
            'quality_grade'    => 'A',
            'unit'             => 'Bag',
            'minimum_order_qty' => 1,
        ]);

        Product::create([
            'user_id'          => $kojo->id,
            'name'             => 'Standard Cherry Tomatoes',
            'category'         => 'Tomato',
            'quantity'         => 50,
            'price'            => 30.00,
            'image_path'       => '/images/products/grade_b_tomatoes_1.jpg',
            'harvest_date'     => now()->subDays(2)->format('Y-m-d'),
            'quality_grade'    => 'B',
            'unit'             => 'Basket',
            'minimum_order_qty' => 1,
        ]);

        Product::create([
            'user_id'          => $kojo->id,
            'name'             => 'Plum Tomatoes (Standard)',
            'category'         => 'Tomato',
            'quantity'         => 70,
            'price'            => 28.00,
            'image_path'       => '/images/products/grade_b_tomatoes_2.jpg',
            'harvest_date'     => now()->subDays(3)->format('Y-m-d'),
            'quality_grade'    => 'B',
            'unit'             => 'Crate',
            'minimum_order_qty' => 1,
        ]);

        Product::create([
            'user_id'          => $kojo->id,
            'name'             => 'Mixed Tomato Variety (B)',
            'category'         => 'Tomato',
            'quantity'         => 90,
            'price'            => 25.00,
            'image_path'       => '/images/products/grade_b_tomatoes_3.jpg',
            'harvest_date'     => now()->subDays(2)->format('Y-m-d'),
            'quality_grade'    => 'B',
            'unit'             => 'Bag',
            'minimum_order_qty' => 2,
        ]);

        Product::create([
            'user_id'          => $kojo->id,
            'name'             => 'Budget Roma Tomatoes',
            'category'         => 'Tomato',
            'quantity'         => 150,
            'price'            => 18.00,
            'image_path'       => '/images/products/grade_c_tomatoes_1.jpg',
            'harvest_date'     => now()->subDays(4)->format('Y-m-d'),
            'quality_grade'    => 'C',
            'unit'             => 'Bag',
            'minimum_order_qty' => 3,
        ]);

        Product::create([
            'user_id'          => $kojo->id,
            'name'             => 'Quick-Sale Tomatoes (Soft)',
            'category'         => 'Tomato',
            'quantity'         => 200,
            'price'            => 12.00,
            'image_path'       => '/images/products/grade_c_tomatoes_2.jpg',
            'harvest_date'     => now()->subDays(5)->format('Y-m-d'),
            'quality_grade'    => 'C',
            'unit'             => 'Bag',
            'minimum_order_qty' => 5,
        ]);

        Product::create([
            'user_id'          => $kojo->id,
            'name'             => 'Overripe Paste Tomatoes',
            'category'         => 'Tomato',
            'quantity'         => 180,
            'price'            => 10.00,
            'image_path'       => '/images/products/grade_c_tomatoes_3.jpg',
            'harvest_date'     => now()->subDays(5)->format('Y-m-d'),
            'quality_grade'    => 'C',
            'unit'             => 'Bag',
            'minimum_order_qty' => 5,
        ]);

        // ─── Farmer 2 (Kwesi Appiah) — 10 listings ───────────────────────────

        Product::create([
            'user_id'          => $kwesi->id,
            'name'             => 'Premium Daboase Tomatoes',
            'category'         => 'Tomato',
            'quantity'         => 90,
            'price'            => 50.00,
            'image_path'       => '/images/products/grade_a_tomatoes_5.jpg',
            'harvest_date'     => now()->subDays(1)->format('Y-m-d'),
            'quality_grade'    => 'A',
            'unit'             => 'Crate',
            'minimum_order_qty' => 1,
        ]);

        Product::create([
            'user_id'          => $kwesi->id,
            'name'             => 'Fresh Beposo Roma Tomatoes',
            'category'         => 'Tomato',
            'quantity'         => 75,
            'price'            => 48.00,
            'image_path'       => '/images/products/grade_a_tomatoes_6.jpg',
            'harvest_date'     => now()->subDays(0)->format('Y-m-d'),
            'quality_grade'    => 'A',
            'unit'             => 'Crate',
            'minimum_order_qty' => 1,
        ]);

        Product::create([
            'user_id'          => $kwesi->id,
            'name'             => 'Tarkwa Market Tomatoes (Premium)',
            'category'         => 'Tomato',
            'quantity'         => 110,
            'price'            => 42.00,
            'image_path'       => '/images/products/grade_a_tomatoes_7.jpg',
            'harvest_date'     => now()->subDays(1)->format('Y-m-d'),
            'quality_grade'    => 'A',
            'unit'             => 'Crate',
            'minimum_order_qty' => 2,
        ]);

        Product::create([
            'user_id'          => $kwesi->id,
            'name'             => 'Standard Vine Tomatoes',
            'category'         => 'Tomato',
            'quantity'         => 80,
            'price'            => 32.00,
            'image_path'       => '/images/products/grade_b_tomatoes_4.jpg',
            'harvest_date'     => now()->subDays(2)->format('Y-m-d'),
            'quality_grade'    => 'B',
            'unit'             => 'Crate',
            'minimum_order_qty' => 1,
        ]);

        Product::create([
            'user_id'          => $kwesi->id,
            'name'             => 'Local Red Tomatoes (Standard)',
            'category'         => 'Tomato',
            'quantity'         => 65,
            'price'            => 27.00,
            'image_path'       => '/images/products/grade_b_tomatoes_5.jpg',
            'harvest_date'     => now()->subDays(3)->format('Y-m-d'),
            'quality_grade'    => 'B',
            'unit'             => 'Bag',
            'minimum_order_qty' => 2,
        ]);

        Product::create([
            'user_id'          => $kwesi->id,
            'name'             => 'Beposo Tomatoes (B Grade)',
            'category'         => 'Tomato',
            'quantity'         => 95,
            'price'            => 24.00,
            'image_path'       => '/images/products/grade_b_tomatoes_6.jpg',
            'harvest_date'     => now()->subDays(2)->format('Y-m-d'),
            'quality_grade'    => 'B',
            'unit'             => 'Basket',
            'minimum_order_qty' => 2,
        ]);

        Product::create([
            'user_id'          => $kwesi->id,
            'name'             => 'Bulk Plum Tomatoes (B)',
            'category'         => 'Tomato',
            'quantity'         => 130,
            'price'            => 22.00,
            'image_path'       => '/images/products/grade_b_tomatoes_7.jpg',
            'harvest_date'     => now()->subDays(3)->format('Y-m-d'),
            'quality_grade'    => 'B',
            'unit'             => 'Bag',
            'minimum_order_qty' => 3,
        ]);

        Product::create([
            'user_id'          => $kwesi->id,
            'name'             => 'Wholesale Tomatoes (Budget)',
            'category'         => 'Tomato',
            'quantity'         => 200,
            'price'            => 16.00,
            'image_path'       => '/images/products/grade_c_tomatoes_4.jpg',
            'harvest_date'     => now()->subDays(4)->format('Y-m-d'),
            'quality_grade'    => 'C',
            'unit'             => 'Bag',
            'minimum_order_qty' => 5,
        ]);

        Product::create([
            'user_id'          => $kwesi->id,
            'name'             => 'Discount Tomatoes (Soft Batch)',
            'category'         => 'Tomato',
            'quantity'         => 170,
            'price'            => 14.00,
            'image_path'       => '/images/products/grade_c_tomatoes_5.jpg',
            'harvest_date'     => now()->subDays(5)->format('Y-m-d'),
            'quality_grade'    => 'C',
            'unit'             => 'Bag',
            'minimum_order_qty' => 5,
        ]);

        Product::create([
            'user_id'          => $kwesi->id,
            'name'             => 'Processing Tomatoes (C Grade)',
            'category'         => 'Tomato',
            'quantity'         => 250,
            'price'            => 10.00,
            'image_path'       => '/images/products/grade_c_tomatoes_6.jpg',
            'harvest_date'     => now()->subDays(5)->format('Y-m-d'),
            'quality_grade'    => 'C',
            'unit'             => 'Bag',
            'minimum_order_qty' => 10,
        ]);
    }
}
