<akaunting-edit-item-columns
    type="<?php echo e($type); ?>"
    :edit-column="<?php echo e(json_encode([
        'status' => true,
        'text' => trans('documents.edit_columns'),
        'new_text' => trans('modules.new'),
        'buttons' => [
            'cancel' => [
                'text' => trans('general.cancel'),
                'class' => 'btn-outline-secondary'
            ],
            'confirm' => [
                'text' => trans('general.save'),
                'class' => 'btn-success'
            ]
        ]
    ])); ?>"
></akaunting-edit-item-columns><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/edit-item-columns.blade.php ENDPATH**/ ?>