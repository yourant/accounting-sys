    <!-- Core -->
    <script src="<?php echo e(asset('public/vendor/jquery/dist/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/vendor/js-cookie/js.cookie.js')); ?>"></script>

    <script type="text/javascript">
        var company_currency_code = '<?php echo e(setting("default.currency")); ?>';
    </script>
    
    <?php echo $__env->yieldPushContent('scripts_start'); ?>

    <?php echo $__env->yieldPushContent('charts'); ?>

    <script src="<?php echo e(asset('public/vendor/chart.js/dist/Chart.min.js')); ?>"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js" charset=utf-8></script>

    <?php echo $__env->yieldPushContent('body_css'); ?>

    <?php echo $__env->yieldPushContent('body_stylesheet'); ?>

    <?php echo $__env->yieldPushContent('body_js'); ?>

    <?php echo $__env->yieldPushContent('body_scripts'); ?>

    <?php echo \Livewire\Livewire::scripts(); ?>


    <!-- Livewire -->
    <script type="text/javascript">
        window.livewire_app_url = <?php echo e(company_id()); ?>;
    </script>
<?php echo $__env->yieldPushContent('scripts_end'); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/print/scripts.blade.php ENDPATH**/ ?>