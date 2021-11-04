<div id="widget-<?php echo e($class->model->id); ?>" class="<?php echo e($class->model->settings->width); ?>">
    <div class="card">
        <?php echo $__env->make($class->views['header'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div class="card-body" id="widget-line-<?php echo e($class->model->id); ?>">
            <div class="chart">
                <?php echo $chart->container(); ?>

            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('body_scripts'); ?>
    <?php echo $chart->script(); ?>

<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/widgets/line_chart.blade.php ENDPATH**/ ?>