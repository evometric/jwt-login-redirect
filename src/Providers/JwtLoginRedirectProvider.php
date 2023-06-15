<?php

namespace Evometric\JwtLoginRedirect\Providers;

use Illuminate\Support\ServiceProvider;

class JwtLoginRedirectProvider extends ServiceProvider
{
    public function register()
    {
    }
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }
}