<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;
use App\Models\Common\Company;
use Modules\Inventory\Models\History;

class CreateHistory extends Job
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

        foreach($this->request->items as $item){
            $history = History::create([
                'company_id' => company_id(),
                'user_id' => $user->id,
                'item_id' => $this->item->id,
                'type_id' => $this->item->id,
                'type_type' => get_class($this->item),
                'warehouse_id' => $item['warehouse_id'],
                'quantity' => $item['opening_stock'],
            ]);
        }

        return $history;
    }
}
