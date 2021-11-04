<?php
    if (($page == 'create') || !$model->recurring()->count()) {
        $frequency = old('recurring_frequency', 'no');
        $interval = old('recurring_interval', 1);
        $custom_frequency = old('recurring_custom_frequency', 'monthly');
        $count = old('recurring_count', 0);
    } else {
        $r = $model->recurring;

        $frequency = old('recurring_frequency', ($r->interval != 1) ? 'custom' : $r->frequency);
        $interval = old('recurring_interval', $r->interval);
        $custom_frequency = old('recurring_custom_frequency', $r->frequency);
        $count = old('recurring_count', $r->count);
    }
?>

<akaunting-recurring
    :form-classes="[{'has-error': form.errors.get('recurring_frequency')}, '<?php echo e($col); ?>']"
    title="<?php echo e(trans('recurring.recurring')); ?>"
    placeholder="<?php echo e(trans('general.form.select.field', ['field' => trans('recurring.recurring')])); ?>"

    :frequency-options="<?php echo e(json_encode($recurring_frequencies)); ?>"
    :frequency-value="'<?php echo e($frequency); ?>'"
    :frequency-error="form.errors.get('recurring_frequency')"

    :interval-value="'<?php echo e($interval); ?>'"
    :interval-error="form.errors.get('recurring_interval')"

    :custom-frequency-options="<?php echo e(json_encode($recurring_custom_frequencies)); ?>"
    :custom-frequency-value="'<?php echo e($custom_frequency); ?>'"
    :custom-frequency-error="form.errors.get('custom_frequency')"

    :count-value="'<?php echo e($count); ?>'"
    :count-error="form.errors.get('recurring_count')"

    @recurring_frequency="form.recurring_frequency = $event"
    @recurring_interval="form.recurring_interval = $event"
    @recurring_custom_frequency="form.recurring_custom_frequency = $event"
    @recurring_count="form.recurring_count = $event"
>
</akaunting-recurring>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/form/recurring.blade.php ENDPATH**/ ?>