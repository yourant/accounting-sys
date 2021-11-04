<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;
use App\Jobs\Common\UpdateItem;
use App\Models\Common\Item;
use Modules\Inventory\Models\Item as InventoryItem;
use Modules\Inventory\Models\ItemGroup;
use Modules\Inventory\Models\ItemGroupOptionItem;

class UpdateItemGroup extends Job
{
    protected $item_group;

    protected $request;

    /**
     * Create a new job instance.
     *
     * @param  $item_group
     * @param  $request
     */
    public function __construct($item_group, $request)
    {
        $this->item_group = $item_group;
        $this->request = $this->getRequestInstance($request);
    }

    /**
     * Execute the job.
     *
     * @return ItemGroup
     */
    public function handle()
    {
        $item_group_picture = $this->item_group->picture;

        $this->item_group->update($this->request->all());

        if ($this->request->file('picture')) {
            $media = $this->getMedia($this->request->file('picture'), 'items');

            $this->item_group->attachMedia($media, 'picture');
        }

        $items = ItemGroupOptionItem::where('item_group_id', $this->item_group->id)->pluck('item_id')->toArray();

        if ($this->request->has('items')) {
            $default_request = request()->input();

            foreach ($this->request->get('items') as $item_data) {
                if (!in_array($item_data['item_id'], $items)) {
                    continue;
                }

                $item = Item::where('id', $item_data['item_id'])->first();

                if ($item_group_picture == $item->picture){
                    if ($this->request->file('picture')) {
                        $item->attachMedia($media, 'picture');
                    }
                } else{
                    return;
                }

                $main_request = request();

                $item_data['company_id'] = $this->item_group->company_id;
                $item_data['description'] = $this->request->get('description');
                $item_data['category_id'] = $this->request->get('category_id');
                $item_data['tax_ids'] = $this->request->get('tax_ids');
                $item_data['enabled'] = $this->request->get('enabled');

                foreach ($main_request->all() as $key => $value) {
                    $main_request->request->remove($key);
                }

                // This field for Inventory item...
                $item_data['vendor_id'] = 0;
                $item_data['track_inventory'] = true;

                // Set laravel request() data...
                $main_request->merge($item_data);

                $item = $this->dispatch(new UpdateItem($item, $item_data));

                $inventory_item = InventoryItem::where('item_id', $item_data['item_id'])->update([
                    'company_id' =>  $item_data['company_id'],
                    'item_id' => $item->id,
                    'opening_stock' => $item_data['opening_stock'],
                    'opening_stock_value' => $item_data['opening_stock_value'],
                    'reorder_level' => $item_data['reorder_level'],
                    'warehouse_id' => setting('inventory.default_warehouse'),
                    'default_warehouse' => 1,
                    'sku' =>  $item_data['sku'],
                ]);
            }
        }

        return $this->item_group;
    }
}
