<?php


namespace App\Services\Weather;


use App\Models\City;
use App\Models\Weather;
use App\Services\Weather\Clients\WeatherClient;

class WeatherService
{
    private $weatherClient;

    /**
     * WeatherService constructor.
     * @param WeatherClient $weatherClient
     */
    public function __construct(WeatherClient $weatherClient)
    {
        $this->weatherClient = $weatherClient;
    }

    /**
     * @param string $cityName
     * @return Weather
     */
    public function getWeatherByCity(string $cityName)
    {
        $city = City::where('name', 'ilike', $cityName)->firstOrFail();

        return $this->weatherClient->getWeatherByCity($city);
    }

}