<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('city_user', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('city_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();

            // da se isti grad ne doda istom korisniku vise puta
            $table->unique(['user_id', 'city_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('city_user');
    }
};
