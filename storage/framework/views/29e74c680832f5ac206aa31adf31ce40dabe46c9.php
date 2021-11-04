<?php echo $__env->yieldPushContent('footer_start'); ?>
    <footer class="footer">
        <div class="row">
            <div class="col-xs-12 col-sm-6">
                <div class="text-sm float-left text-muted footer-texts">
                    <?php echo e(trans('footer.powered')); ?>: <a href="<?php echo e(trans('footer.link')); ?>" target="_blank" class="text-muted"><?php echo e(trans('footer.software')); ?></a>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6">
                <div class="text-sm float-right text-muted footer-texts">
                    <?php echo e(trans('footer.version')); ?> <?php echo e(version('short')); ?>

                </div>
            </div>
        </div>
    </footer>
<?php echo $__env->yieldPushContent('footer_end'); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/admin/footer.blade.php ENDPATH**/ ?>