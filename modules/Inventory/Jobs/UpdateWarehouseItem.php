<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;
use Modules\Inventory\Models\WarehouseItem;

class UpdateWarehouseItem extends Job
{
    protected $item;

    protected $request;

    /**
     * Create a new job instance.
     *
     * @param  $request
     */
    public function __construct($request, $item)
    {
        $this->request = $request;
        $this->item = $item;
    }

    /**
     * Execute the job.
     *
     * @return WarehouseItem
     */
    public function handle()
    {
        $warehouse_item = WarehouseItem::where('item_id', $this->item->id)->delete();

        foreach ($this->request as $inventory_item) {
            $warehouse_item = WarehouseItem::create([
                'company_id' => company_id(),
                'warehouse_id' => $inventory_item['warehouse_id'],
                'item_id' =>  $this->item->id,
            ]);
        }

        return $warehouse_item;
    }
}
