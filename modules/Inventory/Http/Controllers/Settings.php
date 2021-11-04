<?php

namespace Modules\Inventory\Http\Controllers;

use Artisan;
use App\Abstracts\Http\Controller;
use Modules\Inventory\Models\Warehouse;
use Modules\Inventory\Http\Requests\Setting as Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Response;


class Settings extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return Response
     */
    public function edit()
    {
        $warehouses = Warehouse::enabled()->pluck('name', 'id');

        return view('inventory::settings.edit', compact('warehouses'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     *
     * @return Response
     */
    public function update(Request $request)
    {
        setting()->set('inventory.default_warehouse', $request['default_warehouse']);
        setting()->set('inventory.negatif_stock', $request['negatif_stock']);
        setting()->set('inventory.track_inventory', $request['track_inventory']);
        setting()->save();

        if (config('setting.cache.enabled')) {
            Cache::forget(setting()->getCacheKey());
        }

        $response = [
            'success' => true,
            'error' => false,
            'redirect' => route('settings.index'),
            'data' => [],
        ];

        if ($response['success']) {

            $message = trans('messages.success.updated', ['type' => trans_choice('general.settings', 2)]);

            flash($message)->success();
        } else {
            $message = $response['message'];

            flash($message)->error()->important();
        }

        return response()->json($response);
    }
}
