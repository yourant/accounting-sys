<div class="position-relative js-search-box-hidden" style="height: 48.5px;">
    <div class="border-bottom-0 w-100 position-absolute left-0 right-0" style="z-index: 9;">
        <input type="text" placeholder="Search or filter results..." class="form-control" />
    </div>
</div>

<akaunting-search
    placeholder="<?php echo e((!empty($filters)) ? trans('general.placeholder.search_and_filter') : trans('general.search_placeholder')); ?>"
    search-text="<?php echo e(trans('general.search_text')); ?>"
    operator-is-text="<?php echo e(trans('general.is')); ?>"
    operator-is-not-text="<?php echo e(trans('general.isnot')); ?>" 
    no-data-text="<?php echo e(trans('general.no_data')); ?>"
    no-matching-data-text="<?php echo e(trans('general.no_matching_data')); ?>"
    value="<?php echo e(request()->get('search', null)); ?>"
    :filters="<?php echo e(json_encode($filters)); ?>"
    <?php if($filtered): ?>
    :default-filtered="<?php echo e(json_encode($filtered)); ?>"
    <?php endif; ?>
    :date-config="{
        allowInput: true,
        altInput: true,
        altFormat: '<?php echo e(company_date_format()); ?>',
        dateFormat: '<?php echo e(company_date_format()); ?>',
        <?php if(!empty($attributes['min-date'])): ?>
        minDate: <?php echo e($attributes['min-date']); ?>

        <?php endif; ?>
        <?php if(!empty($attributes['max-date'])): ?>
        maxDate: <?php echo e($attributes['max-date']); ?>

        <?php endif; ?>
    }"
></akaunting-search>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/search-string.blade.php ENDPATH**/ ?>