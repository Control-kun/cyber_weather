<?php

namespace App\Service;

use App\Data\WeatherData;

abstract class WeatherService
{
    public function getCityCurrentWeather(string $city):WeatherData
    {

    }
}
