<?php $row_total = 0; ?>
<tr class="row rp-border-top-1 font-size-unset">
    <td class="<?php echo e($class->column_name_width); ?>"><?php echo e($class->row_names[$table][$id]); ?></td>
    <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $row_total += $row; ?>
        <td class="<?php echo e($class->column_value_width); ?> text-right px-0"><?php echo e($row); ?></td>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <td class="<?php echo e($class->column_name_width); ?> text-right pl-0 pr-4"><?php echo e($row_total); ?></td>
</tr>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\modules\Inventory\Providers/../Resources/views/reports/item/table/rows.blade.php ENDPATH**/ ?>