<?php

namespace SoftC\Persons\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;

class PersonServiceProvider extends ServiceProvider
{
    public function boot(Router $router): void
    {
        include __DIR__.'/../Http/helpers.php';

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'person');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'person');

        Blade::anonymousComponentPath(__DIR__.'/../resources/views/components', 'person');

        $this->publishes([
            dirname(__DIR__).'/Config/softc.php' => config_path('softc.php'),
            dirname(__DIR__).'/Config/persons.php'    => config_path('persons.php'),
            dirname(__DIR__).'/Config/sanctum.php' => config_path('sanctum.php'),
        ]);
    }
    
    public function register() {}
}