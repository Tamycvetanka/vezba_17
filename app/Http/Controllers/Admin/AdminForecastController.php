<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Forecast;
use Illuminate\Http\Request;

class AdminForecastController extends Controller
{
    public function index(Request $request)
    {
        $cityId = (int) $request->input('city_id');

        $cities = City::orderBy('name')->get();

        $query = Forecast::with('city')->orderBy('date');

        if ($cityId) {
            $query->where('city_id', $cityId);
        }

        $forecasts = $query->get();

        return view('admin.forecasts.index', compact('cities', 'cityId', 'forecasts'));
    }
}
