<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;
use Modules\Inventory\Models\Warehouse;

class UpdateWarehouse extends Job
{
    protected $warehouse;

    protected $request;

    /**
     * Create a new job instance.
     *
     * @param  $warehouse
     * @param  $request
     */
    public function __construct($warehouse, $request)
    {
        $this->warehouse = $warehouse;
        $this->request = $this->getRequestInstance($request);
    }

    /**
     * Execute the job.
     *
     * @return Warehouse
     */
    public function handle()
    {
        $this->authorize();

        $this->warehouse->update($this->request->all());

         // Set default warehouse
        if ($this->request['default_warehouse']) {
            setting()->set('inventory.default_warehouse', $this->warehouse->id);
            setting()->save();
        }

        return $this->warehouse;
    }

    /**
     * Determine if this action is applicable.
     *
     * @return void
     */
    public function authorize()
    {
        if (!$this->request->get('enabled') && ($this->warehouse->id == setting('inventory.default_warehouse'))) {
            $relationships[] = strtolower(trans_choice('general.companies', 1));

            $message = trans('messages.warning.disabled', ['name' => $this->warehouse->name, 'text' => implode(', ', $relationships)]);

            throw new \Exception($message);
        }
    }

    public function getRelationships()
    {
        $rels = [
            'transactions' => 'transactions',
        ];

        return $this->countRelationships($this->warehouse, $rels);
    }
}
