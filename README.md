# Maig81\MenuManager
An multiple menu manager for Laravel Backpack. Created out of the need to make multiple menus and to include multiple models in the menu. 

## Install
1. Run in your terminal:
    ```
    composer require maig81/backpack-menu
    ``` 
1.  Publish the views, config and migrations:
    ```
    php artisan vendor:publish --provider="Maig81\BackpackMenu\MenuServiceProvider"
    ```
1. Run the migration to have the database table we need:
    ```
    php artisan migrate
    ```
1. [optional] Add a menu item for it in resources/views/vendor/backpack/base/inc/sidebar.blade.php or menu.blade.php:    
    ```
    php artisan backpack:add-sidebar-content "<li class='nav-item'><a class='nav-link' href='{{ backpack_url('backpackmenu') }}'><i class='nav-icon fa fa-file-o'></i> <span>Menus</span></a></li>"
    ```
   
## Usage
1. 
    