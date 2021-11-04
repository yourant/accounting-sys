<?php echo $__env->yieldPushContent('navbar_start'); ?>
<nav class="navbar navbar-top navbar-expand navbar-dark border-bottom">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <?php echo $__env->yieldPushContent('navbar_search'); ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read-common-search')): ?>
                <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('common.search', [])->html();
} elseif ($_instance->childHasBeenRendered('2ou23Vx')) {
    $componentId = $_instance->getRenderedChildComponentId('2ou23Vx');
    $componentTag = $_instance->getRenderedChildComponentTagName('2ou23Vx');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('2ou23Vx');
} else {
    $response = \Livewire\Livewire::mount('common.search', []);
    $html = $response->html();
    $_instance->logRenderedChild('2ou23Vx', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
            <?php endif; ?>

            <ul class="navbar-nav align-items-center ml-md-auto">
                <li class="nav-item d-xl-none">
                    <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </li>

                <?php echo $__env->yieldPushContent('navbar_create'); ?>

                <li class="nav-item d-sm-none">
                    <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                        <i class="fa fa-search"></i>
                    </a>
                </li>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['create-sales-invoices', 'create-sales-revenues', 'create-sales-invoices', 'create-purchases-bills', 'create-purchases-payments', 'create-purchases-vendors'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-plus"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-dark dropdown-menu-right">
                            <div class="row shortcuts px-4">
                                <?php echo $__env->yieldPushContent('navbar_create_invoice'); ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-sales-invoices')): ?>
                                    <a href="<?php echo e(route('invoices.create')); ?>" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-info">
                                        <i class="fa fa-money-bill"></i>
                                        </span>
                                        <small class="text-info"><?php echo e(trans_choice('general.invoices', 1)); ?></small>
                                    </a>
                                <?php endif; ?>

                                <?php echo $__env->yieldPushContent('navbar_create_revenue'); ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-sales-revenues')): ?>
                                    <a href="<?php echo e(route('revenues.create')); ?>" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-info">
                                            <i class="fas fa-hand-holding-usd"></i>
                                        </span>
                                        <small class="text-info"><?php echo e(trans_choice('general.revenues', 1)); ?></small>
                                    </a>
                                <?php endif; ?>

                                <?php echo $__env->yieldPushContent('navbar_create_customer'); ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-sales-customers')): ?>
                                    <a href="<?php echo e(route('customers.create')); ?>" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-info">
                                        <i class="fas fa-user"></i>
                                        </span>
                                        <small class="text-info"><?php echo e(trans_choice('general.customers', 1)); ?></small>
                                    </a>
                                <?php endif; ?>

                                <?php echo $__env->yieldPushContent('navbar_create_bill'); ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-purchases-bills')): ?>
                                    <a href="<?php echo e(route('bills.create')); ?>" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-danger">
                                        <i class="fa fa-shopping-cart"></i>
                                        </span>
                                        <small class="text-danger"><?php echo e(trans_choice('general.bills', 1)); ?></small>
                                    </a>
                                <?php endif; ?>

                                <?php echo $__env->yieldPushContent('navbar_create_payment'); ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-purchases-payments')): ?>
                                    <a href="<?php echo e(route('payments.create')); ?>" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-danger">
                                            <i class="fas fa-hand-holding-usd"></i>
                                        </span>
                                        <small class="text-danger"><?php echo e(trans_choice('general.payments', 1)); ?></small>
                                    </a>
                                <?php endif; ?>

                                <?php echo $__env->yieldPushContent('navbar_create_vendor_start'); ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-purchases-vendors')): ?>
                                    <a href="<?php echo e(route('vendors.create')); ?>" class="col-4 shortcut-item">
                                        <span class="shortcut-media avatar rounded-circle bg-gradient-danger">
                                        <i class="fas fa-user"></i>
                                        </span>
                                        <small class="text-danger"><?php echo e(trans_choice('general.vendors', 1)); ?></small>
                                    </a>
                                <?php endif; ?>

                                <?php echo $__env->yieldPushContent('navbar_create_vendor_end'); ?>
                            </div>
                        </div>
                    </li>
                <?php endif; ?>

                <?php echo $__env->yieldPushContent('navbar_notifications'); ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read-common-notifications')): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="display: none;">
                            <span>
                                <i class="far fa-bell"></i>
                            </span>
                            <?php if($notifications): ?>
                                <span class="badge badge-md badge-circle badge-reminder badge-warning"><?php echo e($notifications); ?></span>
                            <?php endif; ?>
                        </a>

                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right py-0 overflow-hidden">
                            <?php if($notifications): ?>
                                <div class="p-3">
                                    <a class="text-sm text-muted"><?php echo e(trans_choice('header.notifications.counter', $notifications, ['count' => $notifications])); ?></a>
                                </div>
                            <?php endif; ?>

                            <div class="list-group list-group-flush" display="hidden">
                                <?php echo $__env->yieldPushContent('notification_new_apps_start'); ?>

                                <?php if(!empty($new_apps) && count($new_apps)): ?>
                                    <a href="<?php echo e(route('notifications.index') . '#new-apps'); ?>" class="list-group-item list-group-item-action">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <i class="fa fa-rocket"></i>
                                            </div>
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h4 class="mb-0 text-sm"><?php echo e(trans_choice('header.notifications.new_apps', count($new_apps), ['count' => count($new_apps)])); ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php endif; ?>

                                <?php echo $__env->yieldPushContent('notification_new_apps_end'); ?>

                                <?php echo $__env->yieldPushContent('notification_exports_completed_start'); ?>

                                <?php if(!empty($exports['completed']) && count($exports['completed'])): ?>
                                    <a href="<?php echo e(route('notifications.index') . '#exports'); ?>" class="list-group-item list-group-item-action">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <i class="fas fa-file-export"></i>
                                            </div>
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h4 class="mb-0 text-sm"><?php echo e(trans_choice('header.notifications.exports.completed', count($exports['completed']), ['count' => count($exports['completed'])])); ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php endif; ?>

                                <?php echo $__env->yieldPushContent('notification_exports_completed_end'); ?>

                                <?php echo $__env->yieldPushContent('notification_exports_failed_start'); ?>

                                <?php if(!empty($exports['failed']) && count($exports['failed'])): ?>
                                    <a href="<?php echo e(route('notifications.index') . '#exports'); ?>" class="list-group-item list-group-item-action">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <i class="fas fa-file-export"></i>
                                            </div>
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h4 class="mb-0 text-sm"><?php echo e(trans_choice('header.notifications.exports.failed', count($exports['failed']), ['count' => count($exports['failed'])])); ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php endif; ?>

                                <?php echo $__env->yieldPushContent('notification_exports_failed_end'); ?>

                                <?php echo $__env->yieldPushContent('notification_imports_completed_start'); ?>

                                <?php if(!empty($imports['completed']) && count($imports['completed'])): ?>
                                    <a href="<?php echo e(route('notifications.index') . '#imports'); ?>" class="list-group-item list-group-item-action">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <i class="fas fa-file-import"></i>
                                            </div>
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h4 class="mb-0 text-sm"><?php echo e(trans_choice('header.notifications.imports.completed', count($imports['completed']), ['count' => count($imports['completed'])])); ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php endif; ?>

                                <?php echo $__env->yieldPushContent('notification_imports_completed_end'); ?>

                                <?php echo $__env->yieldPushContent('notification_imports_failed_start'); ?>

                                <?php if(!empty($imports['failed']) && count($imports['failed'])): ?>
                                    <a href="<?php echo e(route('notifications.index') . '#imports'); ?>" class="list-group-item list-group-item-action">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <i class="fas fa-file-import"></i>
                                            </div>
                                            <div class="col ml--2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <h4 class="mb-0 text-sm"><?php echo e(trans_choice('header.notifications.imports.failed', count($imports['failed']), ['count' => count($imports['failed'])])); ?></h4>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php endif; ?>

                                <?php echo $__env->yieldPushContent('notification_imports_failed_end'); ?>

                                <?php echo $__env->yieldPushContent('notification_bills_start'); ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read-purchases-bills')): ?>
                                    <?php if(count($bills)): ?>
                                        <a href="<?php echo e(route('notifications.index') . '#reminder-bill'); ?>" class="list-group-item list-group-item-action">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </div>
                                                <div class="col ml--2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h4 class="mb-0 text-sm"><?php echo e(trans_choice('header.notifications.upcoming_bills', count($bills), ['count' => count($bills)])); ?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php echo $__env->yieldPushContent('notification_bills_end'); ?>

                                <?php echo $__env->yieldPushContent('notification_invoices_start'); ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read-sales-invoices')): ?>
                                    <?php if(count($invoices)): ?>
                                        <a href="<?php echo e(route('notifications.index') . '#reminder-invoice'); ?>" class="list-group-item list-group-item-action">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <i class="fa fa-money-bill"></i>
                                                </div>
                                                <div class="col ml--2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <h4 class="mb-0 text-sm"><?php echo e(trans_choice('header.notifications.overdue_invoices', count($invoices), ['count' => count($invoices)])); ?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php echo $__env->yieldPushContent('notification_invoices_end'); ?>
                            </div>

                            <?php if($notifications): ?>
                                <a href="<?php echo e(route('notifications.index')); ?>" class="dropdown-item text-center text-primary font-weight-bold py-3"><?php echo e(trans('header.notifications.view_all')); ?></a>
                            <?php else: ?>
                                <a class="dropdown-item text-center text-primary font-weight-bold py-3"><?php echo e(trans_choice('header.notifications.counter', $notifications, ['count' => $notifications])); ?></a>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endif; ?>

                <?php echo $__env->yieldPushContent('navbar_updates'); ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read-install-updates')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo e(route('updates.index')); ?>" title="<?php echo e($updates); ?> Updates Available" role="button" aria-haspopup="true" aria-expanded="false" style="display:none;">
                            <span>
                                <i class="fa fa-sync-alt"></i>
                            </span>
                            <?php if($updates): ?>
                                <span class="badge badge-md badge-circle badge-update badge-warning"><?php echo e($updates); ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                <?php endif; ?>

                <?php echo $__env->yieldPushContent('navbar_help_start'); ?>

                <li class="nav-item d-none d-md-block">
                    <a class="nav-link" href="<?php echo e(url(trans('header.support_link'))); ?>" target="_blank" title="<?php echo e(trans('general.help')); ?>" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="far fa-life-ring" style="display:none;"></i>
                    </a>
                </li>

                <?php echo $__env->yieldPushContent('navbar_help_end'); ?>
            </ul>

            <?php echo $__env->yieldPushContent('navbar_profile'); ?>

            <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <div class="media align-items-center">
                            <?php if(setting('default.use_gravatar', '0') == '1'): ?>
                                <img src="<?php echo e($user->picture); ?>" alt="<?php echo e($user->name); ?>" class="rounded-circle image-style user-img" title="<?php echo e($user->name); ?>">
                            <?php elseif(is_object($user->picture)): ?>
                                <img src="<?php echo e(Storage::url($user->picture->id)); ?>" class="rounded-circle image-style user-img" alt="<?php echo e($user->name); ?>" title="<?php echo e($user->name); ?>">
                            <?php else: ?>
                                <img src="<?php echo e(asset('public/img/user.svg')); ?>" class="user-img" alt="<?php echo e($user->name); ?>"/>
                            <?php endif; ?>
                            <?php if(!empty($user->name)): ?>
                                <div class="media-body ml-2 d-none d-lg-block">
                                    <span class="mb-0 text-sm font-weight-bold"><?php echo e($user->name); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <?php echo $__env->yieldPushContent('navbar_profile_welcome'); ?>

                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0"><?php echo e(trans('general.welcome')); ?></h6>
                        </div>

                        <?php echo $__env->yieldPushContent('navbar_profile_edit'); ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['read-auth-users', 'read-auth-profile'])): ?>
                            <a href="<?php echo e(route('users.edit', $user->id)); ?>" class="dropdown-item">
                                <i class="fas fa-user"></i>
                                <span><?php echo e(trans('auth.profile')); ?></span>
                            </a>
                        <?php endif; ?>
                        
                        <?php echo $__env->yieldPushContent('navbar_profile_edit_end'); ?>

                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['read-auth-users', 'read-auth-roles', 'read-auth-permissions'])): ?>
                            <div class="dropdown-divider"></div>

                            <?php echo $__env->yieldPushContent('navbar_profile_users'); ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read-auth-users')): ?>
                                <a href="<?php echo e(route('users.index')); ?>" class="dropdown-item">
                                    <i class="fas fa-users"></i>
                                    <span><?php echo e(trans_choice('general.users', 2)); ?></span>
                                </a>
                            <?php endif; ?>

                            <?php echo $__env->yieldPushContent('navbar_profile_roles'); ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read-auth-roles')): ?>
                                <a href="<?php echo e(route('roles.index')); ?>" class="dropdown-item">
                                    <i class="fas fa-list"></i>
                                    <span><?php echo e(trans_choice('general.roles', 2)); ?></span>
                                </a>
                            <?php endif; ?>

                            <?php echo $__env->yieldPushContent('navbar_profile_permissions_start'); ?>

                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read-auth-permissions')): ?>
                                <a href="<?php echo e(route('permissions.index')); ?>" class="dropdown-item">
                                    <i class="fas fa-key"></i>
                                    <span><?php echo e(trans_choice('general.permissions', 2)); ?></span>
                                </a>
                            <?php endif; ?>

                            <?php echo $__env->yieldPushContent('navbar_profile_permissions_end'); ?>
                        <?php endif; ?>

                        <div class="dropdown-divider"></div>

                        <?php echo $__env->yieldPushContent('navbar_profile_logout_start'); ?>

                        <a href="<?php echo e(route('logout')); ?>" class="dropdown-item">
                            <i class="fas fa-power-off"></i>
                            <span><?php echo e(trans('auth.logout')); ?></span>
                        </a>

                        <?php echo $__env->yieldPushContent('navbar_profile_logout_end'); ?>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php echo $__env->yieldPushContent('navbar_end'); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/admin/navbar.blade.php ENDPATH**/ ?>