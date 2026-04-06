<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

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
        // Força o idioma para português brasileiro
        App::setLocale('pt_BR');
        config(['app.locale' => 'pt_BR']);
        config(['app.fallback_locale' => 'pt_BR']);
    }
}
