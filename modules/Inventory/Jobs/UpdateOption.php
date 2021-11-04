<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;
use Modules\Inventory\Models\Option;

class UpdateOption extends Job
{
    protected $option;

    protected $request;

    /**
     * Create a new job instance.
     *
     * @param  $option
     * @param  $request
     */
    public function __construct($option, $request)
    {
        $this->option = $option;
        $this->request = $this->getRequestInstance($request);
    }

    /**
     * Execute the job.
     *
     * @return Option
     */
    public function handle()
    {
        $this->option->update($this->request->all());

        if (!empty($this->request->get('inline', 0))) {
          return $this->option;
        }

        // Delete current items
        $this->deleteRelationships($this->option, ['values']);

        if ($this->option->type == 'select' || $this->option->type == 'radio' || $this->option->type == 'checkbox') {
            $option_items = $this->request->get('items');

            foreach ($option_items as $option_item) {
                if (empty($option_item['name'])) {
                    continue;
                }

                $value = [
                    'company_id' => $this->option->company_id,
                    'option_id' => $this->option->id,
                    'name' => $option_item['name']
                ];

                $option_item = $this->dispatch(new CreateOptionValue($value, $this->option));
            }
        }

        return $this->option;
    }

    public function getRelationships()
    {
        $rels = [
            'transactions' => 'transactions',
        ];

        return $this->countRelationships($this->warehouse, $rels);
    }
}
