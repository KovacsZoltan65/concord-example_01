<?php

namespace SoftC\Installer\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Event;
use SoftC\Installer\Http\Middleware\CanInstall;
use SoftC\Installer\Http\Middleware\Locale;

class InstallerServiceProvider extends ServiceProvider
{
    protected bool $defer = false;

    public function boot(Router $router): void 
    {
        $router->middlewareGroup('install', [CanInstall::class]);

        $this->loadTranslationsFrom(dirname(__DIR__) . '/resources/lang', 'installer');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'installer');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'installer');
        
        $router->aliasMiddleware('installer_locale', Locale::class);

        Event::listen('krayin.installed', 'SoftC\Installer\Listeners\Installer@installed');
    }
}