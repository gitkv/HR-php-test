<?php


namespace App\Services\Weather\Clients\Yandex;


use App\Models\Weather;
use App\Services\Weather\Clients\WeatherDeserializer;

class YandexWeatherDeserializer implements WeatherDeserializer
{
    /**
     * @var array
     */
    protected $data;

    /**
     * @var Weather
     */
    protected $weather;

    /***
     * YandexWeatherDeserializer constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
        $this->weather = new Weather();
    }

    /**
     * @inheritDoc
     */
    public function deserialize()
    {
        $factData = data_get($this->data, 'fact');
        $this->weather->provider = 'yandex';
        $this->weather->temp = data_get($factData, 'temp');
        $this->weather->feels_like = data_get($factData, 'feels_like');
        $this->weather->temp_water = data_get($factData, 'temp_water');
        $this->weather->wind_speed = data_get($factData, 'wind_speed');
        $this->weather->meta = $this->data;

        return $this->weather;
    }

}