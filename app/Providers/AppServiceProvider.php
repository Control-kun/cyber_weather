<?php

namespace App\Providers;

use App\Contract\WeatherServiceContract;
use App\Http\Controllers\WeatherApiController;
use App\Http\Controllers\WeatherController;
use App\Http\Controllers\WeatherstackController;
use App\Service\WeatherAggregateService;
use App\Service\WeatherApiService;
use App\Service\WeatherStackService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            WeatherServiceContract::class,
            WeatherStackService::class
        );

        $this->app->bind(
            WeatherServiceContract::class,
            WeatherApiService::class
        );

        $this->app->when(WeatherApiController::class)
            ->needs(WeatherServiceContract::class)
            ->give(function () {
                return new WeatherApiService();
            });

        $this->app->when(WeatherstackController::class)
            ->needs(WeatherServiceContract::class)
            ->give(function () {
                return new WeatherStackService();
            });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
