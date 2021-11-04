<?php

namespace Modules\Inventory\Http\Controllers;

use App\Abstracts\Http\Controller;
use App\Models\Common\item;
use App\Http\Requests\Common\Stock as Request;
use App\Models\Setting\Category;
use App\Models\Setting\Currency;
use App\Models\Setting\Tax;
use App\Http\Requests\Common\Import as ImportRequest;
use App\Http\Requests\Common\TotalItem as TotalRequest;
use App\Jobs\Common\CreateItem as BaseCreateItem;
use App\Jobs\Common\DeleteItem as BaseDeleteItem;
use App\Jobs\Common\UpdateItem as BaseUpdateItem;
use Modules\Inventory\Models\History;
use Modules\Inventory\Models\WarehouseItem;
use Modules\Inventory\Models\Warehouse;
use Modules\Inventory\Models\Stock as Stock_item;
use Modules\Inventory\Models\Item as InventoryItem;
use Modules\Inventory\Exports\Items\Items as Export;
use Modules\Inventory\Imports\Items\Items as Import;
use Modules\Inventory\Jobs\CreateItem;
use Modules\Inventory\Jobs\CreateOutStock;
use Modules\Inventory\Jobs\CreateInStock;
use Modules\Inventory\Jobs\CreateStock;
use Modules\Inventory\Jobs\DeleteItem as InventoryDeleteItem;
use Modules\Inventory\Jobs\UpdateItem;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;
Class Stock extends Controller
{   
    use Sortable;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    //Iventory Item Index Interface example
    public function index()
    {   
        if(isset($_GET['limit'])){
            if(isset($_GET['page'])){
                $skip = $_GET['limit']*($_GET['page']-1);
                $items = DB::table("items")
                ->whereNull("items.deleted_at")
                ->where("items.company_id", "=", 1)
                ->skip($skip)
                ->take($_GET['limit'])
                ->get();
                $limit = $_GET['limit'];
            }else{
                $items = DB::table("items")
                ->whereNull("items.deleted_at")
                ->where("items.company_id", "=", 1)
                ->take($_GET['limit'])
                ->get();
                $limit = $_GET['limit'];
            }
        }else{
            $items = DB::table("items")
            ->whereNull("items.deleted_at")
            ->where("items.company_id", "=", 1)
            ->take(50)
            ->get();
            $limit = 50;
        }
        $item_total=DB::table("items")
        ->whereNull("items.deleted_at")
        ->where("items.company_id", "=", 1)
        ->count();
        if(isset($_GET['limit'])){
            $first = $item_total/$_GET['limit'];
        }else{
            $first = "1";
        }
            $limit_pages= Array(
                    "10" => "10", 
                    "25" => "25", 
                    "50" => "50",
                    "100" => "100", 
                    );
        return view('inventory::Stock.stock_in', compact('item_total','first','items','limit','limit_pages'));
    }


    //Stock In Out Take Interface display
    public function stock_in()
    {   
        if(isset($_GET['limit'])){
            if(isset($_GET['page'])){
                $skip = $_GET['limit']*($_GET['page']-1);
                $items = DB::table("stock_in")
                ->whereNull("deleted_at")
                // ->where("items.company_id", "=", 1)
                ->skip($skip)
                ->take($_GET['limit'])
                ->get();
                $limit = $_GET['limit'];
            }else{
                $items = DB::table("stock_in")
                ->whereNull("deleted_at")
                // ->where("items.company_id", "=", 1)
                ->take($_GET['limit'])
                ->get();
                $limit = $_GET['limit'];
            }
        }else{
            $items = DB::table("stock_in")
            ->whereNull("deleted_at")
            // ->where("items.company_id", "=", 1)
            ->take(50)
            ->get();
            $limit = 50;
        }
        $item_total=DB::table("stock_in")
        ->whereNull("deleted_at")
        // ->where("items.company_id", "=", 1)
        ->count();
        if(isset($_GET['limit'])){
            $first = $item_total/$_GET['limit'];
        }else{
            $first = "1";
        }
            $limit_pages= Array(
                    "10" => "10", 
                    "25" => "25", 
                    "50" => "50",
                    "100" => "100", 
                    );
        return view('inventory::Stock.stock_in', compact('item_total','first','items','limit','limit_pages'));
    }

    public function stock_out()
    {   
        if(isset($_GET['limit'])){
            if(isset($_GET['page'])){
                $skip = $_GET['limit']*($_GET['page']-1);
                $items = DB::table("stock_out")
                ->whereNull("deleted_at")
                // ->where("items.company_id", "=", 1)
                ->skip($skip)
                ->take($_GET['limit'])
                ->get();
                $limit = $_GET['limit'];
            }else{
                $items = DB::table("stock_out")
                ->whereNull("deleted_at")
                // ->where("items.company_id", "=", 1)
                ->take($_GET['limit'])
                ->get();
                $limit = $_GET['limit'];
            }
        }else{
            $items = DB::table("stock_out")
            ->whereNull("deleted_at")
            // ->where("items.company_id", "=", 1)
            ->take(50)
            ->get();
            $limit = 50;
        }
        $item_total=DB::table("stock_out")
        ->whereNull("deleted_at")
        // ->where("items.company_id", "=", 1)
        ->count();
        if(isset($_GET['limit'])){
            $first = $item_total/$_GET['limit'];
        }else{
            $first = "1";
        }
            $limit_pages= Array(
                    "10" => "10", 
                    "25" => "25", 
                    "50" => "50",
                    "100" => "100", 
                    );
        return view('inventory::Stock.stock_out', compact('item_total','first','items','limit','limit_pages'));
    }

    public function stock_index()
    {   
        if(isset($_GET['limit'])){
            if(isset($_GET['page'])){
                $skip = $_GET['limit']*($_GET['page']-1);
                $items = DB::table("stock")
                ->skip($skip)
                ->take($_GET['limit'])
                ->get();
                $limit = $_GET['limit'];
            }else{
                $items = DB::table("stock")
                ->take($_GET['limit'])
                ->get();
                $limit = $_GET['limit'];
            }
        }else{
            
            $items = DB::table("stock")
            ->leftJoin("stock_in", function($join){
                $join->on("stock_in.sku", "=", "stock.sku");
            })
            ->leftJoin("stock_out", function($join){
                $join->on("stock_out.sku", "=", "stock.sku");
            })
            ->select("stock.*",
            DB::raw("SUM(akho_stock_in.quantity) as in_quantity"),
            DB::raw("SUM((akho_stock_in.sale_price*akho_stock_in.quantity)) as in_sale_price"),
            DB::raw("SUM((akho_stock_in.stock_price*akho_stock_in.quantity)) as in_stock_price"),
            DB::raw("SUM((akho_stock_out.sale_price*akho_stock_out.quantity)) as out_sale_price"),
            DB::raw("SUM(akho_stock_out.quantity) as out_quantity")
            )
            ->take(50)
            ->groupBy("stock.sku")
            ->get();
            
            $limit = 50;
        }
        $item_total=DB::table("stock")
        ->count();
        if(isset($_GET['limit'])){
            $first = $item_total/$_GET['limit'];
        }else{
            $first = "1";
        }
            $limit_pages= Array(
                    "10" => "10", 
                    "25" => "25", 
                    "50" => "50",
                    "100" => "100", 
                    );
        return view('inventory::Stock.stock', compact('item_total','first','items','limit','limit_pages'));
    }


    //Stock Create Interface
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function stock_in_create()
    {
        $Item = Stock_item::enabled()->pluck('item', 'id');

        $Sku = Stock_item::enabled()->pluck('sku', 'id');;

        $taxes = Tax::enabled()->orderBy('name')->get()->pluck('title', 'id');

        $currency = Currency::where('code', setting('default.currency'))->first();

        $warehouses = Warehouse::enabled()->pluck('name', 'id');

        return view('inventory::Stock.stock_in_create', compact('Item', 'Sku', 'taxes', 'currency', 'warehouses'));
    }

    public function stock_out_create()
    {
        $Item = Stock_item::enabled()->pluck('item', 'id');

        $Sku = Stock_item::enabled()->pluck('sku', 'id');;

        $taxes = Tax::enabled()->orderBy('name')->get()->pluck('title', 'id');

        $currency = Currency::where('code', setting('default.currency'))->first();

        $warehouses = Warehouse::enabled()->pluck('name', 'id');

        return view('inventory::Stock.stock_out_create', compact('Item', 'Sku', 'taxes', 'currency', 'warehouses'));
    }

    public function create()
    {
        $sku=DB::table("stock")
        ->select(DB::raw("(MAX(id)+1) as sku"))
        ->get();
        $categories = Category::item()->enabled()->orderBy('name')->pluck('name', 'id');

        $taxes = Tax::enabled()->orderBy('name')->get()->pluck('title', 'id');

        $currency = Currency::where('code', setting('default.currency'))->first();

        $warehouses = Warehouse::enabled()->pluck('name', 'id');

        return view('inventory::Stock.stock_create', compact('sku', 'categories', 'taxes', 'currency', 'warehouses'));
    }
    

    //Stock Store Insert function
    public function stock_in_store(Request $request)
    {
        $response = $this->ajaxDispatch(new CreateInStock($request));

        if ($response['success']) {
            $response['redirect'] = route('inventory.items.stock_in');

            $message = trans('messages.success.added', ['type' => trans_choice('general.items', 1)]);

            flash($message)->success();
        } else {
            $response['redirect'] = route('inventory.items.stock_in_create');

            $message = $response['message'];

            flash($message)->error()->important();
        }

        return response()->json($response);
    }

    public function stock_out_store(Request $request)
    {
        $response = $this->ajaxDispatch(new CreateOutStock($request));

        if ($response['success']) {
            $response['redirect'] = route('inventory.items.stock_out');

            $message = trans('messages.success.added', ['type' => trans_choice('general.items', 1)]);

            flash($message)->success();
        } else {
            $response['redirect'] = route('inventory.items.stock_out_create');

            $message = $response['message'];

            flash($message)->error()->important();
        }

        return response()->json($response);
    }

    public function stock_store(Request $request)
    {
        $response = $this->ajaxDispatch(new CreateStock($request));

        if ($response['success']) {
            $response['redirect'] = route('inventory.items.stock');

            $message = trans('messages.success.added', ['type' => trans_choice('general.items', 1)]);

            flash($message)->success();
        } else {
            $response['redirect'] = route('inventory.items.stock_create');

            $message = $response['message'];

            flash($message)->error()->important();
        }

        return response()->json($response);
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  Item  $item
     *
     * @return Response
     */
    public function edit(item $item)
    {
        $categories = Category::item()->enabled()->orderBy('name')->pluck('name', 'id');

        $warehouses = Warehouse::enabled()->pluck('name', 'id');

        $inventory_items = $item->inventory()->get();

        $sku = null;

        if (!empty($inventory_items[0])) {
            $sku = $inventory_items[0]->sku;
        }

        $track_control = !empty($inventory_items[0]) ? true : false;

        $taxes = Tax::enabled()->orderBy('name')->get()->pluck('title', 'id');

        return view('inventory::items.edit', compact('categories', 'taxes', 'item', 'inventory_items', 'warehouses', 'track_control', 'sku'));
    }

    public function update(item $item, Request $request)
    {
        $response = $this->ajaxDispatch(new UpdateItem($item, $request));

        if ($response['success']) {
            $response['redirect'] = route('inventory.items.index');

            $message = trans('messages.success.updated', ['type' => $item->name]);

            flash($message)->success();
        } else {
            $response['redirect'] = route('inventory.items.edit', $item->id);

            $message = $response['message'];

            flash($message)->error()->important();
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Item $item
     *
     * @return Response
     */
    public function destroy(item $item)
    {
        $inventory_item = $item->inventory()->first();

        if (empty($inventory_item)) {
            $response = $this->ajaxDispatch(new BaseDeleteItem($item));
        } else {
            $response = $this->ajaxDispatch(new InventoryDeleteItem($item));
        }

        $response['redirect'] = route('inventory.items.index');

        if ($response['success']) {
            $message = trans('messages.success.deleted', ['type' => $item->name]);

            flash($message)->success();
        } else {
            $message = $response['message'];

            flash($message)->error()->important();
        }

        return response()->json($response);
    }

    /**
     * Show the form for viewing the specified resource.
     *
     * @return Response
     */
    public function show(item $item)
    {
        $counts = [
            'invoices' => 100,
            'bills' => 10,
        ];

        $amounts = [
            'paid' => 0,
            'open' => 0,
            'overdue' => 0,
        ];

        $transactions = [];

        $item_inventory = InventoryItem::where('item_id', $item->id)->first();

        $item_warehouse = WarehouseItem::where('item_id', $item->id)->first();

        $item_histories = History::where('item_id', $item->id)->get();

        return view('inventory::items.show', compact('item', 'item_inventory', 'item_warehouse', 'item_histories', 'counts', 'amounts', 'transactions'));
    }

    /**
     * Enable the specified resource.
     *
     * @param  Item $item
     *
     * @return Response
     */
    public function enable(item $item)
    {
        $response = $this->ajaxDispatch(new BaseUpdateItem($item, request()->merge(['enabled' => 1])));

        if ($response['success']) {
            $response['message'] = trans('messages.success.enabled', ['type' => $item->name]);
        }

        return response()->json($response);
    }

    /**
     * Disable the specified resource.
     *
     * @param  Item $item
     *
     * @return Response
     */
    public function disable(item $item)
    {
        $response = $this->ajaxDispatch(new BaseUpdateItem($item, request()->merge(['enabled' => 0])));

        if ($response['success']) {
            $response['message'] = trans('messages.success.disabled', ['type' => $item->name]);
        }

        return response()->json($response);
    }
    
    /**
     * Import the specified resource.
     *
     * @param  ImportRequest  $request
     *
     * @return Response
     */
    public function import(ImportRequest $request)
    {
        $response = $this->importExcel(new Import, $request, trans_choice('general.items', 2));

        if ($response['success']) {
            $response['redirect'] = route('inventory.items.index');

            flash($response['message'])->success();
        } else {
            $response['redirect'] = route('import.create', ['inventory', 'items']);

            flash($response['message'])->error()->important();
        }

        return response()->json($response);
    }

    /**
     * Export the specified resource.
     *
     * @return Response
     */
    public function export()
    {
        return $this->exportExcel(new Export, trans_choice('general.items', 2));
    }
}
