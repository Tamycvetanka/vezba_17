<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Forecast;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ForecastSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            'sunny' => ['min' => -30, 'max' => 45, 'icon' => '☀️'],
            'cloudy' => ['min' => -30, 'max' => 15, 'icon' => '☁️'],
            'rainy' => ['min' => -30, 'max' => -10, 'icon' => '🌧️'],
            'snowy' => ['min' => -30, 'max' => 1, 'icon' => '❄️'],
        ];

        $cities = City::all();

        foreach ($cities as $city) {
            $lastTemp = null;
            $start = Carbon::today();

            for ($i = 0; $i < 5; $i++) {
                $date = $start->copy()->addDays($i)->toDateString();

                if ($lastTemp === null) {
                    $weatherType = array_rand($types);
                    $min = $types[$weatherType]['min'];
                    $max = $types[$weatherType]['max'];
                    $temp = rand($min, $max);
                } else {
                    $windowMin = $lastTemp - 5;
                    $windowMax = $lastTemp + 5;

                    $candidates = [];
                    foreach ($types as $key => $rule) {
                        $min = max($rule['min'], $windowMin);
                        $max = min($rule['max'], $windowMax);

                        if ($min <= $max) {
                            $candidates[$key] = ['min' => $min, 'max' => $max];
                        }
                    }

                    if (empty($candidates)) {
                        $weatherType = 'sunny';
                        $min = $windowMin;
                        $max = $windowMax;
                    } else {
                        $keys = array_keys($candidates);
                        $weatherType = $keys[array_rand($keys)];
                        $min = $candidates[$weatherType]['min'];
                        $max = $candidates[$weatherType]['max'];
                    }

                    $temp = rand($min, $max);
                }

                Forecast::updateOrCreate(
                    [
                        'city_id' => $city->id,
                        'date' => $date,
                    ],
                    [
                        'weather_type' => $weatherType,
                        'temperature' => $temp,
                        'icon' => $types[$weatherType]['icon'] ?? null,
                    ]
                );

                $lastTemp = $temp;
            }
        }
    }
}
