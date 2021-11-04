<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;
use App\Jobs\Common\CreateStock as CoreCreateStock;
use App\Models\Common\Item as CoreItem;
use Modules\Inventory\Models\Item as InventoryItem;

class CreateStock extends Job
{
    protected $request;

    /**
     * Create a new job instance.
     *
     * @param  $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return Item
     */
    public function handle()
    {
        $this->item = $this->dispatch(new CoreCreateStock($this->request));
        $this->item->sku = $this->request->get('sku');
        $this->item->save();

        if ($this->request->has('track_inventory')) {
            if (empty($this->request->get('track_inventory'))) {
                return;
            }
        } else {
            if (setting('inventory.track_inventory') == false) {
                return;
            }
        }

        // foreach($this->request->items as $item){
        //     if ($item['default_warehouse'] == 'true') {
        //         $item['default_warehouse'] = 1;
        //     } else if ($item['default_warehouse'] == 'false') {
        //         $item['default_warehouse'] = 0;
        //     }

            $created_item = "";
            // InventoryItem::create([
            //     'company_id' => $this->item->company_id,
            //     'item_id' => $this->item->id,
            //     'opening_stock' => $item['opening_stock'],
            //     'opening_stock_value' => $item['opening_stock_value'],
            //     'reorder_level' => $item['reorder_level'],
            //     'warehouse_id' => $item['warehouse_id'],
            //     'default_warehouse' => $item['default_warehouse'],
            //     'sku' => $this->request->get('sku'),
            // ]);
        // }

        // $this->dispatch(new CreateHistory($this->request, $this->item));

        return $created_item;
    }
}
