<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\User;
use App\Models\UserWeather;
use Illuminate\Database\Seeder;

class UserWeatherSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'tamara@example.com')->first();
        if (!$user) {
            $this->command?->error('USER_NOT_FOUND');
            return;
        }

        $city = City::firstOrCreate(['name' => 'Skopje']);

        $user->cities()->syncWithoutDetaching([$city->id]);

        UserWeather::updateOrCreate(
            [
                'user_id' => $user->id,
                'city_id' => $city->id,
                'date' => now()->toDateString(),
            ],
            [
                'temperature' => 19,
            ]
        );

        $this->command?->info('USER_WEATHER_CREATED');
    }
}
