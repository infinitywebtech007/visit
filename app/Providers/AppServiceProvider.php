<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (!function_exists('settings')) {
            function settings($key = null, $default = null)
            {
                $settings = \Cache::remember('app_settings', 3600, function () {
                    return \App\Models\Setting::pluck('value', 'key')->toArray();
                });

                return $key ? $settings[$key] ?? $default : $settings;
            }
        }
    }
}
