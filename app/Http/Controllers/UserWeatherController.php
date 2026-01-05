<?php

namespace App\Http\Controllers;

use App\Models\UserWeather;

class UserWeatherController extends Controller
{
    public function index()
    {
        $userWeathers = UserWeather::with(['user', 'city'])
            ->whereHas('user')
            ->whereHas('city')
            ->get();

        return view('user_weathers.index', compact('userWeathers'));
    }
}
