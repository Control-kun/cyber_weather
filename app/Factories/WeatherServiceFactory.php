<?php

namespace App\Factories;

use App\Contract\WeatherServiceContract;
use App\Service\WeatherAggregateService;
use App\Service\WeatherApiService;
use App\Service\WeatherStackService;

class WeatherServiceFactory
{
    public function getWeatherService(string $service):WeatherServiceContract
    {
        return match ($service) {
            'api' => new WeatherApiService(),
            'stack' => new WeatherStackService(),
            'aggregate' => new WeatherAggregateService(),
            default => throw new \InvalidArgumentException('Invalid service name')
        };
    }
}
