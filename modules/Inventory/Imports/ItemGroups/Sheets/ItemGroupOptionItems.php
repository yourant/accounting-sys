<?php

namespace Modules\Inventory\Imports\ItemGroups\Sheets;

use App\Abstracts\Import;
use App\Models\Common\Item;
use Modules\Inventory\Models\ItemGroup;
use Modules\Inventory\Http\Requests\Imports\ItemGroupOptionItem as Request;
use Modules\Inventory\Models\ItemGroupOptionItem as Model;
use Modules\Inventory\Models\ItemGroupOptionValue;
use Modules\Inventory\Models\Option;
use Modules\Inventory\Models\OptionValue;

class ItemGroupOptionItems extends Import
{
    public function model(array $row)
    {
        return new Model($row);
    }

    public function map($row): array
    {
        $row = parent::map($row);

        $row['item_id'] = Item::where('name', $row['item_name'])->pluck('id')->first();
        $row['item_group_id'] = ItemGroup::where('name', $row['item_group_name'])->pluck('id')->first();
        $row['option_id'] = Option::where('name', $row['option_name'])->pluck('id')->first();

        $option_value_id = OptionValue::firstOrCreate([
            'name'              => $row['option_value_name'],
        ], [
            'company_id'        => company_id(),
            'option_id'           => $row['option_id'],
        ])->id;

        $row['option_value_id'] = $option_value_id;
        $row['item_group_option_id'] = $option_value_id;

        $item_group_option_value = ItemGroupOptionValue::create([
            'company_id'           => company_id(),
            'item_group_id'        => $row['item_group_id'],
            'item_group_option_id' => $row['option_id'],
            'option_id'            => $row['option_id'],
            'option_value_id'      => $row['option_value_id'],
        ]);

        return $row;
    }

    public function rules(): array
    {
        return (new Request())->rules();
    }
}
