<?php $__env->startSection('title', trans('general.title.new', ['type' => trans_choice('general.items', 1)])); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <?php echo Form::open([
            'route' => 'inventory.items.store',
            'id' => 'item',
            '@submit.prevent' => 'onSubmit',
            '@keydown' => 'form.errors.clear($event.target.name)',
            'files' => true,
            'role' => 'form',
            'class' => 'form-loading-button',
            'novalidate' => true
        ]); ?>


            <div class="card-body">
                <div class="row">
                    <?php echo e(Form::textGroup('name', trans('general.name'), 'tag')); ?>


                    <?php echo e(Form::textGroup('sku', trans('inventory::general.sku'), 'fa fa-key', ['required' => 'required'], !empty($inventory_item->sku) ? $inventory_item->sku : '')); ?>


                    <?php echo e(Form::multiSelectAddNewGroup('tax_ids', trans_choice('general.taxes', 1), 'percentage', $taxes, (setting('default.tax')) ? [setting('default.tax')] : null, ['path' => route('modals.taxes.create'), 'field' => ['key' => 'id', 'value' => 'title']], 'col-md-6 el-select-tags-pl-38')); ?>


                    <?php echo e(Form::textareaGroup('description', trans('general.description'))); ?>


                    <?php echo e(Form::textGroup('sale_price', trans('items.sales_price'), 'money-bill-wave')); ?>


                    <?php echo e(Form::textGroup('purchase_price', trans('items.purchase_price'), 'money-bill-wave-alt')); ?>


                    <?php echo e(Form::selectRemoteAddNewGroup('category_id', trans_choice('general.categories', 1), 'folder', $categories, null, ['path' => route('modals.categories.create') . '?type=item', 'remote_action' => route('categories.index'). '?search=type:item'])); ?>


                    <?php echo e(Form::fileGroup('picture', trans_choice('general.pictures', 1), 'plus', ['dropzone-class' => 'form-file', 'options' => ['acceptedFiles' => 'image/*']])); ?>


                    <?php echo e(Form::radioGroup('enabled', trans('general.enabled'), true)); ?>


                    <div id="track_inventories" class="row col-md-12">
                        <?php echo $__env->yieldPushContent('track_inventory_input_start'); ?>
                            <div id="item-track-inventory" class="form-group col-md-12 margin-top">
                                <div class="custom-control custom-checkbox">
                                    <?php echo e(Form::checkbox('track_inventory', '1', setting('inventory.track_inventory'), [
                                        'v-model' => 'form.track_inventory',
                                        'id' => 'track_inventory',
                                        'class' => 'custom-control-input'
                                    ])); ?>


                                    <label class="custom-control-label" for="track_inventory">
                                        <strong><?php echo e(trans('inventory::items.track_inventory')); ?></strong>
                                    </label>
                                </div>
                            </div>
                        <?php echo $__env->yieldPushContent('track_inventory_input_end'); ?>
                    </div>

                    <div v-if="form.track_inventory.length" class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="items">
                                <thead class="thead-light">
                                    <tr class="row">
                                        <th class="col-md-1"><?php echo e(trans('general.actions')); ?></th>
                                        <th class="col-md-5"><?php echo e(trans_choice('inventory::general.warehouses', 1)); ?></th>
                                        <th class="col-md-2"><?php echo e(trans('inventory::items.opening_stock')); ?></th>
                                        <th class="col-md-2"><?php echo e(trans('inventory::items.opening_stock_value')); ?></th>
                                        <th class="col-md-2"><?php echo e(trans('inventory::items.reorder_level')); ?></th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr class="row" v-for="(row, index) in form.items" :index="index">
                                        <td class="col-md-1">
                                            <button type="button"
                                                @click="onDeleteItem(index)"
                                                data-toggle="tooltip"
                                                title="<?php echo e(trans('general.delete')); ?>"
                                                class="btn btn-icon btn-outline-danger btn-lg"><i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                        <td class="col-md-5">
                                            <div class="row">
                                                <div class="custom-radio col-md-2 p-3">
                                                    <input type="radio"
                                                        name="items[][default_warehouse]"
                                                        :id="'default-warehouse-' + index"
                                                        data-item="default_warehouse"
                                                        :value="'true'"
                                                        @change="onChangeDefault(index)"
                                                        v-model="row.default_warehouse"
                                                        class="custom-control-input">
                                                    <label :for="'default-warehouse-' + index" class="custom-control-label">
                                                        <?php echo e(trans('inventory::general.default')); ?>

                                                    </label>
                                                </div>

                                                <akaunting-select
                                                    class="form-control-sm d-inline-block col-md-10"
                                                    :placeholder="'<?php echo e(trans('general.form.select.field', ['field' => trans_choice('inventory::general.warehouses', 1)])); ?>'"
                                                    :name="'items.' + index + '.warehouse_id'"
                                                    :icon="'fas fa-warehouse'"
                                                    :options="<?php echo e(json_encode($warehouses)); ?>"
                                                    :value="'<?php echo e(setting('inventory.default_warehouse')); ?>'"
                                                    @interface="row.warehouse_id = $event"
                                                >
                                                </akaunting-select>
                                            </div>
                                        </td>
                                        <td class="col-md-2">
                                            <input value=""
                                            class="form-control"
                                            data-item="opening_stock"
                                            required="required"
                                            name="items[][opening_stock]"
                                            v-model="row.opening_stock"
                                            type="text"
                                            autocomplete="off">
                                        </td>
                                        <td class="col-md-2">
                                            <input value=""
                                            class="form-control"
                                            data-item="opening_stock_value"
                                            required="required"
                                            name="items[][opening_stock_value]"
                                            v-model="row.opening_stock_value"
                                            type="text"
                                            autocomplete="off">
                                        </td>
                                        <td class="col-md-2">
                                            <input value=""
                                            class="form-control"
                                            data-item="reorder_level"
                                            required="required"
                                            name="items[][reorder_level]"
                                            v-model="row.reorder_level"
                                            type="text"
                                            autocomplete="off">
                                        </td>
                                    </tr>
                                    <tr id="addItem">
                                        <td class="col-md-1">
                                            <button type="button"
                                                @click="onAddItem"
                                                id="button-add-item"
                                                data-toggle="tooltip"
                                                title="<?php echo e(trans('general.add')); ?>"
                                                class="btn btn-icon btn-outline-success btn-lg"
                                                data-original-title="<?php echo e(trans('general.add')); ?>">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="row save-buttons">
                    <?php echo e(Form::saveButtons('inventory.items.index')); ?>

                </div>
            </div>
        <?php echo Form::close(); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
<script src="<?php echo e(asset('modules/Inventory/Resources/assets/js/items.min.js?v=' . module_version('inventory'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\modules\Inventory\Providers/../Resources/views/items/create.blade.php ENDPATH**/ ?>