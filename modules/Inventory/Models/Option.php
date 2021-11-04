<?php

namespace Modules\Inventory\Models;

use App\Abstracts\Model;
use Bkwld\Cloner\Cloneable;
use Modules\Inventory\Database\Factories\Option as OptionFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Option extends Model
{
    use Cloneable, HasFactory;

    protected $table = 'inventory_options';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'name', 'type', 'enabled'];

    /**
     * Sortable columns.
     *
     * @var array
     */
    public $sortable = ['name', 'type', 'enabled'];

    /**
     * Clonable relationships.
     *
     * @var array
     */
    public $cloneable_relations = ['values'];

    public function values()
    {
        return $this->hasMany('Modules\Inventory\Models\OptionValue');
    }

    public function item_groups()
    {
        return $this->hasMany('Modules\Inventory\Models\ItemGroupOption');
    }

     /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return OptionFactory::new();
    }
}
