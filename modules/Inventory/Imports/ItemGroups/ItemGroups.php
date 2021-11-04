<?php

namespace Modules\Inventory\Imports\ItemGroups;

use Modules\Inventory\Imports\ItemGroups\Sheets\Items;
use Modules\Inventory\Imports\ItemGroups\Sheets\Warehouses;
use Modules\Inventory\Imports\ItemGroups\Sheets\Options;
use Modules\Inventory\Imports\ItemGroups\Sheets\ItemGroups as BaseItemGroups;
use Modules\Inventory\Imports\ItemGroups\Sheets\ItemGroupOptions;
use Modules\Inventory\Imports\ItemGroups\Sheets\ItemGroupOptionItems;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ItemGroups implements WithMultipleSheets
{
    use Importable;

    public function sheets(): array
    {
        return [
            'items' => new Items(),
            'warehouses' => new Warehouses(),
            'options' => new Options(),
            'item_groups' => new BaseItemGroups(),
            'item_group_options' => new ItemGroupOptions(),
            'item_group_option_items' => new ItemGroupOptionItems(),
        ];
    }
}
