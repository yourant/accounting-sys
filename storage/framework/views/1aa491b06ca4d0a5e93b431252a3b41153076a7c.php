
<?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <a href="<?php echo e(url($module->action_url) . '?' . http_build_query((array) $module->action_parameters)); ?>" class="btn btn-white btn-sm" target="<?php echo e($module->action_target); ?>">
        <?php echo e($module->name); ?>

    </a>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/admin/suggestions.blade.php ENDPATH**/ ?>