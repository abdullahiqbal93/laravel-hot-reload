<?php

namespace dedsec\LaravelHotReload;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use dedsec\LaravelHotReload\Http\Middleware\HotReloadMiddleware;

class HotReloadServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

         if (function_exists('public_path')) {
            $this->publishes([
                __DIR__ . '/../resources/js' => public_path('dedsec/laravel-hot-reload'),
            ], 'hot-reload-assets');
        }


        $router = $this->app->make(Router::class);
        $router->pushMiddlewareToGroup('web', HotReloadMiddleware::class);
    }

    public function register()
    {
        //
    }
}
