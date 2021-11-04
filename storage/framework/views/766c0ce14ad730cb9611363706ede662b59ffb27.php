<?php echo $__env->yieldPushContent('header_start'); ?>

    <div id="header" class="header pb-6">
        <div class="container-fluid content-layout">
            <div class="header-body">
                <div class="row py-4 align-items-center">
                    <div class="col-xs-12 col-sm-4 col-md-5 align-items-center">
                        <h2 class="d-inline-flex mb-0 long-texts"><?php echo $__env->yieldContent('title'); ?></h2>
                        <?php echo $__env->yieldContent('dashboard_action'); ?>
                    </div>

                    <div class="col-xs-12 col-sm-8 col-md-7">
                        <div class="text-right">
                            <?php echo $__env->yieldPushContent('header_button_start'); ?>

                            <?php echo $__env->yieldContent('new_button'); ?>

                            <!--<?php echo $__env->yieldPushContent('header_button_end'); ?>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php echo $__env->yieldPushContent('header_end'); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/admin/header.blade.php ENDPATH**/ ?>