<?php

namespace Modules\Inventory\Reports;

use App\Abstracts\Report;
use App\Traits\Charts;
use App\Utilities\Chartjs;
use App\Models\Common\Item as CoreItem;
use Date;
use Modules\Inventory\Models\Item;
use Modules\Inventory\Models\History;

class ExpectedStockIncome extends Report
{
    public $default_name = 'inventory::general.reports.name.income_status';

    public $category = 'inventory::general.name';

    public $icon = 'fa fa-cubes';

    public function setViews()
    {
        parent::setViews();
        $this->views['content'] = 'inventory::reports.income.content';
    }

    public function setData()
    {
        $items = CoreItem::get();

        $bill_quantity = 0;
        $sale_quantity = 0;

        foreach ($items as $item) {
            $item['quantity'] = $item->inventory()->sum('opening_stock');

            $item['expected_income'] = $item['quantity'] * $item['sale_price'];

            $sale_histories = History::where('item_id', $item->id)->where('type_type', 'App\Models\Sale\InvoiceItem')->get();

            foreach ($sale_histories as $history) {
                $sale_quantity += $history->quantity;
            }

            $item['sale_quantity'] = $sale_quantity;
            $item['sale_amount'] = $item['sale_quantity'] * $item['sale_price'];

            $bill_histories = History::where('item_id', $item->id)->where('type_type', 'App\Models\Purchase\BillItem')->get();

            foreach ($bill_histories as $history) {
                $bill_quantity += $history->quantity;
            }

            $item['bill_quantity'] = $bill_quantity;
            $item['bill_amount'] = $item['bill_quantity'] * $item['purchase_price'];

            $item['income'] = $item['sale_amount'] - $item['bill_amount'];
        }

        $this->items = $items;
    }

    public function setTables()
    {
        //
    }

    public function setDates()
    {
        //
    }

    public function setRows()
    {
        //
    }
}
