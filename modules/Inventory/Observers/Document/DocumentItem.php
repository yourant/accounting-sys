<?php

namespace Modules\Inventory\Observers\Document;

use App\Abstracts\Observer;
use App\Models\Common\Company;
use App\Models\Document\Document;
use App\Models\Document\DocumentItem as DocumentItemModel;
use App\Traits\Modules;
use Modules\Inventory\Models\BillItem as InventoryBillItem;
use Modules\Inventory\Models\InvoiceItem as InventoryInvoiceItem;
use Modules\Inventory\Models\History as InventoryHistory;

class DocumentItem extends Observer
{
    use Modules;

     /**
     * Listen to the created event.
     *
     * @param  DocumentItemModel $document_item
     *
     * @return void
     */
    public function created(DocumentItemModel $document_item)
    {
        if (!$this->moduleIsEnabled('inventory')) {
            return;
        }

        $user = user();

        if (!$user) {
            $company = Company::find($document_item->company_id);

            $user = $company->users()->first();
        }

        $item = $document_item->item;

        if (!$item) {
            return;
        }

        $inventory_item = $item->inventory()->first();

        //Item Stock
        if (!$inventory_item) {
            return;
        }

        $request = request();

        $clone = $request->is('*/duplicate');

        if (!$request->items && $clone == false) {
            return;
        }

        if ($clone) {
            $segments = $request->segments();

            $request = Document::find($segments[2]);

            if ($request->type == 'invoice') {
                foreach ($request->items as $request_item) {
                    $warehouse_id = InventoryInvoiceItem::where('invoice_id', $request_item->document_id)->where('item_id', $request_item->item_id)->value('warehouse_id');
                    $request_item->warehouse_id = $warehouse_id;
                }
            } else if ($request->type == 'bill') {
                foreach ($request->items as $request_item) {
                    $warehouse_id = InventoryBillItem::where('bill_id', $request_item->document_id)->where('item_id', $request_item->item_id)->value('warehouse_id');
                    $request_item->warehouse_id = $warehouse_id;
                }
            }
        }

        if ($request->type == 'invoice') {
            foreach ($request->items as $request_item) {
                if (empty($request_item['warehouse_id'])) {
                    continue;
                }

                $inventory_invoice_item = InventoryInvoiceItem::where('invoice_id', $document_item->document_id)
                    ->where('item_id', $request_item['item_id'])
                    ->delete();

                $inventory_invoice_item = InventoryInvoiceItem::create([
                    'company_id' => $document_item->company_id,
                    'invoice_id' => $document_item->document_id,
                    'item_id' => $request_item['item_id'],
                    'warehouse_id' => $request_item['warehouse_id'],
                    'quantity' => $request_item['quantity'],
                ]);
            }
        } else if ($request->type == 'bill') {
            foreach($request->items as $request_item){
                if (empty($request_item['warehouse_id'])) {
                    continue;
                }

                $inventory_bill_item = InventoryBillItem::where('bill_id', $document_item->document_id)
                    ->where('item_id', $request_item['item_id'])
                    ->where('warehouse_id', $request_item['warehouse_id'])
                    ->delete();

                $inventory_bill_item = InventoryBillItem::create([
                    'company_id' => $document_item->company_id,
                    'bill_id' => $document_item->document_id,
                    'item_id' => $request_item['item_id'],
                    'warehouse_id' => $request_item['warehouse_id'],
                    'quantity' => $request_item['quantity'],
                ]);
            }
        }
    }

    /**
     * Listen to the deleted event.
     *
     * @param  DocumentItemModel $document_item
     *
     * @return void
     */
    public function deleted(DocumentItemModel $document_item)
    {
        if (!$this->moduleIsEnabled('inventory')) {
            return;
        }

        $item = $document_item->item;

        if (empty($item)) {
            return;
        }

        if ($document_item->document->status == 'draft' || $document_item->document->status == 'cancelled') {
            return;
        }

        $inventory_item = $item->inventory()->first();

        if (!$inventory_item) {
            return;
        }

        if ($document_item->type == 'invoice') {
            $inventory_item->opening_stock += (float) $document_item->quantity;
            $inventory_item->save();

            InventoryHistory::where('type_type', get_class($document_item))
                ->where('type_id', $document_item->id)
                ->delete();
        } else if ($document_item->type == 'bill') {
            $inventory_item->opening_stock -= (float) $document_item->quantity;
            $inventory_item->save();

            InventoryHistory::where('type_type', get_class($document_item))
                ->where('type_id', $document_item->id)
                ->delete();
        }
    }
}
