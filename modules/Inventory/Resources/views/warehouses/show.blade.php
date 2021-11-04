@extends('layouts.admin')

@section('title', $warehouse->name)

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header with-border">
                    <h3 class="mb-0">{{ trans('auth.profile') }}</h3>
                </div>
                <div class="card-header border-bottom-0 show-transaction-card-header">
                    <b class="text-sm font-weight-600">{{ trans('general.email') }}</b> <a class="float-right text-xs">{{ $warehouse->email }}</a>
                </div>
                <div class="card-header border-bottom-0 show-transaction-card-header">
                    <b class="text-sm font-weight-600">{{ trans('general.phone') }}</b> <a class="float-right text-xs">{{ $warehouse->phone }}</a>
                </div>
            </div>

            <div class="card ">
                <div class="card-header with-border">
                    <h3 class="mb-0">{{ trans('general.address') }}</h3>
                </div>
                <div class="card-body">
                    <p class="text-muted">
                        {{ $warehouse->address }}
                    </p>
                </div>
            </div>

            <div>
                <a href="{{ route('inventory.warehouses.edit', $warehouse->id) }}" class="btn btn-primary btn-block">
                    <b>{{ trans('general.edit') }}</b>
                </a>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header with-border">
                    <h4 class="no-margin">{{ trans_choice('general.items', 2) }}</h4>
                </div>

                <div class="table-responsive">
                    <table class="table table-flush table-hover">
                        <thead class="thead-light">
                            <tr class="row table-head-line">
                                <th class="col-md-4 text-center">{{ trans('general.name') }}</th>
                                <th class="col-md-2 hidden-xs">{{ trans_choice('general.categories', 1) }}</th>
                                <th class="col-md-2 hidden-xs">{{ trans('inventory::general.quantity') }}</th>
                                <th class="col-md-2 text-right amount-space">{{ trans('items.sales_price') }}</th>
                                <th class="col-md-2 hidden-xs text-right amount-space">{{ trans('items.purchase_price') }}</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($items as $item)
                                <tr class="row align-items-center border-top-1">
                                    <td class="col-md-4 border-0">
                                        <img src="{{ $item->picture ? Storage::url($item->picture->id) : asset('public/img/akaunting-logo-green.svg') }}" class="avatar image-style p-1 mr-3 item-img hidden-md" alt="{{ $item->name }}">
                                        <a href="{{ route('inventory.items.edit', $item->id) }}">{{ $item->name }}</a>
                                    </td>
                                    <td class="col-md-2 hidden-xs border-0">{{ $item->category ? $item->category->name : trans('general.na') }}</td>
                                    <td class="col-md-2 hidden-xs border-0">{{ $item->inventory()->where('warehouse_id', $warehouse->id)->first()->opening_stock }}</td>
                                    <td class="col-md-2 text-right amount-space border-0">{{ money($item->sale_price, setting('default.currency'), true) }}</td>
                                    <td class="col-md-2 hidden-xs text-right amount-space border-0">{{ money($item->purchase_price, setting('default.currency'), true) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts_start')
    <script src="{{ asset('modules/Inventory/Resources/assets/js/warehouses.min.js?v=' . module_version('inventory')) }}"></script>
@endpush
