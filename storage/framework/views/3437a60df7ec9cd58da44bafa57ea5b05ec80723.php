<?php echo $__env->yieldPushContent($name . '_input_start'); ?>

    <label class="custom-toggle d-inline-block">
        <input type="checkbox"
            name="status[<?php echo e($id); ?>]"
            @input="bulk_action.path='<?php echo e(request()->path()); ?>'; onStatus(<?php echo e($id); ?>, $event)"
                <?php echo e(($value) ? 'checked' :''); ?>>

        <span class="custom-toggle-slider rounded-circle status-green"
            data-label-off="<?php echo e(trans('general.no')); ?>"
            data-label-on="<?php echo e(trans('general.yes')); ?>">
        </span>
    </label>

<?php echo $__env->yieldPushContent($name . '_input_end'); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/form/enabled_group.blade.php ENDPATH**/ ?>