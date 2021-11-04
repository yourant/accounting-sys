<?php

namespace Modules\Inventory\Imports\ItemGroups\Sheets;

use App\Abstracts\Import;
use Modules\Inventory\Models\ItemGroup;
use Modules\Inventory\Http\Requests\ItemGroupOptionAdd as Request;
use Modules\Inventory\Models\Option;
use Modules\Inventory\Models\ItemGroupOption as Model;

class ItemGroupOptions extends Import
{
    public function model(array $row)
    {
        return new Model($row);
    }

    public function map($row): array
    {
        $row = parent::map($row);

        $row['item_group_id'] = ItemGroup::where('name', $row['item_group_name'])->pluck('id')->first();
        $row['option_id'] = Option::where('name', $row['option_name'])->pluck('id')->first();

        return $row;
    }

    public function rules(): array
    {
        return (new Request())->rules();
    }
}
