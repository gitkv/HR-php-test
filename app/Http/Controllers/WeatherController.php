<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Services\Weather\WeatherService;

class WeatherController extends Controller
{
    protected $service;

    public function __construct(WeatherService $weatherService)
    {
        $this->service = $weatherService;
    }

    public function getWeatherByCity(City $city)
    {
        $weather = $this->service->getWeatherByCity($city);

        return view('weather', compact('weather'));
    }
}
