<div class="col-md-3">
    <div class="card">
        <div class="card-header py-2">
            <h4 class="ml--3 mb-0 float-left">
                <a href="<?php echo e(route('apps.app.show', $module->slug)); ?>"><?php echo e($module->name); ?></a>
            </h4>

            <?php if(isset($installed[$module->slug])): ?>
                <?php $color = 'bg-green'; ?>

                <?php if(!$installed[$module->slug]): ?>
                    <?php $color = 'bg-warning'; ?>
                <?php endif; ?>

                <span class="mr--3 float-right">
                    <span class="badge <?php echo e($color); ?> text-white"><?php echo e(trans('modules.badge.installed')); ?></span>
                </span>
            <?php endif; ?>
        </div>

        <a href="<?php echo e(route('apps.app.show', $module->slug)); ?>">
            <?php $__currentLoopData = $module->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(($file->media_type == 'image') && ($file->pivot->zone == 'thumbnail')): ?>
                    <img src="<?php echo e($file->path_string); ?>" alt="<?php echo e($module->name); ?>" class="card-img-top border-radius-none">
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </a>

        <div class="card-footer py-2">
            <div class="float-left ml--3 mt--1">
                <?php for($i = 1; $i <= $module->vote; $i++): ?>
                    <i class="fa fa-star text-xs text-yellow"></i>
                <?php endfor; ?>

                <?php for($i = $module->vote; $i < 5; $i++): ?>
                    <i class="far fa-star text-xs"></i>
                <?php endfor; ?>

                <small class="text-xs">
                    <?php if($module->total_review): ?>
                      (<?php echo e($module->total_review); ?>)
                    <?php endif; ?>
                </small>
            </div>

            <div class="float-right mr--3">
                <small>
                    <strong>
                        <?php if($module->price == '0.0000'): ?>
                            <?php echo e(trans('modules.free')); ?>

                        <?php else: ?>
                            <?php echo $module->price_prefix; ?>

                        <?php if(isset($module->special_price)): ?>
                            <del class="text-danger"><?php echo e($module->price); ?></del>
                            <?php echo e($module->special_price); ?>

                        <?php else: ?>
                            <?php echo e($module->price); ?>

                        <?php endif; ?>
                            <?php echo $module->price_suffix; ?>

                        <?php endif; ?>
                    </strong>
                </small>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/modules/item.blade.php ENDPATH**/ ?>