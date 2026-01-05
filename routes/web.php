<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WeatherApiController;
use App\Http\Controllers\UserWeatherController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/weather', [WeatherApiController::class, 'form'])->name('weather.form');
Route::post('/weather', [WeatherApiController::class, 'search'])->name('weather.search');

Route::get('/user-weathers', [UserWeatherController::class, 'index'])->name('user.weathers');
