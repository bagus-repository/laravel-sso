<?php

namespace Forisa\Sso\Providers;

use Forisa\Sso\Core\SsoManager;
use Forisa\Sso\Middleware\Sso;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

class SsoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('sso_manager', SsoManager::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function boot()
    {
        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('sso', Sso::class);

        $this->loadViewsFrom(__DIR__ . '/../views', 'Sso');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        $this->publish();
    }

    protected function publish()
    {
        $this->publishes(
            [
                __DIR__ . '/../config/forisasso.php' => config_path('forisasso.php'),
            ],
            'forisa-sso'
        );
    }
}
