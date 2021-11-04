<div class="table-responsive">
    <table class="table table-hover align-items-center rp-border-collapse">
        <?php echo $__env->make($class->views['table.header'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <tbody>
            <?php if(!empty($class->row_values[$table])): ?>
                <?php $__currentLoopData = $class->row_values[$table]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $rows): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo $__env->make($class->views['table.rows'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                <tr>
                    <td colspan="<?php echo e(count($class->dates) + 2); ?>">
                        <div class="text-muted pl-0"><?php echo e(trans('general.no_records')); ?></div>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
        <?php echo $__env->make($class->views['table.footer'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </table>
</div>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/reports/table.blade.php ENDPATH**/ ?>