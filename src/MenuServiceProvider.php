<?php

namespace GreenAdvertising\BackpackMenu;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/backpack/backpackmenu.php');
        $this->loadViewsFrom(realpath(__DIR__.'/resources/views/vendor/backpack/crud'), 'crud');
        $this->loadViewsFrom(realpath(__DIR__.'/resources/views/backpack_menu'), 'backpack_menu');
        $this->mergeConfigFrom(__DIR__.'/config/backpack_menu_config.php', 'backpack_menu');
        $this->loadMigrationsFrom( __DIR__ . '/database/migrations');


        $this->publishes([
            __DIR__.'/resources/views/backpack_menu' => resource_path('views/vendor/backpack_menu'),
        ], 'public');
    }

    public function register()
    {

    }

}
