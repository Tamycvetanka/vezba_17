<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('weather', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')->constrained()->cascadeOnDelete();
            $table->integer('temperature');
            $table->timestamps();

            $table->unique('city_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('weather');
    }
};
