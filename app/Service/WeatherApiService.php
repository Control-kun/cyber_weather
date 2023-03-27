<?php

namespace App\Service;

use GuzzleHttp\Client;

class WeatherApiService implements \App\Contract\WeatherServiceContract
{

    public function getCityCurrentWeather(string $city)
    {
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
        ]);

        $queryString = http_build_query([
            'key' => config('weather.api_key'),
            'q' => htmlspecialchars($city),
            'aqi' => 'no'
        ]);

        $response = $client->get('http://api.weatherapi.com/v1/current.json?' . $queryString);

        return json_decode($response->getBody()->getContents());
    }
}
