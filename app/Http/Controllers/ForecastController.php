<?php

namespace App\Http\Controllers;

use App\Models\CityTemperature;
use Illuminate\View\View;

class ForecastController extends Controller
{
    public function index(): View
    {
        $cities = CityTemperature::with('city')
            ->orderBy('temperature')
            ->get();

        return view('prognoza', compact('cities'));
    }
}

