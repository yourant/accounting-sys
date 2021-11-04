@extends('layouts.admin')

@section('title', trans_choice('general.settings', 2))

@section('content')
    <div class="card">
        {!! Form::open([
            'id' => 'setting',
            'method' => 'POST',
            'route' => 'inventory.settings.update',
            '@submit.prevent' => 'onSubmit',
            '@keydown' => 'form.errors.clear($event.target.name)',
            'files' => true,
            'role' => 'form',
            'class' => 'form-loading-button',
            'novalidate' => true
        ]) !!}
            <div class="card-header">
                <h3 class="mb-0">{{ trans_choice('inventory::general.warehouses', 1) }}</h3>
            </div>

            <div class="card-body">
                <div class="row">
                    {{ Form::selectGroup('default_warehouse', trans('inventory::warehouses.default'), 'building', $warehouses, old('default_warehouse', setting('inventory.default_warehouse'))) }}

                    {{ Form::radioGroup('negatif_stock', trans('inventory::general.negatif_stock'), old('negatif_stock', setting('inventory.negatif_stock'), false)) }}

                    {{ Form::radioGroup('track_inventory', trans('inventory::general.track_inventory'), old('track_inventory', setting('inventory.track_inventory'), false)) }}
                </div>
            </div>

            <div class="card-footer">
                <div class="row float-right">
                    {{ Form::saveButtons('inventory.settings.edit') }}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection

@push('scripts_start')
    <script src="{{ asset('modules/Inventory/Resources/assets/js/settings.min.js?v=' . module_version('inventory')) }}"></script>
@endpush
