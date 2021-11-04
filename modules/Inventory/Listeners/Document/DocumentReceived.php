<?php

namespace Modules\Inventory\Listeners\Document;

use App\Events\Document\DocumentReceived as Event;
use App\Traits\Modules;
use Modules\Inventory\Models\History as InventoryHistory;
use Modules\Inventory\Models\BillItem as InventoryBillItem;
use Modules\Inventory\Models\Item as InventoryItem;

class DocumentReceived
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

        if ($event->document->type != 'bill') {
            return;
        }

        $user = user();
        $user_id = !empty($user) ? $user->id : 0;

        if ($event->document->type == 'bill') {
            foreach ($event->document->items as $bill_item) {
                $warehouse_id = InventoryBillItem::where('bill_id', $event->document->id)->where('item_id', $bill_item->item->id)->value('warehouse_id');
                $inventory_item = InventoryItem::where('warehouse_id', $warehouse_id)->where('item_id', $bill_item->item_id)->first();

                if (!empty($inventory_item)) {
                    $inventory_item->opening_stock += (float) $bill_item->quantity;
                    $inventory_item->save();

                    InventoryHistory::where('type_type', get_class($bill_item))
                        ->where('type_id', $bill_item->id)
                        ->delete();

                    InventoryHistory::create([
                        'company_id'    => $bill_item->company_id,
                        'user_id'       => $user_id,
                        'item_id'       => $bill_item->item->id,
                        'type_id'       => $bill_item->id,
                        'type_type'     => get_class($bill_item),
                        'warehouse_id'  => !empty($warehouse_id) ? $warehouse_id : setting('inventory.default.warehouse'),
                        'quantity'      => $bill_item->quantity,
                    ]);
                }
            }
        }
    }
}
