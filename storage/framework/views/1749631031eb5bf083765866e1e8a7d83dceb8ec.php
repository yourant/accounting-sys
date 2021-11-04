<?php $__env->startSection('title', trans_choice('general.vendors', 2)); ?>

<?php $__env->startSection('new_button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-purchases-vendors')): ?>
        <a href="<?php echo e(route('vendors.create')); ?>" class="btn btn-success btn-sm"><?php echo e(trans('general.add_new')); ?></a>
        <a href="<?php echo e(route('import.create', ['group' => 'purchases', 'type' => 'vendors'])); ?>" class="btn btn-white btn-sm"><?php echo e(trans('import.import')); ?></a>
    <?php endif; ?>
    <a href="<?php echo e(route('vendors.export', request()->input())); ?>" class="btn btn-white btn-sm"><?php echo e(trans('general.export')); ?></a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($vendors->count() || request()->get('search', false)): ?>
        <div class="card">
            <div class="card-header border-bottom-0" :class="[{'bg-gradient-primary': bulk_action.show}]">
                <?php echo Form::open([
                    'method' => 'GET',
                    'route' => 'vendors.index',
                    'role' => 'form',
                    'class' => 'mb-0'
                ]); ?>

                    <div class="align-items-center" v-if="!bulk_action.show">
                        <?php if (isset($component)) { $__componentOriginaldec57d2dc7c3b62478d574f9a4a67fba694d4f23 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\SearchString::class, ['model' => 'App\Models\Common\Contact']); ?>
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

                    <?php echo e(Form::bulkActionRowGroup('general.vendors', $bulk_actions, ['group' => 'purchases', 'type' => 'vendors'])); ?>

                <?php echo Form::close(); ?>

            </div>

            <div class="table-responsive">
                <table class="table table-flush table-hover">
                    <thead class="thead-light">
                        <tr class="row table-head-line">
                            <th class="col-sm-2 col-md-1 col-lg-1 col-xl-1 d-none d-sm-block"><?php echo e(Form::bulkActionAllGroup()); ?></th>
                            <th class="col-xs-4 col-sm-3 col-md-4 col-lg-3 col-xl-3"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('name', trans('general.name'), ['filter' => 'active, visible'], ['class' => 'col-aka', 'rel' => 'nofollow']));?></th>
                            <th class="col-md-3 col-lg-3 col-xl-3 d-none d-md-block"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('email', trans('general.email')));?></th>
                            <th class="col-lg-2 col-xl-2 d-none d-lg-block text-right"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('unpaid', trans('general.unpaid')));?></th>
                            <th class="col-xs-4 col-sm-2 col-md-2 col-lg-2 col-xl-2 text-center"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('enabled', trans('general.enabled')));?></th>
                            <th class="col-xs-4 col-sm-2 col-md-2 col-lg-1 col-xl-1 text-center"><?php echo e(trans('general.actions')); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $vendors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="row align-items-center border-top-1">
                                <td class="col-sm-2 col-md-1 col-lg-1 col-xl-1 d-none d-sm-block">
                                    <?php echo e(Form::bulkActionGroup($item->id, $item->name)); ?>

                                </td>
                                <td class="col-xs-4 col-sm-3 col-md-4 col-lg-3 col-xl-3">
                                    <a class="col-aka long-texts d-block" href="<?php echo e(route('vendors.show', $item->id)); ?>"><?php echo e($item->name); ?></a>
                                </td>
                                <td class="col-md-3 col-lg-3 col-xl-3 d-none d-md-block long-texts">
                                    <el-tooltip content="<?php echo e(!empty($item->phone) ? $item->phone : trans('general.na')); ?>"
                                        effect="dark"
                                        placement="top">
                                        <span><?php echo e(!empty($item->email) ? $item->email : trans('general.na')); ?></span>
                                    </el-tooltip>
                                </td>
                                <td class="col-lg-2 col-xl-2 d-none d-lg-block text-right long-texts">
                                    <?php echo money($item->unpaid, setting('default.currency'), true); ?>
                                </td>
                                <td class="col-xs-4 col-sm-2 col-md-2 col-lg-2 col-xl-2 text-center">
                                    <?php if(user()->can('update-purchases-vendors')): ?>
                                        <?php echo e(Form::enabledGroup($item->id, $item->name, $item->enabled)); ?>

                                    <?php else: ?>
                                        <?php if($item->enabled): ?>
                                            <badge rounded type="success" class="mw-60 d-inline-block"><?php echo e(trans('general.yes')); ?></badge>
                                        <?php else: ?>
                                            <badge rounded type="danger" class="mw-60 d-inline-block"><?php echo e(trans('general.no')); ?></badge>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                                <td class="col-xs-4 col-sm-2 col-md-2 col-lg-1 col-xl-1 text-center">
                                    <div class="dropdown">
                                        <a class="btn btn-neutral btn-sm text-light items-align-center py-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h text-muted"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <a class="dropdown-item" href="<?php echo e(route('vendors.show', $item->id)); ?>"><?php echo e(trans('general.show')); ?></a>
                                                
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-purchases-vendors')): ?>
                                                <a class="dropdown-item" href="<?php echo e(route('vendors.edit', $item->id)); ?>"><?php echo e(trans('general.edit')); ?></a>
                                            <?php endif; ?>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-purchases-vendors')): ?>
                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item" href="<?php echo e(route('vendors.duplicate', $item->id)); ?>"><?php echo e(trans('general.duplicate')); ?></a>
                                            <?php endif; ?>
                                            
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-purchases-vendors')): ?>
                                                <div class="dropdown-divider"></div>
                                                <?php echo Form::deleteLink($item, 'vendors.destroy'); ?>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <div class="card-footer table-action">
                <div class="row">
                    <?php echo $__env->make('partials.admin.pagination', ['items' => $vendors], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <?php if (isset($component)) { $__componentOriginald468e2fade69e67273028f1262ac2cab98f9a730 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\EmptyPage::class, ['group' => 'purchases','page' => 'vendors']); ?>
<?php $component->withName('empty-page'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginald468e2fade69e67273028f1262ac2cab98f9a730)): ?>
<?php $component = $__componentOriginald468e2fade69e67273028f1262ac2cab98f9a730; ?>
<?php unset($__componentOriginald468e2fade69e67273028f1262ac2cab98f9a730); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script src="<?php echo e(asset('public/js/purchases/vendors.js?v=' . version('short'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/purchases/vendors/index.blade.php ENDPATH**/ ?>