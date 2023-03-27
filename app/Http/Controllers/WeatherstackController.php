<?php

namespace App\Http\Controllers;

use App\Contract\WeatherServiceContract;
use App\Http\Requests\WeatherRequest;
use App\Service\WeatherStackService;

class WeatherstackController extends Controller
{
    public function __construct(private readonly WeatherServiceContract $weatherStackService)
    {
    }

    public function show($city)
    {
        $currentWeather = $this->weatherStackService->getCityCurrentWeather($city);
    }
}
