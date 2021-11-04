@extends('layouts.admin')

@section('title', trans('general.title.edit', ['type' => trans_choice('inventory::general.warehouses', 1)]))

@section('content')
    <div class="card">
        {!! Form::model($warehouse, [
            'id' => 'warehouse',
            'method' => 'PATCH',
            'route' => ['inventory.warehouses.update', $warehouse->id],
            '@submit.prevent' => 'onSubmit',
            '@keydown' => 'form.errors.clear($event.target.name)',
            'files' => true,
            'role' => 'form',
            'class' => 'form-loading-button',
            'novalidate' => true
        ]) !!}

            <div class="card-body">
                <div class="row">
                    {{ Form::textGroup('name', trans('general.name'), 'id-card') }}

                    {{ Form::textGroup('email', trans('general.email'), 'envelope', []) }}

                    {{ Form::textGroup('phone', trans('general.phone'), 'phone', []) }}

                    {{ Form::textareaGroup('address', trans('general.address')) }}

                    {{ Form::radioGroup('default_warehouse', trans('inventory::general.default_warehouse'), $warehouse->default_warehouse) }}

                    {{ Form::radioGroup('enabled', trans('general.enabled'), $warehouse->enabled) }}
                </div>
            </div>

            @permission('update-inventory-warehouses')
                <div class="card-footer">
                    <div class="row save-buttons">
                        {{ Form::saveButtons('inventory.warehouses.index') }}
                    </div>
                </div>
            @endpermission
        {!! Form::close() !!}
    </div>
@endsection

@push('scripts_start')
    <script src="{{ asset('modules/Inventory/Resources/assets/js/warehouses.min.js?v=' . module_version('inventory')) }}"></script>
@endpush
