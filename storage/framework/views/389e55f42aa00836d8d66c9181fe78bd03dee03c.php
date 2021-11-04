<div class="row">
    <?php echo $__env->yieldPushContent('row_footer_histories_start'); ?>
        <?php if(!$hideFooterHistories): ?>
            <div class="<?php echo e($classFooterHistories); ?>">
                <?php if (isset($component)) { $__componentOriginalf6a285a4879135f6d921b6832355265b526c51b0 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Show\Histories::class, ['type' => ''.e($type).'','document' => $document,'histories' => $histories,'textHistories' => ''.e($textHistories).'','textHistoryStatus' => ''.e($textHistoryStatus).'']); ?>
<?php $component->withName('documents.show.histories'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalf6a285a4879135f6d921b6832355265b526c51b0)): ?>
<?php $component = $__componentOriginalf6a285a4879135f6d921b6832355265b526c51b0; ?>
<?php unset($__componentOriginalf6a285a4879135f6d921b6832355265b526c51b0); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
            </div>
        <?php endif; ?>
    <?php echo $__env->yieldPushContent('row_footer_histories_end'); ?>

    <?php echo $__env->yieldPushContent('row_footer_transactions_start'); ?>
        <?php if(!$hideFooterTransactions): ?> 
            <div class="<?php echo e($classFooterTransactions); ?>">
                <?php if (isset($component)) { $__componentOriginala5dd47e2683a1082e869e2e14c8f9e582eab8fcc = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Show\Transactions::class, ['type' => ''.e($type).'','document' => $document,'transactions' => $transactions]); ?>
<?php $component->withName('documents.show.transactions'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginala5dd47e2683a1082e869e2e14c8f9e582eab8fcc)): ?>
<?php $component = $__componentOriginala5dd47e2683a1082e869e2e14c8f9e582eab8fcc; ?>
<?php unset($__componentOriginala5dd47e2683a1082e869e2e14c8f9e582eab8fcc); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
            </div>
        <?php endif; ?>
    <?php echo $__env->yieldPushContent('row_footer_transactions_end'); ?>
</div>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/documents/show/footer.blade.php ENDPATH**/ ?>