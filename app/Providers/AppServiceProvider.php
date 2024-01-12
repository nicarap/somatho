<?php

namespace App\Providers;

use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
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
        FilamentAsset::register([
            Css::make("custom_leaflet_style", "https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"),
            Js::make("custom_leaflet", "https://unpkg.com/leaflet@1.7.1/dist/leaflet.js")
        ]);
    }
}
