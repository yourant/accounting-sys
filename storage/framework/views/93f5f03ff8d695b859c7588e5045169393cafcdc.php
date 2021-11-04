<?php $__env->startSection('title', trans('general.title.new', ['type' => trans_choice('inventory::general.item_groups', 1)])); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <?php echo Form::open([
            'route' => 'inventory.item-groups.store',
            'id' => 'item-group',
            'method' => 'POST',
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


                    <?php echo e(Form::multiSelectAddNewGroup('tax_ids', trans_choice('general.taxes', 1), 'percentage', $taxes, (setting('default.tax')) ? [setting('default.tax')] : null, ['path' => route('modals.taxes.create'), 'field' => ['key' => 'id', 'value' => 'title']], 'col-md-6 el-select-tags-pl-38')); ?>


                    <?php echo e(Form::textareaGroup('description', trans('general.description'))); ?>


                    <?php echo e(Form::selectRemoteAddNewGroup('category_id', trans_choice('general.categories', 1), 'folder', $categories, null, ['path' => route('modals.categories.create') . '?type=item', 'remote_action' => route('categories.index'). '?search=type:item'])); ?>


                    <?php echo e(Form::fileGroup('picture', trans_choice('general.pictures', 1), 'plus', ['dropzone-class' => 'form-file', 'options' => ['acceptedFiles' => 'image/*']])); ?>


                    <div class="form-group col-md-12 required">
                        <?php echo Form::label('options', trans_choice('inventory::general.options', 2), ['class' => 'control-label']); ?>


                        <div class="table-responsive">
                            <table class="table table-bordered" id="options">
                                <thead class="thead-light">
                                    <tr class="row table-head-line">
                                        <?php echo $__env->yieldPushContent('name_th_start'); ?>
                                        <th class="text-left col-md-3"><?php echo e(trans('general.name')); ?></th>
                                        <?php echo $__env->yieldPushContent('name_th_end'); ?>

                                        <?php echo $__env->yieldPushContent('quantity_th_start'); ?>
                                        <th class="text-center col-md-9"><?php echo e(trans('inventory::options.values')); ?></th>
                                        <?php echo $__env->yieldPushContent('quantity_th_end'); ?>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php echo $__env->make('inventory::item-groups.option', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-12 mb-4">
                        <?php echo Form::label('items', trans_choice('general.items', 2), ['class' => 'control-label']); ?>


                        <div class="table-responsive">
                            <table class="table table-bordered" id="items">
                                <thead class="thead-light">
                                    <tr class="row">
                                        <?php echo $__env->yieldPushContent('name_th_start'); ?>
                                        <th class="col-md-2 action-column border-right-0 border-bottom-0"><?php echo e(trans('general.name')); ?></th>
                                        <?php echo $__env->yieldPushContent('name_th_end'); ?>

                                        <?php echo $__env->yieldPushContent('sku_th_start'); ?>
                                        <th class="col-md-1 action-column border-right-0 border-bottom-0"><?php echo e(trans('inventory::general.sku')); ?></th>
                                        <?php echo $__env->yieldPushContent('sku_th_end'); ?>

                                        <?php echo $__env->yieldPushContent('opening_stock_th_start'); ?>
                                        <th class="col-md-2 action-column border-right-0 border-bottom-0"><?php echo e(trans('inventory::items.opening_stock')); ?></th>
                                        <?php echo $__env->yieldPushContent('opening_stock_th_end'); ?>

                                        <?php echo $__env->yieldPushContent('opening_stock_value_th_start'); ?>
                                        <th class="col-md-2 action-column border-right-0 border-bottom-0"><?php echo e(trans('inventory::items.opening_stock_value')); ?></th>
                                        <?php echo $__env->yieldPushContent('opening_stock_value_th_end'); ?>

                                        <?php echo $__env->yieldPushContent('sales_price_th_start'); ?>
                                        <th class="col-md-2 action-column border-right-0 border-bottom-0"><?php echo e(trans('items.sales_price')); ?></th>
                                        <?php echo $__env->yieldPushContent('sales_price_th_end'); ?>

                                        <?php echo $__env->yieldPushContent('purchase_price_th_start'); ?>
                                        <th class="col-md-2 action-column border-right-0 border-bottom-0"><?php echo e(trans('items.purchase_price')); ?></th>
                                        <?php echo $__env->yieldPushContent('purchase_price_th_end'); ?>

                                        <?php echo $__env->yieldPushContent('reorder_level_th_start'); ?>
                                        <th class="col-md-1 action-column border-right-0 border-bottom-0"><?php echo e(trans('inventory::items.reorder_level')); ?></th>
                                        <?php echo $__env->yieldPushContent('reorder_level_th_end'); ?>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php echo $__env->make('inventory::item-groups.item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <?php echo e(Form::radioGroup('enabled', trans('general.enabled'), true)); ?>

                </div>
            </div>

            <div class="card-footer">
                <div class="row save-buttons">
                    <?php echo e(Form::saveButtons('inventory.item-groups.index')); ?>

                </div>
            </div>
        <?php echo Form::close(); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script src="<?php echo e(asset('modules/Inventory/Resources/assets/js/item_groups.min.js?v=' . module_version('inventory'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\modules\Inventory\Providers/../Resources/views/item-groups/create.blade.php ENDPATH**/ ?>