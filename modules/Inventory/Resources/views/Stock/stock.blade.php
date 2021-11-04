@extends('layouts.admin')

@section('title', trans_choice('Stock', 2))

@section('new_button')
    @can('create-common-items')
        <span><a href="{{ route('inventory.items.stock_create') }}" class="btn btn-success btn-sm header-button-top">{{ trans('general.add_new') }}</a></span>
        <span><a href="{{ route('import.create', ['inventory', 'items']) }}" class="btn btn-white btn-sm header-button-top">{{ trans('import.import') }}</a></span>
    @endcan
    <span><a href="{{ route('inventory.items.export', request()->input()) }}" class="btn btn-white btn-sm header-button-top">{{ trans('general.export') }}</a></span>
@endsection

@section('content')
    @if ($items->count() || request()->get('search', false))
        <div class="card">
            <div class="card-header border-bottom-0" :class="[{'bg-gradient-primary': bulk_action.show}]">
                {!! Form::open([
                    'method' => 'GET',
                    'route' => 'items.index',
                    'role' => 'form',
                    'class' => 'mb-0'
                ]) !!}
                    <div class="align-items-center" v-if="!bulk_action.show">
                        <x-search-string model="App\Models\Common\Item" />
                    </div>

                    {{-- {{ Form::bulkActionRowGroup('general.items', $bulk_actions, ['group' => 'inventory', 'type' => 'items']) }} --}}
                {!! Form::close() !!}
            </div>

            <div class="table-responsive">
                <table class="table table-flush table-hover">
                    <thead class="thead-light">
                        <tr class="row table-head-line">
                            {{-- <th class="col-sm-2 col-md-1 col-lg-1 col-xl-1 d-none d-sm-block">{{ Form::bulkActionAllGroup() }}</th> --}}
                            <th class="col-xs-4 col-sm-5 col-md-4 col-lg-2 col-xl-2">@sortablelink('item', trans('general.name'), ['filter' => 'active, visible'])</th>
                            {{-- <th class="col-lg-2 col-xl-2 d-none d-lg-block">@sortablelink('category', trans_choice('general.categories', 1))</th> --}}
                            <th class="col-lg-2 col-xl-2 text-right d-none d-md-block">@sortablelink('Total', trans('S-Total'))</th>
                            <th class="col-md-3 col-lg-2 col-xl-2 text-right d-none d-md-block">@sortablelink('In', trans('S-In'))</th>
                            <th class="col-lg-2 col-xl-2 text-right d-none d-lg-block">@sortablelink('Out', trans('S-Out'))</th>
                            <th class="col-xs-4 col-sm-4 col-md-3 col-lg-2 col-xl-2 text-center"><a>@sortablelink('date', trans('Date'))</a></th>
                            <th class="col-xs-4 col-sm-3 col-md-2 col-lg-1 col-xl-1 text-center">@sortablelink('enabled', trans('general.enabled'))</th>
                            <th class="col-xs-3 col-sm-2 col-md-1 col-lg-1 col-xl-1 text-center"><a>{{ trans('general.actions') }}</a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                            <tr class="row align-items-center border-top-1">
                                {{-- <td class="col-sm-2 col-md-1 col-lg-1 col-xl-1 d-none d-sm-block"> --}}
                                    {{-- {{ Form::bulkActionGroup($item->id, $item->item) }} --}}
                                {{-- </td> --}}
                                <td class="col-xs-4 col-sm-5 col-md-4 col-lg-2 col-xl-2 py-2">
                                    {{ $item->item }}({{ $item->sku }})
                                </td>
                                <td class="col-lg-2 col-xl-2 text-right d-none d-md-block">
                                    @if($item->out_sale_price==NULL && $item->in_stock_price==NULL)
                                    {{ ($item->in_quantity-$item->out_quantity) }}({{ "Null" }})
                                    @else  
                                        @if(($item->in_quantity-$item->out_quantity)>0)
                                            <span style="color:green"> {{ ($item->in_quantity-$item->out_quantity) }} </span>
                                        @else
                                            <span style="color:red"> {{ ($item->in_quantity-$item->out_quantity) }} </span>
                                        @endif

                                        @if(($item->out_sale_price-$item->in_stock_price)>0)
                                            <span style="color:green"> ({{ money(($item->out_sale_price-$item->in_stock_price), setting('default.currency'), true) }}) </span>
                                        @else
                                            <span style="color:red"> ({{ money(($item->out_sale_price-$item->in_stock_price), setting('default.currency'), true) }}) </span>
                                        @endif
                                    
                                    @endif
                                </td>
                                <td class="col-md-3 col-lg-2 col-xl-2 text-right d-none d-md-block">
                                    @if($item->in_sale_price==NULL && $item->in_stock_price==NULL)
                                    {{ $item->in_quantity }}({{ "Null" }})
                                    @else
                                    {{ $item->in_quantity }}({{ money(($item->in_sale_price), setting('default.currency'), true) }}/{{ money(($item->in_stock_price), setting('default.currency'), true) }})
                                    @endif
                                </td>
                                <td class="col-lg-2 col-xl-2 text-right d-none d-lg-block">
                                    @if($item->out_sale_price==NULL)
                                    {{ $item->out_quantity }}({{ "Null" }})
                                    @else
                                    {{ $item->out_quantity }}({{ money(($item->out_sale_price), setting('default.currency'), true) }})
                                    @endif
                                </td>
                                <td class="col-xs-4 col-sm-4 col-md-3 col-lg-2 col-xl-2 text-center">
                                    {{ $item->created_at }}
                                </td>
                                <td class="col-xs-3 col-sm-2 col-md-1 col-lg-1 col-xl-1 text-center">
                                    @if (user()->can('update-common-items'))
                                        {{ Form::enabledGroup($item->id, $item->item,$item->enabled) }}
                                    @else
                                        @if ($item->enabled)
                                            <badge rounded type="success" class="mw-60">{{ trans('general.yes') }}</badge>
                                        @else
                                            <badge rounded type="danger" class="mw-60">{{ trans('general.no') }}</badge>
                                        @endif
                                    @endif
                                </td>
                                <td class="col-xs-4 col-sm-3 col-md-2 col-lg-1 col-xl-1 text-center">
                                    <div class="dropdown">
                                        <a class="btn btn-neutral btn-sm text-light items-align-center p-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h text-muted"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="{{ route('inventory.items.edit', $item->id) }}">{{ trans('general.edit') }}</a>
                                            @permission('create-common-items')
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="{{ route('items.duplicate', $item->id) }}">{{ trans('general.duplicate') }}</a>
                                            @endpermission
                                            {{-- @permission('delete-common-items')
                                                <div class="dropdown-divider"></div>
                                                {!! Form::deleteLink($item, 'inventory.items.destroy') !!}
                                            @endpermission --}}
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
                    @include('partials.admin.other_pagination', ['total' => $item_total,'fist' => $first,'limit' => $limit,'limit_pages' => $limit_pages])
                </div>
            </div>
        </div>
    @else
        @include('inventory::partials.item.empty_page', ['page' => 'items', 'docs_path' => 'items'])
    @endif
@endsection

@push('scripts_start')
    <script src="{{ asset('modules/Inventory/Resources/assets/js/items.min.js?v=' . module_version('inventory')) }}"></script>
@endpush