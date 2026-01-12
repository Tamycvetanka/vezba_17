<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\User;

class WeatherHomeController extends Controller
{
    public function index()
    {
        $user = auth()->user() ?? User::findOrFail(1);

        $cities = City::with('weather')
            ->orderBy('name')
            ->get();

        $favourites = $user->cities()
            ->with('weather')
            ->orderBy('name')
            ->get();

        return view('exercise17.index', compact('cities', 'favourites'));
    }

    public function destroyFavourite(City $city)
    {
        $user = auth()->user() ?? User::findOrFail(1);

        $user->cities()->detach($city->id);

        return back();
    }
}
