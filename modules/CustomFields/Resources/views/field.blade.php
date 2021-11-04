@switch($input_type)
    @case('textGroup')
    @case('dateGroup')
    @case('dateTimeGroup')
    @case('timeGroup')
        {{ Form::$input_type($field->code, ucwords($field->name), $field->icon, $input_attributes, $input_values, $input_col) }}
        @break

    @case('selectGroup')
        {{ Form::$input_type($field->code, ucwords($field->name), $field->icon, $input_options, $input_values, $input_attributes, $input_col) }}
        @break
    
    @case('radioGroup')
        {{ Form::$input_type($field->code, ucwords($field->name), $input_values, trans('general.yes'), trans('general.no'), $input_attributes, $input_col) }}
        @break
    
    @case('checkboxGroup')
        {{ Form::$input_type($field->code, ucwords($field->name), $input_options, 'value', 'id', $input_values, $input_attributes, $input_col) }}
        @break
    
    @case('textareaGroup')
        {{ Form::$input_type($field->code, ucwords($field->name), $field->icon, $input_values, $input_attributes, $input_col) }}
        @break

    @default
        @break
@endswitch
