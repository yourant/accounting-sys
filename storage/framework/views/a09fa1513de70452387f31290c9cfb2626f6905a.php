<html lang="<?php echo e(app()->getLocale()); ?>">
    <?php echo $__env->make('partials.wizard.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <body class="wizard-page">

        <div class="container mt--5">
            <?php echo $__env->yieldPushContent('body_start'); ?>

            <div id="app">
                <div class="card-body">

                    <?php echo $__env->make('flash::message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php echo $__env->yieldContent('content'); ?>
                </div>
            </div>

        </div>

        <?php echo $__env->make('partials.wizard.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    </body>
</html><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/layouts/wizard.blade.php ENDPATH**/ ?>