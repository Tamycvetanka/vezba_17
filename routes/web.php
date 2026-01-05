<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherApiController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/trenutno', [WeatherApiController::class, 'current'])->name('weather.current');
