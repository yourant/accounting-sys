<?php echo $__env->yieldPushContent($name . '_input_start'); ?>

    <akaunting-select-remote
        class="<?php echo e($col); ?><?php echo e(isset($attributes['required']) ? ' required' : ''); ?><?php echo e(isset($attributes['disabled']) ? ' disabled' : ''); ?>"

        id="form-select-<?php echo e($name); ?>"

        <?php if(!empty($attributes['v-error'])): ?>
        :form-classes="[{'has-error': <?php echo e($attributes['v-error']); ?> }]"
        <?php else: ?>
        :form-classes="[{'has-error': form.errors.get('<?php echo e($name); ?>') }]"
        <?php endif; ?>

        icon="<?php echo e($icon); ?>"
        title="<?php echo e($text); ?>"
        placeholder="<?php echo e(trans('general.form.select.field', ['field' => $text])); ?>"
        name="<?php echo e($name); ?>"
        :options="<?php echo e(json_encode($values)); ?>"

        <?php if(isset($attributes['disabledOptions'])): ?>
        :disabled-options="<?php echo e(json_encode($attributes['disabledOptions'])); ?>"
        <?php endif; ?>

        <?php if(isset($attributes['dynamicOptions'])): ?>
        :dynamic-options="<?php echo e($attributes['dynamicOptions']); ?>"
        <?php endif; ?>

        <?php if(!empty($selected) || old($name)): ?>
        :value="<?php echo e(json_encode(old($name, $selected))); ?>"
        <?php endif; ?>

        <?php if(!empty($attributes['model'])): ?>
        :model="<?php echo e($attributes['model']); ?>"
        <?php endif; ?>

        :multiple="true"

        <?php if(!empty($attributes['collapse'])): ?>
        :collapse="true"
        <?php endif; ?>

        <?php if(!empty($attributes['v-model'])): ?>
        @interface="form.errors.clear('<?php echo e($attributes['v-model']); ?>'); <?php echo e($attributes['v-model'] . ' = $event'); ?>"
        <?php elseif(!empty($attributes['data-field'])): ?>
        @interface="form.errors.clear('<?php echo e('form.' . $attributes['data-field'] . '.' . $name); ?>'); <?php echo e('form.' . $attributes['data-field'] . '.' . $name . ' = $event'); ?>"
        <?php else: ?>
        @interface="form.errors.clear('<?php echo e($name); ?>'); form.<?php echo e($name); ?> = $event"
        <?php endif; ?>

        <?php if(!empty($attributes['change'])): ?>
        @change="<?php echo e($attributes['change']); ?>($event)"
        <?php endif; ?>

        <?php if(!empty($attributes['visible-change'])): ?>
        @visible-change="<?php echo e($attributes['visible-change']); ?>"
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

        remote-action="<?php echo e($attributes['remote_action']); ?>"

        <?php if(!empty($attributes['currecny_code'])): ?>
        currency-code="<?php echo e($attributes['currecny_code']); ?>"
        <?php endif; ?>

        loading-text="<?php echo e(trans('general.loading')); ?>"
        no-data-text="<?php echo e(trans('general.no_data')); ?>"
        no-matching-data-text="<?php echo e(trans('general.no_matching_data')); ?>"
    ></akaunting-select-remote>

<?php echo $__env->yieldPushContent($name . '_input_end'); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/form/multi_select_remote_group.blade.php ENDPATH**/ ?>