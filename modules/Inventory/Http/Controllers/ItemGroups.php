<?php

namespace Modules\Inventory\Http\Controllers;

use App\Abstracts\Http\Controller;
use App\Models\Setting\Category;
use App\Models\Setting\Tax;
use App\Models\Common\Item;
use App\Traits\Uploads;
use App\Http\Requests\Common\Import as ImportRequest;
use Modules\Inventory\Exports\ItemGroups\ItemGroups as Export;
use Modules\Inventory\Models\ItemGroupOptionItem;
use Modules\Inventory\Models\ItemGroup;
use Modules\Inventory\Models\Option;
use Modules\Inventory\Http\Requests\ItemGroup as Request;
use Modules\Inventory\Http\Requests\ItemGroupOptionAdd as OptionAddRequest;
use Modules\Inventory\Imports\ItemGroups\ItemGroups as Import;
use Modules\Inventory\Jobs\CreateItemGroup;
use Modules\Inventory\Jobs\DeleteItemGroup;
use Modules\Inventory\Jobs\UpdateItemGroup;

class ItemGroups extends Controller
{
    use Uploads;

    /**
     * Display a listing of the resource.
     *
     * @return Response
    */
    public function index()
    {
        $item_groups = ItemGroup::with('category')->collect();

        return view('inventory::item-groups.index', compact('item_groups'));
    }

    /**
     * Show the form for viewing the specified resource.
     *
     * @return Response
    */
    public function show()
    {
        return redirect()->route('inventory.items.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
    */
    public function create()
    {
        $categories = Category::type('item')->enabled()->orderBy('name')->pluck('name', 'id');

        $taxes = Tax::enabled()->orderBy('name')->get()->pluck('title', 'id');

        $options = Option::enabled()->orderBy('name')->pluck('name', 'id');

        return view('inventory::item-groups.create', compact('categories', 'taxes', 'options'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     *
     * @return Response
    */
    public function store(Request $request)
    {
        if(empty($request->option_values)){
            $response['redirect'] = route('inventory.item-groups.create');

            $message = trans('inventory::itemgroups.error.option_value');

            flash($message)->error()->important();

            return response()->json($response);
        }

        foreach ($request->items as $item) {
            if (empty($item['opening_stock']) && empty($item['sale_price']) && empty($item['purchase_price'])) {
                $response['redirect'] = route('inventory.item-groups.create');

                if (empty($item['opening_stock'])){
                    $message = trans('inventory::itemgroups.error.opening_stock');

                    flash($message)->error()->important();
                }

                if (empty($item['sale_price'])){
                    $message = trans('inventory::itemgroups.error.sale_price');

                    flash($message)->error()->important();
                }

                if (empty($item['purchase_price'])){
                    $message = trans('inventory::itemgroups.error.purchase_price');

                    flash($message)->error()->important();
                }

                return response()->json($response);
            }
        }

        $response = $this->ajaxDispatch(new CreateItemGroup($request));

        if ($response['success']) {
            $response['redirect'] = route('inventory.item-groups.index');

            $message = trans('messages.success.added', ['type' => trans_choice('inventory::general.item_groups', 1)]);

            flash($message)->success();
        } else {
            $response['redirect'] = route('inventory.item-groups.create');

            $message = $response['message'];

            flash($message)->error()->important();
        }

        return response()->json($response);
    }

    /**
     * Duplicate the specified resource.
     *
     * @param  ItemGroup  $item_group
     *
     * @return Response
     */
    public function duplicate(ItemGroup $item_group)
    {
        $clone = $item_group->duplicate();

        $message = trans('messages.success.duplicated', ['type' => trans_choice('inventory::general.item_groups', 1)]);

        flash($message)->success();

        return redirect()->route('inventory.item-groups.edit', $clone->id);
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
        $response = $this->importExcel(new Import, $request, trans_choice('inventory::general.item_groups', 2));

        if ($response['success']) {
            $response['redirect'] = route('inventory.item-groups.index');

            flash($response['message'])->success();
        } else {
            $response['redirect'] = route('import.create', ['inventory', 'item-groups']);

            flash($response['message'])->error()->important();
        }

        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ItemGroup  $item_group
     *
     * @return Response
     */
    public function edit(ItemGroup $item_group)
    {
        $categories = Category::enabled()->orderBy('name')->type('item')->pluck('name', 'id');

        $taxes = Tax::enabled()->orderBy('name')->get()->pluck('title', 'id');

        $options = Option::enabled()->orderBy('name')->pluck('name', 'id');

        $select_option = $item_group->options()->first();

        $items = ItemGroupOptionItem::with(['item', 'inventory_item'])->where('item_group_id', $item_group->id)->get();

        $select_option_values = !empty($select_option->values) ? $select_option->values()->pluck('option_value_id') : null;

        if ($select_option_values) {
            foreach ($select_option_values as $key => $value) {
                $select_option_values[$key] = (string) $value;
            }
        }

        return view('inventory::item-groups.edit', compact('item_group', 'categories', 'taxes', 'options', 'select_option', 'select_option_values', 'items'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ItemGroup  $item_group
     * @param  Request  $request
     *
     * @return Response
     */
    public function update(ItemGroup $item_group, Request $request)
    {
        $response = $this->ajaxDispatch(new UpdateItemGroup($item_group, $request));

        if ($response['success']) {
            $response['redirect'] = route('inventory.item-groups.index');

            $message = trans('messages.success.updated', ['type' => $item_group->name]);

            flash($message)->success();
        } else {
            $response['redirect'] = route('inventory.item-groups.edit', $item_group->id);

            $message = $response['message'];

            flash($message)->error()->important();
        }

        return response()->json($response);
    }

    /**
     * Enable the specified resource.
     *
     * @param  ItemGroup $item
     *
     * @return Response
     */
    public function enable(ItemGroup $item_group)
    {
        $response = $this->ajaxDispatch(new UpdateItemGroup($item_group, request()->merge(['enabled' => 1])));

        if ($response['success']) {
            $response['message'] = trans('messages.success.enabled', ['type' => $item_group->name]);
        }

        return response()->json($response);
    }

    /**
     * Disable the specified resource.
     *
     * @param  ItemGroup $item
     *
     * @return Response
     */
    public function disable(ItemGroup $item_group)
    {
        $response = $this->ajaxDispatch(new UpdateItemGroup($item_group, request()->merge(['enabled' => 0])));

        if ($response['success']) {
            $response['message'] = trans('messages.success.disabled', ['type' => $item_group->name]);
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ItemGroup  $item_group
     *
     * @return Response
     */
    public function destroy(ItemGroup $item_group)
    {
        $response = $this->ajaxDispatch(new DeleteItemGroup($item_group));

        $response['redirect'] = route('inventory.item-groups.index');

        if ($response['success']) {
            $message = trans('messages.success.deleted', ['type' => $item_group->name]);

            flash($message)->success();
        } else {
            $message = $response['message'];

            flash($message)->error()->important();
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
        return $this->exportExcel(new Export, trans_choice('inventory::general.item_groups', 2));
    }

    public function addOption(OptionAddRequest $request)
    {
        $option_row = $request->get('option_row');

        $options = Option::enabled()->orderBy('name')->pluck('name', 'id');

        $html = view('inventory::item-groups.option', compact('option_row', 'options'))->render();

        return response()->json([
            'success' => true,
            'error'   => false,
            'data'    => [],
            'message' => 'null',
            'html'    => $html,
        ]);
    }

    public function addItem(\Illuminate\Http\Request $request)
    {
        $name = $request->get('name');
        $option_id = $request->get('option_id');
        $_values = $request->get('values');
        $text_value = $request->get('text_value');

        $option = Option::with('values')->where('id', $option_id)->first();

        $values = [];

        if ($_values) {
            foreach ($option->values as $value) {
                if (in_array($value->id, $_values)) {
                    $values[] = [
                        'name' => !empty($name) ? $name . ' - ' . $value->name : $value->name,
                        'value' => $value->id
                    ];
                }
            }
        }

        if ($text_value) {
            $values[] = !empty($name) ? $name . ' - ' . $text_value : $text_value;
        }

        return response()->json([
            'data' => $values
        ]);
    }

    public function getOptionValues($option_id)
    {
        $option = Option::with('values')->where('id', $option_id)->first();

        $values = $option->values()->get()->map(function ($item) {
            return [
                'label' => $item->name,
                'value' => $item->id
            ];
        });

        return response()->json([
            'option' => $option,
            'values' => $values,
        ]);
    }
}
