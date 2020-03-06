<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    protected $table = 'city_weather';

    protected $fillable = [
        'provider',
        'temp',
        'feels_like',
        'temp_water',
        'wind_speed',
        'city_id',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
