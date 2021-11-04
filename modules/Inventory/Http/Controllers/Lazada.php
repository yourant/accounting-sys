<?php

namespace Modules\Inventory\Http\Controllers;

use App\Abstracts\Http\Controller;
use App\Models\Common\item;
use App\Http\Requests\Common\Item as Request;
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
use Modules\Inventory\Models\Item as InventoryItem;
use Modules\Inventory\Exports\Items\Items as Export;
use Modules\Inventory\Imports\Items\Items as Import;
use Modules\Inventory\Jobs\CreateItem;
use Modules\Inventory\Jobs\DeleteItem as InventoryDeleteItem;
use Modules\Inventory\Jobs\UpdateItem;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;
class Lazada extends Controller
{   
    use Sortable;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function lazada_items()
    {   
        if(isset($_GET['limit'])){
            if(isset($_GET['page'])){
                $skip = $_GET['limit']*($_GET['page']-1);
                $items = DB::table("lazada_data")
                ->where("lazada_data.status", "=", "active")
                ->skip($skip)
                ->take($_GET['limit'])
                ->get();
                $limit = $_GET['limit'];
            }else{
                $items = DB::table("lazada_data")
                ->where("lazada_data.status", "=", "active")
                ->take($_GET['limit'])
                ->get();
                $limit = $_GET['limit'];
            }
        }else{
            $items = DB::table("lazada_data")
            ->where("lazada_data.status", "=", "active")
            ->take(50)
            ->get();
            $limit = 50;
        }
        
        $item_total=DB::table("lazada_data")
        ->where("lazada_data.status", "=", "active")
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
        return view('inventory::lazada.lazada_item', compact('item_total','first','items','limit','limit_pages'));
    }

    public function lazada_orders()
    {   
        if(isset($_GET['limit'])){
            if(isset($_GET['page'])){
                $skip = $_GET['limit']*($_GET['page']-1);
                $items = DB::table("lazada_data")
                ->where("lazada_data.status", "=", "active")
                ->skip($skip)
                ->take($_GET['limit'])
                ->get();
                $limit = $_GET['limit'];
            }else{
                $items = DB::table("lazada_data")
                ->where("lazada_data.status", "=", "active")
                ->take($_GET['limit'])
                ->get();
                $limit = $_GET['limit'];
            }
        }else{
            $items = DB::table("lazada_data")
            ->where("lazada_data.status", "=", "active")
            ->take(50)
            ->get();
            $limit = 50;
        }
        
        $item_total=DB::table("lazada_data")
        ->where("lazada_data.status", "=", "active")
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
        return view('inventory::lazada.lazada_orders', compact('item_total','first','items','limit','limit_pages'));
    }

    public function lazada_stock()
    {
        $items = item::with('category', 'media')->collect();

        return view('inventory::stock.lazada_stock', compact('items'));
    }

    public function shopee_stock()
    {
        $items = item::with('category', 'media')->collect();

        return view('inventory::stock.shopee_stock', compact('items'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::item()->enabled()->orderBy('name')->pluck('name', 'id');

        $taxes = Tax::enabled()->orderBy('name')->get()->pluck('title', 'id');

        $currency = Currency::where('code', setting('default.currency'))->first();

        $warehouses = Warehouse::enabled()->pluck('name', 'id');

        return view('inventory::items.create', compact('categories', 'taxes', 'currency', 'warehouses'));
    }

    public function store(Request $request)
    {
        $response = $this->ajaxDispatch(new CreateItem($request));

        if ($response['success']) {
            $response['redirect'] = route('inventory.items.index');

            $message = trans('messages.success.added', ['type' => trans_choice('general.items', 1)]);

            flash($message)->success();
        } else {
            $response['redirect'] = route('inventory.items.create');

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
