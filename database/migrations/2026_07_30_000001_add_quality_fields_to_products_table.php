<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Adds quality-related fields to the products table for Phase 2.
     * All columns are nullable so existing listings are unaffected.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->date('harvest_date')->nullable()->default(null)->after('image_path');
            $table->enum('quality_grade', ['A', 'B', 'C'])->nullable()->default(null)->after('harvest_date');
            $table->string('unit', 50)->nullable()->default('crate')->after('quality_grade');
            $table->integer('minimum_order_qty')->nullable()->default(1)->after('unit');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['minimum_order_qty', 'unit', 'quality_grade', 'harvest_date']);
        });
    }
};
