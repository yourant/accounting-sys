
<?php echo Form::model($customer, [
    'id' => 'form-edit-customer',
    'method' => 'PATCH',
    'route' => ['customers.update', $customer->id],
    '@submit.prevent' => 'onSubmit',
    '@keydown' => 'form.errors.clear($event.target.name)',
    'files' => true,
    'role' => 'form',
    'class' => 'form-loading-button',
    'novalidate' => true
]); ?>

    <div class="row">
        <?php echo e(Form::textGroup('name', trans('general.name'), 'font')); ?>


        <?php echo e(Form::textGroup('email', trans('general.email'), 'envelope', [])); ?>


        <?php echo e(Form::textGroup('tax_number', trans('general.tax_number'), 'percent', [], $customer->tax_number)); ?>


        <?php echo e(Form::selectGroup('currency_code', trans_choice('general.currencies', 1), 'exchange-alt', $currencies, $customer->currency_code)); ?>


        <?php echo e(Form::textareaGroup('address', trans('general.address'), null, $customer->address)); ?>


        <?php echo e(Form::hidden('type', 'customer')); ?>

        <?php echo Form::hidden('enabled', '1', []); ?>

    </div>
<?php echo Form::close(); ?>

<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/modals/customers/edit.blade.php ENDPATH**/ ?>