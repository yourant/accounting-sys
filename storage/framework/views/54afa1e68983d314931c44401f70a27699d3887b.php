<?php $__env->startSection('title', trans('settings.scheduling.name')); ?>

<?php $__env->startSection('content'); ?>
    <?php echo Form::open([
        'id' => 'setting',
        'method' => 'PATCH',
        'route' => 'settings.update',
        '@submit.prevent' => 'onSubmit',
        '@keydown' => 'form.errors.clear($event.target.name)',
        'files' => true,
        'role' => 'form',
        'class' => 'form-loading-button',
        'novalidate' => true,
    ]); ?>


    <div class="card">
        <div class="card-body">
            <div class="row">
                <?php echo e(Form::radioGroup('send_invoice_reminder', trans('settings.scheduling.send_invoice'), setting('schedule.send_invoice_reminder'))); ?>


                <?php echo e(Form::textGroup('invoice_days', trans('settings.scheduling.invoice_days'), 'calendar', [], setting('schedule.invoice_days'))); ?>


                <?php echo e(Form::radioGroup('send_bill_reminder', trans('settings.scheduling.send_bill'), setting('schedule.send_bill_reminder'))); ?>


                <?php echo e(Form::textGroup('bill_days', trans('settings.scheduling.bill_days'), 'calendar', [], setting('schedule.bill_days'))); ?>


                <div class="col-sm-6">
                    <label for="cron_command" class="form-control-label"><?php echo e(trans('settings.scheduling.cron_command')); ?></label>
                    <input type="text" class="form-control form-control-muted" value="php <?php echo e(base_path('artisan')); ?> schedule:run >> /dev/null 2>&1">
                </div>

                <?php echo e(Form::textGroup('time', trans('settings.scheduling.schedule_time'), 'clock', [], setting('schedule.time'))); ?>

            </div>
        </div>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update-settings-settings')): ?>
            <div class="card-footer">
                <div class="row save-buttons">
                    <?php echo e(Form::saveButtons('settings.index')); ?>

                </div>
            </div>
        <?php endif; ?>
    </div>

    <?php echo Form::hidden('_prefix', 'schedule'); ?>


    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script src="<?php echo e(asset('public/js/settings/settings.js?v=' . version('short'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/settings/schedule/edit.blade.php ENDPATH**/ ?>