<?php

namespace Modules\Inventory\Models;

use App\Abstracts\Model;
use Bkwld\Cloner\Cloneable;

class OptionValue extends Model
{
    use Cloneable;

    protected $table = 'inventory_option_values';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'option_id', 'name'];

    public function option()
    {
        return $this->belongsTo('Modules\Inventory\Models\Option');
    }
}
