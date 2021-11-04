@extends('layouts.admin')

@section('title', $item->name)

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="d-none">
                <div class="card-body card-profile">
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item" style="border-top: 0;">
                            <b>{{ trans_choice('general.invoices', 2) }}</b> <a class="pull-right">{{ $counts['invoices'] }}</a>
                        </li>
                        <li class="list-group-item">
                            <b>{{ trans_choice('general.bills', 2) }}</b> <a class="pull-right">{{ $counts['bills'] }}</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-header with-border">
                    <h3 class="card-title">{{ trans('inventory::general.information') }}</h3>
                </div>
                <div class="card-header border-bottom-0 show-transaction-card-header">
                    <b class="text-sm font-weight-600">{{ trans('items.sales_price') }}</b> <a class="float-right text-xs">@money($item->sale_price, setting('default.currency'), true)</a>
                </div>
                <div class="card-footer show-transaction-card-footer">
                    <b class="text-sm font-weight-600">{{ trans('items.purchase_price') }}</b> <a class="float-right text-xs">@money($item->purchase_price, setting('default.currency'), true)</a>
                </div>
                @if ($item->inventory()->sum('opening_stock'))
                    <div class="card-footer border-bottom-0 show-transaction-card-header">
                        <b class="text-sm font-weight-600">{{ trans('inventory::items.opening_stock') }}</b> <a class="float-right text-xs">{{ $item->inventory()->sum('opening_stock') }}</a>
                    </div>
                @endif
                @if ($item->inventory()->sum('opening_stock_value'))
                    <div class="card-footer show-transaction-card-footer">
                        <b class="text-sm font-weight-600">{{ trans('inventory::items.opening_stock_value') }}</b> <a class="float-right text-xs">{{ $item->inventory()->sum('opening_stock_value') }}</a>
                    </div>
                @endif
                    <div class="card-footer show-transaction-card-footer">
                        <b class="text-sm font-weight-600">{{ trans_choice('general.categories', 1) }}</b> <a class="float-right text-xs">{{ $item->category->name }}</a>
                    </div>
                @if ($item->tax)
                    <div class="card-footer show-transaction-card-footer">
                        <b class="text-sm font-weight-600">{{ trans_choice('general.taxes', 1) }}</b> <a class="float-right text-xs">{{ $item->tax->name }}</a>
                    </div>
                @endif
                <div class="card-footer show-transaction-card-footer">
                    <b class="text-sm font-weight-600">{{ trans_choice('general.statuses', 1) }}</b>
                    <a class="float-right text-xs">
                        @if ($item->enabled)
                            <span class="label label-success">{{ trans('general.enabled') }}</span>
                        @else
                            <span class="label label-danger">{{ trans('general.disabled') }}</span>
                        @endif
                    </a>
                </div>
            </div>

            <div>
                <a href="{{ route('inventory.items.edit', $item->id) }}" class="btn btn-primary btn-block"><b>{{ trans('general.edit') }}</b></a>
            </div>
        </div>

        <div class="col-md-9">
            <div class="row d-none">
                <div class="col-md-4 col-sm-8 col-xs-12">
                    <div class="info-card">
                        <span class="info-card-icon bg-green"><i class="fa fa-money"></i></span>

                        <div class="info-card-content">
                            <span class="info-card-text">{{ trans('general.paid') }}</span>
                            <span class="info-card-number">@money($amounts['paid'], setting('default.currency'), true)</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-8 col-xs-12">
                    <div class="info-card">
                        <span class="info-card-icon bg-yellow"><i class="fa fa-paper-plane-o"></i></span>

                        <div class="info-card-content">
                            <span class="info-card-text">{{ trans('dashboard.open_invoices') }}</span>
                            <span class="info-card-number">@money($amounts['open'], setting('default.currency'), true)</span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-sm-8 col-xs-12">
                    <div class="info-card">
                        <span class="info-card-icon bg-red"><i class="fa fa-warning"></i></span>

                        <div class="info-card-content">
                            <span class="info-card-text">{{ trans('dashboard.overdue_invoices') }}</span>
                            <span class="info-card-number">@money($amounts['overdue'], setting('default.currency'), true)</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header border-bottom-0">
                            <div class="row">
                                <div class="col-12 card-header-search card-header-space">
                                    <span class="table-text hidden-lg card-header-search-text">{{ trans_choice('general.transactions',2) }}:</span>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table align-items-center table-flush" id="tbl-transactions">
                                <thead class="thead-light">
                                    <tr class="row table-head-line">
                                        <th class="col-md-7">{{ trans_choice('inventory::general.warehouses', 1) }}</th>
                                        <th class="col-md-3">{{ trans('invoices.quantity') }}</th>
                                        <th class="col-md-2">{{ trans('general.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($item_histories as $item)
                                        <tr class="row align-items-center border-top-1">
                                            <td class="col-md-7">
                                                <a href="{{ route('inventory.warehouses.show', [$item->warehouse_id]) }}">{{ $item->warehouse->name }}</a>
                                            </td>
                                            <td class="col-md-3">
                                                {{ $item->quantity }}
                                            </td>
                                            <td class="col-md-2">
                                                <a href="{{ url($item->action_url) }}">{{ $item->action_text }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts_start')
    <script src="{{ asset('modules/Inventory/Resources/assets/js/items.min.js?v=' . module_version('inventory')) }}"></script>
@endpush
