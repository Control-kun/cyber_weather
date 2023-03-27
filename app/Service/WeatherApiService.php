<?php

namespace App\Service;

use GuzzleHttp\Client;

class WeatherApiService implements \App\Contract\WeatherServiceContract
{

    public function getCityCurrentWeather(string $city)
    {
//        http://api.weatherapi.com/v1/current.json?key=4183b20f45a04def957221403232603&q=Saint Petersburg&aqi=no

        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'
            ],
        ]);

        $queryString = http_build_query([
            'key' => '4183b20f45a04def957221403232603',
            'q' => $city,
        ]);

        $response = $client->get('http://api.weatherapi.com/v1/current.json?' . $queryString);

        return $response->getBody();
//        dd(2);
    }
}
