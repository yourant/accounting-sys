<?php

namespace Modules\Inventory\Http\Controllers;

use App\Abstracts\Http\Controller;
use App\Models\Common\Item;
use Modules\Inventory\Http\Requests\TransferOrder as Request;
use Modules\Inventory\Jobs\CreateTransferOrder;
use Modules\Inventory\Jobs\DeleteTransferOrder;
use Modules\Inventory\Jobs\UpdateTransferOrder;
use Modules\Inventory\Models\TransferOrder;
use Modules\Inventory\Models\Warehouse;
use Modules\Inventory\Models\Item as InventoryItem;
use Date;

class TransferOrders extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $transfer_orders = TransferOrder::collect();

        return view('inventory::transfer-orders.index', compact('transfer_orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $warehouses = Warehouse::enabled()->pluck('name', 'id');

        return view('inventory::transfer-orders.create', compact('warehouses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $response = $this->ajaxDispatch(new CreateTransferOrder($request));

        if ($response['success']) {
            $response['redirect'] = route('inventory.transfer-orders.index');

            $message = trans('messages.success.added', ['type' => trans_choice('inventory::general.tranfer-orders', 1)]);

            flash($message)->success();
        } else {
            $response['redirect'] = route('inventory.transfer-orders.create');

            $message = $response['message'];

            flash($message)->error()->important();
        }

        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  TransferOrder $transfer_order
     *
     * @return Response
     */
    public function edit(TransferOrder $transfer_order)
    {
        $warehouses = Warehouse::enabled()->pluck('name', 'id');

        return view('inventory::transfer-orders.edit', compact('transfer_order', 'warehouses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TransferOrder $transfer_order
     * @param  Request $request
     *
     * @return Response
     */
    public function update(TransferOrder $transfer_order, Request $request)
    {
        $response = $this->ajaxDispatch(new UpdateTransferOrder($transfer_order, $request));

        if ($response['success']) {
            $response['redirect'] = route('inventory.transfer-orders.index');

            $message = trans('messages.success.updated', ['type' => $transfer_order->transfer_order]);

            flash($message)->success();
        } else {
            $response['redirect'] = route('inventory.transfer-orders.edit', $transfer_order->id);

            $message = $response['message'];

            flash($message)->error()->important();
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  TransferOrder $transfer_order
     *
     * @return Response
     */
    public function destroy(TransferOrder $transfer_order)
    {
        $response = $this->ajaxDispatch(new DeleteTransferOrder($transfer_order));

        $response['redirect'] = route('inventory.transfer-orders.index');

        if ($response['success']) {
            $message = trans('messages.success.deleted', ['type' => $transfer_order->transfer_order]);

            flash($message)->success();
        } else {
            $message = $response['message'];

            flash($message)->error()->important();
        }

        return response()->json($response);
    }

    public function getSourceItem(Request $request)
    {
        $items = [];

        $warehouse_items = InventoryItem::where('warehouse_id', $request['warehouse_id'])->get();

        foreach($warehouse_items as $warehouse_item){
            $item = Item::firstWhere('id', $warehouse_item->item_id);

            $items[$item->id] = $item->name;
        }

        $destination_warehouses = Warehouse::enabled()->pluck('name', 'id');

        if (!empty($request['warehouse_id'])){
            unset( $destination_warehouses[$request['warehouse_id']]);
        }

        return response()->json([
            'data' => [
                'items' => $items,
                'destination_warehouses' => $destination_warehouses
            ],
        ]);
    }

    public function getItemQuantity(Request $request)
    {
        $quantity = InventoryItem::where('warehouse_id', $request['warehouse_id'])->where('item_id', $request['item_id'])->value('opening_stock');

        return response()->json(['data' => $quantity]);
    }
}
