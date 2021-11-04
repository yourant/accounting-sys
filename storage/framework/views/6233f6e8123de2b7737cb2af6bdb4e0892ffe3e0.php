<?php $__env->startSection('title', trans('custom-fields::general.name')); ?>

<?php $__env->startSection('new_button'); ?>
<?php if (app('laratrust')->isAbleTo('create-custom-fields-fields')) : ?>
<span class="new-button"><a href="<?php echo e(route('custom-fields.fields.create')); ?>" class="btn btn-success btn-sm"><span class="fa fa-plus"></span> &nbsp;<?php echo e(trans('general.add_new')); ?></a></span>
<?php endif; // app('laratrust')->permission ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!-- Default box -->
<div class="card">
         <div class="card-header border-bottom-0" v-bind:class="[bulk_action.show ? 'bg-gradient-primary' : '']">
            <?php echo Form::open([
                'route' => 'custom-fields.fields.index',
                'role' => 'form',
                'method' => 'GET',
                'class' => 'mb-0'
            ]); ?>

                <div class="align-items-center" v-if="!bulk_action.show">
                    <?php if (isset($component)) { $__componentOriginaldec57d2dc7c3b62478d574f9a4a67fba694d4f23 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\SearchString::class, ['model' => 'Modules\CustomFields\Models\Field']); ?>
<?php $component->withName('search-string'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginaldec57d2dc7c3b62478d574f9a4a67fba694d4f23)): ?>
<?php $component = $__componentOriginaldec57d2dc7c3b62478d574f9a4a67fba694d4f23; ?>
<?php unset($__componentOriginaldec57d2dc7c3b62478d574f9a4a67fba694d4f23); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                </div>

                <?php echo e(Form::bulkActionRowGroup('custom-fields::general.name', $bulk_actions, ['group' => 'custom-fields', 'type' => 'fields'])); ?>

            <?php echo Form::close(); ?>

        </div>
        <!-- /.box-header -->

        <div class="table-responsive">
            <table class="table table-flush table-hover" id="tbl-custom-fields">
                <thead class="thead-light">
                    <tr class="row table-head-line">
                        <th class="col-sm-2 col-md-1 col-lg-1 col-xl-1 d-none d-sm-block"><?php echo e(Form::bulkActionAllGroup()); ?></th>
                        <th class="col-md-3"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('name', trans_choice('general.name', 1)));?></th>
                        <th class="col-md-3"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('location.name', trans_choice('custom-fields::general.locations', 1)));?></th>
                        <th class="col-md-2"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('type.name', trans_choice('general.types', 1)));?></th>
                        <th class="col-md-2"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('enabled', trans('general.enabled')));?></th>
                        <th class="col-md-1 text-center"><?php echo e(trans('general.actions')); ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $custom_fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="row align-items-center border-top-1">
                        <td class="col-sm-2 col-md-1 col-lg-1 col-xl-1 d-none d-sm-block"><?php echo e(Form::bulkActionGroup($item->id, $item->type->name )); ?></td>
                        <td class="col-md-3"><a href="<?php echo e(route('custom-fields.fields.edit', $item->id)); ?>"><?php echo e($item->name); ?></a></td>
                        <td class="col-md-3"><?php echo e($item->location->name); ?></td>
                        <td class="col-md-2"><?php echo e($item->type->name); ?></td>
                        <td class="col-md-2">
                            <?php if(user()->can('update-custom-fields-fields')): ?>
                                <?php echo e(Form::enabledGroup($item->id, $item->name, $item->enabled)); ?>

                            <?php else: ?>
                                <?php if($item->enabled): ?>
                                    <badge rounded type="success" class="mw-60"><?php echo e(trans('general.yes')); ?></badge>
                                <?php else: ?>
                                    <badge rounded type="danger" class="mw-60"><?php echo e(trans('general.no')); ?></badge>
                                <?php endif; ?>
                            <?php endif; ?>
                        </td>
                        <td class="col-xs-4 col-sm-3 col-md-2 col-lg-1 col-xl-1 text-center border-0">
                            <div class="dropdown">
                                <a class="btn btn-neutral btn-sm text-light items-align-center p-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-h text-muted"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                    <?php if (app('laratrust')->isAbleTo('update-custom-fields-fields')) : ?>
                                    <a class="dropdown-item" href="<?php echo e(route('custom-fields.fields.edit', $item->id)); ?>"><?php echo e(trans('general.edit')); ?></a>
                                    <?php endif; // app('laratrust')->permission ?>
                                    <?php if (app('laratrust')->isAbleTo('create-custom-fields-fields')) : ?>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo e(route('custom-fields.fields.duplicate', $item->id)); ?>"><?php echo e(trans('general.duplicate')); ?></a>
                                    <?php endif; // app('laratrust')->permission ?>
                                    <?php if (app('laratrust')->isAbleTo('delete-custom-fields-fields')) : ?>
                                    <div class="dropdown-divider"></div>
                                    <?php echo Form::deleteLink($item, 'custom-fields.fields.destroy', 'custom-fields::general.name'); ?>

                                    <?php endif; // app('laratrust')->permission ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <!-- /.card -->

    <div class="card-footer table-action">
        <div class="row align-items-center">
            <?php echo $__env->make('partials.admin.pagination', ['items' => $custom_fields, 'type' => 'custom_fields', 'title' => trans('custom-fields::general.title')], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>
    <!-- /.box-footer -->
</div>
<!-- /.box -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script src="<?php echo e(asset('modules/CustomFields/Resources/assets/js/custom-fields-fields.min.js?v=' . version('short'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\modules\CustomFields\Providers/../Resources/views/fields/index.blade.php ENDPATH**/ ?>