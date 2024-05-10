<?php

namespace Diskominfo;

use Illuminate\Support\ServiceProvider;
use Diskominfo\Middlewares\AuthLogin;
use Diskominfo\Middlewares\MustLogin;
use Diskominfo\Middlewares\AdminLogin;
use Diskominfo\Middlewares\DiceroMiddleware;

class DiceroServiceProvider extends ServiceProvider
{

    public function boot()
    {

        $this->publishes([
            __DIR__ . '/AuthController.php' => app_path('Http/Controllers/AuthController.php'),
            __DIR__ . '/config/dicero.php' => config_path('dicero.php'),
            __DIR__ . '/database/migrations/' => database_path('migrations'),
            __DIR__ . '/database/seeds/' => database_path('seeds'),
            __DIR__ . '/helpers/' => app_path(),
            __DIR__ . '/routes.php' => base_path("routes/web.php")
        ], 'all');

        $this->loadMiddleware();
    }

    protected function loadMiddleware()
    {
        app('router')->aliasMiddleware('auth.login', AuthLogin::class);
        app('router')->aliasMiddleware('opd.login', MustLogin::class);
        app('router')->aliasMiddleware('admin.login', AdminLogin::class);
        app('router')->aliasMiddleware('role', DiceroMiddleware::class);
    }
}
