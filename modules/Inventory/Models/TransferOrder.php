<?php

namespace Modules\Inventory\Models;

use App\Abstracts\Model;
use Bkwld\Cloner\Cloneable;
use Modules\Inventory\Database\Factories\TransferOrder as TransferOrderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TransferOrder extends Model
{
    use Cloneable, HasFactory;

    protected $table = 'inventory_transfer_orders';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'item_id', 'date', 'transfer_order', 'reason', 'transfer_quantity', 'source_warehouse_id', 'destination_warehouse_id'];

    public $cloneable_relations = ['items'];

    public function item()
    {
        return $this->belongsTo('App\Models\Common\Item')->withDefault(['name' => trans('general.na')]);
    }

    public function source_warehouse()
    {
        return $this->belongsTo('Modules\Inventory\Models\Warehouse', 'source_warehouse_id', 'id')->withDefault(['name' => trans('general.na')]);
    }

    public function destination_warehouse()
    {
        return $this->belongsTo('Modules\Inventory\Models\Warehouse', 'destination_warehouse_id', 'id')->withDefault(['name' => trans('general.na')]);
    }

    public function getItemQuantityAttribute()
    {
        if (empty($this->item_id)) {
            return 0;
        }

        return  \Modules\Inventory\Models\Item::where('warehouse_id', $this->source_warehouse_id)
            ->where('item_id', $this->item_id)
            ->value('opening_stock');
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return TransferOrderFactory::new();
    }
}
