<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Fix: The primary buyer account was seeded with a male name.
        // Correct it to Ama Serwaa who is the female buyer persona for FarmLink demos.
        DB::table('users')
            ->where('role', 'buyer')
            ->where('phone_number', '0244333444')
            ->update(['name' => 'Ama Serwaa']);

        // Also catch any buyer with a clearly wrong male name just in case phone number changed
        DB::table('users')
            ->where('role', 'buyer')
            ->whereIn('name', ['Kofi Buyer', 'Kwame Buyer', 'Yaw Trader', 'Kojo Buyer', 'Ama Buyer'])
            ->update(['name' => 'Ama Serwaa']);
    }

    public function down(): void
    {
        // Non-destructive — no rollback needed
    }
};
