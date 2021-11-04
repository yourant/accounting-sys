<div id="widget-<?php echo e($class->model->id); ?>" class="<?php echo e($class->model->settings->width); ?>">
    <div class="card bg-gradient-danger card-stats">
        <?php echo $__env->make($class->views['header'], ['header_class' => 'border-bottom-0'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h5 class="text-uppercase text-white mb-0"><?php echo e($class->model->name); ?></h5>
                    <span class="font-weight-bold text-white mb-0"><?php echo e($totals['grand']); ?></span>
                </div>

                <div class="col-auto">
                    <div class="icon icon-shape bg-white text-danger rounded-circle shadow">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                </div>
            </div>

            <p class="mt-3 mb-0 text-sm cursor-default">
                <span class="text-white"><?php echo e(trans('widgets.payables')); ?></span>
                <el-tooltip
                content="<?php echo e(trans('widgets.open_bills')); ?>: <?php echo e($totals['open']); ?> / <?php echo e(trans('widgets.overdue_bills')); ?>: <?php echo e($totals['overdue']); ?>"
                effect="dark"
                :open-delay="100"
                placement="top">
                    <span class="text-white font-weight-bold float-right"><?php echo e($totals['open']); ?> / <?php echo e($totals['overdue']); ?></span>
                </el-tooltip>
            </p>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/widgets/total_expenses.blade.php ENDPATH**/ ?>