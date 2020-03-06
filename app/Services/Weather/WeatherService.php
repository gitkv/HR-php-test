<?php


namespace App\Services\Weather;


use App\Models\City;
use App\Models\Weather;
use App\Services\Weather\Clients\WeatherClient;
use Carbon\Carbon;

class WeatherService
{
    private $weatherClient;

    /**
     * время кеширования погоды в часах
     */
    const CACHED_TIME = 3;

    /**
     * WeatherService constructor.
     * @param WeatherClient $weatherClient
     */
    public function __construct(WeatherClient $weatherClient)
    {
        $this->weatherClient = $weatherClient;
    }

    /**
     * @param City $city
     * @return Weather|mixed
     */
    public function getWeatherByCity(City $city)
    {

        $weather = data_get($city, 'weather');

        if (!$weather || Carbon::now()->diffInHours($weather->updated_at) > self::CACHED_TIME) {
            $weatherData = $this->weatherClient->getWeatherByCity($city);
            if (!$weather) {
                $weather = new Weather(array_merge($weatherData, ['city_id' => $city->id]));
            }
            else {
                $weather->fill($weatherData);
            }
            $weather->save();
        }

        return $weather;
    }

}