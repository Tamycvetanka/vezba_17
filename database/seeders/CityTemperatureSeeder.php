<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\CityTemperature;
use Illuminate\Database\Seeder;

class CityTemperatureSeeder extends Seeder
{
    public function run(): void
    {
        CityTemperature::query()->delete();

        $cities = City::orderBy('name')->get();

        foreach ($cities as $city) {
            CityTemperature::create([
                'city_id' => $city->id,
                'temperature' => random_int(-10, 30),
            ]);
        }
    }
}
