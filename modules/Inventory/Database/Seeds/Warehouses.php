<?php

namespace Modules\Inventory\Database\Seeds;

use App\Abstracts\Model;
use App\Utilities\Overrider;
use App\Models\Common\Company;
use Modules\Inventory\Models\Warehouse;

use Illuminate\Database\Seeder;

class Warehouses extends Seeder
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
        $row = [
            'company_id' => company_id(),
            'name' => trans('inventory::warehouses.main_warehouse'),
            'enabled' => true,
        ];

        $warehouse = Warehouse::firstOrCreate($row);

        setting()->set('inventory.default_warehouse', $warehouse->id);
        setting()->save();
    }
}
