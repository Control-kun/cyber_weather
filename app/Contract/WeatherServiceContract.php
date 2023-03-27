<?php

namespace App\Contract;

interface WeatherServiceContract
{
    public function getCityCurrentWeather(string $city);
}
