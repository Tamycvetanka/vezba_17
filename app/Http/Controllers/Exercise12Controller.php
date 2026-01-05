<?php

namespace App\Http\Controllers;

use App\Models\City;

class Exercise12Controller extends Controller
{
    public function index()
    {
        $cities = City::with('forecasts', 'weather')->take(5)->get();

        return view('exercise12.index', compact('cities'));
    }
}
