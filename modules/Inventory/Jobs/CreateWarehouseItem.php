<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;
use Modules\Inventory\Models\WarehouseItem;

class CreateWarehouseItem extends Job
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
        foreach($this->request->items as $item){
            $warehouse_item = WarehouseItem::create([
                'company_id' => $this->item->company_id,
                'warehouse_id' => $item['warehouse_id'],
                'item_id' => $this->item->id,
            ]);
        }

        return $warehouse_item;
    }
}
