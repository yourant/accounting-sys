<?php

namespace Modules\Inventory\Exports\ItemGroups;

use Modules\Inventory\Exports\ItemGroups\Sheets\Items;
use Modules\Inventory\Exports\ItemGroups\Sheets\Warehouses;
use Modules\Inventory\Exports\ItemGroups\Sheets\Options;
use Modules\Inventory\Exports\ItemGroups\Sheets\ItemGroups as BaseItemGroups;
use Modules\Inventory\Exports\ItemGroups\Sheets\ItemGroupOptions;
use Modules\Inventory\Exports\ItemGroups\Sheets\ItemGroupOptionItems;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ItemGroups implements WithMultipleSheets
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
            'items' => new Items($this->ids),
            'warehouses' => new Warehouses($this->ids),
            'options' => new Options($this->ids),
            'item_groups' => new BaseItemGroups($this->ids),
            'item_group_options' => new ItemGroupOptions($this->ids),
            'item_group_option_items' => new ItemGroupOptionItems($this->ids),
        ];
    }
}
