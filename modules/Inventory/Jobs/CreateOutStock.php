<?php

namespace Modules\Inventory\Jobs;

use App\Abstracts\Job;
use App\Jobs\Common\CreateInStock as CoreCreateInStock;
use App\Models\Common\Item as CoreItem;
use Modules\Inventory\Models\StockOut;
use DB;

class CreateOutStock extends Job
{
    protected $request;

    /**
     * Create a new job instance.
     *
     * @param  $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     *
     * @return Item
     */
    public function handle()
    {
        // $this->item = $this->dispatch(new CoreCreateInStock($this->request));
        // $this->item->sku = $this->request->get('sku');
        // $this->item->save();
        $data = DB::table("stock")
            ->whereNull("deleted_at")
            ->where("id", "=", $this->request->itemSku)
            ->get();
        foreach($this->request->items as $item){
            $created_item = StockOut::create([
                'item' => $data[0]->item,
                'sku' => $data[0]->sku,
                'category' => $data[0]->category,
                
                'quantity' => $item['stock_in_quantity'],
                // 'stock_price' => $item['stock_price'],
                'sale_price' => $item['sale_price'],
                'enabled' => $this->request->enabled,
            ]);
        }

        // $this->dispatch(new CreateHistory($this->request, $this->item));

        return $created_item;
    }
}
