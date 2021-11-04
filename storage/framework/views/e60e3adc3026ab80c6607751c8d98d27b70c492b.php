<?php $__env->startSection('title', trans('errors.title.404')); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0 text-warning">
                <i class="fa fa-exclamation-triangle text-warning"></i> &nbsp;<?php echo e(trans('errors.header.404')); ?>

            </h2>
        </div>

        <div class="card-body">
            <p><?php echo e(trans('errors.message.404')); ?></p>

            <?php $landing_page = user() ? user()->getLandingPageOfUser() : route('login'); ?>

            <a href="<?php echo e($landing_page); ?>" class="btn btn-success"><?php echo e(trans('general.go_to_dashboard')); ?></a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/errors/404.blade.php ENDPATH**/ ?>