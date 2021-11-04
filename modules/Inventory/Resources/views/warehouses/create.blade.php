@extends('layouts.admin')

@section('title', trans('general.title.new', ['type' => trans_choice('inventory::general.warehouses', 1)]))

@section('content')
    <div class="card">
        {!! Form::open([
            'route' => 'inventory.warehouses.store',
            'id' => 'warehouse',
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

                    {{ Form::radioGroup('default_warehouse', trans('inventory::general.default_warehouse'), false) }}

                    {{ Form::radioGroup('enabled', trans('general.enabled'), true) }}

                </div>
            </div>

            <div class="card-footer">
                <div class="row save-buttons">
                    {{ Form::saveButtons('inventory.warehouses.index') }}
                </div>
            </div>
        {!! Form::close() !!}
    </div>
@endsection

@push('scripts_start')
    <script src="{{ asset('modules/Inventory/Resources/assets/js/warehouses.min.js?v=' . module_version('inventory')) }}"></script>
@endpush
