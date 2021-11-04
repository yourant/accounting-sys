<?php

namespace Modules\Inventory\BulkActions;

use App\Abstracts\BulkAction;
use Modules\Inventory\Models\History;

class Histories extends BulkAction
{
    public $model = History::class;

    public $actions = [
        //
    ];
}
