<?php
    /**
     * @var $menuItem
     */

    $type_field_name = 'menu_item_type_' . $menuItem->id;
?>
<div class="{!! isset($field['wrapper']['class']) ? $field['wrapper']['class'] : 'form-group' !!}">
    <label>{!! $field['label'] !!}</label>
    <div class="form-row p-0">

        {{-- SELECT TYPE --}}
        <div class="col pt-0">
            <select data-identifier="page_or_link_select" id="{!! $type_field_name !!}" name="{!! $type_field_name !!}" data-id="{!! $menuItem->id !!}" class="form-control js__select_type">
                @foreach ($menuItem->getMenuOptions() as $key => $value)
                    <option value="{{ $key }}"
                        @if (isset($menuItem->type) && $key==$menuItem->type)
                            selected
                        @endif
                        data-input-id="{!! str_replace('\\', '-', $key) !!}_{!! $menuItem->id !!}"
                    >{{ $value }}</option>
                @endforeach
            </select>
        </div>

        {{-- INPUTS --}}
        <div class="col pt-0">
            <input id="link_{!! $menuItem->id !!}" name="menu_item_link_{!! $menuItem->id !!}"
                   value="{!! $menuItem->link !!}"
                   class="form-control value-input_{!! $menuItem->id !!}"
                   @if ($menuItem->type != 'link') disabled style="display: none" @endif
            >

            @foreach ($menuItem->getMenuOptions() as $key => $value)
                {{-- Skip link filed --}}
                @if(!$loop->first)
                    <select name="menu_item_model_id_{!! $menuItem->id !!}" id="{!! str_replace('\\', '-', $key) !!}_{!! $menuItem->id !!}" class="form-control value-input_{!! $menuItem->id !!}"
                        {{-- Enabled only if model is selected --}}
                        @if ($menuItem->type != $key)
                            disabled
                            style="display: none"
                        @endif>
                        {{-- Get model with values --}}
                        <?php $models = $key::all();?>
                        {{-- List all options form model --}}
                        @foreach ($models as $model)
                            <option value="{!! $model->id !!}"
                                @if ($model->id == $menuItem->model_id)
                                selected
                                @endif
                            >{{ $model->title }}</option>
                        @endforeach
                    </select>
                @endif
            @endforeach
        </div>
{{--        JS KOJI NA SELECT PRVOG HAJDUJE I DISEJBLUJE OSTALA POLJA--}}
{{--        CONFIG GDE CEMO DEFINISATI MODELE--}}
{{--        DOKUMENTACIJA--}}
{{--        PUSH--}}
    </div>
</div>

@push('after_scripts')
    <script>
        $('.js__select_type')
            .off('change')
            .on('change', function() {
            // Hide all inputs
            let div_class = '.value-input_' + $(this).data('id');
            $(div_class).hide();
            $(div_class).prop('disabled', true);

            // show selected input
            let div_id = "#" + $(this).children("option:selected").data('input-id');
            console.log(div_id);
            $(div_id).prop('disabled', false);
            $(div_id).show();
        })
    </script>
@endpush
