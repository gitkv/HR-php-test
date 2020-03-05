<?php

namespace App\Providers;

use App\Services\Weather\Clients\WeatherClient;
use App\Services\Weather\Clients\Yandex\YandexWeatherClient;
use Illuminate\Support\ServiceProvider;

class WeatherServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->app->singleton(WeatherClient::class, function ($app) {
            return new YandexWeatherClient(config('services.yandex-weather.key'));
        });
    }
}
