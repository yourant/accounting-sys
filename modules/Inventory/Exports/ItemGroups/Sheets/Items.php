<?php

namespace Modules\Inventory\Exports\ItemGroups\Sheets;

use App\Abstracts\Export;
use App\Models\Common\Item as Model;
use Modules\Inventory\Models\ItemGroupOptionItem;

class Items extends Export
{
    public function collection()
    {
        $model = Model::with('category', 'tax')->usingSearchString(request('search'));

        if (!empty($this->ids)) {
            $model->whereIn('id', (array) $this->ids);
        }

        return $model->cursor();
    }

    public function map($model): array
    {
        $model->sku = $model->inventory()->where('item_id', $model->id)->first()->sku;
        $model->category_name = $model->category->name;
        $model->tax_rate = $model->tax->rate;

        return parent::map($model);
    }

    public function fields(): array
    {
        return [
            'name',
            'description',
            'sale_price',
            'purchase_price',
            'category_name',
            'tax_rate',
            'enabled',
            'sku'
        ];
    }
}
