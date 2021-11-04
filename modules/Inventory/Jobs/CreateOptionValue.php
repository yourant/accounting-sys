<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;
use Modules\Inventory\Models\OptionValue;

class CreateOptionValue extends Job
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
     * @return OptionValue
     */
    public function handle()
    {
        $option_value = OptionValue::create($this->request->all());

        return $option_value;
    }
}
