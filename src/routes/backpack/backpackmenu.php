<?php
/**
 * Defines the routes of Backpack
 */
Route::group([
    'namespace' => 'Maig81\BackpackMenu\App\Http\Controllers\Admin',
    'prefix' => config('backpack.laravel-backpack-menu.prefix', 'admin'),
    'middleware' => ['web', 'admin'],
], function () {
    Route::crud('backpackmenu', 'BackpackMenuCrudController');
    Route::crud('backpackmenuitem', 'BackpackMenuItemCrudController');
});
