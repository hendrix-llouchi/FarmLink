<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

/**
 * Safely re-inserts the standard seeded test accounts if they don't already exist.
 * Uses insertOrIgnore — completely safe, will never overwrite existing users.
 */
return new class extends Migration
{
    public function up(): void
    {
        $users = [
            [
                'name'           => 'Kojo Mensah',
                'phone_number'   => '0244111222',
                'password'       => Hash::make('password123'),
                'role'           => 'farmer',
                'location'       => 'Takoradi Market Circle',
                'average_rating' => 4.80,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Kwesi Appiah',
                'phone_number'   => '0244222333',
                'password'       => Hash::make('password123'),
                'role'           => 'farmer',
                'location'       => 'Tarkwa',
                'average_rating' => 4.50,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Ama Serwaa',
                'phone_number'   => '0244333444',
                'password'       => Hash::make('password123'),
                'role'           => 'buyer',
                'location'       => 'Takoradi',
                'average_rating' => 0.00,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Yaw Boateng',
                'phone_number'   => '0244444555',
                'password'       => Hash::make('password123'),
                'role'           => 'buyer',
                'location'       => 'Tarkwa',
                'average_rating' => 0.00,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Emmanuel Mensah',
                'phone_number'   => '0244555666',
                'password'       => Hash::make('password123'),
                'role'           => 'driver',
                'location'       => 'Takoradi Market Circle',
                'average_rating' => 0.00,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'Kofi Ansah',
                'phone_number'   => '0244666777',
                'password'       => Hash::make('password123'),
                'role'           => 'driver',
                'location'       => 'Tarkwa',
                'average_rating' => 0.00,
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ];

        foreach ($users as $user) {
            // Only insert if this phone number doesn't already exist
            $exists = DB::table('users')
                ->where('phone_number', $user['phone_number'])
                ->exists();

            if (!$exists) {
                DB::table('users')->insert($user);
            }
        }

        // Re-assign the 20 tomato products to the correct farmer IDs
        $kojo  = DB::table('users')->where('phone_number', '0244111222')->first();
        $kwesi = DB::table('users')->where('phone_number', '0244222333')->first();

        if ($kojo && $kwesi) {
            // Products 1–10 style (grade_a 1-7, grade_b 1-3) → Kojo
            // Products 11–20 style (grade_a 5-7, grade_b 4-7, grade_c 4-6) → Kwesi
            $kojoImages = [
                '/images/products/grade_a_tomatoes_1.jpg',
                '/images/products/grade_a_tomatoes_2.jpg',
                '/images/products/grade_a_tomatoes_3.jpg',
                '/images/products/grade_a_tomatoes_4.jpg',
                '/images/products/grade_b_tomatoes_1.jpg',
                '/images/products/grade_b_tomatoes_2.jpg',
                '/images/products/grade_b_tomatoes_3.jpg',
                '/images/products/grade_c_tomatoes_1.jpg',
                '/images/products/grade_c_tomatoes_2.jpg',
                '/images/products/grade_c_tomatoes_3.jpg',
            ];

            $kwesiImages = [
                '/images/products/grade_a_tomatoes_5.jpg',
                '/images/products/grade_a_tomatoes_6.jpg',
                '/images/products/grade_a_tomatoes_7.jpg',
                '/images/products/grade_b_tomatoes_4.jpg',
                '/images/products/grade_b_tomatoes_5.jpg',
                '/images/products/grade_b_tomatoes_6.jpg',
                '/images/products/grade_b_tomatoes_7.jpg',
                '/images/products/grade_c_tomatoes_4.jpg',
                '/images/products/grade_c_tomatoes_5.jpg',
                '/images/products/grade_c_tomatoes_6.jpg',
            ];

            DB::table('products')
                ->whereIn('image_path', $kojoImages)
                ->update(['user_id' => $kojo->id, 'updated_at' => now()]);

            DB::table('products')
                ->whereIn('image_path', $kwesiImages)
                ->update(['user_id' => $kwesi->id, 'updated_at' => now()]);
        }
    }

    public function down(): void
    {
        // Intentionally empty — safe to leave seeded users in place
    }
};
