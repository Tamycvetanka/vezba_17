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

            $previousTemp = null;

            for ($i = 1; $i <= 5; $i++) {

                $date = now()->addDays($i)->toDateString();

                $weatherType = $this->randomWeatherType();

                $temp = $this->randomTempForType($weatherType);

                if ($previousTemp !== null) {
                    $temp = max($previousTemp - 5, min($previousTemp + 5, $temp));
                }

                if ($city->name === 'Beograd') {
                    $temp = max(10, min(20, $temp));
                }

                Forecast::updateOrCreate(
                    [
                        'city_id' => $city->id,
                        'date' => $date,
                    ],
                    [
                        'weather_type' => $weatherType,
                        'temperature' => $temp,
                    ]
                );

                $previousTemp = $temp;
            }
        }
    }

    private function randomWeatherType(): string
    {
        $types = ['sunny', 'cloudy', 'rainy', 'snowy'];

        return $types[array_rand($types)];
    }

    private function randomTempForType(string $type): float
    {
        $value = match ($type) {
            'sunny'  => rand(150, 350) / 10,
            'cloudy' => rand(0, 250) / 10,
            'rainy'  => rand(-100, 150) / 10,
            'snowy'  => rand(-10, 10) / 10,
            default  => rand(0, 250) / 10,
        };

        return round($value, 1);
    }
}
