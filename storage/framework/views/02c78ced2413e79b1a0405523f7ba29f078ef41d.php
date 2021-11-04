<akaunting-item-button
    placeholder="<?php echo e(trans('general.placeholder.item_search')); ?>"
    no-data-text="<?php echo e(trans('general.no_data')); ?>"
    no-matching-data-text="<?php echo e(trans('general.no_matching_data')); ?>"
    type="<?php echo e($type); ?>"
    price="<?php echo e($price); ?>"
    :dynamic-currency="currency"
    :items="<?php echo e(json_encode($items)); ?>"
    :search-char-limit="<?php echo e($searchCharLimit); ?>"
    @item="onSelectedItem($event)"
    add-item-text="<?php echo e(trans('general.form.add_an', ['field' => trans_choice('general.items', 1)])); ?>"
    create-new-item-text="<?php echo e(trans('general.title.create', ['type' =>  trans_choice('general.items', 1)])); ?>"
></akaunting-item-button>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/select-item-button.blade.php ENDPATH**/ ?>