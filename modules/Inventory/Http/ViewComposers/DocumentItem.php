<?php

namespace Modules\Inventory\Http\ViewComposers;

use App\Models\Sale\InvoiceItem;
use App\Models\Common\Item;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Modules\Inventory\Models\Warehouse;
use Modules\Inventory\Models\Item as InventoryItem;
use Modules\Inventory\Models\BillItem as InventoryBillItem;
use Modules\Inventory\Models\InvoiceItem as InventoryInvoiceItem;

class DocumentItem
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $request = request();
        $warehouses = $item_warehouses = [];

        $document_type_class = 'inventory::classes.income';
        $document_type_name = 'general.sales';

        if ($request->segment(1) == 'purchases') {
            $document_type_class = 'inventory::classes.expenses';
            $document_type_name = 'general.purchases';
        }

        $item_selected_warehouse = [];

        if ($request->routeIs('invoices.edit') || $request->routeIs('bills.edit')) {
            $document = $request->route(Str::singular((string) $request->segment(3)));

            foreach ($document->items as $key => $item) {
                if ($request->routeIs('invoices.edit')) {
                    $warehouse_id = InventoryInvoiceItem::where('invoice_id', $item->document_id)->where('item_id', $item->item_id)->value('warehouse_id');
                } else {
                    $warehouse_id = InventoryBillItem::where('bill_id', $item->document_id)->where('item_id', $item->item_id)->value('warehouse_id');
                }

                if (empty($warehouse_id)) {
                    continue;
                }

                $item_selected_warehouse[$item->item_id][$key] = $warehouse_id;
            }
        }

        $warehouses = Warehouse::enabled()->pluck('name', 'id');

        $input_warehouse_col = 'col-md-12 mb-0';

        $item_warehouses = [];
        $item_default_warehouse = [];

        $input_warehouse_attributes = [
            'data-item' => 'warehouse_id',
            'v-model' => 'row.warehouse_id',
            'visible-change' => 'onBindingItemField(index, "warehouse_id")',
        ];

        $items = Item::enabled()->get();

        foreach ($items as $item) {
            $inventory_items = $item->inventory()->get();

            if (!$inventory_items->count()) {
                continue;
            }

            $inventory_item_warehouses = [];
            $inventory_item_default = '';

            foreach ($inventory_items as $inventory_item) {
                if (!empty($inventory_item->warehouse)) {
                    $inventory_item_warehouses[$inventory_item->warehouse->id] = $inventory_item->warehouse->name;
                    $inventory_item_warehouses[$inventory_item->warehouse->id] .= ' (' . trans('inventory::general.stock') . ': ' . $inventory_item->opening_stock . ')';
                }

                if ($inventory_item->default_warehouse) {
                    $inventory_item_default = $inventory_item->warehouse_id;
                }
            }

            if (!empty($inventory_item_warehouses)) {
                $item_warehouses[$item->id] = !empty($inventory_item_warehouses) ? $inventory_item_warehouses : [];
                $item_default_warehouse[$inventory_item->item_id] = !empty($inventory_item_default) ? $inventory_item_default : '';

                if ($request->routeIs('invoices.create') || $request->routeIs('bills.create')) {
                    $input_warehouse_attributes['dynamicOptions'] = 'this.item_warehouses[row.item_id]';
                    $input_warehouse_attributes['model'] = 'this.item_default_warehouse[row.item_id].toString()';
                } else {
                    $input_warehouse_attributes['dynamicOptions'] = 'this.item_warehouses[row.item_id]';
                    $input_warehouse_attributes['model'] = '(this.item_selected_warehouse[row.item_id] == undefined || this.item_selected_warehouse[row.item_id][index] == undefined) ? this.item_default_warehouse[row.item_id].toString() : this.item_selected_warehouse[row.item_id][index].toString() ';
                }
            }
        }

        // Push to a stack
        $view->getFactory()->startPush('item_custom_fields', view('inventory::partials.input_document_item', compact('warehouses', 'input_warehouse_attributes', 'input_warehouse_col', 'document_type_class', 'document_type_name')));

        $view->getFactory()->startPush('scripts', view('inventory::partials.script', compact('item_warehouses', 'item_default_warehouse', 'item_selected_warehouse')));
    }
}
