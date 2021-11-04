<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;
use Modules\Inventory\Models\Warehouse;

class CreateWarehouse extends Job
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
     * @return Warehouse
     */
    public function handle()
    {
        $warehouse = Warehouse::create($this->request->all());

        // Set default warehouse
        if ($this->request['default_warehouse']) {
            setting()->set('inventory.default_warehouse', $warehouse->id);
            setting()->save();
        }

        return $warehouse;
    }
}
