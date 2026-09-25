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
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            static $globalSettings = null;
            if ($globalSettings === null) {
                try {
                    if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                        $globalSettings = \App\Models\Setting::all()->pluck('value', 'key')->toArray();
                    } else {
                        $globalSettings = [];
                    }
                } catch (\Throwable $e) {
                    $globalSettings = [];
                }
            }
            $view->with('settings', $globalSettings);
        });
    }
}
