<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('dispute_photo_path')->nullable();
            $table->string('dispute_status')->nullable();
            $table->string('dispute_resolution')->nullable();
            $table->text('dispute_resolution_reason')->nullable();
            $table->timestamp('dispute_resolved_at')->nullable();
        });
    }
    public function down(): void {}
};
