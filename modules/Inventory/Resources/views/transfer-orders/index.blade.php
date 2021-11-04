@extends('layouts.admin')

@section('title', trans_choice('inventory::general.transfer_orders', 2))

@section('new_button')
    @permission('create-inventory-transfer-orders')
        <span><a href="{{ route('inventory.transfer-orders.create') }}" class="btn btn-success btn-sm header-button-top">{{ trans('general.add_new') }}</a></span>
    @endpermission
@endsection

@section('content')
    <div class="card">
        <div class="card-header border-bottom-0" :class="[{'bg-gradient-primary': bulk_action.show}]">
            {!! Form::open([
                'method' => 'GET',
                'route' => 'inventory.transfer-orders.index',
                'role' => 'form',
                'class' => 'mb-0'
            ]) !!}
                <div class="align-items-center" v-if="!bulk_action.show">
                    <x-search-string model="Modules\Inventory\Models\TransferOrder" />
                </div>

                {{ Form::bulkActionRowGroup('inventory::general.transfer-orders', $bulk_actions, ['group' => 'inventory', 'type' => 'transfer-orders']) }}
            {!! Form::close() !!}
        </div>

        <div class="table-responsive">
            <table class="table table-flush table-hover">
                <thead class="thead-light">
                    <tr class="row table-head-line">
                        <th class="col-sm-2 col-md-1 col-lg-1 col-xl-1 hidden-sm">{{ Form::bulkActionAllGroup() }}</th>
                        <th class="col-md-3">@sortablelink('transfer_order', trans_choice('inventory::general.transfer_orders', 1))</th>
                        <th class="col-md-2">@sortablelink('transfer_quantity', trans('inventory::transferorders.transfer_quantity'))</th>
                        <th class="col-md-2">@sortablelink('source_warehouse', trans('inventory::transferorders.source_warehouse'))</th>
                        <th class="col-md-2">@sortablelink('destination_warehouse', trans('inventory::transferorders.destination_warehouse'))</th>
                        <th class="col-md-1">@sortablelink('date', trans('general.date'))</th>
                        <th class="col-md-1 text-center">{{ trans('general.actions') }}</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($transfer_orders as $item)
                        <tr class="row align-items-center border-top-1">
                            <td class="col-sm-2 col-md-1 col-lg-1 col-xl-1 hidden-sm border-0">{{ Form::bulkActionGroup($item->id, $item->transfer_order) }}</td>
                            <td class="col-md-3 border-0">{{ $item->transfer_order }}</a></td>
                            <td class="col-md-2 border-0">{{ $item->transfer_quantity }}</a></td>
                            <td class="col-md-2 border-0">{{ $item->source_warehouse->name }}</a></td>
                            <td class="col-md-2 border-0">{{ $item->destination_warehouse->name }}</a></td>
                            <td class="col-md-1 border-0">{{ $item->date }}</a></td>
                            <td class="col-xs-4 col-sm-3 col-md-1 col-lg-1 col-xl-1 text-center border-0">
                                <div class="dropdown">
                                    <a class="btn btn-neutral btn-sm text-light items-align-center p-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h text-muted"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="dropdown-item" href="{{ route('inventory.transfer-orders.edit', $item->id) }}">{{ trans('general.edit') }}</a>
                                        @permission('delete-inventory-transfer-orders')
                                            <div class="dropdown-divider"></div>
                                            {!! Form::deleteLink($item, 'inventory.transfer-orders.destroy') !!}
                                        @endpermission
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card-footer table-action">
            <div class="row align-items-center">
                @include('partials.admin.pagination', ['items' => $transfer_orders, 'type' => 'transfer_orders'])
            </div>
        </div>
    </div>
@endsection

@push('scripts_start')
    <script src="{{ asset('modules/Inventory/Resources/assets/js/transfer_orders.min.js?v=' . module_version('inventory')) }}"></script>
@endpush
