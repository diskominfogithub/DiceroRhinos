<?php

namespace Diskominfo;

use Illuminate\Support\ServiceProvider;

class DiceroServiceProvider extends ServiceProvider {

    public function boot(){
        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations')
        ], 'migrations');
    }
}