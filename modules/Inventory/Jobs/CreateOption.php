<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;
use Modules\Inventory\Models\Option;

class CreateOption extends Job
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
     * @return Option
     */
    public function handle()
    {
        $option = Option::create($this->request->all());

        if ($option->type == 'select' || $option->type == 'radio' || $option->type == 'checkbox') {
            $option_items = $this->request->get('items');

            foreach ($option_items as $option_item) {
                if (empty($option_item['name'])) {
                    continue;
                }

                $value = [
                    'company_id' => $option->company_id,
                    'option_id' => $option->id,
                    'name' => $option_item['name']
                ];

                $option_item = $this->dispatch(new CreateOptionValue($value, $option));
            }
        }

        return $option;
    }
}
