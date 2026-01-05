<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Forecast;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ForecastSeeder extends Seeder
{
    private array $types = ['sunny', 'cloudy', 'rainy', 'snowy'];

    public function run(): void
    {
        $start = Carbon::today();
        $days = 7;

        $cities = City::all();

        foreach ($cities as $city) {

            Forecast::where('city_id', $city->id)->delete();

            $prevTemp = null;

            for ($i = 0; $i < $days; $i++) {
                $date = $start->copy()->addDays($i);
                $type = $this->types[array_rand($this->types)];

                $temp = $this->generateTemperature($type, $prevTemp);

                Forecast::create([
                    'city_id'      => $city->id,
                    'date'         => $date->toDateString(),
                    'weather_type' => $type,
                    'temperature'  => $temp,
                ]);

                $prevTemp = $temp;
            }
        }
    }

    private function generateTemperature(string $type, ?int $prevTemp): int
    {

        [$min, $max] = match ($type) {
            'cloudy' => [-5, 15],
            'rainy'  => [-10, 25],
            'snowy'  => [-20, 1],
            'sunny'  => [-15, 35],
            default  => [-10, 10],
        };


        if ($prevTemp !== null) {
            $min = max($min, $prevTemp - 5);
            $max = min($max, $prevTemp + 5);
        }


        if ($min > $max) {
            return $min;
        }

        return random_int($min, $max);
    }
}
