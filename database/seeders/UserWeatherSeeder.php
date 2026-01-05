<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\City;
use App\Models\UserWeather;

class UserWeatherSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'tamara@example.com')->first();

        if (!$user) {
            $this->command->error('Korisnik ne postoji – unos prekinut.');
            return;
        }

        $city = City::first();

        if (!$city) {
            $this->command->error('Grad ne postoji – unos prekinut.');
            return;
        }

        UserWeather::firstOrCreate([
            'user_id' => $user->id,
            'city_id' => $city->id,
        ]);
    }
}
