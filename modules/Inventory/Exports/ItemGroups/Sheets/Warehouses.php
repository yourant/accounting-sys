<?php

namespace Modules\Inventory\Exports\ItemGroups\Sheets;

use App\Abstracts\Export;
use App\Models\Common\Item;
use Modules\Inventory\Models\Item as Model;
use Modules\Inventory\Models\Warehouse as InventoryWarehouse;
use Modules\Inventory\Models\ItemGroupOptionItem;

class Warehouses extends Export
{
    public function collection()
    {
        $model = Model::usingSearchString(request('search'));

        if (!empty($this->ids)) {
            $model->whereIn('id', (array) $this->ids);
        }

        return $model->get();
    }

    public function map($model): array
    {
        $model->warehouse_name =  InventoryWarehouse::where('id', $model->warehouse_id)->pluck('name')->first();
        $model->item_name = Item::where('id', $model->item_id)->pluck('name')->first();

        return parent::map($model);

    }

    public function fields(): array
    {
        return [
            'item_name',
            'opening_stock',
            'opening_stock_value',
            'reorder_level',
            'warehouse_name',
            'sku',
        ];
    }
}
