<?php

namespace App\Http\Controllers;

use App\Contract\WeatherServiceContract;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class WeatherApiController extends Controller
{
    public function __construct(public WeatherServiceContract $weatherService)
    {
    }

    /**
     * @param $city
     * @return JsonResponse
     */
    public function show($city):JsonResponse
    {
        try {
            $weather = $this->weatherService->getCityCurrentWeather($city);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['error' => 'Bad request'], 400);
        }

        return response()->json(['data' => [
            'current_temperature' => $weather->current->temp_c,
            'real_feel' => $weather->current->feelslike_c,
        ]]);
    }
}
