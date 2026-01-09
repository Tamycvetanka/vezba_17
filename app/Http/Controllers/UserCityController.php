<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserCityController extends Controller
{
    public function index()
    {
        $user = User::with([
            'cities.weather',
            'cities.forecasts' => fn ($q) => $q->orderBy('date'),
        ])->findOrFail(1);

        return view('user.cities', compact('user'));
    }
}
