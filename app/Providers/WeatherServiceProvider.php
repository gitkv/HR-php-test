<?php

namespace App\Providers;

use App\Models\City;
use App\Services\Weather\Clients\WeatherClient;
use App\Services\Weather\Clients\Yandex\YandexWeatherClient;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class WeatherServiceProvider extends ServiceProvider
{

    public function boot()
    {
        $this->app->singleton(WeatherClient::class, function ($app) {
            return new YandexWeatherClient(config('services.yandex-weather.key'));
        });

        Route::bind('cityName', function ($value, $route) {
            return City::where('name', 'like', $value)->firstOrFail();
        });
    }
}
