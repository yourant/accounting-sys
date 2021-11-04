<?php

namespace Modules\Inventory\Models;

use App\Abstracts\Model;
use Bkwld\Cloner\Cloneable;

class StockOut extends Model
{
    use Cloneable;

    protected $table = 'stock_out';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['item', 'sku', 'quantity', 'sale_price' , 'created_at', 'updated_at', 'deleted_at', 'enabled'];

    // public function item()
    // {
    //     return $this->belongsTo('App\Models\Common\Item')->withDefault(['name' => trans('general.na')]);
    // }

    // public function values()
    // {
    //     return $this->hasMany('Modules\Inventory\Models\OptionValue');
    // }

    // public function warehouse()
    // {
    //     return $this->belongsTo('Modules\Inventory\Models\Warehouse');
    // }

    // public function history()
    // {
    //     return $this->belongsTo('Modules\Inventory\Models\History', 'item_id', 'item_id');
    // }

    // public function histories()
    // {
    //     return $this->hasMany('Modules\Inventory\Models\History', 'item_id', 'item_id');
    // }

    // public function bill_items()
    // {
    //     return $this->hasMany('App\Models\Purchase\BillItem');
    // }

    // public function invoice_items()
    // {
    //     return $this->hasMany('App\Models\Sale\InvoiceItem');
    // }

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
