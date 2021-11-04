<div id="widget-<?php echo e($class->model->id); ?>" class="<?php echo e($class->model->settings->width); ?>">
    <div class="card">
        <?php echo $__env->make($class->views['header'], ['header_class' => 'border-bottom-0'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="table-responsive">
            <table class="table align-items-center table-flush">
                <thead class="thead-light">
                    <tr class="row table-head-line">
                        <th class="col-xs-6 col-md-6 text-left"><?php echo e(trans('general.name')); ?></th>
                        <th class="col-xs-6 col-md-6 text-right"><?php echo e(trans('general.balance')); ?></th>
                    </tr>
                </thead>
                <tbody class="thead-light">
                    <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="row border-top-1 tr-py">
                            <td class="col-xs-6 col-md-6 text-left long-texts"><?php echo e($item->name); ?></td>
                            <td class="col-xs-6 col-md-6 text-right"><?php echo money($item->balance, $item->currency_code, true); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/widgets/account_balance.blade.php ENDPATH**/ ?>