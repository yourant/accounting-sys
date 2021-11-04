<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;
use Modules\Inventory\Models\TransferOrder;
use Modules\Inventory\Models\Item as InventoryItem;

class DeleteTransferOrder extends Job
{
    protected $transfer_order;

    /**
     * Create a new job instance.
     *
     * @param  $option
     */
    public function __construct($transfer_order)
    {
        $this->transfer_order = $transfer_order;
    }

    /**
     * Execute the job.
     *
     * @return boolean|Exception
     */
    public function handle()
    {
        $source_inventory_item = InventoryItem::where('warehouse_id', $this->transfer_order->source_warehouse_id)->where('item_id', $this->transfer_order->item_id)->first();

        $source_inventory_item->opening_stock += $this->transfer_order->transfer_quantity;

        $source_inventory_item->save();

        $destination_inventory_item = InventoryItem::where('warehouse_id', $this->transfer_order->destination_warehouse_id)->where('item_id', $this->transfer_order->item_id)->first();

        if ($destination_inventory_item->opening_stock > $this->transfer_order->transfer_quantity ){
            $destination_inventory_item->opening_stock -= $this->transfer_order->transfer_quantity;

            $destination_inventory_item->save();
        } else{
            $destination_inventory_item->delete();
        }

        $this->transfer_order->delete();

        return true;
    }
}
