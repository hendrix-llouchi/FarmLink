<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;

class MarketplaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
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

        // 4. Seed Products
        // Farmer 1 (Kojo) Products
        Product::create([
            'user_id' => $kojo->id,
            'name' => 'Fresh Habanero Pepper',
            'category' => 'Vegetable',
            'quantity' => 50,
            'price' => 15.00,
            'image_path' => 'products/sample_habanero.jpg',
        ]);

        Product::create([
            'user_id' => $kojo->id,
            'name' => 'Fresh Tomatoes',
            'category' => 'Vegetable',
            'quantity' => 100,
            'price' => 25.00,
            'image_path' => 'products/sample_tomatoes.jpg',
        ]);

        Product::create([
            'user_id' => $kojo->id,
            'name' => 'Garden Eggs',
            'category' => 'Vegetable',
            'quantity' => 40,
            'price' => 12.00,
            'image_path' => 'products/sample_garden_eggs.jpg',
        ]);

        Product::create([
            'user_id' => $kojo->id,
            'name' => 'Kontomire (Taro Leaves)',
            'category' => 'Leafy Green',
            'quantity' => 80,
            'price' => 8.00,
            'image_path' => 'products/sample_kontomire.jpg',
        ]);

        Product::create([
            'user_id' => $kojo->id,
            'name' => 'Cabbage Heads',
            'category' => 'Vegetable',
            'quantity' => 35,
            'price' => 15.00,
            'image_path' => 'products/sample_cabbage.jpg',
        ]);

        // Farmer 2 (Kwesi) Products
        Product::create([
            'user_id' => $kwesi->id,
            'name' => 'Cassava Sacks',
            'category' => 'Root/Tuber',
            'quantity' => 20,
            'price' => 120.00,
            'image_path' => 'products/sample_cassava.jpg',
        ]);

        Product::create([
            'user_id' => $kwesi->id,
            'name' => 'White Yam',
            'category' => 'Root/Tuber',
            'quantity' => 30,
            'price' => 45.00,
            'image_path' => 'products/sample_yam.jpg',
        ]);

        Product::create([
            'user_id' => $kwesi->id,
            'name' => 'Green Plantain',
            'category' => 'Other',
            'quantity' => 15,
            'price' => 35.00,
            'image_path' => 'products/sample_plantain.jpg',
        ]);

        Product::create([
            'user_id' => $kwesi->id,
            'name' => 'Scotch Bonnet Pepper',
            'category' => 'Vegetable',
            'quantity' => 60,
            'price' => 18.00,
            'image_path' => 'products/sample_pepper.jpg',
        ]);

        Product::create([
            'user_id' => $kwesi->id,
            'name' => 'Sweet Potatoes',
            'category' => 'Root/Tuber',
            'quantity' => 25,
            'price' => 30.00,
            'image_path' => 'products/sample_sweet_potatoes.jpg',
        ]);
    }
}
