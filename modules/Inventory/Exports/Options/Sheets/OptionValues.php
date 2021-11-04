<?php

namespace Modules\Inventory\Exports\Options\Sheets;

use App\Abstracts\Export;
use Modules\Inventory\Models\Option;
use Modules\Inventory\Models\OptionValue as Model;

class OptionValues extends Export
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
        $option_name = Option::where('id', $model->option_id)->pluck('name')->first();

        $model->option_name = $option_name;

        return parent::map($model);
    }

    public function fields(): array
    {
        return [
            'option_name',
            'name',
        ];
    }
}
