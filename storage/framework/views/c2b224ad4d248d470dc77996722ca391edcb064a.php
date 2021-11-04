<?php $__env->startSection('title', trans('general.title.new', ['type' => trans_choice('inventory::general.warehouses', 1)])); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <?php echo Form::open([
            'route' => 'inventory.warehouses.store',
            'id' => 'warehouse',
            '@submit.prevent' => 'onSubmit',
            '@keydown' => 'form.errors.clear($event.target.name)',
            'files' => true,
            'role' => 'form',
            'class' => 'form-loading-button',
            'novalidate' => true
        ]); ?>


            <div class="card-body">
                <div class="row">
                    <?php echo e(Form::textGroup('name', trans('general.name'), 'id-card')); ?>


                    <?php echo e(Form::textGroup('email', trans('general.email'), 'envelope', [])); ?>


                    <?php echo e(Form::textGroup('phone', trans('general.phone'), 'phone', [])); ?>


                    <?php echo e(Form::textareaGroup('address', trans('general.address'))); ?>


                    <?php echo e(Form::radioGroup('default_warehouse', trans('inventory::general.default_warehouse'), false)); ?>


                    <?php echo e(Form::radioGroup('enabled', trans('general.enabled'), true)); ?>


                </div>
            </div>

            <div class="card-footer">
                <div class="row save-buttons">
                    <?php echo e(Form::saveButtons('inventory.warehouses.index')); ?>

                </div>
            </div>
        <?php echo Form::close(); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script src="<?php echo e(asset('modules/Inventory/Resources/assets/js/warehouses.min.js?v=' . module_version('inventory'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\modules\Inventory\Providers/../Resources/views/warehouses/create.blade.php ENDPATH**/ ?>