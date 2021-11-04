<?php $__env->startSection('title', trans('print-template::general.title')); ?>

<?php $__env->startSection('content'); ?>
<!-- Default card -->
<div class="card ">
    <div class="card-header with-border">
        <h3 class="card-title"><?php echo e(trans('print-template::general.header_create')); ?></h3>
        <!-- /.card-tools -->
    </div>
    <!-- /.card-header -->
    <?php echo Form::open([
    'id' => 'print-template',
    'route' => 'print-template.settings.store',
    '@submit.prevent' => 'onSubmit',
    '@keydown' => 'form.errors.clear($event.target.name)',
    'files' => true,
    'role' => 'form',
    'class' => 'form-loading-button',
    'novalidate' => true,
    ]); ?>

    <div class="card-body">
        <div class="row">
            <?php echo e(Form::textGroup('name', trans('print-template::general.form.name'), 'barcode', ['required' => 'required'])); ?>

            <?php echo e(Form::selectGroup('type', trans_choice('print-template::general.form.type', 1), 'file', $type,null)); ?>

            <?php echo e(Form::selectGroup('pagesize', trans_choice('print-template::general.form.pagesize', 1), 'font', $pagesize)); ?>

            <?php echo e(Form::fileGroup('attachment', trans('print-template::general.form.attachment'),null, ['required' => 'required'])); ?>

            <?php echo e(Form::radioGroup('enabled', trans('general.enabled'),1)); ?>

            <?php echo e(Form::radioGroup('printBackground', trans('print-template::general.printBackground'),0)); ?>

        </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <div class="row save-buttons">
            <?php echo e(Form::saveButtons('settings/print-template')); ?>

        </div>
    </div>
    <!-- /.card-footer -->

    <?php echo Form::close(); ?>


</div>
<!-- /.card -->
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
<script src="<?php echo e(asset('modules/PrintTemplate/Resources/assets/js/print-template.min.js?v=' . version('short'))); ?>">
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\modules\PrintTemplate\Providers/../Resources/views/create.blade.php ENDPATH**/ ?>