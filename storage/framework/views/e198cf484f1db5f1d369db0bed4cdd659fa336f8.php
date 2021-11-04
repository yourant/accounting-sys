<?php $__env->startSection('title', trans_choice('general.defaults', 1)); ?>

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
                <?php echo e(Form::selectGroup('account', trans_choice('general.accounts', 1), 'university', $accounts, setting('default.account'), [])); ?>


                <?php echo e(Form::selectGroup('currency', trans_choice('general.currencies', 1), 'exchange-alt', $currencies, setting('default.currency'), [])); ?>


                <?php echo e(Form::selectRemoteGroup('income_category', trans('settings.default.income_category'), 'folder', $sales_categories, setting('default.income_category'), ['remote_action' => route('categories.index'). '?search=type:income'])); ?>


                <?php echo e(Form::selectRemoteGroup('expense_category', trans('settings.default.expense_category'), 'folder', $purchases_categories, setting('default.expense_category'), ['remote_action' => route('categories.index'). '?search=type:expense'])); ?>


                <?php echo e(Form::selectGroup('tax', trans_choice('general.taxes', 1), 'percent', $taxes, setting('default.tax'), [])); ?>


                <?php echo e(Form::selectGroup('payment_method', trans_choice('general.payment_methods', 1), 'credit-card', $payment_methods, setting('default.payment_method'), [])); ?>


                <?php echo e(Form::selectGroup('locale', trans_choice('general.languages', 1), 'flag', language()->allowed(), setting('default.locale'), [])); ?>


                <?php echo e(Form::selectGroup('list_limit', trans('settings.default.list_limit'), 'columns', ['10' => '10', '25' => '25', '50' => '50', '100' => '100'], setting('default.list_limit'), [])); ?>


                <?php echo e(Form::radioGroup('use_gravatar', trans('settings.default.use_gravatar'), setting('default.use_gravatar'))); ?>

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

    <?php echo Form::hidden('_prefix', 'default'); ?>


    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script src="<?php echo e(asset('public/js/settings/settings.js?v=' . version('short'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/settings/default/edit.blade.php ENDPATH**/ ?>