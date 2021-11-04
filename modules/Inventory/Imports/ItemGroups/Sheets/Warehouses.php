<?php

namespace Modules\Inventory\Imports\ItemGroups\Sheets;

use App\Abstracts\Import;
use App\Models\Common\Item;
use Modules\Inventory\Http\Requests\Item as Request;
use Modules\Inventory\Models\Item as Model;
use Modules\Inventory\Models\Warehouse as InventoryWarehouse;

class Warehouses extends Import
{
    public function model(array $row)
    {
        return new Model($row);
    }

    public function map($row): array
    {
        $row = parent::map($row);

        $row['item_id'] = Item::where('name', $row['item_name'])->pluck('id')->first();

        $warehouse = InventoryWarehouse::firstOrCreate([
            'name'              => $row['warehouse_name'],
        ], [
            'company_id'        => company_id(),
            'enabled'           => 1,
        ])->id;

        $row['warehouse_id'] = $warehouse;

        return $row;
    }

    public function rules(): array
    {
        return (new Request())->rules();
    }
}
