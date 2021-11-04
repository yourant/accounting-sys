<?php

namespace Modules\Inventory\Imports\Items;

use Modules\Inventory\Imports\Items\Sheets\Items as BaseItems;
use Modules\Inventory\Imports\Items\Sheets\ItemTaxes;
use Modules\Inventory\Imports\Items\Sheets\Warehouses;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class Items implements WithMultipleSheets
{
    use Importable;

    public function sheets(): array
    {
        return [
            'items' => new BaseItems(),
            'item_taxes' => new ItemTaxes(),
            'warehouses' => new Warehouses(),
        ];
    }
}
