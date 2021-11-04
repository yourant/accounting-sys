<?php

namespace Modules\Inventory\Imports\Items\Sheets;

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

        if ($row['warehouse_name'] == null){
            $row['warehouse_id'] = setting('inventory.default_warehouse');
        } else {
            $warehouse = InventoryWarehouse::firstOrCreate([
                'name'              => $row['warehouse_name'],
            ], [
                'company_id'        => company_id(),
                'enabled'           => 1,
            ])->id;

            $row['warehouse_id'] = $warehouse;
        }
        return $row;
    }

    public function rules(): array
    {
        return (new Request())->rules();
    }
}
