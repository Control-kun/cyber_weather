<?php

namespace Tests\Feature;

use Tests\TestCase;

class WeatherTest extends TestCase
{
    protected const API_URL = '/api/';

    public function testGetWeatherStackSuccessData()
    {
        $structure = [
            'data' => [
                'city',
                'current_temperature',
                'real_feel',
            ],
        ];

        $response = $this
            ->get(self::API_URL . 'weather-stack/Saint Petersburg',
                [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ]);

        $response->assertOk();
        $response
            ->assertJsonStructure($structure);
    }

    public function testGetWeatherStackUnsuccessful()
    {

        $response = $this
            ->get(self::API_URL . 'weather-stack/',
                [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ]);

        $response->assertStatus(404);
    }

    public function testGetWeatherCityWrongCity()
    {

        $response = $this
            ->get(self::API_URL . 'weather-stack/123',
                [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ]);

        $response->assertStatus(400);
    }
}
