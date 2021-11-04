<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;
use App\Traits\Relationships;

class DeleteItemGroupOptionItem extends Job
{
    use Relationships;

    protected $item;

    /**
     * Create a new job instance.
     *
     * @param  $item
     */
    public function __construct($item)
    {
        $this->item = $item;
    }

    /**
     * Execute the job.
     *
     * @return boolean|Exception
     */
    public function handle()
    {
        //$this->authorize();

        $this->item->delete();

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
