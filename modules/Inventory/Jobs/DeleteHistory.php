<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;

class DeleteHistory extends Job
{
    protected $history;

    /**
     * Create a new job instance.
     *
     * @param  $history
     */
    public function __construct($history)
    {
        $this->history = $history;
    }

    /**
     * Execute the job.
     *
     * @return boolean|Exception
     */
    public function handle()
    {
        $this->history->delete();

        return true;
    }
}
