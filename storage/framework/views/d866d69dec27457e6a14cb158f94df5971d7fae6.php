<?php echo $__env->yieldPushContent('scripts_start'); ?>
    <!-- Core -->
    <script src="<?php echo e(asset('public/vendor/jquery/dist/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/vendor/js-cookie/js.cookie.js')); ?>"></script>

    <?php echo $__env->yieldPushContent('body_css'); ?>

    <?php echo $__env->yieldPushContent('body_stylesheet'); ?>

    <?php echo $__env->yieldPushContent('body_js'); ?>

    <?php echo $__env->yieldPushContent('body_scripts'); ?>

    <?php echo \Livewire\Livewire::scripts(); ?>

<?php echo $__env->yieldPushContent('scripts_end'); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/auth/scripts.blade.php ENDPATH**/ ?>