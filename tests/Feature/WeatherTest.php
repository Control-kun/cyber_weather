<?php

namespace Tests\Feature;

use App\Enum\WeatherServicesEnum;
use Tests\TestCase;

class WeatherTest extends TestCase
{
    protected const API_URL = '/api/';


    /**
     * @dataProvider serviceNamesDataProvider
     */

    public function testGetWeatherSuccessData($service)
    {
        $structure = [
            'data' => [
                'city',
                'current_temperature',
                'real_feel',
            ],
        ];

        $response = $this
            ->get(self::API_URL . 'weather/Saint Petersburg?service=' . $service,
                [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ]);

        $response->assertOk();
        $response
            ->assertJsonStructure($structure);
    }

    public function serviceNamesDataProvider(): array
    {
        $serviceListEnums = WeatherServicesEnum::cases();

        foreach ($serviceListEnums as $enum) {
            $data[] = [$enum->name];
        }

        return $data;
    }

    public function testGetWeatherWrongServiceError()
    {
        $response = $this
            ->get(self::API_URL . 'weather/Saint Petersburg?service=123',
                [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ]);

        $response->assertStatus(400);
        $this->assertTrue(
            $response->getStatusCode() === 400,
            'Invalid service name'
        );
    }

    public function testGetWeatherUnsuccessful()
    {

        $response = $this
            ->get(self::API_URL . 'weather/',
                [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ]);

        $response->assertStatus(404);
    }

    public function testGetWeatherValidationError()
    {

        $response = $this
            ->get(self::API_URL . 'weather/Saint Petersburg?service=',
                [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ]);

        $response->assertStatus(422);
    }

    /**
     * @dataProvider serviceNamesDataProvider
     */

    public function testGetWeatherCityWrongCity($service)
    {

        $response = $this
            ->get(self::API_URL . 'weather-stack/123'  . $service,
                [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json'
                ]);

        $response->assertStatus(404);
    }
}
