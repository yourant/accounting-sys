<?php

namespace Modules\Inventory\Exports\ItemGroups\Sheets;

use App\Abstracts\Export;
use Modules\Inventory\Models\ItemGroup;
use Modules\Inventory\Models\Option;
use Modules\Inventory\Models\ItemGroupOption as Model;

class ItemGroupOptions extends Export
{
    public function collection()
    {
        $model = Model::usingSearchString(request('search'));

        if (!empty($this->ids)) {
            $model->whereIn('id', (array) $this->ids);
        }

        return $model->get();
    }

    public function map($model): array
    {
        $item_group_name = ItemGroup::where('id', $model->item_group_id)->pluck('name')->first();
        $option_name = Option::where('id', $model->option_id)->pluck('name')->first();

        $model->item_group_name =  $item_group_name;
        $model->option_name = $option_name;

        return parent::map($model);
    }

    public function fields(): array
    {
        return [
            'item_group_name',
            'option_name',
        ];
    }
}
