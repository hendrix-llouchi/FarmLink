<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('payment_status', ['unpaid', 'escrow_held', 'released', 'refunded'])->default('unpaid')->change();
            $table->string('workflow_status')->nullable();
            $table->string('verification_status')->nullable();
            $table->string('dispatch_code', 4)->nullable();
            $table->decimal('adjusted_price', 10, 2)->nullable();
            $table->string('delivery_photo_path')->nullable();
            $table->timestamp('arrived_at')->nullable();
            $table->timestamp('buyer_confirmed_at')->nullable();
            $table->string('flag_decision')->nullable();
            $table->timestamp('flag_decided_at')->nullable();
            $table->timestamp('flag_driver_decision_at')->nullable();
            $table->timestamp('flag_deadline_at')->nullable();
            $table->timestamp('flag_buyer_confirmed_at')->nullable();
            $table->timestamp('handover_confirmed_at')->nullable();
        });

        Schema::create('verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->restrictOnDelete();
            $table->foreignId('driver_id')->constrained('users')->restrictOnDelete();
            $table->unsignedInteger('claimed_quantity');
            $table->unsignedInteger('actual_quantity');
            $table->string('claimed_grade', 1)->nullable();
            $table->string('actual_grade', 1)->nullable();
            $table->boolean('grade_match');
            $table->boolean('freshness_match');
            $table->text('damage_note')->nullable();
            $table->boolean('heavy_spoilage')->default(false);
            $table->boolean('packaging_ok');
            $table->json('pickup_photos');
            $table->string('outcome');
            $table->text('notes')->nullable();
            $table->timestamps();
        });

        Schema::create('order_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->restrictOnDelete();
            $table->foreignId('actor_id')->nullable()->constrained('users')->restrictOnDelete();
            $table->string('actor_role')->nullable();
            $table->string('event');
            $table->json('details')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Intentionally non-destructive. FarmLink migrations are additive-only.
    }
};
