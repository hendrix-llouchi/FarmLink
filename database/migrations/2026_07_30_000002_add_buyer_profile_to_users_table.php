<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Adds buyer profile fields to the users table for Phase 2.
     * All columns are nullable so existing user records are unaffected.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('buyer_type', 50)->nullable()->default(null)->after('location');
            $table->string('business_name', 255)->nullable()->default(null)->after('buyer_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['buyer_type', 'business_name']);
        });
    }
};
