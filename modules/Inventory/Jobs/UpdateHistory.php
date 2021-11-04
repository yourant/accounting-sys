<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;
use App\Models\Common\Company;
use Modules\Inventory\Models\History;

class UpdateHistory extends Job
{
    protected $item;

    protected $request;

    /**
     * Create a new job instance.
     *
     * @param  $request
     */
    public function __construct($request, $item)
    {
        $this->request = $this->getRequestInstance($request);
        $this->item = $item;
    }

    /**
     * Execute the job.
     *
     * @return History
     */
    public function handle()
    {
        $user = user();

        if (empty($user)) {
            $company = Company::find($this->item->company_id);
            $user = $company->users()->first();
        }

        $history = History::where('type_id', $this->item->item_id)
                        ->where('type_type', get_class($this->item->item))
                        ->where('item_id', $this->item->item_id)
                        ->first();

        $history->update([
            'company_id' => $this->item->company_id,
            'user_id' => $user->id,
            'item_id' => $this->item->item_id,
            'type_id' => $this->item->item_id,
            'type_type' => get_class($this->item->item),
            'warehouse_id' => $this->request->get('warehouse_id', setting('inventory.default_warehouse')),
            'quantity' => $this->request->get('opening_stock', 0),
        ]);

        return $history;
    }
}
