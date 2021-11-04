<?php $__env->startSection('title', $class->model->name); ?>

<?php $__env->startSection('new_button'); ?>
    <a href="<?php echo e(url($class->getUrl('print'))); ?>" target="_blank" class="btn btn-white btn-sm">
        <?php echo e(trans('general.print')); ?>

    </a>
    <a href="<?php echo e(url($class->getUrl('export'))); ?>" class="btn btn-white btn-sm">
        <?php echo e(trans('general.export')); ?>

    </a>
<?php $__env->stopSection(); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/reports/header.blade.php ENDPATH**/ ?>