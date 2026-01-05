<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forecast extends Model
{
    use HasFactory;

    protected $fillable = [
        'city_id',
        'date',
        'weather_type',
        'temperature',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
