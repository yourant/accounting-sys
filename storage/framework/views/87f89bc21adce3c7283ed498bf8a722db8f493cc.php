<?php if($row_total = array_sum($rows)): ?>
    <tr class="row rp-border-top-1 font-size-unset">
        <td class="<?php echo e($class->column_name_width); ?> long-texts pr-0" title="<?php echo e($class->row_names[$table][$id]); ?>"><?php echo e($class->row_names[$table][$id]); ?></td>
        <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <td class="<?php echo e($class->column_value_width); ?> text-right px-0"><?php echo e($class->has_money ? money($row, setting('default.currency'), true) : $row); ?></td>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <td class="<?php echo e($class->column_name_width); ?> text-right pl-0 pr-4"><?php echo e($class->has_money ? money($row_total, setting('default.currency'), true) : $row); ?></td>
    </tr>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/reports/table/rows.blade.php ENDPATH**/ ?>