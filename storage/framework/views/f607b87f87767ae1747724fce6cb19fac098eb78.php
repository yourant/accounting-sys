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

        <?php
            $vue_key = '@input';
            $vue_value = !empty($attributes['v-model']) ? $attributes['v-model'] . ' = $event.target.value' : (!empty($attributes['data-field']) ? 'form.' . $attributes['data-field'] . '.'. $name . ' = $event.target.value' : 'form.' . $name . ' = $event.target.value');
        
            if (!empty($attributes['enable-v-model'])) {
                $vue_key = 'v-model';
                $vue_value = !empty($attributes['v-model']) ? $attributes['v-model'] : (!empty($attributes['data-field']) ? 'form.' . $attributes['data-field'] . '.'. $name : 'form.' . $name);
            }
        ?>

        <?php echo Form::textarea($name, $value, array_merge([
            'class' => 'form-control',
            'data-name' => $name,
            'placeholder' => trans('general.form.enter', ['field' => $text]),
            $vue_key => $vue_value,
        ], $attributes)); ?>


        <div class="invalid-feedback d-block"
            v-if="<?php echo e(isset($attributes['v-error']) ? $attributes['v-error'] : 'form.errors.has("' . $name . '")'); ?>"
            v-html="<?php echo e(isset($attributes['v-error-message']) ? $attributes['v-error-message'] : 'form.errors.get("' . $name . '")'); ?>">
        </div>
    </div>

<?php echo $__env->yieldPushContent($name . '_input_end'); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/form/textarea_group.blade.php ENDPATH**/ ?>