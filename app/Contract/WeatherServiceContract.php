<?php

namespace App\Contract;

use GuzzleHttp\Psr7\Response;

interface WeatherServiceContract
{
    public function getCityCurrentWeather(string $city);
}
