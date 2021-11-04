<?php if($checkPermissionCreate): ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($permissionCreate)): ?>
        <?php if(!$hideCreate): ?>
            <a href="<?php echo e(route($createRoute)); ?>" class="btn btn-success btn-sm"><?php echo e(trans('general.add_new')); ?></a>
        <?php endif; ?>

        <?php if(!$hideImport): ?>
            <a href="<?php echo e(route($importRoute, $importRouteParameters)); ?>" class="btn btn-white btn-sm"><?php echo e(trans('import.import')); ?></a>
        <?php endif; ?>
    <?php endif; ?>
<?php else: ?>
    <?php if(!$hideCreate): ?>
        <a href="<?php echo e(route($createRoute)); ?>" class="btn btn-success btn-sm"><?php echo e(trans('general.add_new')); ?></a>
    <?php endif; ?>

    <?php if(!$hideImport): ?>
        <a href="<?php echo e(route($importRoute, $importRouteParameters)); ?>" class="btn btn-white btn-sm"><?php echo e(trans('import.import')); ?></a>
    <?php endif; ?>
<?php endif; ?>

<?php if(!$hideExport): ?>
    <a href="<?php echo e(route($exportRoute, request()->input())); ?>" class="btn btn-white btn-sm"><?php echo e(trans('general.export')); ?></a>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/documents/index/top-buttons.blade.php ENDPATH**/ ?>