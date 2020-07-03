<?php

namespace Maig81\BackpackMenu\App\Models;

use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class BackpackMenuItem extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'backpack_menu_items';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function getMenuOptions()
    {
        $optionsForMenu = ['link' => trans('backpack::crud.internal_link')];

        if (Config::get('backpack_menu.models')) {
            foreach (Config::get('backpack_menu.models') as $model) {
                $optionsForMenu[$model] = class_basename($model);
            }
        }
        return $optionsForMenu;
    }

    public function getLink()
    {
        if ($this->type == "link") {
            return $this->link;
        }
        // Instance of the model to be linked to (MUST HAVE getLink function or Menuable trait
        $instance = $this->type::find($this->model_id);
        return $instance->getLink();
    }
    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function menu()
    {
        return $this->hasMany('Maig81\BackpackMenu\App\Models\BackpackMenu', 'id', 'backpack_menu_id');
    }

    public function children()
    {
        return $this->hasMany(get_class($this), 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(get_class($this), 'parent_id');
    }
    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
