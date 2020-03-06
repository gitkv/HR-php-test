<?php


namespace App\Services\Weather\Clients;


use App\Models\City;

interface WeatherClient
{

    /**
     * @param City $city
     * @return array
     */
    public function getWeatherByCity(City $city);

}