<?php echo $__env->yieldPushContent('recurring_message_start'); ?>
<?php if(($recurring = $document->recurring) && ($next = $recurring->getNextRecurring())): ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-info fade show" role="alert">
                <div class="d-flex">
                    <?php echo $__env->yieldPushContent('recurring_message_head_start'); ?>
                        <h5 class="mt-0 text-white"><strong><?php echo e(trans('recurring.recurring')); ?></strong></h5>
                    <?php echo $__env->yieldPushContent('recurring_message_head_end'); ?>
                </div>

                <?php echo $__env->yieldPushContent('recurring_message_body_start'); ?>
                    <p class="text-sm lh-160 mb-0"><?php echo e(trans('recurring.message', [
                        'type' => mb_strtolower(trans_choice($textRecurringType, 1)),
                        'date' => $next->format($date_format)
                    ])); ?>

                    </p>
                <?php echo $__env->yieldPushContent('recurring_message_body_end'); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php echo $__env->yieldPushContent('recurring_message_end'); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/documents/show/recurring-message.blade.php ENDPATH**/ ?>