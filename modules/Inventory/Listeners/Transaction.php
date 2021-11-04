<?php

namespace Modules\Inventory\Listeners;

use App\Events\Banking\TransactionCreated as Event;
use App\Models\Sale\InvoiceItem as InvoiceItemModel;
use App\Traits\Modules;
use Modules\Inventory\Models\History as InventoryHistory;
use Modules\Inventory\Models\InvoiceItem as InventoryInvoiceItem;
use Modules\Inventory\Models\BillItem as InventoryBillItem;
use Modules\Inventory\Models\Item as InventoryItem;

class Transaction
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

        if (!$event->transaction->document_id) {
            return;
        }

        $user = user();

        if ($event->transaction->type == 'income') {
            if ($event->transaction->invoice->status == 'sent') {
                return;
            } else {
                foreach ($event->transaction->invoice->items as $invoice_item) {
                    $warehouse_id = InventoryInvoiceItem::where('invoice_id', $event->transaction->invoice->id)->where('item_id', $invoice_item->item->id)->value('warehouse_id');

                    $inventory_item = InventoryItem::where('warehouse_id', $warehouse_id)->where('item_id', $invoice_item->item_id)->first();

                    if (!empty($inventory_item)) {
                        $inventory_item->opening_stock -= (float) $invoice_item->quantity;
                        $inventory_item->save();

                        InventoryHistory::where('type_type', get_class($invoice_item))
                        ->where('type_id', $invoice_item->id)
                        ->delete();

                        InventoryHistory::create([
                        'company_id' => $invoice_item->company_id,
                        'user_id' => $user->id,
                        'item_id' => $invoice_item->item->id,
                        'type_id' => $invoice_item->id,
                        'type_type' => get_class($invoice_item),
                        'warehouse_id' => $warehouse_id,
                        'quantity' => $invoice_item->quantity,
                        ]);
                    }
                }
            }
        } else if($event->transaction->type == 'expense'){
            if ($event->transaction->bill->status == 'received') {
                return;
            } else {
                foreach ($event->transaction->bill->items as $bill_item) {
                    $warehouse_id = InventoryBillItem::where('bill_id', $event->transaction->bill->id)->where('item_id', $bill_item->item->id)->value('warehouse_id');

                    $inventory_item = InventoryItem::where('warehouse_id', $warehouse_id)->where('item_id', $bill_item->item_id)->first();

                    if (!empty($inventory_item)) {
                        $inventory_item->opening_stock += (float) $bill_item->quantity;
                        $inventory_item->save();

                        InventoryHistory::where('type_type', get_class($bill_item))
                        ->where('type_id', $bill_item->id)
                        ->delete();

                        InventoryHistory::create([
                        'company_id' => $bill_item->company_id,
                        'user_id' => $user->id,
                        'item_id' => $bill_item->item->id,
                        'type_id' => $bill_item->id,
                        'type_type' => get_class($bill_item),
                        'warehouse_id' => $warehouse_id,
                        'quantity' => $bill_item->quantity,
                        ]);
                    }
                }
            }
        }
    }
}
