<?php $__env->startSection('title', trans('general.title.new', ['type' => trans_choice('inventory::general.transfer_orders', 1)])); ?>

<?php $__env->startSection('content'); ?>
    <?php echo Form::open([
        'route' => 'inventory.transfer-orders.store',
        'id' => 'transfer-order',
        '@submit.prevent' => 'onSubmit',
        '@keydown' => 'form.errors.clear($event.target.name)',
        'files' => true,
        'role' => 'form',
        'class' => 'form-loading-button',
        'novalidate' => true
    ]); ?>


        <div class="card">
            <div class="card-body">
                <div class="row">
                    <?php echo e(Form::textGroup('transfer_order', trans_choice('inventory::general.transfer_orders', 1), 'id-card')); ?>


                    <?php echo e(Form::dateGroup('date', trans('general.date'), 'calendar', ['id' => 'closed_at', 'class' => 'form-control datepicker', 'date-format' => 'Y-m-d', 'autocomplete' => 'off'], Date::now()->toDateString())); ?>


                    <?php echo e(Form::textGroup('reason', trans('inventory::transferorders.reason'), 'id-card', [], '', 'col-md-12')); ?>


                    

                    <akaunting-select
                        class="col-md-6 required"
                        :form-classes="[{'has-error': form.errors.get('source_warehouse_id') }]"
                        :icon="'warehouse'"
                        :title="'<?php echo e(trans('inventory::transferorders.source_warehouse')); ?>'"
                        :placeholder="'<?php echo e(trans('general.form.select.field', ['field' => trans('inventory::transferorders.source_warehouse')])); ?>'"
                        :name="'source_warehouse_id'"
                        :options="<?php echo e($warehouses); ?>"
                        :value="'<?php echo e(old('source_warehouse_id')); ?>'"
                        @interface="form.source_warehouse_id = $event"
                        @change="onChangeType()"
                        :form-error="form.errors.get('source_warehouse_id')"
                        :no-data-text="'<?php echo e(trans('general.no_data')); ?>'"
                        :no-matching-data-text="'<?php echo e(trans('general.no_matching_data')); ?>'"
                    ></akaunting-select>

                    <akaunting-select
                        class="col-md-6 required d-none"
                        :class="[{'show': items}]"
                        :form-classes="[{'has-error': form.errors.get('destination_warehouse_id') }]"
                        :icon="'warehouse'"
                        :title="'<?php echo e(trans('inventory::transferorders.destination_warehouse')); ?>'"
                        :placeholder="'<?php echo e(trans('general.form.select.field', ['field' => trans('inventory::transferorders.destination_warehouse')])); ?>'"
                        :name="'destination_warehouse_id'"
                        :dynamic-options="options.destination_warehouse"
                        :value="'<?php echo e(old('destination_warehouse_id')); ?>'"
                        @interface="form.destination_warehouse_id = $event"
                        :form-error="form.errors.get('destination_warehouse_id')"
                        :no-data-text="'<?php echo e(trans('general.no_data')); ?>'"
                        :no-matching-data-text="'<?php echo e(trans('general.no_matching_data')); ?>'"
                    ></akaunting-select>
                </div>
            </div>
        </div>

        <div class="card" v-if="items">
            <div class="card-body">
                <div class="row">
                    <akaunting-select
                        class="col-md-4 required d-none"
                        :class="[{'show': items}]"
                        :form-classes="[{'has-error': form.errors.get('item') }]"
                        :icon="'id-card'"
                        :title="'<?php echo e(trans_choice('general.items', 1)); ?>'"
                        :placeholder="'<?php echo e(trans('general.form.select.field',
                        ['field' => trans_choice('general.items', 1)])); ?>'"
                        :name="'item_id'"
                        :dynamic-options="options.item_id"
                        :value="'<?php echo e(old('item_id')); ?>'"
                        @interface="form.item_id = $event"
                        @change="onChangeItemQuantity()"
                        :form-error="form.errors.get('item_id')"
                        :no-data-text="'<?php echo e(trans('general.no_data')); ?>'"
                        :no-matching-data-text="'<?php echo e(trans('general.no_matching_data')); ?>'"
                    ></akaunting-select>

                    <?php echo e(Form::textGroup('item_quantity', trans('inventory::transferorders.item_quantity'), 'id-card', ['disabled' => 'true', 'v-model' => 'options.item_quantity'], '', 'col-md-4')); ?>


                    <?php echo e(Form::textGroup('transfer_quantity', trans('inventory::transferorders.transfer_quantity'), 'id-card', ['required' => 'required', '@input' => 'onChangeQuantity'], '', 'col-md-4')); ?>


                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-footer">
                <div class="row save-buttons">
                    <a href="<?php echo e(route('inventory.transfer-orders.index')); ?>" class="btn btn-icon btn-outline-secondary header-button-top">
                        <span class="btn-inner--icon"><i class="fas fa-times"></i></span>
                        <span class="btn-inner--text"><?php echo e(trans('general.cancel')); ?></span>
                    </a>
                    <?php echo Form::button(
                        '<div v-if="form.loading" class="aka-loader-frame"><div class="aka-loader"></div></div> <span :class="[{\'opacity-10\': transfer_button}]" v-if="!form.loading" class="btn-inner--icon"><i class="fas fa-save"></i></span>' . '<span :class="[{\'opacity-10\': transfer_button}]" class="btn-inner--text"> ' . trans('general.save') . '</span>',
                        [':disabled' => 'transfer_button|| form.loading', 'type' => 'submit', 'class' => 'btn btn-icon btn-success button-submit header-button-top', 'data-loading-text' => trans('general.loading')]); ?>                </div>
            </div>
        </div>
    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script src="<?php echo e(asset('modules/Inventory/Resources/assets/js/transfer_orders.min.js?v=' . module_version('inventory'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\modules\Inventory\Providers/../Resources/views/transfer-orders/create.blade.php ENDPATH**/ ?>