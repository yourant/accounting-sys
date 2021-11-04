<?php $__env->startSection('title', trans('general.title.new', ['type' => trans_choice('general.reports', 1)])); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <?php echo Form::open([
            'id' => 'report',
            'route' => 'reports.store',
            '@submit.prevent' => 'onSubmit',
            '@keydown' => 'form.errors.clear($event.target.name)',
            'role' => 'form',
            'class' => 'form-loading-button',
            'novalidate' => true,
        ]); ?>


            <div class="card-body">
                <div class="row">
                    <?php echo e(Form::textGroup('name', trans('general.name'), 'font')); ?>


                    <?php echo e(Form::selectGroup('class', trans_choice('general.types', 1), 'bars', $classes, null, ['required' => 'required', 'change' => 'onChangeClass'])); ?>


                    <?php echo e(Form::textareaGroup('description', trans('general.description'), null, null, ['rows' => '3', 'required' => 'required'])); ?>


                    <?php echo e(Form::hidden('report', 'invalid', ['data-field' => 'settings'])); ?>


                    <component v-bind:is="report_fields" @change="onChangeReportFields"></component>
                </div>
            </div>

            <div class="card-footer">
                <div class="row save-buttons">
                    <?php echo e(Form::saveButtons('reports.index')); ?>

                </div>
            </div>
        <?php echo Form::close(); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script src="<?php echo e(asset('public/js/common/reports.js?v=' . version('short'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/common/reports/create.blade.php ENDPATH**/ ?>