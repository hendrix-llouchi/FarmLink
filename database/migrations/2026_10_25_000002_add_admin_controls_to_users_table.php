<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false)->after('role');
            $table->timestamp('suspended_at')->nullable()->after('is_admin');
        });
    }

    public function down(): void
    {
        // FarmLink migrations are additive-only.
    }
};
