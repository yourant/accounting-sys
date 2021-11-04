
<div class="card">
    <div class="row align-items-center">
        <div class="col-xs-12 col-sm-6 text-center p-5">
            <img class="blank-image" src="<?php echo e(asset($imageEmptyPage)); ?>" alt="<?php echo $__env->yieldContent('title'); ?>"/>
        </div>

        <div class="col-xs-12 col-sm-6 text-center p-5">
            <p class="text-justify description">
                <?php echo trans($textEmptyPage); ?> <?php echo trans('general.empty.documentation', ['url' => $urlDocsPath]); ?>

            </p>

            <?php if($checkPermissionCreate): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($permissionCreate)): ?>
                    <a href="<?php echo e(route($createRoute)); ?>" class="btn btn-success float-right mt-4">
                        <span class="btn-inner--text"><?php echo e(trans('general.title.create', ['type' => trans_choice($textPage, 1)])); ?></span>
                    </a>
                <?php endif; ?>
            <?php else: ?>
                <a href="<?php echo e(route($createRoute)); ?>" class="btn btn-success float-right mt-4">
                    <span class="btn-inner--text"><?php echo e(trans('general.title.create', ['type' => trans_choice($textPage, 1)])); ?></span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/documents/index/empty-page.blade.php ENDPATH**/ ?>