<?php

namespace Maig81\BackpackMenu;

use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Routes
        $this->loadRoutesFrom(__DIR__ . '/routes/backpack/backpackmenu.php');

        // Views
        $this->loadViewsFrom(realpath(__DIR__.'/resources/views/vendor/backpack/crud'), 'crud');
        $this->loadViewsFrom(realpath(__DIR__.'/resources/views/backpack_menu'), 'backpack_menu');

        // Migrations and Config
        $this->loadMigrationsFrom( __DIR__ . '/database/migrations');
        $this->mergeConfigFrom(__DIR__.'/config/backpackmenu.php', 'backpack_menu');

        // Publishing config and migrations
        $this->publishes([
            __DIR__.'/resources/views/backpack_menu' => resource_path('views/vendor/backpack_menu'),
        ], 'public');
        $this->publishes([
            __DIR__.'/config/backpackmenu.php' => config_path('backpackmenu.php')
        ], 'config');


    }

    public function register()
    {

    }

}
