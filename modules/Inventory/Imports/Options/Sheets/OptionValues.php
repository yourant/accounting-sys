<?php

namespace Modules\Inventory\Imports\Options\Sheets;

use App\Abstracts\Import;
use Modules\Inventory\Models\Option;
use Modules\Inventory\Http\Requests\Imports\OptionValue as Request;
use Modules\Inventory\Models\OptionValue as Model;

class OptionValues extends Import
{
    public function model(array $row)
    {
        return new Model($row);
    }

    public function map($row): array
    {
        $row['option_id'] = Option::where('name', $row['option_name'])->pluck('id')->first();

        $row = parent::map($row);

        return $row;
    }

    public function rules(): array
    {
        return (new Request())->rules();
    }
}
