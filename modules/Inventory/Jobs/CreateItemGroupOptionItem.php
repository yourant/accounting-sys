<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;

use Modules\Inventory\Models\ItemGroupOptionItem;

class CreateItemGroupOptionItem extends Job
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
     * @return Item
     */
    public function handle()
    {
        $item_group_item = ItemGroupOptionItem::create($this->request->all());

        return $item_group_item;
    }
}
