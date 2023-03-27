<?php

namespace App\Http\Controllers;

use App\Contract\WeatherServiceContract;
use App\Service\WeatherStackService;

class WeatherApiController extends Controller
{
    public function __construct(public WeatherServiceContract $weatherStackService)
    {
    }

    public function show($city)
    {
        $currentWeather = $this->weatherStackService->getCityCurrentWeather($city);

        return $currentWeather;
    }
}
