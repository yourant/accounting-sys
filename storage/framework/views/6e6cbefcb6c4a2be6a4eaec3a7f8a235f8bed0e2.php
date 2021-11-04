<?php $__env->startSection('title', trans('print-template::general.title')); ?>

<?php $__env->startSection('content'); ?>
<iframe src="<?php echo e(route('print-template.settings.design' , $print_template->id)); ?>" style="width:100%;height:2600px"
    frameborder="0"></iframe>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\modules\PrintTemplate\Providers/../Resources/views/show.blade.php ENDPATH**/ ?>