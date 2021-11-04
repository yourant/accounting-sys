<?php $__env->startSection('title', trans('print-template::general.title')); ?>

<?php $__env->startSection('new_button'); ?>
<span class="new-button"><a href="<?php echo e(route('print-template.settings.create')); ?>" class="btn btn-success btn-sm"><spanclass="fa fa-plus"></spanclass=> &nbsp;<?php echo e(trans('general.add_new')); ?></a></span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-md-12">
        <!-- Default card -->
        <div class="card card-success">
            <div class="card-header with-border">
                <h3 class="card-title"><?php echo e(trans('print-template::general.header_list')); ?></h3>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div id="delete-loading"></div>
                <div class="table-responsive">
                    <table class="table table-flush table-hover" id="tbl-items">
                        <thead class="thead-light">
                            <tr class="row table-head-line">
                                <th class="col-md-3 d-none d-sm-block"><?php echo e(trans('general.name')); ?></th>
                                <th class="col-md-3 d-none d-sm-block"><?php echo e(trans_choice('general.types',0)); ?></th>
                                <th class="col-md-3 d-none d-sm-block"><?php echo e(trans_choice('general.statuses',0)); ?></th>
                                <th class="col-md-3 text-center"><?php echo e(trans('general.actions')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(count($templates)): ?>
                            <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr id="method-<?php echo e($template->id); ?>" class="row align-items-center border-top-1">
                                <td class="col-md-3 d-none d-sm-block"><a
                                        href="<?php echo e(route('print-template.settings.show', $template->id)); ?>"><?php echo e($template->name); ?></a>
                                </td>
                                <td class="col-md-3 d-none d-sm-block">
                                    <?php echo e(trans('print-template::sablon.type.' . $template->type)); ?>


                                </td>
                                <td class="col-md-3 d-none d-sm-block">
                                    <?php if($template->enabled): ?>
                                    <span class="badge badge-pill badge-success"><?php echo e(trans('general.enabled')); ?></span>
                                    <?php else: ?>
                                    <span class="badge badge-pill badge-danger"><?php echo e(trans('general.disabled')); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="col-md-3 text-center">
                                    <div class="dropdown">
                                        <a class="btn btn-neutral btn-sm text-light items-align-center py-2" href="#"
                                            role="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="fa fa-ellipsis-h text-muted"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item"
                                                href="<?php echo e(route('print-template.settings.show' , $template->id)); ?>"><?php echo e(trans('general.show')); ?></a>

                                            <a class="dropdown-item"
                                                href="<?php echo e(route('print-template.settings.edit' , $template->id )); ?>"><?php echo e(trans('general.edit')); ?></a>

                                            <?php if($template->enabled): ?>
                                            <a class="dropdown-item"
                                                href="<?php echo e(route('print-template.settings.disable' , $template->id )); ?>"><?php echo e(trans('general.disable')); ?></a>
                                            <?php else: ?>
                                            <a class="dropdown-item"
                                                href="<?php echo e(route('print-template.settings.enable' , $template->id )); ?>"><?php echo e(trans('general.enable')); ?></a>
                                            <?php endif; ?>

                                            <div class="dropdown-divider"></div>

                                            <?php echo Form::deleteLink($template,'print-template.settings.delete','print-template::general.title'); ?>


                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                            <tr>
                                <td colspan="4">
                                    <a
                                        href="<?php echo e(route('print-template.settings.create')); ?>"><?php echo e(trans('print-template::general.list_empty')); ?></a>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
<script src="<?php echo e(asset('modules/PrintTemplate/Resources/assets/js/print-template.min.js?v=' . version('short'))); ?>">
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\modules\PrintTemplate\Providers/../Resources/views/index.blade.php ENDPATH**/ ?>