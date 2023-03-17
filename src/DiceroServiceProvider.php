<?php

namespace Diskominfo;

use Illuminate\Support\ServiceProvider;

class DiceroServiceProvider extends ServiceProvider {

    public function boot(){

        $this->publishes([
            __DIR__.'/config/dicero.php' => config_path('dicero.php'),
            __DIR__.'/database/migrations/' => database_path('migrations'),
             __DIR__.'/database/seeds/' => database_path('seeds'),
            __DIR__.'/helpers/' => app_path()
        ],'all');
        
        $this->loadMiddleware();
    }
    
    protected function loadMiddleware()
    {
        app('router')->aliasMiddleware('auth.login', AuthLogin::class);
        app('router')->aliasMiddleware('opd.login', MustLogin::class);
        app('router')->aliasMiddleware('admin.login', AdminLogin::class);
       
    }
}
