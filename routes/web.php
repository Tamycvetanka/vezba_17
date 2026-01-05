<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherApiController;
use App\Http\Controllers\UserWeatherController;
use App\Http\Controllers\Exercise12Controller;
use App\Models\City;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/weather', [WeatherApiController::class, 'form'])->name('weather.form');
Route::post('/weather', [WeatherApiController::class, 'search'])->name('weather.search');

Route::get('/user-weathers', [UserWeatherController::class, 'index'])->name('user.weathers');

Route::get('/exercise-12', function () {
    return City::with('forecasts', 'weather')->take(3)->get();
});

Route::get('/exercise-12-view', [Exercise12Controller::class, 'index'])->name('exercise12.view');
