<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;   // <-- Añadir esto arriba
use Illuminate\Support\Facades\Log;  // <-- Añadir esto arriba

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
        // <-- Todo va aquí dentro:
        DB::listen(function ($query) {
            Log::info("SQL: {$query->sql} | Bindings: " . json_encode($query->bindings) . " | Time: {$query->time}ms");
        });
    }
}