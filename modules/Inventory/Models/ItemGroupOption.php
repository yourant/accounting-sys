<?php

namespace Modules\Inventory\Models;

use App\Abstracts\Model;
use Bkwld\Cloner\Cloneable;

class ItemGroupOption extends Model
{
    use Cloneable;

    protected $table = 'inventory_item_group_options';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'item_group_id', 'option_id'];

    public function values()
    {
        return $this->hasMany('Modules\Inventory\Models\ItemGroupOptionValue');
    }

    public function option()
    {
        return $this->belongsTo('Modules\Inventory\Models\Option');
    }
}