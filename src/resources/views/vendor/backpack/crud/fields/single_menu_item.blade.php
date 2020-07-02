<ol class="sortable mt-0">
    <?php foreach ($menuItems as $menuItem): ?>
    <li id="li_{!! $menuItem->id !!}">
        <div id="div_{!! $menuItem->id !!}">
            <div class="form-group col-sm-12">
                <label>{!! __('Title') !!}</label>
                <input class="form-control" name="menu_item_name_{!! $menuItem->id !!}" value="{!! $menuItem->name !!}">
                <input type="hidden" name="menu_item_lft_{!! $menuItem->id !!}" id="menu_item_lft_{!! $menuItem->id !!}" value="{!! $menuItem->lft !!}">
                <input type="hidden" name="menu_item_rgt_{!! $menuItem->id !!}"  id="menu_item_rgt_{!! $menuItem->id !!}" value="{!! $menuItem->rgt !!}">
                <input type="hidden" name="menu_item_depth_{!! $menuItem->id !!}" id="menu_item_depth_{!! $menuItem->id !!}" value="{!! $menuItem->depth !!}">
                <input type="hidden" name="menu_item_parent_id_{!! $menuItem->id !!}" id="menu_item_parent_id_{!! $menuItem->id !!}" value="{!! $menuItem->parent_id !!}">
            </div>

            <?php
                $field = [
                    'page_model' => "App\Models\Page",
                    'slug' => 'slug',
                    'label' => 'Link',
                    'menuItem' => $menuItem,
                ];
            ?>
            @include('crud::fields.model_or_link', ['field' => $field])
        </div>


        @if(isset($menuItem->children) && !empty($menuItem->children))
            @include('crud::fields.single_menu_item', ['menuItems' => $menuItem->children])
        @endif
    </li>
    <?php endforeach; ?>
</ol>
