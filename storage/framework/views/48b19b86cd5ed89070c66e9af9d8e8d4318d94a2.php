<?php
foreach ($class->footer_totals as $table => $dates) {
    foreach ($dates as $date => $total) {
        if (!isset($class->net_profit[$date])) {
            $class->net_profit[$date] = 0;
        }

        $class->net_profit[$date] += $total;
    }
}
?>

<div class="table-responsive my-2">
    <table class="table table-hover align-items-center rp-border-collapse">
        <tfoot class="border-top-style">
            <tr class="row rp-border-top-1 font-size-unset px-3">
                <th class="<?php echo e($class->column_name_width); ?> text-uppercase text-left border-top-0"><?php echo e(trans('reports.net_profit')); ?></th>
                <?php $__currentLoopData = $class->net_profit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $profit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th class="<?php echo e($class->column_value_width); ?> text-right px-0 border-top-0"><?php echo money($profit, setting('default.currency'), true); ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <th class="<?php echo e($class->column_name_width); ?> text-right pl-0 pr-4 border-top-0"><?php echo money(array_sum($class->net_profit), setting('default.currency'), true); ?></th>
            </tr>
        </tfoot>
    </table>
</div>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/reports/profit_loss/content/footer.blade.php ENDPATH**/ ?>