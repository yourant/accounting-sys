<html lang="<?php echo e(app()->getLocale()); ?>">

    <?php echo $__env->make('partials.admin.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <body id="leftMenu" class="g-sidenav-show g-sidenav-pinned">
        <?php echo $__env->yieldPushContent('body_start'); ?>

        <div class="main-content" id="panel">

            <div id="main-body">

                <?php echo $__env->make('partials.admin.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="container-fluid content-layout mt--6">

                    <?php echo $__env->make('partials.admin.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php echo $__env->make('partials.admin.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                </div>

            </div>

        </div>

        <?php echo $__env->yieldPushContent('body_end'); ?>

        <?php echo $__env->make('partials.admin.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>

</html>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/layouts/error.blade.php ENDPATH**/ ?>