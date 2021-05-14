<?php

namespace Dptsi\Sso\Providers;

use Dptsi\Sso\Core\SsoManager;
use Dptsi\Sso\Middleware\Sso;
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

        $this->publish();
    }

    protected function publish()
    {
        $this->publishes(
            [
                __DIR__ . '/../config/openid.php' => config_path('openid.php'),
            ]
        );
    }
}
