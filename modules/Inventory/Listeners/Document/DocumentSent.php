<?php

namespace Modules\Inventory\Listeners\Document;

use App\Events\Document\DocumentSent as Event;
use App\Models\Document\DocumentItem as DocumentItemModel;
use App\Traits\Modules;
use Modules\Inventory\Models\History as InventoryHistory;
use Modules\Inventory\Models\InvoiceItem as InventoryInvoiceItem;
use Modules\Inventory\Models\Item as InventoryItem;

class DocumentSent
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

        if ($event->document->type != 'invoice') {
            return;
        }

        $user = user();
        $user_id = !empty($user) ? $user->id : 0;

        if ($event->document->type == 'invoice') {
            foreach ($event->document->items as $invoice_item) {
                $warehouse_id = InventoryInvoiceItem::where('invoice_id', $event->document->id)->where('item_id', $invoice_item->item->id)->value('warehouse_id');
                $inventory_item = InventoryItem::where('warehouse_id', $warehouse_id)->where('item_id', $invoice_item->item_id)->first();

                if (!empty($inventory_item)) {
                    $inventory_item->opening_stock -= (float) $invoice_item->quantity;
                    $inventory_item->save();

                    InventoryHistory::where('type_type', get_class($invoice_item))
                        ->where('type_id', $invoice_item->id)
                        ->delete();

                    InventoryHistory::create([
                        'company_id'    => $invoice_item->company_id,
                        'user_id'       => $user_id,
                        'item_id'       => $invoice_item->item->id,
                        'type_id'       => $invoice_item->id,
                        'type_type'     => get_class($invoice_item),
                        'warehouse_id'  => !empty($warehouse_id) ? $warehouse_id : setting('inventory.default.warehouse'),
                        'quantity'      => $invoice_item->quantity,
                    ]);
                }
            }
        }
    }
}
