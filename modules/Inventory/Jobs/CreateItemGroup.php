<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;
use App\Jobs\Common\CreateItem;
use Modules\Inventory\Models\Item as InventoryItem;
use Modules\Inventory\Models\ItemGroup;

class CreateItemGroup extends Job
{
    protected $request;

    /**
     * Create a new job instance.
     *
     * @param  $request
     */
    public function __construct($request)
    {
        $this->request = $this->getRequestInstance($request);
    }

    /**
     * Execute the job.
     *
     * @return ItemGroup
     */
    public function handle()
    {
        $item_group = ItemGroup::create($this->request->all());

        if ($this->request->file('picture')) {
            $media = $this->getMedia($this->request->file('picture'), 'items');

            $item_group->attachMedia($media, 'picture');
        }

        // Add item group option
        if ($this->request->has('option_id')) {
            $option = [
                'company_id' => $item_group->company_id,
                'item_group_id' => $item_group->id,
                'option_id' => $this->request->option_id
            ];

            $option['option_values'] = $this->request->option_values;

            $item_group_option = $this->dispatch(new CreateItemGroupOption($option, $item_group));
        }

        // Add Items
        if ($this->request->has('items')) {
            $default_request = request()->input();

            foreach ($this->request->get('items') as $item_data) {
                $main_request = request();

                $item_data['company_id'] = $item_group->company_id;
                $item_data['description'] = $this->request->get('description');
                $item_data['category_id'] = $this->request->get('category_id');
                $item_data['tax_ids'] = $this->request->get('tax_ids');
                $item_data['enabled'] = $this->request->get('enabled');

                // This field for Inventory item...
                $item_data['vendor_id'] = 0;
                $item_data['track_inventory'] = true;

                foreach ($main_request->all() as $key => $value) {
                    $main_request->request->remove($key);
                }

                // Set laravel request() data...
                $main_request->merge($item_data);

                $item = $this->dispatch(new CreateItem($item_data));

                if ($this->request->file('picture')) {
                    $item->attachMedia($media, 'picture');
                }

                $inventory_item = InventoryItem::create([
                    'company_id' =>  $item_data['company_id'],
                    'item_id' => $item->id,
                    'opening_stock' => $item_data['opening_stock'],
                    'opening_stock_value' => $item_data['opening_stock_value'],
                    'reorder_level' => $item_data['reorder_level'],
                    'warehouse_id' => setting('inventory.default_warehouse'),
                    'default_warehouse' => 1,
                    'sku' =>  $item_data['sku'],
                ]);

                //Create ItemGroupOptionItem
                $option_item = [
                    'company_id' => $item_group->company_id,
                    'item_id' => $item->id,
                    'option_id' => $item_group_option->option_id,
                    'option_value_id' => $item_data['option_value_id'],
                    'item_group_id' => $item_group->id,
                    'item_group_option_id' => $item_group_option->id,
                ];

                $item_group_item = $this->dispatch(new CreateItemGroupOptionItem($option_item));
            }

            // Set default request() value...
            foreach ($main_request->all() as $key => $value) {
                $main_request->request->remove($key);
            }
        }

        return $item_group;
    }
}
