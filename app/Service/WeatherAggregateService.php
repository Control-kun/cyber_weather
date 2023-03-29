<?php

namespace App\Service;

use App\Contract\WeatherServiceContract;
use App\Data\WeatherData;

class WeatherAggregateService implements WeatherServiceContract
{

    public function __construct(
        protected WeatherApiService $weatherApiService,
        protected WeatherStackService $weatherStackService
    )
    {
    }

    public function getCityCurrentWeather(string $city): WeatherData
    {
        $weatherApi = $this->weatherApiService->getCityCurrentWeather($city);
        $weatherStack = $this->weatherStackService->getCityCurrentWeather($city);

        $weatherData = [
            'name' => $weatherApi->city,
            'current_temperature' => ($weatherApi->current_temperature + $weatherStack->current_temperature) / 2,
            'real_feel' => ($weatherApi->real_feel + $weatherStack->real_feel) / 2,
        ];

        return new WeatherData($weatherData['name'], $weatherData['current_temperature'], $weatherData['real_feel']);
    }
}
