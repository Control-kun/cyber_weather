<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class WeatherData extends Data
{
    public function __construct(
        public string $city,
        public float $current_temperature,
        public float $real_feel,
    ) {}
}
