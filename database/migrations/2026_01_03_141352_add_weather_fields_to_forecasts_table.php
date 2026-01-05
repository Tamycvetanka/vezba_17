<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('forecasts', function (Blueprint $table) {
            if (!Schema::hasColumn('forecasts', 'weather_type')) {
                $table->string('weather_type')->default('sunny')->after('date');
            }
            if (!Schema::hasColumn('forecasts', 'temperature')) {
                $table->integer('temperature')->default(0)->after('weather_type');
            }
        });
    }

    public function down(): void
    {
        Schema::table('forecasts', function (Blueprint $table) {
            $table->dropColumn(['weather_type', 'temperature']);
        });
    }
};
