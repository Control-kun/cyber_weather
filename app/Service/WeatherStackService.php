<?php

namespace App\Service;

use GuzzleHttp\Client;

class WeatherStackService implements \App\Contract\WeatherServiceContract
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
            'access_key' => config('weather.stack_key'),
            'query' => $city,
        ]);

        $response = $client->get('http://api.weatherstack.com/current?' . $queryString);

        return json_decode($response->getBody()->getContents());
    }
}
