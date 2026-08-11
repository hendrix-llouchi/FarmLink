<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Aligns all legacy user locations and product names from 'Tarkwa' to 'Daboase' / 'Beposo'
     * to match the pilot supply corridor (Daboase/Beposo → Takoradi Market Circle).
     */
    public function up(): void
    {
        // 1. Update farmer locations
        DB::table('users')
            ->where('phone_number', '0244111222') // Kojo Mensah
            ->update(['location' => 'Daboase']);

        DB::table('users')
            ->where('phone_number', '0244222333') // Kwesi Appiah
            ->update(['location' => 'Beposo']);

        // Update any remaining Tarkwa locations for farmers
        DB::table('users')
            ->where('role', 'farmer')
            ->where('location', 'like', '%Tarkwa%')
            ->update(['location' => 'Beposo']);

        // Update buyers to Takoradi Market Circle
        DB::table('users')
            ->where('role', 'buyer')
            ->where('location', 'like', '%Tarkwa%')
            ->update(['location' => 'Takoradi Market Circle']);

        // Update drivers
        DB::table('users')
            ->where('role', 'driver')
            ->where('location', 'like', '%Tarkwa%')
            ->update(['location' => 'Takoradi Market Circle']);

        // 2. Update product names referencing Tarkwa
        DB::table('products')
            ->where('name', 'like', '%Tarkwa%')
            ->update([
                'name' => DB::raw("REPLACE(name, 'Tarkwa Market', 'Beposo Harvest')")
            ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Additive migration — safe
    }
};

