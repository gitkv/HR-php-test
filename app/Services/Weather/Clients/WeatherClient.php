<?php


namespace App\Services\Weather\Clients;


use App\Models\City;
use App\Models\Weather;

interface WeatherClient
{

    /**
     * @param City $city
     * @return Weather
     */
    public function getWeatherByCity(City $city);

}