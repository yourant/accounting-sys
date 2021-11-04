<?php echo $__env->yieldPushContent($name . '_input_start'); ?>

    <akaunting-money :col="'<?php echo e($col); ?>'"
        <?php if(!empty($attributes['v-error'])): ?>
        :form-classes="[{'has-error': <?php echo e($attributes['v-error']); ?> }]"
        <?php else: ?>
        :form-classes="[{'has-error': form.errors.has('<?php echo e($name); ?>') }]"
        <?php endif; ?>

        <?php if(!empty($attributes['money-class'])): ?>
        money-class="<?php echo e($attributes['money-class']); ?>"
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

        <?php if(isset($attributes['masked'])): ?>
        :masked="<?php echo e(($attributes['masked']) ? 'true' : 'false'); ?>"
        <?php endif; ?>

        :error="<?php echo e(isset($attributes['v-error']) ? $attributes['v-error'] : 'form.errors.get("' . $name . '")'); ?>"
        name="<?php echo e($name); ?>"
        title="<?php echo e($text); ?>"
        :group_class="'<?php echo e($group_class); ?>'"
        icon="<?php echo e($icon); ?>"
        :currency="<?php echo e(json_encode($attributes['currency'])); ?>"
        :value="<?php echo e($value); ?>"

        <?php if(!empty($attributes['dynamic-currency'])): ?>
        :dynamic-currency="<?php echo e($attributes['dynamic-currency']); ?>"
        <?php else: ?>
        :dynamic-currency="currency"
        <?php endif; ?>

        <?php if(!empty($attributes['v-model'])): ?>
        v-model="<?php echo e($attributes['v-model']); ?>"
        <?php endif; ?>

        <?php if(!empty($attributes['change'])): ?>
        @change="<?php echo e($attributes['change']); ?>($event)"
        <?php endif; ?>

        <?php if(!empty($attributes['input'])): ?>
        @input="<?php echo e($attributes['input']); ?>"
        <?php endif; ?>

        <?php if(!empty($attributes['v-model'])): ?>
        @interface="form.errors.clear('<?php echo e($attributes['v-model']); ?>'); <?php echo e($attributes['v-model'] . ' = $event'); ?>"
        <?php elseif(!empty($attributes['data-field'])): ?>
        @interface="form.errors.clear('<?php echo e('form.' . $attributes['data-field'] . '.' . $name); ?>'); <?php echo e('form.' . $attributes['data-field'] . '.' . $name . ' = $event'); ?>"
        <?php else: ?>
        @interface="form.errors.clear('<?php echo e($name); ?>'); form.<?php echo e($name); ?> = $event"
        <?php endif; ?>

        <?php if(isset($attributes['v-error-message'])): ?>
        :form-error="<?php echo e($attributes['v-error-message']); ?>"
        <?php else: ?>
        :form-error="form.errors.get('<?php echo e($name); ?>')"
        <?php endif; ?>

        <?php if(isset($attributes['row-input'])): ?>
        :row-input="<?php echo e($attributes['row-input']); ?>"
        <?php endif; ?>
    ></akaunting-money>

<?php echo $__env->yieldPushContent($name . '_input_end'); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/form/money_group.blade.php ENDPATH**/ ?>