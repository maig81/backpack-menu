<?php

namespace Maig81\BackpackMenu\App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Request;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use Maig81\BackpackMenu\App\Models\BackpackMenu;
use Maig81\BackpackMenu\App\Models\BackpackMenuItem;
use Maig81\BackpackMenu\App\Http\Requests\BackpackMenuRequest;
use Maig81\BackpackMenu\App\Http\Requests\BackpackMenuItemRequest;

/**
 * Class BackpackMenuCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BackpackMenuCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {
        update as traitUpdate;
    }

    public function setup()
    {
        $this->crud->setModel('Maig81\BackpackMenu\App\Models\BackpackMenu');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/backpackmenu');
        $this->crud->setEntityNameStrings('Menu', 'Menus');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(BackpackMenuRequest::class);

        $this->crud->addFields([
            [   // Text
                'name' => 'name',
                'label' => 'Title',
            ],
            [   // relationship
                'type' => "menuitems",
                'name' => 'test',
            ]


        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }


    public function update(BackpackMenuRequest $request)
    {
        $backpackMenu = BackpackMenu::find($request->id);

        // Save child menu items
        foreach ($backpackMenu->menuItems as $menuItem) {
            // TODO VALIDATE INPUT
            $fields = ['name', 'lft', 'rgt', 'depth', 'parent_id', 'type', 'link', 'model_id'];
            foreach ($fields as $field) {
                $fieldName = 'menu_item_' . $field . '_' . $menuItem->id;
                $menuItem->$field = $request->$fieldName;
            }
            $menuItem->save();
        }

        $response = $this->traitUpdate();
        return $response;
    }
}
