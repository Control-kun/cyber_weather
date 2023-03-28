<?php

namespace App\Contract;

use App\Data\WeatherData;

interface WeatherServiceContract
{
    public function getCityCurrentWeather(string $city):WeatherData;
}
