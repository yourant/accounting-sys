<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;
use App\Traits\Relationships;
use App\Models\Common\Item;
use Modules\Inventory\Models\Item as InventoryItem;
use Modules\Inventory\Models\ItemGroupOptionItem;

class DeleteItemGroup extends Job
{
    use Relationships;

    protected $item_group;

    protected $item;

    /**
     * Create a new job instance.
     *
     * @param  $item
     */
    public function __construct($item_group)
    {
        $this->item_group = $item_group;
    }

    /**
     * Execute the job.
     *
     * @return boolean|Exception
     */
    public function handle()
    {
        $items = ItemGroupOptionItem::where('item_group_id', $this->item_group->id)->pluck('item_id')->toArray();

        foreach ($items as $item_id) {
            $this->item = Item::where('id', $item_id)->first();
        }

        //$this->authorize();

        $this->deleteRelationships($this->item_group, [
            'items', 'options', 'option_values'
        ]);

        $this->item_group->delete();

        foreach ($items as $item_id) {
            $this->item = Item::where('id', $item_id)->first();
            $this->item->delete();

            $this->inventory_item = InventoryItem::where('item_id', $item_id)->first();
            $this->inventory_item->delete();
        }

        return true;
    }

    /**
     * Determine if this action is applicable.
     *
     * @return void
    */
    public function authorize()
    {
        #Todo added releations
        if ($relationships = $this->getRelationships()) {
            $message = trans('messages.warning.deleted', ['name' => $this->item->name, 'text' => implode(', ', $relationships)]);

            throw new \Exception($message);
        }
    }

    public function getRelationships()
    {
        $rels = [
            'invoice_items' => 'invoices',
            'bill_items' => 'bills',
        ];

        return $this->countRelationships($this->item, $rels);
    }
}
