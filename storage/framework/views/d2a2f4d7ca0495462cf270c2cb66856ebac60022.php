<?php echo $__env->yieldPushContent($name . '_input_start'); ?>

    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="bulk-action-<?php echo e($id); ?>"
            <?php if(isset($attributes['disabled'])): ?>
            :disabled="<?php echo e(($attributes['disabled']) ? true : false); ?>"
            <?php else: ?>
            data-bulk-action="<?php echo e($id); ?>"
            <?php endif; ?>
            :value="<?php echo e($id); ?>"
            v-model="<?php echo e(!empty($attributes['v-model']) ? $attributes['v-model'] : 'bulk_action.selected'); ?>"
            v-on:change="onSelect">
        <label class="custom-control-label" for="bulk-action-<?php echo e($id); ?>"></label>
    </div>

<?php echo $__env->yieldPushContent($name . '_input_end'); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/form/bulk_action_group.blade.php ENDPATH**/ ?>