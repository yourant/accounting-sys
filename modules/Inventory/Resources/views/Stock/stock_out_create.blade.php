@extends('layouts.admin')

@section('title', trans('general.title.new', ['type' => trans_choice('Stock Out', 1)]))

@section('content')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}

    <div class="card">
        {!! Form::open([
            'route' => 'inventory.items.stock_out_store',
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

                    {{ Form::selectRemoteAddNewGroup('itemSku', trans_choice('item', 1), 'folder', $Item, null, ['required' => 'required','path' => route('modals.categories.create') . '?type=item', 'remote_action' => route('categories.index'). '?search=type:item']) }}

                    {{-- {{ Form::textGroup('item', trans('general.name'), 'tag') }} --}}

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

                    <div v-if="form.track_inventory.length" class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="items">
                                <thead class="thead-light">
                                    <tr class="row">
                                        <th class="col-md-1">{{ trans('general.actions') }}</th>
                                        <th class="col-md-3">{{ trans('Stock In Quantity') }}</th>
                                        <th class="col-md-4">{{ trans('Sale Price') }}</th>
                                        {{-- <th class="col-md-3">{{ trans('Stock Price') }}</th> --}}
                                        <th class="col-md-4">{{ trans('Total Earn') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr class="row" v-for="(row, index) in form.items" :index="index">
                                        <td class="col-md-1">
                                            <button type="button"
                                                @click="onDeleteItem(index)"
                                                data-toggle="tooltip"
                                                title="{{ trans('general.delete') }}"
                                                class="btn btn-icon btn-outline-danger btn-lg"><i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                        <td class="col-md-3">
                                            <input value=""
                                            class="form-control"
                                            data-item="Stock In Quantity"
                                            required="required"
                                            name="items[][stock_in_quantity]"
                                            :quantity="index"
                                            v-model="row.stock_in_quantity"
                                            type="number"
                                            autocomplete="off">
                                        </td>
                                        <td class="col-md-4">
                                            <input value=""
                                            class="form-control"
                                            data-item="Sale Price"
                                            required="required"
                                            name="items[][sale_price]"
                                            :sale_price="index"
                                            v-model="row.sale_price"
                                            type="number"
                                            autocomplete="off">
                                        </td>
                                        {{-- <td class="col-md-3">
                                            <input value=""
                                            class="form-control"
                                            data-item="Stock Price"
                                            required="required"
                                            name="items[][stock_price]"
                                            :stock_price="index"
                                            v-model="row.stock_price"
                                            type="number"
                                            autocomplete="off">
                                        </td> --}}
                                        <td class="col-md-4">
                                            <input value=""
                                            class="form-control"
                                            data-item="Total"
                                            required="required"
                                            name="items[][total]"
                                            :total="index"
                                            v-model="row.total"
                                            type="number"
                                            readonly="readonly"
                                            autocomplete="off">
                                        </td>
                                    </tr>
                                    <tr id="addItem">
                                        <td class="col-md-1">
                                            <button type="button"
                                                @click="onAddItem"
                                                id="button-add-item"
                                                data-toggle="tooltip"
                                                title="{{ trans('general.add') }}"
                                                class="btn btn-icon btn-outline-success btn-lg"
                                                data-original-title="{{ trans('general.add') }}">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row save-buttons">
                    {{ Form::saveButtons('inventory.items.stock_in') }}
                </div>
            </div>
        {!! Form::close() !!}
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <script>
        $(document).on('keyup', "[quantity],[sale_price],[stock_price]", function(){
            $("[total]").each(function() {
                var id = $(this).attr('total');
                var quantity = $("[quantity^="+id+"]").val();
                var sale_price = $("[sale_price^="+id+"]").val();
                // var stock_price = $("[stock_price^="+id+"]").val();
                var total = (quantity*sale_price);
                $("[total^="+id+"]").val(parseFloat(total));
            });
	    });	
    </script>
    
@endsection

@push('scripts_start')
<script src="{{ asset('modules/Inventory/Resources/assets/js/items.min.js?v=' . module_version('inventory')) }}"></script>
@endpush
