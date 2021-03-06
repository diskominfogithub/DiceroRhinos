<?php

namespace Diskominfo;

use Illuminate\Support\ServiceProvider;

class DiceroServiceProvider extends ServiceProvider {

    public function boot(){

        $this->publishes([
            __DIR__.'/config/dicero.php' => config_path('dicero.php')
        ],'config');

        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations')
        ], 'migrations');

        $this->publishes([
            __DIR__.'/database/seeds/' => database_path('seeds')
        ], 'seeds');

        $this->publishes([
            __DIR__.'/helpers/' => app_path()
        ],'helpers');
    }
}