<?php $__env->startSection('title', trans('general.title.edit', ['type' => trans_choice('general.roles', 1)])); ?>

<?php $__env->startSection('content'); ?>
    <?php echo Form::model($role, [
        'id' => 'role',
        'method' => 'PATCH',
        'route' => ['roles.update', $role->id],
        '@submit.prevent' => 'onSubmit',
        '@keydown' => 'form.errors.clear($event.target.name)',
        'files' => true,
        'role' => 'form',
        'class' => 'form-loading-button',
        'novalidate' => true,
    ]); ?>


        <div class="card">
            <div class="card-body">
                <div class="row">
                    <?php echo e(Form::textGroup('display_name', trans('general.name'), 'font')); ?>


                    <?php echo e(Form::textGroup('name', trans('general.code'), 'code')); ?>


                    <?php echo e(Form::textareaGroup('description', trans('general.description'))); ?>

                </div>
            </div>
        </div>

        <div id="role-permissions">
            <label for="permissions" class="form-control-label d-block"><?php echo e(trans_choice('general.permissions', 2)); ?></label>
            <span class="btn btn-outline-primary btn-sm" @click="permissionSelectAll"><?php echo e(trans('general.select_all')); ?></span>
            <span class="btn btn-outline-primary btn-sm" @click="permissionUnselectAll"><?php echo e(trans('general.unselect_all')); ?></span>

            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $active_action_tab = ($action == 'read') ? 'active' : ''; ?>
                        <li class="nav-item">
                            <a class="nav-link mb-sm-3 mb-md-0 <?php echo e($active_action_tab); ?>" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tab-<?php echo e($action); ?>" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><?php echo e(ucwords($action)); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="tab-content">
                        <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action => $action_permissions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $active_action_tab = ($action == 'read') ? 'active' : ''; ?>
                            <div class="tab-pane fade show <?php echo e($active_action_tab); ?>" id="tab-<?php echo e($action); ?>" ref="tab-<?php echo e($action); ?>" role="tabpanel">
                                <span class="btn btn-primary btn-sm" @click="select('<?php echo e($action); ?>')"><?php echo e(trans('general.select_all')); ?></span>
                                <span class="btn btn-primary btn-sm" @click="unselect('<?php echo e($action); ?>')"><?php echo e(trans('general.unselect_all')); ?></span>

                                <?php echo $__env->yieldPushContent('permissions_input_start'); ?>

                                <div class="form-group <?php echo e($errors->has('permissions') ? 'has-error' : ''); ?>">
                                    <div class="row pt-4">
                                        <?php $__currentLoopData = $action_permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-4 role-list">
                                                <div class="custom-control custom-checkbox">
                                                    <?php if(($item->name == 'read-admin-panel')): ?>
                                                        <?php echo e(Form::checkbox('permissions', $item->id, null, ['id' => 'permissions-' . $item->id, 'class' => 'custom-control-input', 'v-model' => 'form.permissions', ':disabled' => 'form.permissions.includes(permissions.read_client_portal)'])); ?>

                                                    <?php elseif(($item->name == 'read-client-portal')): ?>
                                                        <?php echo e(Form::checkbox('permissions', $item->id, null, ['id' => 'permissions-' . $item->id, 'class' => 'custom-control-input', 'v-model' => 'form.permissions', ':disabled' => 'form.permissions.includes(permissions.read_admin_panel)'])); ?>

                                                    <?php else: ?>
                                                        <?php echo e(Form::checkbox('permissions', $item->id, null, ['id' => 'permissions-' . $item->id, 'class' => 'custom-control-input', 'v-model' => 'form.permissions'])); ?>

                                                    <?php endif; ?>

                                                    <label class="custom-control-label" for="permissions-<?php echo e($item->id); ?>">
                                                        <?php echo e($item->title); ?>

                                                    </label>
                                                </div>
                                            </div>

                                            <?php if(($item->name == 'read-admin-panel') || ($item->name == 'read-client-portal')): ?>
                                                <?php echo e(Form::hidden($item->name, $item->id, ['id' => $item->name])); ?>

                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php echo $errors->first('permissions', '<p class="help-block">:message</p>'); ?>

                                    </div>
                                </div>

                                <?php echo $__env->yieldPushContent('permissions_input_end'); ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update-auth-roles')): ?>
                    <div class="card-footer">
                        <div class="row save-buttons">
                            <?php echo e(Form::saveButtons('roles.index')); ?>

                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script src="<?php echo e(asset('public/js/auth/roles.js?v=' . version('short'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/auth/roles/edit.blade.php ENDPATH**/ ?>