<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\User;

class ForecastSearchController extends Controller
{
    public function index()
    {
        $cities = City::query()
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        $user = User::with('cities:id')->find(1);
        $favoriteCityIds = $user ? $user->cities->pluck('id')->all() : [];

        return view('forecasts.search', compact('cities', 'favoriteCityIds'));
    }

    public function show(Request $request)
    {
        $data = $request->validate([
            'q' => ['required', 'string', 'min:2', 'max:80'],
        ]);

        $q = trim($data['q']);

        $city = City::query()
            ->with(['forecasts' => function ($query) {
                $query->orderBy('date');
            }])
            ->where('name', 'like', $q)
            ->orWhere('name', 'like', $q . '%')
            ->orWhere('name', 'like', '%' . $q . '%')
            ->orderBy('name')
            ->first();

        if (!$city) {
            return redirect()
                ->route('forecast.search')
                ->with('error', 'Nema grada sa tim imenom.');
        }

        $user = User::with('cities:id')->find(1);
        $favoriteCityIds = $user ? $user->cities->pluck('id')->all() : [];

        $forecasts = $city->forecasts ?? collect();

        return view('forecasts.result', compact('city', 'forecasts', 'q', 'favoriteCityIds'));
    }
}
