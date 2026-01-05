<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function forecasts()
    {
        return $this->hasMany(Forecast::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_cities')->withTimestamps();
    }

    public function userWeathers()
    {
        return $this->hasMany(UserWeather::class);
    }
}
