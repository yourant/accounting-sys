<div class="row" style="font-size: inherit !important">
    <?php echo $__env->yieldPushContent('header_status_start'); ?>
        <?php if(!$hideHeaderStatus): ?>
        <div class="<?php echo e($classHeaderStatus); ?>">
            <?php echo e(trans_choice('general.statuses', 1)); ?>

            <br>

            <strong>
                <span class="float-left">
                    <span class="badge badge-<?php echo e($document->status_label); ?>">
                        <?php echo e(trans($textHistoryStatus . $document->status)); ?>

                    </span>
                </span>
            </strong>
            <br><br>
        </div>
        <?php endif; ?>
    <?php echo $__env->yieldPushContent('header_status_end'); ?>

    <?php echo $__env->yieldPushContent('header_contact_start'); ?>
        <?php if(!$hideHeaderContact): ?>
        <div class="<?php echo e($classHeaderContact); ?>">
            <?php echo e(trans_choice($textHeaderContact, 1)); ?>

            <br>

            <strong>
                <span class="float-left">
                    <a href="<?php echo e(route($routeContactShow, $document->contact_id)); ?>">
                        <?php echo e($document->contact_name); ?>

                    </a>
                </span>
            </strong>
            <br><br>
        </div>
        <?php endif; ?>
    <?php echo $__env->yieldPushContent('header_contact_end'); ?>

    <?php echo $__env->yieldPushContent('header_amount_start'); ?>
        <?php if(!$hideHeaderAmount): ?>
        <div class="<?php echo e($classHeaderAmount); ?>">
            <?php echo e(trans($textHeaderAmount)); ?>

            <br>

            <strong>
                <span class="float-left">
                    <?php echo money($document->amount_due, $document->currency_code, true); ?>
                </span>
            </strong>
            <br><br>
        </div>
        <?php endif; ?>
    <?php echo $__env->yieldPushContent('header_amount_end'); ?>

    <?php echo $__env->yieldPushContent('header_due_at_start'); ?>
        <?php if(!$hideHeaderDueAt): ?>
        <div class="<?php echo e($classHeaderDueAt); ?>">
            <?php echo e(trans($textHeaderDueAt)); ?>

            <br>

            <strong>
                <span class="float-left">
                    <?php echo company_date($document->due_at); ?>
                </span>
            </strong>
            <br><br>
        </div>
        <?php endif; ?>
    <?php echo $__env->yieldPushContent('header_due_at_end'); ?>
</div>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/documents/show/header.blade.php ENDPATH**/ ?>