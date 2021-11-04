<?php

namespace Modules\Inventory\Exports\Options\Sheets;

use App\Abstracts\Export;
use Modules\Inventory\Models\Option as Model;

class Options extends Export
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
        return parent::map($model);
    }

    public function fields(): array
    {
        return [
            'name',
            'type',
            'enabled',
        ];
    }
}
