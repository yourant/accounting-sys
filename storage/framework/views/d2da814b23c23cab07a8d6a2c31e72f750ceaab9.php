<?php echo $__env->yieldPushContent('save_buttons_start'); ?>
    <?php
        if (\Str::contains($cancel, ['.']) || $cancel == 'dashboard') {
            $url = route($cancel);
        } else {
            $url = url($cancel);
        }
    ?>

    <div class="<?php echo e($col); ?>">
        <a href="<?php echo e($url); ?>" class="btn btn-outline-secondary"><?php echo e(trans('general.cancel')); ?></a>

        <?php echo Form::button(
        '<span v-if="form.loading" class="btn-inner--icon"><i class="aka-loader"></i></span> <span :class="[{\'ml-0\': form.loading}]" class="btn-inner--text">' . trans('general.save') . '</span>',
        [':disabled' => 'form.loading', 'type' => 'submit', 'class' => 'btn btn-icon btn-success']); ?>

    </div>

<?php echo $__env->yieldPushContent('save_buttons_end'); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/form/save_buttons.blade.php ENDPATH**/ ?>