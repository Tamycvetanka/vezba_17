<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Weather;

class WeatherSeeder extends Seeder
{
    public function run(): void
    {
        $cities = City::all();

        foreach ($cities as $city) {
            Weather::updateOrCreate(
                ['city_id' => $city->id],
                ['temperature' => rand(150, 350) / 10]
            );
        }
    }
}
