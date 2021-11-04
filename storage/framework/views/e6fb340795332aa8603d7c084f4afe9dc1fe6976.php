<div id="widget-<?php echo e($class->model->id); ?>" class="<?php echo e($class->model->settings->width); ?>">
    <div class="card">
        <?php echo $__env->make($class->views['header'], ['header_class' => 'border-bottom-0'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr class="row table-head-line">
                        <th class="col-xs-4 col-md-4 text-left"><?php echo e(trans('general.date')); ?></th>
                        <th class="col-xs-4 col-md-4 text-left"><?php echo e(trans_choice('general.categories', 1)); ?></th>
                        <th class="col-xs-4 col-md-4 text-right"><?php echo e(trans('general.amount')); ?></th>
                    </tr>
                </thead>

                <tbody>
                    <?php if($transactions->count()): ?>
                        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="row border-top-1 tr-py">
                                <td class="col-xs-4 col-md-4 text-left"><?php echo company_date($item->paid_at); ?></td>
                                <td class="col-xs-4 col-md-4 text-left long-texts" title="<?php echo e($item->category->name); ?>"><?php echo e($item->category->name); ?></td>
                                <td class="col-xs-4 col-md-4 text-right"><?php echo money($item->amount, $item->currency_code, true); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr class="border-top-1">
                            <td colspan="3">
                                <div class="text-muted nr-py" id="datatable-basic_info" role="status" aria-live="polite">
                                    <?php echo e(trans('general.no_records')); ?>

                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/widgets/latest_income.blade.php ENDPATH**/ ?>