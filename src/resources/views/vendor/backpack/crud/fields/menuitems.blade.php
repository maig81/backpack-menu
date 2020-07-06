<div class="form-group col-sm-12">
    <h5>Menu items</h5>
    @if (isset($entry))
        <a href="{!! route('backpackmenuitem.create') !!}?menu_id={!! $entry->id !!}">
            <button type="button" class="btn btn-primary">+ {!! __('Add Menu Item') !!}</button>
        </a>
        @include('crud::fields.single_menu_item', ['menuItems' => $entry->menuItems->where('depth', 1)])
    @else
{{--        TODO add --}}
    @endif
    <input type="hidden" name="menuItems" id="menuItems">
</div>

@push('after_styles')
    <style>
        .ui-sortable .placeholder {
            /*outline: 1px dashed #4183C4;*/
            /*-webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            margin: -1px;*/
        }

        .ui-sortable .mjs-nestedSortable-error {
            background: #fbe3e4;
            border-color: transparent;
        }

        .ui-sortable ol {
            margin: 0;
            padding: 0;
            padding-left: 30px;
        }

        ol.sortable, ol.sortable ol {
            margin: 0 0 0 25px;
            padding: 0;
            list-style-type: none;
        }

        ol.sortable {
            margin: 2em 0;
        }

        .sortable li {
            margin: 5px 0 0 0;
            padding: 0;
        }

        .sortable li div  {
            /*border: 1px solid #ddd;*/
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            padding: 6px;
            margin: 0;
            cursor: move;
            background-color: #f4f4f4;
            color: #444;
            border-color: #00acd6;
        }

        .sortable li.mjs-nestedSortable-branch div {
            /*background-color: #00c0ef;*/
            /*border-color: #00acd6;*/
        }

        .sortable li.mjs-nestedSortable-leaf div {
            /*background-color: #00c0ef;*/
            border: 1px solid #ddd;
        }

        li.mjs-nestedSortable-collapsed.mjs-nestedSortable-hovering div {
            border-color: #999;
            background: #fafafa;
        }

        .ui-sortable .disclose {
            cursor: pointer;
            width: 10px;
            display: none;
        }

        .sortable li.mjs-nestedSortable-collapsed > ol {
            display: none;
        }

        .sortable li.mjs-nestedSortable-branch > div > .disclose {
            display: inline-block;
        }

        .sortable li.mjs-nestedSortable-collapsed > div > .disclose > span:before {
            content: '+ ';
        }

        .sortable li.mjs-nestedSortable-expanded > div > .disclose > span:before {
            content: '- ';
        }

        .ui-sortable h1 {
            font-size: 2em;
            margin-bottom: 0;
        }

        .ui-sortable h2 {
            font-size: 1.2em;
            font-weight: normal;
            font-style: italic;
            margin-top: .2em;
            margin-bottom: 1.5em;
        }

        .ui-sortable h3 {
            font-size: 1em;
            margin: 1em 0 .3em;;
        }

        .ui-sortable p, .ui-sortable ol, .ui-sortable ul, .ui-sortable pre, .ui-sortable form {
            margin-top: 0;
            margin-bottom: 1em;
        }

        .ui-sortable dl {
            margin: 0;
        }

        .ui-sortable dd {
            margin: 0;
            padding: 0 0 0 1.5em;
        }

        .ui-sortable code {
            background: #e5e5e5;
        }

        .ui-sortable input {
            vertical-align: text-bottom;
        }

        .ui-sortable .notice {
            color: #c33;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('packages/backpack/crud/css/crud.css') }}">
@endpush

@push('after_scripts')
    <script src="{{ asset('packages/jquery-ui-dist/jquery-ui.min.js') }}" type="text/javascript" ></script>
    <script src="{{ asset('packages/nestedSortable/jquery.mjs.nestedSortable2.js') }}" type="text/javascript" ></script>

    <script type="text/javascript">
        jQuery(document).ready(function($) {

            // initialize the nested sortable plugin
            $('.sortable').nestedSortable({
                forcePlaceholderSize: true,
                handle: 'div',
                helper: 'clone',
                items: 'li',
                opacity: .6,
                placeholder: 'placeholder',
                revert: 250,
                tabSize: 25,
                tolerance: 'pointer',
                toleranceElement: '> div',
                maxLevels: {{ $crud->get('reorder.max_level') ?? 3 }},

                isTree: true,
                expandOnHover: 700,
                startCollapsed: false
            });

            $('.sortable').on('sortstop', function() {
                arraied = $('ol.sortable').nestedSortable('toArray', {startDepthCount: 0});

                arraied.forEach(function(element) {
                    $("#menu_item_lft_" + element.item_id).val(element.left);
                    $("#menu_item_rgt_" + element.item_id).val(element.right);
                    $("#menu_item_depth_" + element.item_id).val(element.depth);
                    $("#menu_item_parent_id_" + element.item_id).val(element.parent_id);
                });

                jsonValues = JSON.stringify(arraied);
                $('#menuItems').val(jsonValues);
            });

            $('#toArray').click(function(e) {
                // get the current tree order
                arraied = $('ol.sortable').nestedSortable('toArray', {startDepthCount: 0});

                // log it
                console.log(arraied);

                // send it with POST
                $.ajax({
                    url: '{{ Request::url() }}',
                    type: 'POST',
                    data: {tree: arraied},
                })
                    .done(function () {
                        new Noty({
                            type: "success",
                            text: "<strong>{{ trans('backpack::crud.reorder_success_title') }}</strong><br>{{ trans('backpack::crud.reorder_success_message') }}"
                        }).show();
                    })
                    .fail(function () {
                        new Noty({
                            type: "error",
                            text: "<strong>{{ trans('backpack::crud.reorder_error_title') }}</strong><br>{{ trans('backpack::crud.reorder_error_message') }}"
                        }).show();
                    })
                    .always(function () {
                        console.log("complete");
                    });
            });
        });

    </script>
@endpush
