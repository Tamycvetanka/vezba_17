<?php

namespace App\Http\Controllers;

use App\Models\City;

class ForecastController extends Controller
{
    public function index()
    {
        $cities = City::with([
            'forecasts' => fn ($q) => $q->orderBy('date'),
            'weather'
        ])->orderBy('name')->get();

        return view('forecast.index', compact('cities'));
    }
}
