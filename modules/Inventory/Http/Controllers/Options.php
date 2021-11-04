<?php

namespace Modules\Inventory\Http\Controllers;

use App\Abstracts\Http\Controller;
use App\Http\Requests\Common\Import as ImportRequest;
use Modules\Inventory\Exports\Options\Options as Export;
use Modules\Inventory\Http\Requests\Option as Request;
use Modules\Inventory\Imports\Options\Options as Import;
use Modules\Inventory\Jobs\CreateOption;
use Modules\Inventory\Jobs\DeleteOption;
use Modules\Inventory\Jobs\UpdateOption;
use Modules\Inventory\Models\Option;

class Options extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $options = Option::collect();

        return view('inventory::options.index', compact('options'));
    }

    /**
     * Show the form for viewing the specified resource.
     *
     * @return Response
     */
    public function show(Option $option)
    {
        return redirect()->route('inventory.options.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $types = [
            trans('inventory::options.types.choose') => [
                'select' => trans('inventory::options.types.select'),
                'radio' => trans('inventory::options.types.radio'),
                'checkbox' => trans('inventory::options.types.checkbox')
            ],
            trans('inventory::options.types.input') => [
                'text' => trans('inventory::options.types.text'),
                'textarea' => trans('inventory::options.types.textarea')
            ],
        ];

        return view('inventory::options.create', compact('types'));
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
        $response = $this->ajaxDispatch(new CreateOption($request));

        if ($response['success']) {
            $response['redirect'] = route('inventory.options.index');

            $message = trans('messages.success.added', ['type' => trans_choice('inventory::general.options', 1)]);

            flash($message)->success();
        } else {
            $response['redirect'] = route('inventory.options.create');

            $message = $response['message'];

            flash($message)->error()->important();
        }

        return response()->json($response);
    }

    /**
     * Duplicate the specified resource.
     *
     * @param  Option $option
     *
     * @return Response
     */
    public function duplicate(Option $option)
    {
        $clone = $option->duplicate();

        $message = trans('messages.success.duplicated', ['type' => trans_choice('inventory::general.options', 1)]);

        flash($message)->success();

        return redirect()->route('inventory.options.edit', $clone->id);
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
        $response = $this->importExcel(new Import, $request, trans_choice('inventory::general.options', 2));

        if ($response['success']) {
            $response['redirect'] = route('inventory.options.index');

            flash($response['message'])->success();
        } else {
            $response['redirect'] = route('import.create', ['inventory', 'options']);

            flash($response['message'])->error()->important();
        }

        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Option $option
     *
     * @return Response
     */
    public function edit(Option $option)
    {
        $types = [
            trans('inventory::options.types.choose') => [
                'select' => trans('inventory::options.types.select'),
                'radio' => trans('inventory::options.types.radio'),
                'checkbox' => trans('inventory::options.types.checkbox')
            ],
            trans('inventory::options.types.input') => [
                'text' => trans('inventory::options.types.text'),
                'textarea' => trans('inventory::options.types.textarea')
            ],
        ];

        return view('inventory::options.edit', compact('option', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Option $option
     * @param  Request $request
     *
     * @return Response
     */
    public function update(Option $option, Request $request)
    {
        $response = $this->ajaxDispatch(new UpdateOption($option, $request));

        if ($response['success']) {
            $response['redirect'] = route('inventory.options.index');

            $message = trans('messages.success.updated', ['type' => $option->name]);

            flash($message)->success();
        } else {
            $response['redirect'] = route('inventory.options.edit', $option->id);

            $message = $response['message'];

            flash($message)->error()->important();
        }

        return response()->json($response);
    }

    /**
     * Enable the specified resource.
     *
     * @param  Option $option
     *
     * @return Response
     */
    public function enable(Option $option)
    {
        $response = $this->ajaxDispatch(new UpdateOption($option, request()->merge(['enabled' => 1, 'inline' => 'true'])));

        if ($response['success']) {
            $response['message'] = trans('messages.success.enabled', ['type' => $option->name]);
        }

        return response()->json($response);
    }

    /**
     * Disable the specified resource.
     *
     * @param  Option $option
     *
     * @return Response
     */
    public function disable(Option $option)
    {
        $response = $this->ajaxDispatch(new UpdateOption($option, request()->merge(['enabled' => 0, 'inline' => 'true'])));

        if ($response['success']) {
            $response['message'] = trans('messages.success.enabled', ['type' => $option->name]);
        }

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Option $option
     *
     * @return Response
     */
    public function destroy(Option $option)
    {
        $response = $this->ajaxDispatch(new DeleteOption($option));

        $response['redirect'] = route('inventory.options.index');

        if ($response['success']) {
            $message = trans('messages.success.deleted', ['type' => $option->name]);

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
        return $this->exportExcel(new Export, trans_choice('inventory::general.options', 2));
    }
}
