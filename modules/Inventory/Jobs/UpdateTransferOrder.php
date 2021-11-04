<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;
use Modules\Inventory\Models\TransferOrder;
use Modules\Inventory\Models\Item as InventoryItem;

class UpdateTransferOrder extends Job
{
    protected $transfer_order;

    protected $request;

    /**
     * Create a new job instance.
     *
     * @param  $transfer_order
     * @param  $request
     */
    public function __construct($transfer_order, $request)
    {
        $this->transfer_order = $transfer_order;
        $this->request = $this->getRequestInstance($request);
    }

    /**
     * Execute the job.
     *
     * @return TransferOrder
     */
    public function handle()
    {
        $source_inventory_item = InventoryItem::where('warehouse_id', $this->transfer_order->source_warehouse_id)->where('item_id', $this->transfer_order->item_id)->first();

        $source_quantity = $source_inventory_item->opening_stock + $this->transfer_order->transfer_quantity;

        $source_inventory_item->update(['opening_stock' => $source_quantity]);

        $transfer_order = TransferOrder::where('id', $this->transfer_order->id)->update([
            'company_id' => company_id(),
            'item_id' => $this->request->item_id,
            'date' => $this->request->date,
            'transfer_order' => $this->request->transfer_order,
            'reason' => $this->request->reason,
            'transfer_quantity' => $this->request->transfer_quantity,
            'source_warehouse_id' => $this->request->source_warehouse_id,
            'destination_warehouse_id' => $this->request->destination_warehouse_id,
        ]);

        $destination_inventory_item = InventoryItem::where('warehouse_id', $this->request->destination_warehouse_id)->where('item_id', $this->request->item_id)->first();

        $source_inventory_item = InventoryItem::where('warehouse_id', $this->request->source_warehouse_id)->where('item_id', $this->request->item_id)->first();

        $source_quantity = $source_inventory_item->opening_stock - $this->request->transfer_quantity;

        $source_inventory_item->update(['opening_stock' => $source_quantity]);

        if (empty($destination_inventory_item)){
            $destination_inventory_item =InventoryItem::create([
                'company_id' => $source_inventory_item->company_id,
                'item_id' => $this->request->item_id,
                'opening_stock' => $this->request->transfer_quantity,
                'opening_stock_value' => $this->request->transfer_quantity,
                'warehouse_id' => $this->request->destination_warehouse_id,
                'sku' => $source_inventory_item->sku,
            ]);
        } else{
            $destination_inventory_item = InventoryItem::where('warehouse_id', $this->request->destination_warehouse_id)->where('item_id', $this->request->item_id)->first();

            $destination_quantity = $destination_inventory_item->opening_stock + $this->request->transfer_quantity;

            $destination_inventory_item_updated = $destination_inventory_item->update(['opening_stock' => $destination_quantity]);
        }

        return $this->transfer_order;
    }
}
