<?php

namespace Modules\Inventory\Models;

use App\Abstracts\Model;
use Bkwld\Cloner\Cloneable;
use Modules\Inventory\Database\Factories\Warehouse as WarehouseFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Warehouse extends Model
{
    use Cloneable, HasFactory;

    protected $table = 'inventory_warehouses';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'name', 'email', 'phone', 'address', 'enabled'];

    /**
     * Sortable columns.
     *
     * @var array
     */
    public $sortable = ['name', 'email', 'phone', 'enabled'];

    /**
     * Clonable relationships.
     *
     * @var array
     */
    public $cloneable_relations = ['items'];

    public function items()
    {
        return $this->hasMany('Modules\Inventory\Models\WarehouseItem');
    }

    public function warehouses_items()
    {
        return $this->hasMany('App\Models\Common\Item');
    }

    public function getDefaultWarehouseAttribute()
    {
        return (setting('inventory.default_warehouse', 1) == $this->id) ? true : false;
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return WarehouseFactory::new();
    }
}
