<?php

namespace Modules\Inventory\Imports\Options\Sheets;

use App\Abstracts\Import;
use Modules\Inventory\Http\Requests\Option as Request;

use Modules\Inventory\Models\Option as Model;

class Options extends Import
{
    public function model(array $row)
    {
        return new Model($row);
    }

    public function map($row): array
    {
        $row = parent::map($row);

        return $row;
    }

    public function rules(): array
    {
        return (new Request())->rules();
    }
}
