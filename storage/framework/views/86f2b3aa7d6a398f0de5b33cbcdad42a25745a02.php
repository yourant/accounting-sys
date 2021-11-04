<?php $__env->startSection('title', trans_choice('general.localisations', 1)); ?>

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
                <?php echo e(Form::dateGroup('financial_start', trans('settings.localisation.financial_start'), 'calendar', ['id' => 'financial_start', 'class' => 'form-control datepicker', 'show-date-format' => 'j F', 'date-format' => 'd-m', 'autocomplete' => 'off', 'hidden_year' => true], setting('localisation.financial_start'))); ?>


                <?php echo e(Form::selectGroup('financial_denote', trans('settings.localisation.financial_denote.title'), 'calendar', $financial_denote_options, setting('localisation.financial_denote'), [])); ?>


                <?php echo e(Form::selectGroupGroup('timezone', trans('settings.localisation.timezone'), 'globe', $timezones, setting('localisation.timezone'), [])); ?>


                <?php echo e(Form::selectGroup('date_format', trans('settings.localisation.date.format'), 'calendar', $date_formats, setting('localisation.date_format'), ['autocomplete' => 'off'])); ?>


                <?php echo e(Form::selectGroup('date_separator', trans('settings.localisation.date.separator'), 'minus', $date_separators, setting('localisation.date_separator'), [])); ?>


                <?php echo e(Form::selectGroup('percent_position', trans('settings.localisation.percent.title'), 'percent', $percent_positions, setting('localisation.percent_position'), [])); ?>


                <?php echo e(Form::selectGroup('discount_location', trans('settings.localisation.discount_location.name'), 'percent', $discount_locations, setting('localisation.discount_location'), [])); ?>

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

    <?php echo Form::hidden('_prefix', 'localisation'); ?>


    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script src="<?php echo e(asset('public/js/settings/settings.js?v=' . version('short'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/settings/localisation/edit.blade.php ENDPATH**/ ?>