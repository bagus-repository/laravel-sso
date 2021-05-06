<?php

namespace Dptsi\Sso\Providers;

use Dptsi\Sso\Core\AuthManager;
use Illuminate\Support\Facades\App;
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
        $this->app->singleton('auth', AuthManager::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }

    protected function publish()
    {
    }
}
