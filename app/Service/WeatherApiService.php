<?php

namespace App\Service;

use App\Data\WeatherData;
use GuzzleHttp\Client;

class WeatherApiService implements \App\Contract\WeatherServiceContract
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
            'key' => config('weather.api_key'),
            'q' => htmlspecialchars($city),
            'aqi' => 'no'
        ]);

        $response = $client->get('http://api.weatherapi.com/v1/current.json?' . $queryString);

        $data = json_decode($response->getBody()->getContents());

        return new WeatherData($data->location->name,$data->current->temp_c, $data->current->feelslike_c);
    }
}
