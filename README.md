# maig81/backpack-menu
An multiple menu manager for Laravel Backpack. Created out of the need to make multiple menus and to include multiple models in the menu.
It also has a bootstrap menu frontend blade files. 

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
1. Edit `config/backpackmenu.php` and add models you need to be in the Menu system. The Model should have `title` as it will be in the list. 
1. Edit files in `views/vendor/backpack_menu` if you need to alter the views. As the names suggest, `menu_template.php` is the outer template for the menu, and the `menu_item.blade.php` is a single link that calls itself recursively if there are children.
1. BackpackMenu model has `getMenuView()` that will generate a menu from `views/vendor/backpack_menu` views.

## Example
This is a crude example... You can make a field in your template to get the menu you need.  

Add this to your view controller:
```
$menu = \Maig81\BackpackMenu\App\Models\BackpackMenu::find(1);
return view('your_view', ["menu" => $menu]);
```
Then, in your view you can add to get the bootstrap menu generated:
```
$menu->getMenuView();
```

## To Do
1. Add `Menuable` Trait that you can add to the model. It will add `getLink()` and `getTitle()` function.   