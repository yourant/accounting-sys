<?php echo $__env->yieldPushContent($name . '_input_start'); ?>

    <div
        class="form-group <?php echo e($col); ?><?php echo e(isset($attributes['required']) ? ' required' : ''); ?><?php echo e(isset($attributes['readonly']) ? ' readonly' : ''); ?><?php echo e(isset($attributes['disabled']) ? ' disabled' : ''); ?>"
        :class="[{'has-error': <?php echo e(isset($attributes['v-error']) ? $attributes['v-error'] : 'form.errors.get("' . $name . '")'); ?> }]"
        <?php if(isset($attributes['show'])): ?>
        v-if="<?php echo e($attributes['show']); ?>"
        <?php endif; ?>
        >
        <?php if(!empty($text)): ?>
            <?php echo Form::label($name, $text, ['class' => 'form-control-label']); ?>

        <?php endif; ?>

        <div class="input-group input-group-merge <?php echo e($group_class); ?>">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <i class="fa fa-<?php echo e($icon); ?>"></i>
                </span>
            </div>

            <?php echo Form::email($name, $value, array_merge([
                'class' => 'form-control',
                'data-name' => $name,
                'data-value' => $value,
                'placeholder' => trans('general.form.enter', ['field' => $text]),
                'v-model' => !empty($attributes['v-model']) ? $attributes['v-model'] : (!empty($attributes['data-field']) ? 'form.' . $attributes['data-field'] . '.'. $name : 'form.' . $name),
            ], $attributes)); ?>

        </div>

        <div class="invalid-feedback d-block"
            v-if="<?php echo e(isset($attributes['v-error']) ? $attributes['v-error'] : 'form.errors.has("' . $name . '")'); ?>"
            v-html="<?php echo e(isset($attributes['v-error-message']) ? $attributes['v-error-message'] : 'form.errors.get("' . $name . '")'); ?>">
        </div>
    </div>

<?php echo $__env->yieldPushContent($name . '_input_end'); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/form/email_group.blade.php ENDPATH**/ ?>