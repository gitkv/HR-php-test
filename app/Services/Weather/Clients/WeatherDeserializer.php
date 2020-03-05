<?php


namespace App\Services\Weather\Clients;


use App\Models\Weather;

interface WeatherDeserializer
{

    /**
     * @return Weather
     */
    public function deserialize();

}