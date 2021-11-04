<?php

namespace Modules\Inventory\Listeners\Document;

use App\Events\Document\DocumentCancelled as Event;
use App\Traits\Modules;
use Modules\Inventory\Models\History as InventoryHistory;
use Modules\Inventory\Models\InvoiceItem as InventoryInvoiceItem;
use Modules\Inventory\Models\BillItem as InventoryBillItem;
use Modules\Inventory\Models\Item as InventoryItem;

class DocumentCancelled
{
    use Modules;

    /**
     * Handle the event.
     *
     * @param  Event $event
     * @return void
     */
    public function handle(Event $event)
    {
        if (!$this->moduleIsEnabled('inventory')) {
            return;
        }

        if ($event->document->type == 'invoice') {
            foreach ($event->document->items as $invoice_item) {
                $warehouse_id = InventoryInvoiceItem::where('invoice_id', $event->document->id)->where('item_id', $invoice_item->item->id)->value('warehouse_id');

                $inventory_item = InventoryItem::where('warehouse_id', $warehouse_id)->where('item_id', $invoice_item->item_id)->first();

                if (!empty($inventory_item)) {
                    $inventory_item->opening_stock += (float) $invoice_item->quantity;
                    $inventory_item->save();

                    InventoryHistory::where('type_type', get_class($invoice_item))->where('type_id', $invoice_item->id)->delete();
                }
            }
        } else if ($event->document->type == 'bill') {
            foreach($event->document->items as $bill_item) {
                $warehouse_id = InventoryBillItem::where('bill_id', $event->document->id)->where('item_id', $bill_item->item->id)->value('warehouse_id');

                $inventory_item = InventoryItem::where('warehouse_id', $warehouse_id)->where('item_id', $bill_item->item_id)->first();

                if (!empty($inventory_item)) {
                    $inventory_item->opening_stock -= (float) $bill_item->quantity;
                    $inventory_item->save();

                    InventoryHistory::where('type_type', get_class($bill_item))->where('type_id', $bill_item->id)->delete();
                }
            }
        }
    }
}
