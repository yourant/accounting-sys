<?php $__env->startSection('title', trans('general.title.new', ['type' => trans_choice('general.companies', 1)])); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <?php echo Form::open([
            'id' => 'company',
            'route' => 'companies.store',
            '@submit.prevent' => 'onSubmit',
            '@keydown' => 'form.errors.clear($event.target.name)',
            'files' => true,
            'role' => 'form',
            'class' => 'form-loading-button',
            'novalidate' => true
        ]); ?>


            <div class="card-body">
                <div class="row">
                    <?php echo e(Form::textGroup('name', trans('general.name'), 'font')); ?>


                    <?php echo e(Form::emailGroup('email', trans('general.email'), 'envelope')); ?>


                    <?php echo e(Form::selectGroup('currency', trans_choice('general.currencies', 1), 'exchange-alt', $currencies)); ?>


                    <?php echo e(Form::selectGroup('locale', trans_choice('general.languages', 1), 'flag', language()->allowed(), setting('default.locale', config('app.locale', 'en-GB')), [])); ?>


                    <?php echo e(Form::textGroup('tax_number', trans('general.tax_number'), 'percent', [], setting('company.tax_number'))); ?>


                    <?php echo e(Form::textGroup('phone', trans('settings.company.phone'), 'phone', [], setting('company.phone'))); ?>


                    <?php echo e(Form::textareaGroup('address', trans('general.address'))); ?>


                    <?php echo e(Form::fileGroup('logo', trans('companies.logo'), '', ['dropzone-class' => 'form-file'])); ?>


                    <?php echo e(Form::radioGroup('enabled', trans('general.enabled'), true)); ?>

                </div>
            </div>

            <div class="card-footer">
                <div class="row save-buttons">
                    <?php echo e(Form::saveButtons('companies.index')); ?>

                </div>
            </div>
        <?php echo Form::close(); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script src="<?php echo e(asset('public/js/common/companies.js?v=' . version('short'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/common/companies/create.blade.php ENDPATH**/ ?>