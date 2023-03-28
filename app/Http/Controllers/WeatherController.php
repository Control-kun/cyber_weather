<?php

namespace App\Http\Controllers;

use App\Service\WeatherAggregateService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class WeatherController extends Controller
{
    public function __construct(private readonly WeatherAggregateService $weatherService)
    {
    }

    public function show($city):JsonResponse
    {
        try {
            $weather = $this->weatherService->getCityCurrentWeather($city);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Bad request'], 400);
        }

        return response()->json(['data' => [
            'current_temperature' => $weather->current_temperature,
            'real_feel' => $weather->real_feel,
        ]]);
    }
}
