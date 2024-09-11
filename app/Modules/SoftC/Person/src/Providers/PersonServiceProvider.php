<?php

namespace SoftC\Person\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class PersonServiceProvider extends ServiceProvider
{
    public function boot(Router $router): void {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }
    
    public function register() {}
}