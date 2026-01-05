<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('city_temperatures', function (Blueprint $table) {
            $table->id();
            $table->string('city');         // Beograd, Novi Sad...
            $table->integer('temperature'); // 22, 24...
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('city_temperatures');
    }
};
