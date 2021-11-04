<?php echo $__env->yieldPushContent('scripts_start'); ?>
    <!-- Core -->
    <script src="<?php echo e(asset('public/vendor/jquery/dist/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('public/vendor/js-cookie/js.cookie.js')); ?>"></script>

    <script type="text/javascript">
        var wizard_translations = <?php echo json_encode($translations); ?>;
        var wizard_company = <?php echo json_encode($company); ?>;
        var wizard_currencies = <?php echo json_encode($currencies); ?>;
        var wizard_currency_codes = <?php echo json_encode($currency_codes); ?>;
        var wizard_taxes = <?php echo json_encode($taxes); ?>;
        var wizard_modules = <?php echo json_encode($modules); ?>;
    </script>

    <script src="<?php echo e(asset('public/js/wizard/wizard.js?v=' . version('short'))); ?>"></script>

    <?php echo $__env->yieldPushContent('body_css'); ?>

    <?php echo $__env->yieldPushContent('body_stylesheet'); ?>

    <?php echo $__env->yieldPushContent('body_js'); ?>

    <?php echo $__env->yieldPushContent('body_scripts'); ?>

    <?php echo \Livewire\Livewire::scripts(); ?>

<?php echo $__env->yieldPushContent('scripts_end'); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/wizard/scripts.blade.php ENDPATH**/ ?>