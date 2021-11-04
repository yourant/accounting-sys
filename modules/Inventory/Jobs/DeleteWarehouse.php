<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;

class DeleteWarehouse extends Job
{
    protected $warehouse;

    /**
     * Create a new job instance.
     *
     * @param  $warehouse
     */
    public function __construct($warehouse)
    {
        $this->warehouse = $warehouse;
    }

    /**
     * Execute the job.
     *
     * @return boolean|Exception
     */
    public function handle()
    {
        $this->authorize();

        $this->warehouse->delete();

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
            $message = trans('messages.warning.deleted', ['name' => $this->warehouse->name, 'text' => implode(', ', $relationships)]);

            throw new \Exception($message);
        }
    }

    public function getRelationships()
    {
        $rels = [
            'items' => 'items',
        ];

        return $this->countRelationships($this->warehouse, $rels);
    }
}
