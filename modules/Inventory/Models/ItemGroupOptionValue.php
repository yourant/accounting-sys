<?php

namespace Modules\Inventory\Models;

use App\Abstracts\Model;
use Bkwld\Cloner\Cloneable;

class ItemGroupOptionValue extends Model
{
    use Cloneable;

    protected $table = 'inventory_item_group_option_values';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'item_group_id', 'item_group_option_id', 'option_id', 'option_value_id'];

    public function value()
    {
        return $this->belongsTo('Modules\Inventory\Models\OptionValue');
    }
}
