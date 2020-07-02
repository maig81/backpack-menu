<?php
/**
 * @var $menuItem
 */
?>

<li class="nav-item">
    <a class="nav-link" href="{!! $menuItem->getLink() !!}">{{ $menuItem->name }}</a>
</li>
