<?php echo $__env->yieldPushContent('status_message_start'); ?>
<?php if($document->status == 'draft'): ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-danger fade show" role="alert">
                <?php echo $__env->yieldPushContent('status_message_body_start'); ?>
                    <span class="alert-text">
                        <strong><?php echo trans($textStatusMessage); ?></strong>
                    </span>
                <?php echo $__env->yieldPushContent('status_message_body_end'); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php echo $__env->yieldPushContent('status_message_end'); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/documents/show/status-message.blade.php ENDPATH**/ ?>