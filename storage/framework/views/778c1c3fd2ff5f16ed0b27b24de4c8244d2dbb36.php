<?php if(!$hideBulkAction): ?>
    <div class="card-header border-bottom-0" :class="[{'bg-gradient-primary': bulk_action.show}]">
        <?php echo Form::open([
            'method' => 'GET',
            'route' => $formCardHeaderRoute,
            'role' => 'form',
            'class' => 'mb-0'
        ]); ?>

            <?php if(!$hideSearchString): ?>
                <div class="align-items-center" v-if="!bulk_action.show">
                    <?php if (isset($component)) { $__componentOriginaldec57d2dc7c3b62478d574f9a4a67fba694d4f23 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\SearchString::class, ['model' => ''.e($searchStringModel).'']); ?>
<?php $component->withName('search-string'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginaldec57d2dc7c3b62478d574f9a4a67fba694d4f23)): ?>
<?php $component = $__componentOriginaldec57d2dc7c3b62478d574f9a4a67fba694d4f23; ?>
<?php unset($__componentOriginaldec57d2dc7c3b62478d574f9a4a67fba694d4f23); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                </div>
            <?php endif; ?>

            <?php echo e(Form::bulkActionRowGroup($textBulkAction, $bulkActions, $bulkActionRouteParameters)); ?>

        <?php echo Form::close(); ?>

    </div>
<?php else: ?> 
    <?php if(!$hideSearchString): ?>
        <div class="card-header border-bottom-0">
            <?php echo Form::open([
                'method' => 'GET',
                'route' => $formCardHeaderRoute,
                'role' => 'form',
                'class' => 'mb-0'
            ]); ?>

                <div class="align-items-center">
                    <?php if (isset($component)) { $__componentOriginaldec57d2dc7c3b62478d574f9a4a67fba694d4f23 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\SearchString::class, ['model' => ''.e($searchStringModel).'']); ?>
<?php $component->withName('search-string'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginaldec57d2dc7c3b62478d574f9a4a67fba694d4f23)): ?>
<?php $component = $__componentOriginaldec57d2dc7c3b62478d574f9a4a67fba694d4f23; ?>
<?php unset($__componentOriginaldec57d2dc7c3b62478d574f9a4a67fba694d4f23); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                </div>
            <?php echo Form::close(); ?>

        </div>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/documents/index/card-header.blade.php ENDPATH**/ ?>