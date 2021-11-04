<html lang="<?php echo e(app()->getLocale()); ?>">
    <?php echo $__env->make('partials.print.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <body onload="window.print();">
        <?php echo $__env->yieldPushContent('body_start'); ?>

            <?php echo $__env->yieldContent('content'); ?>

        <?php echo $__env->yieldPushContent('body_end'); ?>
        
        <?php echo $__env->make('partials.print.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>
</html>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/layouts/print.blade.php ENDPATH**/ ?>