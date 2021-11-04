<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;
use App\Jobs\Common\UpdateItem as CoreUpdateItem;
use Modules\Inventory\Models\Item;

class UpdateItem extends Job
{
    protected $items;

    protected $request;

    /**
     * Create a new job instance.
     *
     * @param  $item
     * @param  $request
     */
    public function __construct($items, $request)
    {
        $this->items = $items;
        $this->request = $this->getRequestInstance($request);
    }

    /**2
     * Execute the job.
     *
     * @return Item
     */
    public function handle()
    {
        //$this->authorize();

        $item = $this->dispatch(new CoreUpdateItem($this->items, $this->request));
        $item->sku = $this->request->get('sku');
        $item->save();

        if (!empty($this->request->items)) {
            foreach ($this->request->items as $request){
                $request_item_id[] =  $request['id'];
            }

            foreach ($this->items->inventory()->pluck('id')->toArray() as $inventory_item_id ){
                if (in_array($inventory_item_id, $request_item_id)){
                    foreach ($this->request->items as $request_item) {
                        if ($request_item['default_warehouse'] == 'true') {
                            $request_item['default_warehouse'] = 1;
                        } else if ($request_item['default_warehouse'] == 'false') {
                            $request_item['default_warehouse'] = 0;
                        }

                        if (in_array($request_item['warehouse_id'], $this->items->inventory()->pluck('warehouse_id')->toArray())) {
                            $inventory_item = Item::where('id', $request_item['id'])->update([
                                'company_id' => company_id(),
                                'item_id' =>  $item->id,
                                'opening_stock' => $request_item['opening_stock'],
                                'opening_stock_value' => $request_item['opening_stock_value'],
                                'reorder_level' => $request_item['reorder_level'],
                                'warehouse_id' => $request_item['warehouse_id'],
                                'default_warehouse' => $request_item['default_warehouse'],
                                'sku' => $this->request->get('sku'),
                            ]);
                        } else {
                            $inventory_item = Item::create([
                                'company_id' => company_id(),
                                'item_id' =>  $item->id,
                                'opening_stock' => $request_item['opening_stock'],
                                'opening_stock_value' => $request_item['opening_stock_value'],
                                'reorder_level' => $request_item['reorder_level'],
                                'warehouse_id' => $request_item['warehouse_id'],
                                'default_warehouse' => $request_item['default_warehouse'],
                                'sku' => $this->request->get('sku'),
                            ]);
                        }
                    }
                }else {
                    $inventory_item = Item::where('id', $inventory_item_id)->delete();
                }
            }

            $inventory_item = Item::where('item_id', $this->items->id)->first();
            if (empty($inventory_item)) {
                foreach ($this->request->items as $request_item) {
                    if ($request_item['default_warehouse'] == 'true') {
                        $request_item['default_warehouse'] = 1;
                    } else if ($request_item['default_warehouse'] == 'false') {
                        $request_item['default_warehouse'] = 0;
                    }

                    $inventory_item = Item::create([
                        'company_id' => company_id(),
                        'item_id' =>  $item->id,
                        'opening_stock' => $request_item['opening_stock'],
                        'opening_stock_value' => $request_item['opening_stock_value'],
                        'reorder_level' => $request_item['reorder_level'],
                        'warehouse_id' => $request_item['warehouse_id'],
                        'default_warehouse' => $request_item['default_warehouse'],
                        'sku' => $this->request->get('sku'),
                    ]);
                }
            }
            // Create warehouse item
            // $warehouse_item = $this->dispatch(new UpdateWarehouseItem($this->request->items, $item));

            $this->dispatch(new CreateHistory($this->request, $item));

            return $inventory_item;
        } else {
            $inventory_items = Item::where('item_id', $this->items->id)->get();
            foreach ($inventory_items as $inventory_item) {
                $inventory_item_delete = Item::where('id', $inventory_item->id)->delete();
            }

            return;
        }
    }

    /**
     * Determine if this action is applicable.
     *
     * @return void
     */
    public function authorize()
    {
        if (!$relationships = $this->getRelationships()) {
            return;
        }

        if (!$this->request->get('enabled')) {
            $relationships[] = strtolower(trans_choice('general.companies', 1));

            $message = trans('messages.warning.disabled', ['name' => $this->manufacturer->name, 'text' => implode(', ', $relationships)]);

            throw new \Exception($message);
        }
    }

    public function getRelationships()
    {
        $rels = [
            'inventory_manufacturer_items'   => 'items',
            'inventory_manufacturer_vendors' => 'vendors',
        ];

        return $this->countRelationships($this->manufacturer, $rels);
    }
}
