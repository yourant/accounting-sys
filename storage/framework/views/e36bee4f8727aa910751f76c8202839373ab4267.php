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

        <div class="tab-pane tab-example-result fade show active" role="tabpanel" aria-labelledby="-component-tab">
            <div class="btn-group btn-group-toggle radio-yes-no" data-toggle="buttons">
                <?php if(empty($attributes['disabled'])): ?>
                <label class="btn btn-success" @click="form.<?php echo e($name); ?>=1" v-bind:class="{ active: form.<?php echo e($name); ?> == 1 }">
                    <?php echo e(trans('general.yes')); ?>

                    <input type="radio" name="<?php echo e($name); ?>" id="<?php echo e($name); ?>-1" v-model="<?php echo e(!empty($attributes['v-model']) ? $attributes['v-model'] : (!empty($attributes['data-field']) ? 'form.' . $attributes['data-field'] . '.'. $name : 'form.' . $name)); ?>">
                </label>
                <?php else: ?>
                <label class="btn btn-success<?php echo e(($value) ? ' active-disabled disabled' : ' disabled'); ?>">
                    <?php echo e(trans('general.yes')); ?>

                    <input type="radio" name="<?php echo e($name); ?>" id="<?php echo e($name); ?>-1" disabled>
                </label>
                <?php endif; ?>

                <?php if(empty($attributes['disabled'])): ?>
                <label class="btn btn-danger" @click="form.<?php echo e($name); ?>=0" v-bind:class="{ active: form.<?php echo e($name); ?> == 0 }">
                    <?php echo e(trans('general.no')); ?>

                    <input type="radio" name="<?php echo e($name); ?>" id="<?php echo e($name); ?>-0" v-model="<?php echo e(!empty($attributes['v-model']) ? $attributes['v-model'] : (!empty($attributes['data-field']) ? 'form.' . $attributes['data-field'] . '.'. $name : 'form.' . $name)); ?>">
                </label>
                <?php else: ?>
                <label class="btn btn-danger<?php echo e(($value) ? ' disabled' : ' active-disabled disabled'); ?>">
                    <?php echo e(trans('general.no')); ?>

                    <input type="radio" name="<?php echo e($name); ?>" id="<?php echo e($name); ?>-0" disabled>
                </label>
                <?php endif; ?>
            </div>

            <input type="hidden" name="<?php echo e($name); ?>" value="<?php echo e(($value) ? 1 : 0); ?>" />
        </div>

        <div class="invalid-feedback d-block"
            v-if="<?php echo e(isset($attributes['v-error']) ? $attributes['v-error'] : 'form.errors.has("' . $name . '")'); ?>"
            v-html="<?php echo e(isset($attributes['v-error-message']) ? $attributes['v-error-message'] : 'form.errors.get("' . $name . '")'); ?>">
        </div>
    </div>

<?php echo $__env->yieldPushContent($name . '_input_end'); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/form/radio_group.blade.php ENDPATH**/ ?>