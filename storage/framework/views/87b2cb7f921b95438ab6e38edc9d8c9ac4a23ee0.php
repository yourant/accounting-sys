<?php $__env->startSection('title', trans_choice('general.users', 2)); ?>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-auth-users')): ?>
    <?php $__env->startSection('new_button'); ?>
        <a href="<?php echo e(route('users.create')); ?>" class="btn btn-success btn-sm"><?php echo e(trans('general.add_new')); ?></a>
    <?php $__env->stopSection(); ?>
<?php endif; ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header border-bottom-0" :class="[{'bg-gradient-primary': bulk_action.show}]">

                <div class="align-items-center" v-if="!bulk_action.show">
                    <?php if (isset($component)) { $__componentOriginaldec57d2dc7c3b62478d574f9a4a67fba694d4f23 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\SearchString::class, ['model' => 'App\Models\Auth\User']); ?>
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

                <?php echo e(Form::bulkActionRowGroup('general.users', $bulk_actions, ['group' => 'auth', 'type' => 'users'])); ?>

        </div>

        <div class="table-responsive">
            <table class="table table-flush table-hover">
                <thead class="thead-light">
                    <tr class="row table-head-line">
                        <th class="col-sm-2 col-md-2 col-lg-1 d-none d-sm-block"><?php echo e(Form::bulkActionAllGroup()); ?></th>
                        <th class="col-xs-4 col-sm-3 col-md-2 col-lg-3"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('name', trans('general.name'), ['filter' => 'active, visible'], ['class' => 'col-aka', 'rel' => 'nofollow']));?></th>
                        <th class="col-sm-2 col-md-2 col-lg-3 d-none d-sm-block long-texts"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('email', trans('general.email')));?></th>
                        <th class="col-md-2 col-lg-2 d-none d-md-block"><?php echo e(trans_choice('general.roles', 2)); ?></th>
                        <th class="col-xs-4 col-sm-3 col-md-2 col-lg-2"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('enabled', trans('general.enabled')));?></th>
                        <th class="col-xs-4 col-sm-2 col-md-2 col-lg-1 text-center"><?php echo e(trans('general.actions')); ?></th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="row align-items-center border-top-1">
                            <td class="col-sm-2 col-md-2 col-lg-1 d-none d-sm-block">
                                <?php if(user()->id != $item->id): ?>
                                    <?php echo e(Form::bulkActionGroup($item->id, $item->name)); ?>

                                <?php else: ?>
                                    <?php echo e(Form::bulkActionGroup($item->id, $item->name, ['disabled' => 'true'])); ?>

                                <?php endif; ?>
                            </td>
                            <td class="col-xs-4 col-sm-3 col-md-2 col-lg-3">
                                <a class="col-aka" href="<?php echo e(route('users.edit', $item->id)); ?>">
                                    <?php if(setting('default.use_gravatar', '0') == '1'): ?>
                                        <img src="<?php echo e($item->picture); ?>" alt="<?php echo e($item->name); ?>" class="rounded-circle user-img p-1 mr-3 d-none d-md-inline" title="<?php echo e($item->name); ?>">
                                    <?php elseif(is_object($item->picture)): ?>
                                        <img src="<?php echo e(Storage::url($item->picture->id)); ?>" class="rounded-circle user-img p-1 mr-3 d-none d-md-inline" alt="<?php echo e($item->name); ?>" title="<?php echo e($item->name); ?>">
                                    <?php else: ?>
                                        <img src="<?php echo e(asset('public/img/user.svg')); ?>" class="user-img p-1 mr-3 d-none d-md-inline" alt="<?php echo e($item->name); ?>"/>
                                    <?php endif; ?>
                                    <?php echo e($item->name); ?>

                                </a>
                            </td>
                            <td class="col-sm-2 col-md-2 col-lg-3 d-none d-sm-block long-texts"><?php echo e($item->email); ?></td>
                            <td class="col-md-2 col-lg-2 d-none d-md-block">
                                <?php $__currentLoopData = $item->roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="label label-default"><?php echo e($role->display_name); ?></label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                            <td class="col-xs-4 col-sm-3 col-md-2 col-lg-2">
                                <?php if((user()->id != $item->id) && user()->can('update-auth-users')): ?>
                                    <?php echo e(Form::enabledGroup($item->id, $item->name, $item->enabled)); ?>

                                <?php else: ?>
                                    <?php if($item->enabled): ?>
                                        <badge rounded type="success" class="mw-60"><?php echo e(trans('general.yes')); ?></badge>
                                    <?php else: ?>
                                        <badge rounded type="danger" class="mw-60"><?php echo e(trans('general.no')); ?></badge>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td class="col-xs-4 col-sm-2 col-md-2 col-lg-1 text-center">
                                <div class="dropdown">
                                    <a class="btn btn-neutral btn-sm text-light items-align-center py-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h text-muted"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                        <a class="dropdown-item" href="<?php echo e(route('users.edit', $item->id)); ?>"><?php echo e(trans('general.edit')); ?></a>
                                        <?php if(user()->id != $item->id): ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-auth-users')): ?>
                                                <div class="dropdown-divider"></div>
                                                <?php echo Form::deleteLink($item, 'users.destroy'); ?>

                                            <?php endif; ?>
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
                <?php echo $__env->make('partials.admin.pagination', ['items' => $users], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script src="<?php echo e(asset('public/js/auth/users.js?v=' . version('short'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/auth/users/index.blade.php ENDPATH**/ ?>