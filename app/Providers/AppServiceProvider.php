<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Variant;
use App\Observers\VariantObserver;

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
        // Set the default string length for database migrations
        // to avoid issues with MySQL's default string length limit
        Schema::defaultStringLength(191);

        // Register the observer for the Variant model        
        Variant::observe(VariantObserver::class);

    }
}
