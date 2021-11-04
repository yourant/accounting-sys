<?php

namespace Modules\Inventory\Imports\Options;

use Modules\Inventory\Imports\Options\Sheets\Options as BaseOptions;
use Modules\Inventory\Imports\Options\Sheets\OptionValues;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class Options implements WithMultipleSheets
{
    use Importable;

    public function sheets(): array
    {
        return [
            'options' => new BaseOptions(),
            'option_values' => new OptionValues(),
        ];
    }
}
