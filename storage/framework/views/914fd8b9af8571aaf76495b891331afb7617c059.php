<?php $__env->startSection('title', trans_choice('inventory::general.warehouses', 2)); ?>

<?php $__env->startSection('new_button'); ?>
    <?php if (app('laratrust')->isAbleTo('create-inventory-warehouses')) : ?>
        <span><a href="<?php echo e(route('inventory.warehouses.create')); ?>" class="btn btn-success btn-sm header-button-top"><?php echo e(trans('general.add_new')); ?></a></span>
        <span><a href="<?php echo e(route('import.create', ['inventory', 'warehouses'])); ?>" class="btn btn-white btn-sm header-button-top"><?php echo e(trans('import.import')); ?></a></span>
    <?php endif; // app('laratrust')->permission ?>
    <span><a href="<?php echo e(route('inventory.warehouses.export', request()->input())); ?>" class="btn btn-white btn-sm header-button-top"><?php echo e(trans('general.export')); ?></a></span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header border-bottom-0" :class="[{'bg-gradient-primary': bulk_action.show}]">
            <?php echo Form::open([
                'method' => 'GET',
                'route' => 'inventory.warehouses.index',
                'role' => 'form',
                'class' => 'mb-0'
            ]); ?>

                <div class="align-items-center" v-if="!bulk_action.show">
                    <?php if (isset($component)) { $__componentOriginaldec57d2dc7c3b62478d574f9a4a67fba694d4f23 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\SearchString::class, ['model' => 'Modules\Inventory\Models\Warehouse']); ?>
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

                <?php echo e(Form::bulkActionRowGroup('inventory::general.warehouses', $bulk_actions, ['group' => 'inventory', 'type' => 'warehouses'])); ?>

            <?php echo Form::close(); ?>

        </div>

        <div class="table-responsive">
            <table class="table table-flush table-hover">
                <thead class="thead-light">
                    <tr class="row table-head-line">
                        <th class="col-sm-2 col-md-1 col-lg-1 col-xl-1 hidden-sm"><?php echo e(Form::bulkActionAllGroup()); ?></th>
                        <th class="col-md-4"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('name', trans('general.name')));?></th>
                        <th class="col-md-3 hidden-xs"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('email', trans('general.email')));?></th>
                        <th class="col-md-2"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('phone', trans('general.phone')));?></th>
                        <th class="col-md-1 hidden-xs"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('enabled', trans('general.enabled')));?></th>
                        <th class="col-md-1 text-center"><?php echo e(trans('general.actions')); ?></th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__currentLoopData = $warehouses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="row align-items-center border-top-1">
                            <td class="col-sm-2 col-md-1 col-lg-1 col-xl-1 hidden-sm border-0"><?php echo e(Form::bulkActionGroup($item->id, $item->name)); ?></td>
                            <td class="col-md-4 border-0"><a href="<?php echo e(route('inventory.warehouses.show', $item->id)); ?>"><?php echo e($item->name); ?></a></td>
                            <td class="col-md-3 hidden-xs border-0"><?php echo e(!empty($item->email) ? $item->email : trans('general.na')); ?></td>
                            <td class="col-md-2 border-0"><?php echo e($item->phone); ?></td>
                            <td class="col-md-1 hidden-xs border-0">
                                <?php if(user()->can('update-inventory-warehouses')): ?>
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
                                        <a class="dropdown-item" href="<?php echo e(route('inventory.warehouses.show', $item->id)); ?>"><?php echo e(trans('general.show')); ?></a>
                                        <a class="dropdown-item" href="<?php echo e(route('inventory.warehouses.edit', $item->id)); ?>"><?php echo e(trans('general.edit')); ?></a>
                                        <?php if (app('laratrust')->isAbleTo('create-inventory-warehouses')) : ?>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="<?php echo e(route('inventory.warehouses.duplicate', $item->id)); ?>"><?php echo e(trans('general.duplicate')); ?></a>
                                        <?php endif; // app('laratrust')->permission ?>
                                        <?php if (app('laratrust')->isAbleTo('delete-inventory-warehouses')) : ?>
                                            <div class="dropdown-divider"></div>
                                            <?php echo Form::deleteLink($item, 'inventory.warehouses.destroy'); ?>

                                        <?php endif; // app('laratrust')->permission ?>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="card-footer table-action">
            <div class="row align-items-center">
                <?php echo $__env->make('partials.admin.pagination', ['items' => $warehouses, 'type' => 'warehouses'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script src="<?php echo e(asset('modules/Inventory/Resources/assets/js/warehouses.min.js?v=' . module_version('inventory'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\modules\Inventory\Providers/../Resources/views/warehouses/index.blade.php ENDPATH**/ ?>