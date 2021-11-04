@extends('layouts.admin')

@section('title', trans('general.title.new', ['type' => trans_choice('general.items', 1)]))

@section('content')
    <div class="card">
        {!! Form::open([
            'route' => 'inventory.items.stock_store',
            'id' => 'item',
            '@submit.prevent' => 'onSubmit',
            '@keydown' => 'form.errors.clear($event.target.name)',
            'files' => true,
            'role' => 'form',
            'class' => 'form-loading-button',
            'novalidate' => true
        ]) !!}

            <div class="card-body">
                <div class="row">
                    {{ Form::textGroup('name', trans('general.name'), 'tag') }}

                    {{ Form::textGroup('sku', trans('inventory::general.sku'), 'fa fa-key', ['required' => 'required',"value=".$sku[0]->sku,'readonly'], !empty($inventory_item->sku) ? $inventory_item->sku : '') }}

                    {{ Form::selectGroup('source_warehouse', trans('inventory::transferorders.source_warehouse'), 'warehouse', $warehouses, null, ['required' => 'required', 'change' => 'onChangeType']) }}

                    {{-- {{ Form::textGroup('sale_price', trans('items.sales_price'), 'money-bill-wave') }} --}}

                    {{-- {{ Form::textGroup('purchase_price', trans('items.purchase_price'), 'money-bill-wave-alt') }} --}}

                    {{ Form::selectRemoteAddNewGroup('category_id', trans_choice('general.categories', 1), 'folder', $categories, null, ['path' => route('modals.categories.create') . '?type=item', 'remote_action' => route('categories.index'). '?search=type:item']) }}

                    {{-- {{ Form::fileGroup('picture', trans_choice('general.pictures', 1), 'plus', ['dropzone-class' => 'form-file', 'options' => ['acceptedFiles' => 'image/*']]) }} --}}

                    {{ Form::radioGroup('enabled', trans('general.enabled'), true) }}

                    <div id="track_inventories" class="row col-md-12">
                        @stack('track_inventory_input_start')
                            <div id="item-track-inventory" class="form-group col-md-12 margin-top">
                                <div class="custom-control custom-checkbox">
                                    {{ Form::checkbox('track_inventory', '1', setting('inventory.track_inventory'), [
                                        'v-model' => 'form.track_inventory',
                                        'id' => 'track_inventory',
                                        'class' => 'custom-control-input'
                                    ]) }}
                                    <label class="custom-control-label" for="track_inventory">
                                        <strong>{{ trans('inventory::items.track_inventory')}}</strong>
                                    </label>
                                </div>
                            </div>
                        @stack('track_inventory_input_end')
                    </div>
                    
                </div>
            </div>

            <div class="card-footer">
                <div class="row save-buttons">
                    {{ Form::saveButtons('inventory.items.store') }}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection

@push('scripts_start')
<script src="{{ asset('modules/Inventory/Resources/assets/js/items.min.js?v=' . module_version('inventory')) }}"></script>
@endpush
