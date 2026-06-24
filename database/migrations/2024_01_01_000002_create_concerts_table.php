<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('concerts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('artist');
            $table->text('description')->nullable();
            $table->string('venue');
            $table->string('city');
            $table->date('event_date');
            $table->time('event_time');
            $table->string('poster_emoji')->default('🎵'); // emoji sebagai poster placeholder
            $table->string('genre')->nullable();
            $table->integer('price');
            $table->integer('quota');
            $table->integer('sold')->default(0);
            $table->string('bg_color')->default('#6B21A8'); // warna background tiket
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void { Schema::dropIfExists('concerts'); }
};
