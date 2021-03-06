<div class="table-responsive mt-4">
    <table class="table table-hover align-items-center rp-border-collapse">
        <thead class="border-top-style">
            <tr class="row rp-border-bottom-1 font-size-unset px-3">
                <th class="<?php echo e($class->column_name_width); ?> text-right px-0 border-top-0"></th>
                <?php $__currentLoopData = $class->dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th class="<?php echo e($class->column_value_width); ?> text-right px-0 border-top-0"><?php echo e($date); ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <th class="<?php echo e($class->column_name_width); ?> text-uppercase text-right pl-0 pr-4 border-top-0"><?php echo e(trans_choice('general.totals', 1)); ?></th>
            </tr>
        </thead>
    </table>
</div>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/reports/profit_loss/content/header.blade.php ENDPATH**/ ?>