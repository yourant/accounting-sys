<?php switch($input_type):
    case ('textGroup'): ?>
    <?php case ('dateGroup'): ?>
    <?php case ('dateTimeGroup'): ?>
    <?php case ('timeGroup'): ?>
        <?php echo e(Form::$input_type($field->code, ucwords($field->name), $field->icon, $input_attributes, $input_values, $input_col)); ?>

        <?php break; ?>

    <?php case ('selectGroup'): ?>
        <?php echo e(Form::$input_type($field->code, ucwords($field->name), $field->icon, $input_options, $input_values, $input_attributes, $input_col)); ?>

        <?php break; ?>
    
    <?php case ('radioGroup'): ?>
        <?php echo e(Form::$input_type($field->code, ucwords($field->name), $input_values, trans('general.yes'), trans('general.no'), $input_attributes, $input_col)); ?>

        <?php break; ?>
    
    <?php case ('checkboxGroup'): ?>
        <?php echo e(Form::$input_type($field->code, ucwords($field->name), $input_options, 'value', 'id', $input_values, $input_attributes, $input_col)); ?>

        <?php break; ?>
    
    <?php case ('textareaGroup'): ?>
        <?php echo e(Form::$input_type($field->code, ucwords($field->name), $field->icon, $input_values, $input_attributes, $input_col)); ?>

        <?php break; ?>

    <?php default: ?>
        <?php break; ?>
<?php endswitch; ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\modules\CustomFields\Providers/../Resources/views/field.blade.php ENDPATH**/ ?>