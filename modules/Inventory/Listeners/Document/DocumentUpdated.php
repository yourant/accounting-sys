<?php

namespace Modules\Inventory\Listeners\Document;

use App\Events\Document\DocumentUpdated as Event;
use App\Models\Document\DocumentItem;
use App\Traits\Modules;
use Modules\Inventory\Models\BillItem as InventoryBillItem;
use Modules\Inventory\Models\Item as InventoryItem;
use Modules\Inventory\Models\InvoiceItem as InventoryInvoiceItem;
use Modules\Inventory\Models\History as InventoryHistory;

class DocumentUpdated
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

        if ($event->document->status == 'draft' || $event->document->status == 'cancelled') {
            return;
        }

        $user = user();
        $user_id = !empty($user) ? $user->id : 0;

        $items = $event->document->items;

        foreach ($items as $item) {
            if ($event->document->type == 'invoice') {
                $document_item_id = DocumentItem::where('document_id', $event->document->id)->where('item_id', $item->item_id)->value('id');

                $warehouse_id = InventoryInvoiceItem::where('invoice_id', $event->document->id)->where('item_id', $item->item_id)->value('warehouse_id');
                $inventory_item = InventoryItem::where('item_id', $item->item_id)->where('warehouse_id', $warehouse_id)->first();

                if (!empty($inventory_item)) {
                    $inventory_item->opening_stock -= (float) $item->quantity;
                    $inventory_item->save();

                    InventoryHistory::create([
                        'company_id'    => $event->document->company_id,
                        'user_id'       => $user_id,
                        'item_id'       => $item->item_id,
                        'type_id'       => $document_item_id,
                        'type_type'     => get_class($item),
                        'warehouse_id'  => !empty($warehouse_id) ? $warehouse_id : setting('inventory.default.warehouse'),
                        'quantity'      => $item->quantity,
                    ]);
                }
            } else if ($event->document->type == 'bill') {
                $document_item_id = DocumentItem::where('document_id', $event->document->id)->where('item_id', $item->item_id)->value('id');

                $warehouse_id = InventoryBillItem::where('bill_id', $event->document->id)->where('item_id', $item->item_id)->value('warehouse_id');
                $inventory_item = InventoryItem::where('item_id', $item->item_id)->where('warehouse_id', $warehouse_id)->first();

                if (!empty($inventory_item)) {
                    $inventory_item->opening_stock += (float) $item->quantity;
                    $inventory_item->save();

                    InventoryHistory::create([
                        'company_id'    => $event->document->company_id,
                        'user_id'       => $user_id,
                        'item_id'       => $item->item_id,
                        'type_id'       => $document_item_id,
                        'type_type'     => get_class($item),
                        'warehouse_id'  => !empty($warehouse_id) ? $warehouse_id : setting('inventory.default.warehouse'),
                        'quantity'      => $item->quantity,
                    ]);
                }
            }
        }
    }
}
