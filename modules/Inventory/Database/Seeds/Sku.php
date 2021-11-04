<?php

namespace Modules\Inventory\Database\Seeds;

use App\Abstracts\Model;
use App\Utilities\Overrider;
use App\Models\Common\Item;
use Modules\Inventory\Models\Item as InventoryItem;
use Illuminate\Database\Seeder;

class Sku extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->create();

        Model::reguard();
    }

    private function create()
    {
        $company_id = $this->command->argument('company');

        $items = Item::all();

        foreach ($items as $item) {
            $inventory_item = InventoryItem::where('item_id', $item->id)->first();

            if (empty($inventory_item)) {
                InventoryItem::create([
                    'company_id'            => company_id(),
                    'item_id'               => $item->id,
                    'sku'                   => isset($item->sku) ? $item->sku : 0,
                    'opening_stock'         => $item->quantity,
                    'opening_stock_value'   => $item->quantity,
                    'warehouse_id'          => 1,
                    'default_warehouse'     => 1,
                ]);
            } else {
                $inventory_item->sku = $item->sku;
                $inventory_item->opening_stock = $item->quantity;
                $inventory_item->update();
            }
        }

        setting()->set('inventory.sku_transferred', 1);
        setting()->save();
    }
}
