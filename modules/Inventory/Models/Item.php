<?php

namespace Modules\Inventory\Models;

use App\Abstracts\Model;
use Bkwld\Cloner\Cloneable;

class Item extends Model
{
    use Cloneable;

    protected $table = 'inventory_items';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'item_id', 'sku', 'opening_stock', 'opening_stock_value', 'reorder_level', 'vendor_id', 'warehouse_id', 'default_warehouse'];

    public function item()
    {
        return $this->belongsTo('App\Models\Common\Item')->withDefault(['name' => trans('general.na')]);
    }

    public function values()
    {
        return $this->hasMany('Modules\Inventory\Models\OptionValue');
    }

    public function warehouse()
    {
        return $this->belongsTo('Modules\Inventory\Models\Warehouse');
    }

    public function history()
    {
        return $this->belongsTo('Modules\Inventory\Models\History', 'item_id', 'item_id');
    }

    public function histories()
    {
        return $this->hasMany('Modules\Inventory\Models\History', 'item_id', 'item_id');
    }

    public function bill_items()
    {
        return $this->hasMany('App\Models\Purchase\BillItem');
    }

    public function invoice_items()
    {
        return $this->hasMany('App\Models\Sale\InvoiceItem');
    }

    /**
     * Get the current balance.
     *
     * @return string
     */
    /*
    public function getWarehouseIdAttribute()
    {
        $item_warehouse = $this->belongsTo('Modules\Inventory\Models\WarehouseItem', 'item_id', 'item_id')->first();

        return $item_warehouse->warehouse_id;
    }
    */
}
