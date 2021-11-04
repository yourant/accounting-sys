<?php echo $__env->yieldPushContent('bulk_action_all_input_start'); ?>

    <div class="custom-control custom-checkbox">
        <input class="custom-control-input" id="table-check-all" type="checkbox"
            v-model="<?php echo e(!empty($attributes['v-model']) ? $attributes['v-model'] : 'bulk_action.select_all'); ?>"
            @click="onSelectAll">
        <label class="custom-control-label" for="table-check-all"></label>
    </div>

<?php echo $__env->yieldPushContent('bulk_action_all_input_end'); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/form/bulk_action_all_group.blade.php ENDPATH**/ ?>