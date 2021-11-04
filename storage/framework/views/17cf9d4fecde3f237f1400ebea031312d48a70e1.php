<head>
    <?php echo $__env->yieldPushContent('head_start'); ?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8; charset=ISO-8859-1"/>

    <title><?php echo $__env->yieldContent('title'); ?> - <?php echo setting('company.name'); ?></title>

    <base href="<?php echo e(config('app.url') . '/'); ?>">

    <!-- Favicon -->
    <link rel="icon" href="<?php echo e(asset('public/img/favicon.ico')); ?>" type="image/png">

    <!-- Css -->
    <link rel="stylesheet" href="<?php echo e(asset('public/css/print.css?v=' . version('short'))); ?>" type="text/css">

    <style type="text/css">
        * {
            font-family: DejaVu Sans, sans-serif !important;
        }
    </style>

    <?php echo $__env->yieldPushContent('css'); ?>

    <?php echo $__env->yieldPushContent('stylesheet'); ?>

    <?php echo $__env->yieldPushContent('js'); ?>

    <?php echo $__env->yieldPushContent('scripts'); ?>

    <?php echo $__env->yieldPushContent('head_end'); ?>
</head>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/print/head.blade.php ENDPATH**/ ?>