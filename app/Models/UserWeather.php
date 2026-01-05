<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWeather extends Model
{
    use HasFactory;

    protected $table = 'user_weathers';

    protected $fillable = [
        'user_id',
        'city_id',
        'temperature',
        'date',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
