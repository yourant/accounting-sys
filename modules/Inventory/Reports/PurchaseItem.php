<?php

namespace Modules\Inventory\Reports;

use App\Abstracts\Report;
use App\Traits\Charts;
use App\Utilities\Chartjs;
use App\Models\Document\DocumentItem;
use App\Models\Common\Item as CoreItem;
use Date;
use Modules\Inventory\Models\History;

class PurchaseItem extends Report
{
    use Charts;

    public $default_name = 'inventory::general.reports.name.purchase_summary';

    public $category = 'inventory::general.name';

    public $icon = 'fa fa-cubes';

    public function getGrandTotal()
    {
        if (!$this->loaded) {
            $this->load();
        }

        $grand_total = trans('general.na');

        return $grand_total;
    }

    public function getChart()
    {
        $chart = new Chartjs();

        if (empty($this->model->settings->chart)) {
            return $chart;
        }

        $config = $this->chart[$this->model->settings->chart];

        $default_options = $this->getLineChartOptions();

        $config_options = array_merge((array) $config['options'], ['legend' => ['display' => true]]);

        $options = array_merge($default_options, $config_options);

        $colors = [];

        $items = CoreItem::get();

        $chart->type($this->model->settings->chart)
        ->width((int) $config['width'])
        ->height((int) $config['height'])
        ->options($options)
        ->labels(!empty($config['dates']) ? array_values($config['dates']) : array_values($this->dates));

        if (!$items->count()) {
            foreach ($this->footer_totals as $total) {
                $chart->dataset($this->model->name, 'line', array_values($total))
                    ->backgroundColor(isset($config['backgroundColor']) ? $config['backgroundColor'] : '#6da252')
                    ->color(isset($config['color']) ? $config['color'] : '#6da252')
                    ->options([
                        'borderWidth' => 4,
                        'pointStyle' => 'line',
                    ])
                    ->fill(false);
            }
        } else {
            foreach ($items as $item) {
                $rand_color = mt_rand(0, 999999);
                $colors += [$item->name => $rand_color];
            }

            foreach ($this->row_values['default'] as $type => $totals) {
                $chart->dataset($type, 'line', array_values($totals))
                    ->backgroundColor('#'. $colors[$type])
                    ->color('#'. $colors[$type])
                    ->options([
                        'borderWidth' => 4,
                        'pointStyle' => 'line',
                    ])
                    ->fill(false);
            }
        }

        return $chart;
    }

    public function setViews()
    {
        parent::setViews();
        $this->views['table.rows'] = 'inventory::reports.purchase.table.rows';
        $this->views['table.footer'] = 'inventory::reports.purchase.table.footer';
    }

    public function setRows()
    {
        $rows = [];

        $items = CoreItem::get();

        if (!$items->count()) {
            return;
        }

        foreach ($items as $item) {
            $rows += [$item->name => $item->name];
        }

        foreach ($this->dates as $date) {
            foreach ($this->tables as $table) {
                foreach ($rows as $id => $name) {
                    $this->row_names[$table][$id] = $name;
                    $this->row_values[$table][$id][$date] = 0;
                }
            }
        }
    }

    public function setData()
    {
        $items = CoreItem::get();

        if (!$items->count()) {
            return;
        }

        foreach ($items as $item) {
            $date = $this->getFormattedDate(Date::parse($item->created_at));

            if (empty($date)) {
                continue;
            }

            $histories = $this->applyFilters(History::where('item_id', $item->id), ['date_field' => 'created_at'])->get();

            foreach ($histories as $history) {
                $date = $this->getFormattedDate(Date::parse($history->created_at));

                $document_type = DocumentItem::where('id', $history->type_id)->where('type', 'bill')->first();

                if (!empty($document_type)) {
                    if ($history->type_type == 'App\Models\Document\DocumentItem') {
                        $this->row_values['default'][$item->name][$date] += $history->quantity;
                    }
                }
            }
        }
    }

    public function getFields()
    {
        return [
            $this->getPeriodField(),
            $this->getChartField(),
        ];
    }
}
