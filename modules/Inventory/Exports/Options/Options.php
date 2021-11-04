<?php

namespace Modules\Inventory\Exports\Options;

use Modules\Inventory\Exports\Options\Sheets\Options as BaseOptions;
use Modules\Inventory\Exports\Options\Sheets\OptionValues;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class Options implements WithMultipleSheets
{
    use Exportable;

    public $ids;

    public function __construct($ids = null)
    {
        $this->ids = $ids;
    }

    public function sheets(): array
    {
        return [
            'options' => new BaseOptions($this->ids),
            'option_values' => new OptionValues($this->ids),
        ];
    }
}
