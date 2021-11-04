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

        <div class="row">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php 
                $item_attributes = $attributes;

                if (!empty($attributes[':id'])) {
                    $item_attributes[':id'] = str_replace(':item_id', $item->$id, $attributes[':id']);
                }
            ?>
                <div class="col-md-3">
                    <div class="custom-control custom-checkbox">
                        <?php echo e(Form::checkbox($name, $item->$id, (is_array($selected) && count($selected) ? (in_array($item->$id, $selected) ? true : false) : null), array_merge([
                            'id' => 'checkbox-' . $name . '-' . $item->$id,
                            'class' => 'custom-control-input',
                            'data-type' => (is_array($selected)) ? 'multiple' : 'single',
                            'v-model' => !empty($attributes['v-model']) ? $attributes['v-model'] : (!empty($attributes['data-field']) ? 'form.' . $attributes['data-field'] . '.'. $name : 'form.' . $name),
                        ], $item_attributes))); ?>


                        <label class="custom-control-label" :for="<?php echo e(!empty($item_attributes[':id']) ? $item_attributes[':id'] : '"checkbox-' . $name . '-' . $item->$id . '"'); ?>">
                            <?php echo e($item->$value); ?>

                        </label>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="invalid-feedback d-block"
            v-if="<?php echo e(isset($attributes['v-error']) ? $attributes['v-error'] : 'form.errors.has("' . $name . '")'); ?>"
            v-html="<?php echo e(isset($attributes['v-error-message']) ? $attributes['v-error-message'] : 'form.errors.get("' . $name . '")'); ?>">
        </div>
    </div>

<?php echo $__env->yieldPushContent($name . '_input_end'); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/form/checkbox_group.blade.php ENDPATH**/ ?>