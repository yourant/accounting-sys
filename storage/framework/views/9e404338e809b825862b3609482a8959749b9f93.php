<thead class="thead-light">
    <tr class="row font-size-unset">
        <?php if(($table == 'default') && !empty($class->groups)): ?>
            <th class="<?php echo e($class->column_name_width); ?>"><?php echo e($class->groups[$class->model->settings->group]); ?></th>
        <?php else: ?>
            <th class="<?php echo e($class->column_name_width); ?>"><?php echo e($table); ?></th>
        <?php endif; ?>
        <?php $__currentLoopData = $class->dates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <th class="<?php echo e($class->column_value_width); ?> text-right px-0"><?php echo e($date); ?></th>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <th class="<?php echo e($class->column_name_width); ?> text-right pl-0 pr-4"><?php echo e(trans_choice('general.totals', 1)); ?></th>
    </tr>
</thead>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/reports/table/header.blade.php ENDPATH**/ ?>