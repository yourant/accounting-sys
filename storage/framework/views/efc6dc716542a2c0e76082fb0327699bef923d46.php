<?php $chart = $class->getChart(); ?>

<div id="report-chart" class="card-body">
    <?php echo $chart->container(); ?>

</div>

<?php $__env->startPush('charts'); ?>
    <script>
        var cash_flow = new Vue({
            el: '#report-chart',
        });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('body_scripts'); ?>
    <?php echo $chart->script(); ?>

<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/reports/chart.blade.php ENDPATH**/ ?>