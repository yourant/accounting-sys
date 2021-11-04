<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;
use Modules\Inventory\Models\ItemGroupOption;

class CreateItemGroupOption extends Job
{
    protected $request;

    protected $item_group;
    /**
     * Create a new job instance.
     *
     * @param  $request
     */
    public function __construct($request, $item_group)
    {
        $this->request = $this->getRequestInstance($request);
        $this->item_group = $item_group;
    }

    /**
     * Execute the job.
     *
     * @return ItemGroupOption
     */
    public function handle()
    {
        $item_group_option = ItemGroupOption::create($this->request->all());

        if ($this->request->has('option_values')) {
            $item_group_option_values = [];

            foreach ($this->request->option_values as $option_value_id) {
                $value = [
                    'company_id' => $this->item_group->company_id,
                    'item_group_id' => $item_group_option->item_group_id,
                    'item_group_option_id' => $item_group_option->id,
                    'option_id' => $this->request->option_id,
                    'option_value_id' => $option_value_id,
                ];

                $item_group_option_values[] = $this->dispatch(new CreateItemGroupOptionValue($value));
            }
        }

        return $item_group_option;
    }
}
