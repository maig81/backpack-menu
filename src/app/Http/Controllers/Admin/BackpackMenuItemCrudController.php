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
            [   // PageOrLink
                'name'       => ['type', 'link', 'page_id'],
                'label'      => "Type",
                'type'       => 'page_or_link',
                'page_model' => '\Backpack\PageManager\app\Models\Page'
            ],
            [   // Text
                'name'  => 'title',
                'label' => "Title",
                'type'  => 'text',
            ]
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
