<?php

namespace SoftC\Core\Providers;

use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        /*
        include __DIR__.'/../Http/helpers.php';

        $this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');

        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'core');

        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'core');

        $this->publishes([
            dirname(__DIR__).'/Config/concord.php' => config_path('concord.php'),
            dirname(__DIR__).'/Config/cors.php'    => config_path('cors.php'),
            dirname(__DIR__).'/Config/sanctum.php' => config_path('sanctum.php'),
        ]);
        */
    }
}