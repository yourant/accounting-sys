<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;
use Modules\Inventory\Models\TransferOrder;
use Modules\Inventory\Jobs\CreateItem;
use Modules\Inventory\Models\Item as InventoryItem;

class CreateTransferOrder extends Job
{
    protected $request;

    /**
     * Create a new job instance.
     *
     * @param  $request
     */
    public function __construct($request)
    {
        $this->request = $this->getRequestInstance($request);
    }

    /**
     * Execute the job.
     *
     * @return TransferOrder
     */
    public function handle()
    {
        $transfer_order = TransferOrder::create($this->request->all());

        $destination_inventory_item = InventoryItem::where('warehouse_id', $transfer_order->destination_warehouse_id)->where('item_id', $transfer_order->item_id)->first();

        $source_inventory_item = InventoryItem::where('warehouse_id', $transfer_order->source_warehouse_id)->where('item_id', $transfer_order->item_id)->first();

        $source_quantity = $source_inventory_item->opening_stock - $transfer_order->transfer_quantity;

        $source_inventory_item->update(['opening_stock' => $source_quantity]);

        if (empty($destination_inventory_item)){
            $destination_inventory_item =InventoryItem::create([
                'company_id' => $source_inventory_item->company_id,
                'item_id' => $transfer_order->item_id,
                'opening_stock' => $transfer_order->transfer_quantity,
                'opening_stock_value' => $transfer_order->transfer_quantity,
                'warehouse_id' => $transfer_order->destination_warehouse_id,
                'sku' => $source_inventory_item->sku,
            ]);
        } else{
            $destination_inventory_item = InventoryItem::where('warehouse_id', $transfer_order->destination_warehouse_id)->where('item_id', $transfer_order->item_id)->first();

            $destination_quantity = $destination_inventory_item->opening_stock + $transfer_order->transfer_quantity;

            $destination_inventory_item_updated = $destination_inventory_item->update(['opening_stock' => $destination_quantity]);
        }

        return $transfer_order;
    }
}
