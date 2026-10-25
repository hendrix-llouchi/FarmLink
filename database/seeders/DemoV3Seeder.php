<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;

/**
 * FarmLink V3 Demo Seeder — SAFE, NON-DESTRUCTIVE.
 *
 * Creates the 3 demo accounts and one demo-only admin account (reusing the accounts from the repo's
 * MarketplaceSeeder) and 6 tomato listings for the farmer account.
 *
 * SAFETY (per FarmLink AGENTS.md):
 * - NO deletes, NO truncates, NO migrate:fresh, NO wiping.
 * - Uses firstOrCreate() keyed on phone_number (users) and
 *   name + user_id (products), so running it twice does NOT duplicate rows.
 * - Does NOT touch existing users, products, or orders.
 * - Do NOT run the old MarketplaceSeeder again to get these accounts:
 *   it uses User::create() / Product::create() and WILL duplicate rows.
 *
 * Run (from the FarmLink project root, with MySQL running):
 *   php artisan db:seed --class=DemoV3Seeder
 *
 * Demo logins (demo only — same password as the repo seeder):
 *   Farmer: 0244111222 / password123  (Kojo Mensah)
 *   Buyer:  0244333444 / password123  (Ama Serwaa)
 *   Driver: 0244555666 / password123  (Emmanuel Mensah)
 *   Admin (demo-only): 0244000000 / password123
 */
class DemoV3Seeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(
            ['phone_number' => '0244000000'],
            ['name' => 'FarmLink Demo Admin', 'password' => bcrypt('password123'), 'role' => 'farmer', 'location' => 'FarmLink Team', 'is_admin' => true]
        );

        // 1. Farmer — one account, from the repo seeder
        $farmer = User::firstOrCreate(
            ['phone_number' => '0244111222'],
            [
                'name' => 'Kojo Mensah',
                'password' => bcrypt('password123'),
                'role' => 'farmer',
                'location' => 'Takoradi Market Circle',
                'average_rating' => 4.80,
            ]
        );

        // 2. Buyer — one account, from the repo seeder
        $buyer = User::firstOrCreate(
            ['phone_number' => '0244333444'],
            [
                'name' => 'Ama Serwaa',
                'password' => bcrypt('password123'),
                'role' => 'buyer',
                'location' => 'Takoradi',
                'buyer_type' => 'market_trader',
                'business_name' => "Ama's Market Stall",
                'average_rating' => 0.00,
            ]
        );

        // 3. Driver — one account, from the repo seeder
        $driver = User::firstOrCreate(
            ['phone_number' => '0244555666'],
            [
                'name' => 'Emmanuel Mensah',
                'password' => bcrypt('password123'),
                'role' => 'driver',
                'location' => 'Takoradi Market Circle',
                'average_rating' => 0.00,
            ]
        );

        // 4. Tomato listings for the farmer account only,
        //    using the tomato images already in public/images/products/
        $listings = [
            [
                'name' => 'Premium Roma Tomatoes',
                'category' => 'Tomato',
                'quantity' => 80,
                'price' => 45.00,
                'image_path' => '/images/products/grade_a_tomatoes_1.jpg',
                'harvest_date' => now()->subDays(1)->format('Y-m-d'),
                'quality_grade' => 'A',
                'unit' => 'Crate',
                'minimum_order_qty' => 1,
            ],
            [
                'name' => 'Fresh Beefsteak Tomatoes',
                'category' => 'Tomato',
                'quantity' => 60,
                'price' => 55.00,
                'image_path' => '/images/products/grade_a_tomatoes_2.jpg',
                'harvest_date' => now()->format('Y-m-d'),
                'quality_grade' => 'A',
                'unit' => 'Crate',
                'minimum_order_qty' => 1,
            ],
            [
                'name' => 'Vine-Ripened Tomatoes',
                'category' => 'Tomato',
                'quantity' => 100,
                'price' => 40.00,
                'image_path' => '/images/products/grade_a_tomatoes_3.jpg',
                'harvest_date' => now()->subDays(1)->format('Y-m-d'),
                'quality_grade' => 'A',
                'unit' => 'Crate',
                'minimum_order_qty' => 2,
            ],
            [
                'name' => 'Standard Cherry Tomatoes',
                'category' => 'Tomato',
                'quantity' => 50,
                'price' => 30.00,
                'image_path' => '/images/products/grade_b_tomatoes_1.jpg',
                'harvest_date' => now()->subDays(2)->format('Y-m-d'),
                'quality_grade' => 'B',
                'unit' => 'Basket',
                'minimum_order_qty' => 1,
            ],
            [
                'name' => 'Budget Roma Tomatoes',
                'category' => 'Tomato',
                'quantity' => 150,
                'price' => 18.00,
                'image_path' => '/images/products/grade_c_tomatoes_1.jpg',
                'harvest_date' => now()->subDays(4)->format('Y-m-d'),
                'quality_grade' => 'C',
                'unit' => 'Bag',
                'minimum_order_qty' => 3,
            ],
            [
                'name' => 'Quick-Sale Tomatoes (Soft)',
                'category' => 'Tomato',
                'quantity' => 200,
                'price' => 12.00,
                'image_path' => '/images/products/grade_c_tomatoes_2.jpg',
                'harvest_date' => now()->subDays(5)->format('Y-m-d'),
                'quality_grade' => 'C',
                'unit' => 'Bag',
                'minimum_order_qty' => 5,
            ],
        ];

        foreach ($listings as $listing) {
            Product::firstOrCreate(
                ['user_id' => $farmer->id, 'name' => $listing['name']],
                $listing
            );
        }

        // No orders are created here — the buyer and driver accounts are
        // ready for you to place an order and a delivery job in the demo,
        // so the V3 verification flow can be tested end-to-end.
        $this->command->info('DemoV3Seeder done: 1 farmer, 1 buyer, 1 driver, 6 tomato listings.');
        $this->command->info('Farmer: Kojo Mensah (0244111222) | Buyer: Ama Serwaa (0244333444) | Driver: Emmanuel Mensah (0244555666)');
    }
}
