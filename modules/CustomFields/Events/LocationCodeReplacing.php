<?php

namespace Modules\CustomFields\Events;

class LocationCodeReplacing
{
    public $code;

    /**
     * Create a new event instance.
     *
     * @param $code
     * @param $columns
     *
     */
    public function __construct($code)
    {
        $this->code = $code;
    }
}
