<?php


namespace App\Services\Weather\Clients;


interface WeatherDeserializer
{

    /**
     * @return array
     */
    public function deserialize();

}