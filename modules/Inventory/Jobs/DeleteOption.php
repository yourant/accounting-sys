<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;

class DeleteOption extends Job
{
    protected $option;

    /**
     * Create a new job instance.
     *
     * @param  $option
     */
    public function __construct($option)
    {
        $this->option = $option;
    }

    /**
     * Execute the job.
     *
     * @return boolean|Exception
     */
    public function handle()
    {
        $this->authorize();

        $this->deleteRelationships($this->option, [
            'values'
        ]);

        $this->option->delete();

        return true;
    }

    /**
     * Determine if this action is applicable.
     *
     * @return void
     */
    public function authorize()
    {
        #Todo added releations
        if ($relationships = $this->getRelationships()) {
            $message = trans('messages.warning.deleted', ['name' => $this->option->name, 'text' => implode(', ', $relationships)]);

            throw new \Exception($message);
        }
    }

    public function getRelationships()
    {
        $rels = [
            'item_groups' => 'items',
        ];

        return $this->countRelationships($this->option, $rels);
    }
}
