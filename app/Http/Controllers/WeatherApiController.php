<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherApiController extends Controller
{
    public function current(Request $request)
    {
        $q = trim($request->get('q', 'Skopje'));

        $response = Http::withoutVerifying()->get(
            config('services.weatherapi.base') . '/current.json',
            [
                'key' => config('services.weatherapi.key'),
                'q' => $q,
                'aqi' => 'no',
            ]
        );

        if (!$response->ok()) {
            return view('weather.current', [
                'q' => $q,
                'data' => null,
                'error' => 'API ERROR',
            ]);
        }

        return view('weather.current', [
            'q' => $q,
            'data' => $response->json(),
            'error' => null,
        ]);
    }
}
