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

        <akaunting-html-editor
            name="<?php echo e($name); ?>"

            <?php if(!empty($value)): ?>
            :value="`<?php echo e($value); ?>`"
            <?php else: ?>
            :value="''"
            <?php endif; ?>

            <?php if(!empty($attributes['v-model'])): ?>
            @input="<?php echo e($attributes['v-model'] . ' = $event'); ?>"
            <?php elseif(!empty($attributes['data-field'])): ?>
            @input="<?php echo e('form.' . $attributes['data-field'] . '.' . $name . ' = $event'); ?>"
            <?php else: ?>
            @input="form.<?php echo e($name); ?> = $event"
            <?php endif; ?>

            <?php if(isset($attributes['disabled'])): ?>
            :disabled="<?php echo e($attributes['disabled']); ?>"
            <?php endif; ?>

            <?php if(isset($attributes['readonly'])): ?>
            :readonly="<?php echo e($attributes['readonly']); ?>"
            <?php endif; ?>
        ></akaunting-html-editor>

        <div class="invalid-feedback d-block"
            v-if="<?php echo e(isset($attributes['v-error']) ? $attributes['v-error'] : 'form.errors.has("' . $name . '")'); ?>"
            v-html="<?php echo e(isset($attributes['v-error-message']) ? $attributes['v-error-message'] : 'form.errors.get("' . $name . '")'); ?>">
        </div>
    </div>

<?php echo $__env->yieldPushContent($name . '_input_end'); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/form/text_editor_group.blade.php ENDPATH**/ ?>