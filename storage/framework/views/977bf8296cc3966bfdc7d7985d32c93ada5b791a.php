<?php $__env->startSection('title', trans('general.title.edit', ['type' => trans_choice('custom-fields::general.fields', 1)])); ?>

<?php $__env->startSection('content'); ?>
    <!-- Default box -->
    <?php echo Form::model($field, [
        'method' => 'PATCH',
        'route' => ['custom-fields.fields.update', $field->id],
        'id' => 'field',
        '@submit.prevent' => 'onSubmit',
        '@keydown' => 'form.errors.clear($event.target.name)',
        'files' => true,
        'role' => 'form',
        'class' => 'form-loading-button',
        'novalidate' => true
    ]); ?>

    <div class="card">
        <div class="card-box">
            <div class="card-body">
                <div class="row">
                <?php echo e(Form::textGroup('name', trans('custom-fields::general.form.name'), 'id-card-o', ['required' => 'required', 'autofocus' => 'autofocus'])); ?>

                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

    <div class="card">
        <div class="card-box">
            <div class="card-body">
                <div class="row">
                    <?php echo e(Form::selectGroup('type_id', trans_choice('general.types', 1), 'bars', $types, $field->type_id, ['change' => 'onChangeType','required' => 'required'])); ?>


                    <?php echo e(Form::multiSelectGroup('rule', trans('custom-fields::general.form.rule'), 'check-square-o', $validation_rules, $selected_validation_rules, [])); ?>


                    <template v-if="can_type === 'values'">
                        <div id="option-values" class="form-group col-md-12 hidden">
                            <?php echo Form::label('items', trans('custom-fields::general.form.items'), ['class' => 'control-label']); ?>

                            <div class="table-responsive">
                                <table class="table table-bordered" id="items">
                                    <thead class="thead-light">
                                        <tr class="row">
                                            <th class="col-md-2 border-bottom-0 border-right-0"><?php echo e(trans('general.actions')); ?></th>
                                            <th class="col-md-10"><?php echo e(trans('custom-fields::general.form.value')); ?></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr class="row" v-for="(row, index) in items" :index="index">
                                            <td class="col-md-2 border-bottom-0 border-right-0">
                                                <button type="button"
                                                    @click="onDeleteItem(index)"
                                                    data-toggle="tooltip"
                                                    title="<?php echo e(trans('general.delete')); ?>"
                                                    class="btn btn-icon btn-outline-danger btn-lg"><i class="fa fa-trash"></i>
                                                </button>

                                            </td>
                                            <td class="col-md-10 border-bottom-0">
                                                <input value=""
                                                class="form-control"
                                                data-item="values"
                                                required="required"
                                                name="values[]"
                                                v-model="row.values"
                                                value="row.values"
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

                            <div class="invalid-feedback d-block"
                                v-if="<?php echo e('form.errors.has("' . 'items' . '")'); ?>"
                                v-html="<?php echo e('form.errors.get("' . 'items' . '")'); ?>">
                            </div>
                        </div>
                    </template>

                    <template v-else-if="can_type === 'value'">
                            <?php echo e(Form::textGroup('value', trans('custom-fields::general.form.value'), 'code', [])); ?>

                    </template>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-box">
            <div class="card-body">
                <div class="row">
                <?php echo e(Form::selectGroup('location_id', trans_choice('custom-fields::general.locations', 1), 'map', $locations, $field->location_id, ['change'=> 'onChangeLocation', 'required'=>'required'])); ?>


                <?php echo e(Form::selectGroup('sort', trans('custom-fields::general.sort'), 'map', $sort_values, $field->sort, ['change'=> 'onChangeSort', 'required' => 'required', 'dynamicOptions' => 'sorts', 'disabled' => 'disabled.sort'], 'col-md-3')); ?>


                <?php echo e(Form::selectGroup('order', trans('custom-fields::general.order'), 'sort', $orders, $field->order, ['required' => 'required', 'dynamicOptions' => 'orders', 'disabled' => 'disabled.order'], 'col-md-3')); ?>

                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-box">
            <div class="card-body">
                <div class="row">
                <?php echo e(Form::textGroup('icon', trans('custom-fields::general.form.icon'), 'picture-o')); ?>


                <?php echo e(Form::textGroup('class', trans('custom-fields::general.form.class'), 'paint-brush')); ?>


                <?php echo e(Form::selectGroup('show', trans('custom-fields::general.show'), 'eye', $shows ,$field->show)); ?>

                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-box">
            <div class="card-body">
                <div class="row">
                    <?php echo e(Form::radioGroup('enabled', trans('general.enabled'), $field->enabled)); ?>

                </div>
            </div>
        </div>
    </div>

    <?php if (app('laratrust')->isAbleTo('update-custom-fields-fields')) : ?>
    <div class="card">
        <div class="card-footer">
            <div class="row float-right">
                <?php echo e(Form::saveButtons('custom-fields.fields.index')); ?>

            </div>
        </div>
    </div>
    <?php endif; // app('laratrust')->permission ?>

    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>,
    <script type="text/javascript">
        var field_values = <?php echo json_encode($custom_field_values); ?>;
        var view = <?php echo json_encode($view); ?>;
        var edit_sorts = <?php echo json_encode($sort_values); ?>;
        var orders = <?php echo json_encode($orders); ?>;
        var field_location_id = <?php echo json_encode($field->location_id); ?>;
        var field_sort = <?php echo json_encode($field->sort); ?>;
    </script>

    <script src="<?php echo e(asset('modules/CustomFields/Resources/assets/js/custom-fields-fields.min.js?v=' . version('short'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\modules\CustomFields\Providers/../Resources/views/fields/edit.blade.php ENDPATH**/ ?>