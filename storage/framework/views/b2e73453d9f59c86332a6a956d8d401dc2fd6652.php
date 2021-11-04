<?php echo $__env->yieldPushContent('pagination_start'); ?>
    <?php if($items->firstItem()): ?>
        <div class="col-xs-12 col-sm-5 d-flex align-items-center">
            <?php echo Form::select('limit', $limits, request('limit', setting('default.list_limit', '25')), ['class' => 'form-control form-control-sm d-inline-block w-auto d-none d-md-block', '@change' => 'onChangePaginationLimit($event)']); ?>

            <span class="table-text d-none d-lg-block ml-2">
                <?php echo e(trans('pagination.page')); ?>

                <?php echo e(trans('pagination.showing', ['first' => $items->firstItem(), 'last' => $items->lastItem(), 'total' => $items->total()])); ?>

            </span>
        </div>

        <div class="col-xs-12 col-sm-7 pagination-xs">
            <nav class="float-right">
                <?php echo $items->withPath(request()->url())->withQueryString()->links(); ?>

            </nav>
        </div>
    <?php else: ?>
        <div class="col-xs-12 col-sm-12" id="datatable-basic_info" role="status" aria-live="polite">
            <small><?php echo e(trans('general.no_records')); ?></small>
        </div>
    <?php endif; ?>
<?php echo $__env->yieldPushContent('pagination_end'); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/admin/pagination.blade.php ENDPATH**/ ?>