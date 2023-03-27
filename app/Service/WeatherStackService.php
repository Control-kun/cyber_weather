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
            'access_key' => 'e00eb1787fc8b4a9cb3db63e71dcc3a8',
            'query' => $city,
        ]);

        return $client->get('http://api.weatherstack.com/current' . $queryString);
    }
}
