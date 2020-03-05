<?php


namespace App\Services\Weather\Clients\Yandex;


use App\Models\City;
use App\Services\Weather\Clients\WeatherClient;
use GuzzleHttp\Client;

final class YandexWeatherClient implements WeatherClient
{

    /**
     * @var string
     */
    private $apiKey = '';

    /**
     * @var string
     */
    private $baseUrl = "https://api.weather.yandex.ru";

    /**
     * YandexWeatherClient constructor.
     * @param string $apiKey
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @param string $lat
     * @param string $lon
     * @return mixed
     */
    private function requestApi(string $lat, string $lon)
    {
        $httClient = new Client([
            'base_uri' => $this->baseUrl,
        ]);
        $options = [
            'headers' => [
                'X-Yandex-API-Key' => $this->apiKey,
            ],
            'query'   => [
                'lat'  => $lat,
                'lon'  => $lon,
                'lang' => 'ru_RU',
            ],
        ];
        $response = $httClient->request('GET', '/v1/informers', $options);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @inheritDoc
     */
    public function getWeatherByCity(City $city)
    {
        $data = $this->requestApi(data_get($city, 'lat'), data_get($city, 'lon'));
        $weather = (new YandexWeatherDeserializer($data))->deserialize();

        return $weather;
    }
}