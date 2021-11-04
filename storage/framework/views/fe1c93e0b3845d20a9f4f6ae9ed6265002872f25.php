<?php $__env->startSection('title', trans('import.title', ['type' => $title_type])); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <?php echo Form::open($form_params); ?>


            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-warning alert-important">
                            <?php echo trans('import.limitations', ['extensions' => strtoupper(config('excel.imports.extensions')), 'row_limit' => config('excel.imports.row_limit')]); ?>

                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="alert alert-info alert-important">
                            <?php echo trans('import.sample_file', ['download_link' => $sample_file]); ?>

                        </div>
                    </div>

                    <?php echo e(Form::fileGroup('import', '', 'plus', ['dropzone-class' => 'form-file', 'options' => ['acceptedFiles' => '.xls,.xlsx']], null, 'col-md-12')); ?>

                </div>
            </div>

            <div class="card-footer">
                <div class="row save-buttons">
                    <div class="col-xs-12 col-sm-12">
                        <?php if(!empty($route)): ?>
                            <a href="<?php echo e(route(\Str::replaceFirst('.import', '.index', $route))); ?>" class="btn btn-outline-secondary">
                                <?php echo e(trans('general.cancel')); ?>

                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(url($path)); ?>" class="btn btn-outline-secondary">
                                <?php echo e(trans('general.cancel')); ?>

                            </a>
                        <?php endif; ?>

                        <?php echo Form::button(
                            '<span v-if="form.loading" class="btn-inner--icon"><i class="aka-loader"></i></span> <span :class="[{\'ml-0\': form.loading}]" class="btn-inner--text">' . trans('import.import') . '</span>',
                            [':disabled' => 'form.loading', 'type' => 'submit', 'class' => 'btn btn-icon btn-success']); ?>

                    </div>
                </div>
            </div>

        <?php echo Form::close(); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script src="<?php echo e(asset('public/js/common/imports.js?v=' . version('short'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/common/import/create.blade.php ENDPATH**/ ?>