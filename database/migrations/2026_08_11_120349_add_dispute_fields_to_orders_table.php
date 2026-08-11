<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('disputed_reason')->nullable()->after('delivery_address');
            $table->text('disputed_notes')->nullable()->after('disputed_reason');
            $table->timestamp('disputed_at')->nullable()->after('disputed_notes');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['disputed_reason', 'disputed_notes', 'disputed_at']);
        });
    }
};
