<?php $__env->startSection('title', trans_choice('general.reports', 2)); ?>

<?php $__env->startSection('new_button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-common-reports')): ?>
        <a href="<?php echo e(route('reports.create')); ?>" class="btn btn-success btn-sm"><?php echo e(trans('general.add_new')); ?></a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row mb-4">
        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $reports): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-md-12">
                <h3><?php echo e($name); ?></h3>
            </div>

            <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-4">
                    <div class="card card-stats">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['create-common-reports', 'update-common-reports', 'delete-common-reports'])): ?>
                            <a class="btn btn-sm items-align-center py-2 mr-0 card-action-button shadow-none--hover" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v text-primary"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update-common-reports')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('reports.edit', $report->id)); ?>"><?php echo e(trans('general.edit')); ?></a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-common-reports')): ?>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo e(route('reports.duplicate', $report->id)); ?>"><?php echo e(trans('general.duplicate')); ?></a>
                                <?php endif; ?>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-common-reports')): ?>
                                    <div class="dropdown-divider"></div>
                                    <?php echo Form::deleteLink($report, 'reports.destroy'); ?>

                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <a href="<?php echo e(route('reports.show', $report->id)); ?>">
                                        <h5 class="card-title text-uppercase text-muted mb-0"><?php echo e($report->name); ?></h5>
                                    </a>

                                    <div class="d-flex align-items-center">
                                        <a href="<?php echo e(route('reports.show', $report->id)); ?>">
                                            <h2 class="font-weight-bold mb-0" v-if="reports_total[<?php echo e($report->id); ?>]" v-html="reports_total[<?php echo e($report->id); ?>]"></h2>
                                            <h2 class="font-weight-bold mb-0" v-else><?php echo e($totals[$report->id]); ?></h2>
                                        </a>
    
                                        <button type="button" @click="onRefreshTotal('<?php echo e($report->id); ?>')" class="btn btn-otline-primary btn-sm ml-2">
                                            <i class="fas fa-redo"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <a href="<?php echo e(route('reports.show', $report->id)); ?>">
                                        <div class="icon icon-shape bg-orange text-white rounded-circle shadow">
                                            <i class="<?php echo e($icons[$report->id]); ?>"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <p class="mt-3 mb-0 text-sm">
                                <a class="text-default" href="<?php echo e(route('reports.show', $report->id)); ?>">
                                    <span class="pre"><?php echo e($report->description); ?></span>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script type="text/javascript">
        var reports_total = <?php echo json_encode($totals); ?>;
    </script>

    <script src="<?php echo e(asset('public/js/common/reports.js?v=' . version('short'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/common/reports/index.blade.php ENDPATH**/ ?>