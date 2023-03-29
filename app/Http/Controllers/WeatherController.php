<?php

namespace App\Http\Controllers;

use App\Factories\WeatherServiceFactory;
use App\Http\Requests\WeatherRequest;
use App\Service\WeatherAggregateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    public function __construct(private readonly WeatherAggregateService $weatherService)
    {
    }

    public function show($city, WeatherRequest $request):JsonResponse
    {
        try {
            $weatherServiceFactory = new WeatherServiceFactory();
            $weatherService = $weatherServiceFactory->getWeatherService($request->service);

            $weather = $weatherService->getCityCurrentWeather($city);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }

        return response()->json(['data' => $weather]);
    }

    public function aggregate($city):JsonResponse
    {
        try {
            $weather = $this->weatherService->getCityCurrentWeather($city);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Bad request'], 400);
        }

        return response()->json(['data' => [
            'city' => $weather->city,
            'current_temperature' => $weather->current_temperature,
            'real_feel' => $weather->real_feel,
        ]]);
    }
}
