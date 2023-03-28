<?php

namespace App\Service;

use App\Data\WeatherData;
use GuzzleHttp\Client;

class WeatherStackService implements \App\Contract\WeatherServiceContract
{
    public function getCityCurrentWeather(string $city):WeatherData
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

        $data = json_decode($response->getBody()->getContents());

        return new WeatherData($data->location->name, $data->current->temperature, $data->current->feelslike);
    }
}
