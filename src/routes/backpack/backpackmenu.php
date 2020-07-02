<?php
/**
 * Defines the routes of Backpack
 */
Route::group([
    'namespace' => 'GreenAdvertising\BackpackMenu\App\Http\Controllers\Admin',
    'prefix' => config('backpack.laravel-backpack-menu.prefix', 'admin'),
    'middleware' => ['web', 'admin'],
], function () {
    Route::crud('backpackmenu', 'BackpackMenuCrudController');
    Route::crud('backpackmenuitem', 'BackpackMenuItemCrudController');
});
