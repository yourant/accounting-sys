<html lang="<?php echo e(app()->getLocale()); ?>">

    <?php echo $__env->make('partials.auth.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <body class="login-page">
        <?php echo $__env->yieldPushContent('body_start'); ?>

        <div class="main-content mt-4">
            <div class="header">
                <div class="container">
                    <div class="header-body text-center">
                        <div class="row justify-content-center">
                            <div class="col-xl-5 col-lg-6 col-md-8">
                                <img class="mb-5" src="<?php echo e(asset('public/img/erp-logo-2.png')); ?>" width="22%" alt="Akaunting"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php echo $__env->yieldPushContent('login_box_start'); ?>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-7">
                            <div class="card mb-0 login-card-bg">
                                <div class="card-body px-lg-5 py-lg-5">
                                    <div class="text-center text-white mb-4">
                                        <small><?php echo $__env->yieldContent('message'); ?></small>
                                    </div>

                                    <div id="app">
                                        <?php echo $__env->yieldPushContent('login_content_start'); ?>

                                        <?php echo $__env->yieldContent('content'); ?>

                                        <?php echo $__env->yieldPushContent('login_content_end'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php echo $__env->yieldPushContent('login_box_end'); ?>

            <?php echo $__env->yieldContent('forgotten-password'); ?>

            <footer>
                <div class="container mt-5 mb-4">
                    <div class="row align-items-center justify-content-xl-between">
                        <div class="col-xl-12">
                            <div class="copyright text-center text-white">
                                <small>
                                    <?php echo e(trans('footer.powered')); ?>: <a href="<?php echo e(trans('footer.link')); ?>" target="_blank" class="text-white"><?php echo e(trans('footer.software')); ?></a>
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>

        <?php echo $__env->yieldPushContent('body_end'); ?>

        <?php echo $__env->make('partials.auth.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </body>

</html>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/layouts/auth.blade.php ENDPATH**/ ?>