<akaunting-contact-card
    placeholder="<?php echo e($placeholder); ?>"
    no-data-text="<?php echo e(trans('general.no_data')); ?>"
    no-matching-data-text="<?php echo e(trans('general.no_matching_data')); ?>"
    search-route="<?php echo e($search_route); ?>"
    create-route="<?php echo e($create_route); ?>"
    :contacts="<?php echo e(json_encode($contacts)); ?>"
    :selected="<?php echo e(json_encode($contact)); ?>"
    add-contact-text="<?php echo e(is_array($textAddContact) ? trans($textAddContact[0], ['field' => trans_choice($textAddContact[1], 1)]) : trans($textAddContact)); ?>"
    create-new-contact-text="<?php echo e(is_array($textCreateNewContact) ? trans($textCreateNewContact[0], ['field' => trans_choice($textCreateNewContact[1], 1)]) : trans($textCreateNewContact)); ?>"
    edit-contact-text="<?php echo e(is_array($textEditContact) ? trans($textEditContact[0], ['field' => trans_choice($textEditContact[1], 1)]) : trans($textEditContact)); ?>"
    contact-info-text="<?php echo e(is_array($textContactInfo) ? trans($textContactInfo[0], ['field' => trans_choice($textContactInfo[1], 1)]) : trans($textContactInfo)); ?>"
    tax-number-text="<?php echo e(trans('general.tax_number')); ?>"
    choose-different-contact-text="<?php echo e(is_array($textChooseDifferentContact) ? trans($textChooseDifferentContact[0], ['field' => Str::lower(trans_choice($textChooseDifferentContact[1], 1))]) : trans($textChooseDifferentContact)); ?>"
    :add-new="<?php echo e(json_encode([
        'status' => true,
        'text' => trans('general.add_new'),
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
    :error="<?php echo e($error); ?>"

    @change="onChangeContactCard"
></akaunting-contact-card>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/select-contact-card.blade.php ENDPATH**/ ?>