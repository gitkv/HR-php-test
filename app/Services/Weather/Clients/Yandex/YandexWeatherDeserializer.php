<?php


namespace App\Services\Weather\Clients\Yandex;


use App\Services\Weather\Clients\WeatherDeserializer;

class YandexWeatherDeserializer implements WeatherDeserializer
{
    /**
     * @var array
     */
    protected $data;

    /***
     * YandexWeatherDeserializer constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @inheritDoc
     */
    public function deserialize()
    {
        $factData = data_get($this->data, 'fact');
        $deserializeData = [
            'provider'   => 'yandex',
            'temp'       => data_get($factData, 'temp'),
            'feels_like' => data_get($factData, 'feels_like'),
            'temp_water' => data_get($factData, 'temp_water') ?? 0,
            'wind_speed' => data_get($factData, 'wind_speed'),
        ];

        return $deserializeData;
    }

}