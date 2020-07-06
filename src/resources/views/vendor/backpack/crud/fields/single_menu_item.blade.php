<ol class="sortable mt-0">
    <?php foreach ($menuItems as $menuItem): ?>
    <li id="li_{!! $menuItem->id !!}">
        <div id="div_{!! $menuItem->id !!}" class="row">

            {{-- Title and hidden --}}
            <div class="form-group col-sm-4">
                <label>{!! __('Title') !!}</label>
                <input class="form-control" name="menu_item_name_{!! $menuItem->id !!}" value="{!! $menuItem->name !!}">
                <input type="hidden" name="menu_item_lft_{!! $menuItem->id !!}" id="menu_item_lft_{!! $menuItem->id !!}" value="{!! $menuItem->lft !!}">
                <input type="hidden" name="menu_item_rgt_{!! $menuItem->id !!}"  id="menu_item_rgt_{!! $menuItem->id !!}" value="{!! $menuItem->rgt !!}">
                <input type="hidden" name="menu_item_depth_{!! $menuItem->id !!}" id="menu_item_depth_{!! $menuItem->id !!}" value="{!! $menuItem->depth !!}">
                <input type="hidden" name="menu_item_parent_id_{!! $menuItem->id !!}" id="menu_item_parent_id_{!! $menuItem->id !!}" value="{!! $menuItem->parent_id !!}">
            </div>

            {{-- Model or link field--}}
            <?php
            $field = [
                'label' => 'Link',
                'menuItem' => $menuItem,
                'wrapper'   => [
                    'class' => 'form-group col-sm-7'
                ],
            ];
            ?>
            @include('crud::fields.model_or_link', ['field' => $field])

            {{-- Delete Menu Item--}}
            <div class="form-group col-sm-1 text-right">
                <i class="la la-trash js__delete_menu_item text-danger" data-id="{!! $menuItem->id !!}"></i>
            </div>
        </div>

        {{-- Children --}}
        @if(isset($menuItem->children) && !empty($menuItem->children))
            @include('crud::fields.single_menu_item', ['menuItems' => $menuItem->children])
        @endif

    </li>
    <?php endforeach; ?>
</ol>
