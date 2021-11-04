<?php echo $__env->yieldPushContent($name . '_input_start'); ?>

    <akaunting-date
        class="<?php echo e($col); ?><?php echo e(isset($attributes['required']) ? ' required' : ''); ?>"

        <?php if(!empty($attributes['v-error'])): ?>
        :form-classes="[{'has-error': <?php echo e($attributes['v-error']); ?> }]"
        <?php else: ?>
        :form-classes="[{'has-error': form.errors.get('<?php echo e($name); ?>') }]"
        <?php endif; ?>
        :group_class="'<?php echo e($group_class); ?>'"

        icon="fa fa-<?php echo e($icon); ?>"
        title="<?php echo e($text); ?>"
        placeholder="<?php echo e(trans('general.form.select.field', ['field' => $text])); ?>"
        name="<?php echo e($name); ?>"

        <?php if(isset($value) || old($name)): ?>
        value="<?php echo e(old($name, $value)); ?>"
        <?php endif; ?>

        <?php if(!empty($attributes['model'])): ?>
        :model="<?php echo e($attributes['model']); ?>"
        <?php endif; ?>

        :date-config="{
            wrap: true, // set wrap to true only when using 'input-group'
            allowInput: false,
            <?php if(!empty($attributes['show-date-format'])): ?>
            altInput: true,
            altFormat: '<?php echo e($attributes['show-date-format']); ?>',
            <?php endif; ?>
            <?php if(!empty($attributes['date-format'])): ?>
            dateFormat: '<?php echo e($attributes['date-format']); ?>',
            <?php endif; ?>
            <?php if(!empty($attributes['min-date'])): ?>
            minDate: <?php echo e($attributes['min-date']); ?>,
            <?php endif; ?>
            <?php if(!empty($attributes['max-date'])): ?>
            maxDate: <?php echo e($attributes['max-date']); ?>,
            <?php endif; ?>
        }"

        locale="<?php echo e(language()->getShortCode()); ?>"

        <?php if(isset($attributes['period'])): ?>
        period="<?php echo e($attributes['period']); ?>"
        <?php endif; ?>

        <?php if(!empty($attributes['v-model'])): ?>
        @interface="form.errors.clear('<?php echo e($attributes['v-model']); ?>'); <?php echo e($attributes['v-model'] . ' = $event'); ?>"
        <?php elseif(!empty($attributes['data-field'])): ?>
        @interface="form.errors.clear('<?php echo e('form.' . $attributes['data-field'] . '.' . $name); ?>'); <?php echo e('form.' . $attributes['data-field'] . '.' . $name . ' = $event'); ?>"
        <?php else: ?>
        @interface="form.errors.clear('<?php echo e($name); ?>'); form.<?php echo e($name); ?> = $event"
        <?php endif; ?>

        <?php if(!empty($attributes['hidden_year'])): ?>
        hidden-year
        <?php endif; ?>

        <?php if(!empty($attributes['min-date-dynamic'])): ?>
        :data-value-min="<?php echo e($attributes['min-date-dynamic']); ?>"
        <?php endif; ?>

        <?php if(!empty($attributes['change'])): ?>
        @change="<?php echo e($attributes['change']); ?>"
        <?php endif; ?>

        <?php if(isset($attributes['required'])): ?>
        :required="<?php echo e(($attributes['required']) ? 'true' : 'false'); ?>"
        <?php endif; ?>

        <?php if(isset($attributes['readonly'])): ?>
        :readonly="<?php echo e($attributes['readonly']); ?>"
        <?php endif; ?>

        <?php if(isset($attributes['disabled'])): ?>
        :disabled="<?php echo e($attributes['disabled']); ?>"
        <?php endif; ?>

        <?php if(isset($attributes['show'])): ?>
        v-if="<?php echo e($attributes['show']); ?>"
        <?php endif; ?>

        <?php if(isset($attributes['v-error-message'])): ?>
        :form-error="<?php echo e($attributes['v-error-message']); ?>"
        <?php else: ?>
        :form-error="form.errors.get('<?php echo e($name); ?>')"
        <?php endif; ?>
    ></akaunting-date>

<?php echo $__env->yieldPushContent($name . '_input_end'); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/form/date_group.blade.php ENDPATH**/ ?>