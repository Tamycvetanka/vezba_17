<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class City extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_cities')->withTimestamps();
    }

    public function weather()
    {
        return $this->hasOne(Weather::class, 'city_id');
    }

    public function forecasts()
    {
        return $this->hasMany(Forecast::class);
    }
}
