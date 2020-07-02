<?php
/**
     * @var $menu
     */

$menuItems = $menu->menuItemsFirstLevel();
?>

@if ($menuItems)

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                @foreach($menuItems as $menuItem)
                    @include('backpack_menu::menu_item', ['menuItem' => $menuItem])
                @endforeach
            </ul>
        </div>
    </nav>

@endif
