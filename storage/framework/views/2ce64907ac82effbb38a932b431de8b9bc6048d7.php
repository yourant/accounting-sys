<?php $__env->startSection('title', trans('general.title.new', ['type' => trans_choice('inventory::general.options', 1)])); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <?php echo Form::open([
            'route' => 'inventory.options.store',
            'id' => 'option',
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


                    <?php echo e(Form::selectGroupGroup('type', trans_choice('general.types', 1), 'exchange-alt', $types, null ,['change' => 'onTypeChange'])); ?>


                    <div v-if="can_type" class="row col-md-12">
                        <div id="option-values" class="form-group col-md-12 hidden">
                            <?php echo Form::label('items', trans('inventory::options.values'), ['class' => 'control-label']); ?>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="items">
                                    <thead class="thead-light">
                                        <tr class="row">
                                            <th class="col-md-2"><?php echo e(trans('general.actions')); ?></th>
                                            <th class="col-md-10"><?php echo e(trans('general.name')); ?></th>
                                        </tr>
                                    </thead>

                                            <tbody>
                                        <tr class="row" v-for="(row, index) in form.items" :index="index">
                                            <td class="col-md-2">
                                                <button type="button"
                                                    @click="onDeleteItem(index)"
                                                    data-toggle="tooltip"
                                                    title="<?php echo e(trans('general.delete')); ?>"
                                                    class="btn btn-icon btn-outline-danger btn-lg"><i class="fa fa-trash"></i>
                                                </button>

                                                    </td>
                                            <td class="col-md-10">
                                                <input value=""
                                                class="form-control"
                                                data-item="name"
                                                required="required"
                                                name="items[][name]"
                                                v-model="row.name"
                                                type="text"
                                                autocomplete="off">
                                            </td>
                                        </tr>

                                        <tr id="addItem"        >
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

                    <?php echo e(Form::radioGroup('enabled', trans('general.enabled'), true)); ?>

                </div>
            </div>

            <div class="card-footer">
                <div class="row save-buttons">
                    <?php echo e(Form::saveButtons('inventory.options.index')); ?>

                </div>
            </div>
        <?php echo Form::close(); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script type="text/javascript">
        var option_items = false;
    </script>

    <script src="<?php echo e(asset('modules/Inventory/Resources/assets/js/options.min.js?v=' . module_version('inventory'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\modules\Inventory\Providers/../Resources/views/options/create.blade.php ENDPATH**/ ?>