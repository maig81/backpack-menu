<?php

namespace Maig81\BackpackMenu\App\Http\Controllers\Admin;

use Maig81\BackpackMenu\App\Http\Requests\BackpackMenuItemRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BackpackMenuItemCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BackpackMenuItemCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;

    public function setup()
    {
        $this->crud->setModel('Maig81\BackpackMenu\App\Models\BackpackMenuItem');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/backpackmenuitem');
        $this->crud->setEntityNameStrings('Menu Item', 'Menu Items');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(BackpackMenuItemRequest::class);

        $this->crud->addFields([
            [   // Text
                'name'  => 'name',
                'label' => "Title",
                'type'  => 'text',
                'attributes' => [
                    'required' => 'required'
                    ]
                ],
            [   // Text
                'name'  => 'backpack_menu_id',
                'type'  => 'hidden',
                'value' => $_GET['menu_id'] ?? null
            ],
            [   // Defaut depth
                'name'  => 'depth',
                'type'  => 'hidden',
                'value' => 1
            ],
            [
                'name'  => 'lft',
                'type'  => 'hidden',
                'value' => 0
            ],
            [
                'name'  => 'type',
                'type'  => 'hidden',
                'value' => 'link'
            ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->crud->addFields([
            [   // Text
                'name'  => 'name',
                'label' => "Title",
                'type'  => 'text',
            ],
            [   // Menu Items
                'type' => 'menuitems',
                'name' => 'test',
            ],
        ]);
    }
}
