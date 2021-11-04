<?php $__env->startSection('title', trans_choice('general.settings',2)); ?>

<?php $__env->startSection('content'); ?>
    <div class="card shadow">
        <div class="card-body">
            <div class="row">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read-settings-company')): ?>
                    <div class="col-md-4">
                        <a href="<?php echo e(route('settings.company.edit')); ?>">
                            <button type="button" class="btn-icon-clipboard p-2">
                                <div class="row mx-0">
                                    <div class="col-auto">
                                        <div class="badge badge-secondary settings-icons">
                                            <i class="fa fa-building" ></i>
                                        </div>
                                    </div>
                                    <div class="col ml--2">
                                        <h4 class="mb-0"><?php echo e(trans_choice('general.companies', 1)); ?></h4>
                                        <p class="text-sm text-muted mb-0"><?php echo e(trans('settings.company.description')); ?></p>
                                    </div>
                                </div>
                            </button>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read-settings-localisation')): ?>
                    <div class="col-md-4">
                        <a href="<?php echo e(route('settings.localisation.edit')); ?>">
                            <button type="button" class="btn-icon-clipboard p-2">
                                <div class="row mx-0">
                                    <div class="col-auto">
                                        <div class="badge badge-secondary settings-icons">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                    </div>
                                    <div class="col ml--2">
                                        <h4 class="mb-0"><?php echo e(trans_choice('general.localisations', 1)); ?></h4>
                                        <p class="text-sm text-muted mb-0"><?php echo e(trans('settings.localisation.description')); ?></p>
                                    </div>
                                </div>
                            </button>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read-settings-invoice')): ?>
                    <div class="col-md-4">
                        <a href="<?php echo e(route('settings.invoice.edit')); ?>">
                            <button type="button" class="btn-icon-clipboard p-2">
                                <div class="row mx-0">
                                    <div class="col-auto">
                                        <div class="badge badge-secondary settings-icons">
                                            <i class="fas fa-file-alt"></i>
                                        </div>
                                    </div>
                                    <div class="col ml--2">
                                        <h4 class="mb-0"><?php echo e(trans_choice('general.invoices', 1)); ?></h4>
                                        <p class="text-sm text-muted mb-0"><?php echo e(trans('settings.invoice.description')); ?></p>
                                    </div>
                                </div>
                            </button>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read-settings-defaults')): ?>
                    <div class="col-md-4">
                        <a href="<?php echo e(route('settings.default.edit')); ?>">
                            <button type="button" class="btn-icon-clipboard p-2">
                                <div class="row mx-0">
                                    <div class="col-auto">
                                        <div class="badge badge-secondary settings-icons">
                                            <i class="fa fa-sliders-h"></i>
                                        </div>
                                    </div>
                                    <div class="col ml--2">
                                        <h4 class="mb-0"><?php echo e(trans_choice('general.defaults', 1)); ?></h4>
                                        <p class="text-sm text-muted mb-0"><?php echo e(trans('settings.default.description')); ?></p>
                                    </div>
                                </div>
                            </button>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read-settings-email')): ?>
                    <div class="col-md-4">
                        <a href="<?php echo e(route('settings.email.edit')); ?>">
                            <button type="button" class="btn-icon-clipboard p-2">
                                <div class="row mx-0">
                                    <div class="col-auto">
                                        <div class="badge badge-secondary settings-icons">
                                            <i class="fa fa-envelope"></i>
                                        </div>
                                    </div>
                                    <div class="col ml--2">
                                        <h4 class="mb-0"><?php echo e(trans('general.email')); ?></h4>
                                        <p class="text-sm text-muted mb-0"><?php echo e(trans('settings.email.description')); ?></p>
                                    </div>
                                </div>
                            </button>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read-settings-schedule')): ?>
                    <div class="col-md-4">
                        <a href="<?php echo e(route('settings.schedule.edit')); ?>">
                            <button type="button" class="btn-icon-clipboard p-2">
                                <div class="row mx-0">
                                    <div class="col-auto">
                                        <div class="badge badge-secondary settings-icons">
                                            <i class="fas fa-history"></i>
                                        </div>
                                    </div>
                                    <div class="col ml--2">
                                        <h4 class="mb-0"><?php echo e(trans('settings.scheduling.name')); ?></h4>
                                        <p class="text-sm text-muted mb-0"><?php echo e(trans('settings.scheduling.description')); ?></p>
                                    </div>
                                </div>
                            </button>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read-settings-categories')): ?>
                    <div class="col-md-4">
                        <a href="<?php echo e(route('categories.index')); ?>">
                            <button type="button" class="btn-icon-clipboard p-2">
                                <div class="row mx-0">
                                    <div class="col-auto">
                                        <div class="badge badge-secondary settings-icons">
                                            <i class="fa fa-folder"></i>
                                        </div>
                                    </div>
                                    <div class="col ml--2">
                                        <h4 class="mb-0"><?php echo e(trans_choice('general.categories', 2)); ?></h4>
                                        <p class="text-sm text-muted mb-0"><?php echo e(trans('settings.categories.description')); ?></p>
                                    </div>
                                </div>
                            </button>
                        </a>
                    </div>
                <?php endif; ?>


                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read-settings-currencies')): ?>
                    <div class="col-md-4">
                        <a href="<?php echo e(route('currencies.index')); ?>">
                            <button type="button" class="btn-icon-clipboard p-2">
                                <div class="row mx-0">
                                    <div class="col-auto">
                                        <div class="badge badge-secondary settings-icons">
                                            <i class="fa fa-dollar-sign"></i>
                                        </div>
                                    </div>
                                    <div class="col ml--2">
                                        <h4 class="mb-0"><?php echo e(trans_choice('general.currencies', 2)); ?></h4>
                                        <p class="text-sm text-muted mb-0"><?php echo e(trans('settings.currencies.description')); ?></p>
                                    </div>
                                </div>
                            </button>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('read-settings-taxes')): ?>
                    <div class="col-md-4">
                        <a href="<?php echo e(route('taxes.index')); ?>">
                            <button type="button" class="btn-icon-clipboard p-2">
                                <div class="row mx-0">
                                    <div class="col-auto">
                                        <div class="badge badge-secondary settings-icons">
                                            <i class="fas fa-percent"></i>
                                        </div>
                                    </div>
                                    <div class="col ml--2">
                                        <h4 class="mb-0"><?php echo e(trans_choice('general.taxes', 2)); ?></h4>
                                        <p class="text-sm text-muted mb-0"><?php echo e(trans('settings.taxes.description')); ?></p>
                                    </div>
                                </div>
                            </button>
                        </a>
                    </div>
                <?php endif; ?>

                <?php $__currentLoopData = $modules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4">
                        <a href="<?php echo e(url($module['url'])); ?>">
                            <button type="button" class="btn-icon-clipboard p-2">
                                <div class="row mx-0">
                                    <div class="col-auto">
                                        <div class="badge badge-secondary settings-icons">
                                            <i class="<?php echo e($module['icon']); ?>"></i>
                                        </div>
                                    </div>
                                    <div class="col ml--2">
                                        <h4 class="mb-0"><?php echo e($module['name']); ?></h4>
                                        <p class="text-sm text-muted mb-0"><?php echo e($module['description']); ?></p>
                                    </div>
                                </div>
                            </button>
                        </a>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script src="<?php echo e(asset('public/js/settings/settings.js?v=' . version('short'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/settings/settings/index.blade.php ENDPATH**/ ?>