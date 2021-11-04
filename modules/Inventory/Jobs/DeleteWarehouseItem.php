<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;

class DeleteWarehouseItem extends Job
{
    protected $warehouse_item;

    /**
     * Create a new job instance.
     *
     * @param  $warehouse_item
     */
    public function __construct($warehouse_item)
    {
        $this->warehouse_item = $warehouse_item;
    }

    /**
     * Execute the job.
     *
     * @return boolean|Exception
     */
    public function handle()
    {
        $this->authorize();

        $this->warehouse_item->delete();

        return true;
    }

    /**
     * Determine if this action is applicable.
     *
     * @return void
     */
    public function authorize()
    {
        return;

        #Todo added releations
        if ($relationships = $this->getRelationships()) {
            $message = trans('messages.warning.deleted', ['name' => $this->warehouse->name, 'text' => implode(', ', $relationships)]);

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
