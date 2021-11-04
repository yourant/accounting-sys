<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;
use Modules\Inventory\Models\Option;

class UpdateOptionValue extends Job
{
    protected $optionValue;

    protected $request;

    /**
     * Create a new job instance.
     *
     * @param  $optionValue
     * @param  $request
     */
    public function __construct($optionValue, $request)
    {
        $this->optionValue = $optionValue;
        $this->request = $this->getRequestInstance($request);
    }

    /**
     * Execute the job.
     *
     * @return Option
     */
    public function handle()
    {
        $this->optionValue->update($this->request->all());

        return $this->optionValue;
    }
}
