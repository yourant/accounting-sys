<?php

namespace Modules\Inventory\Imports\Items\Sheets;

use App\Abstracts\Import;
use App\Http\Requests\Common\ItemTax as Request;
use App\Models\Common\ItemTax as Model;

class ItemTaxes extends Import
{
    public function model(array $row)
    {
        if ($row['item_name'] === $this->empty_field) {
            return null;
        }

        return new Model($row);
    }

    public function map($row): array
    {
        $row = parent::map($row);

        $row['item_id'] = $this->getItemIdFromName($row);
        $row['tax_id'] = $this->getTaxId($row);

        return $row;
    }

    public function rules(): array
    {
        return (new Request())->rules();
    }
}
