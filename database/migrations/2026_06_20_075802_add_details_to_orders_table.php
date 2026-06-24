<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Gunakan nullable agar tidak error kalau ada data lama
            $table->string('name')->nullable();
            $table->string('nik')->nullable();
            $table->string('payment_method')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['name', 'nik', 'payment_method']);
        });
    }
};
