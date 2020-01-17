<?php

namespace Diskominfo;

use Illuminate\Support\ServiceProvider;

class DiceroServiceProvider extends ServiceProvider {

    public function boot(){
        $this->loadMigrationsFrom(__DIR__."/database/migrations");
    }
}