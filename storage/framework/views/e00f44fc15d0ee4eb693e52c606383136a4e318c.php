<?php $__env->startSection('title', trans_choice('general.modules', 2)); ?>

<?php $__env->startSection('new_button'); ?>
    <a href="<?php echo e(route('apps.api-key.create')); ?>" class="btn btn-white btn-sm"><?php echo e(trans('modules.api_key')); ?></a>
    <a href="<?php echo e(route('apps.my.index')); ?>" class="btn btn-white btn-sm"><?php echo e(trans('modules.my_apps')); ?></a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('partials.modules.bar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <h2><?php echo e($title); ?></h2>

    <div class="row">
        <?php if($modules && !empty($modules->data)): ?>
            <?php $__currentLoopData = $modules->data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($module->status_type == 'pre_sale'): ?>
                    <?php echo $__env->make('partials.modules.pre_sale', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php else: ?>
                    <?php echo $__env->make('partials.modules.item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="col-md-6 text-left">
                <?php if($modules->current_page > 1): ?>
                    <a href="<?php echo e(url(request()->path())); ?>?page=<?php echo e($modules->current_page - 1); ?>" class="btn btn-white btn-sm"><?php echo trans('pagination.previous'); ?></a>
                <?php endif; ?>
            </div>

            <div class="col-md-6 text-right">
                <?php if($modules->current_page < $modules->last_page): ?>
                    <a href="<?php echo e(url(request()->path())); ?>?page=<?php echo e($modules->current_page + 1); ?>" class="btn btn-white btn-sm"><?php echo trans('pagination.next'); ?></a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="col-md-12">
                <?php echo $__env->make('partials.modules.no_apps', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script src="<?php echo e(asset('public/js/modules/apps.js?v=' . version('short'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.modules', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/modules/tiles/index.blade.php ENDPATH**/ ?>