<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Forecast;

class ForecastSeeder extends Seeder
{
    public function run(): void
    {
        $cities = City::all();

        foreach ($cities as $city) {
            for ($i = 1; $i <= 5; $i++) {
                $date = now()->addDays($i)->toDateString();

                Forecast::updateOrCreate(
                    [
                        'city_id' => $city->id,
                        'date' => $date,
                    ],
                    [
                        'temperature' => rand(150, 350) / 10,
                    ]
                );
            }
        }
    }
}
