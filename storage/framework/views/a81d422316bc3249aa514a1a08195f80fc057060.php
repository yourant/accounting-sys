<?php if(!in_array($document->status, $hideTimelineStatuses)): ?>
<?php echo $__env->yieldPushContent('timeline_body_start'); ?>
    <div class="card">
        <div class="card-body">
            <div class="timeline timeline-one-side" data-timeline-content="axis" data-timeline-axis-style="dashed">
                <?php echo $__env->yieldPushContent('timeline_create_start'); ?>
                    <?php if(!$hideTimelineCreate): ?>
                        <div class="timeline-block">
                            <span class="timeline-step badge-primary">
                                <i class="fas fa-plus"></i>
                            </span>

                            <div class="timeline-content">
                                <?php echo $__env->yieldPushContent('timeline_create_head_start'); ?>
                                <h2 class="font-weight-500">
                                    <?php echo e(trans($textTimelineCreateTitle)); ?>

                                </h2>
                                <?php echo $__env->yieldPushContent('timeline_create_head_end'); ?>

                                <?php echo $__env->yieldPushContent('timeline_create_body_start'); ?>
                                    <?php echo $__env->yieldPushContent('timeline_create_body_message_start'); ?>
                                        <small>
                                            <?php echo e(trans_choice('general.statuses', 1) .  ':'); ?>

                                        </small>
                                        <small>
                                            <?php echo e(trans($textTimelineCreateMessage, ['date' => Date::parse($document->created_at)->format($date_format)])); ?>

                                        </small>
                                    <?php echo $__env->yieldPushContent('timeline_create_body_message_end'); ?>

                                    <div class="mt-3">
                                        <?php echo $__env->yieldPushContent('timeline_create_body_button_edit_start'); ?>
                                            <?php if(!$hideButtonEdit): ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($permissionUpdate)): ?>
                                                    <a href="<?php echo e(route($routeButtonEdit, $document->id)); ?>" class="btn btn-primary btn-sm btn-alone header-button-top">
                                                        <?php echo e(trans('general.edit')); ?>

                                                    </a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php echo $__env->yieldPushContent('timeline_create_body_button_edit_end'); ?>
                                    </div>
                                <?php echo $__env->yieldPushContent('timeline_create_body_end'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php echo $__env->yieldPushContent('timeline_create_end'); ?>

                <?php echo $__env->yieldPushContent('timeline_sent_start'); ?>
                    <?php if(!$hideTimelineSent): ?>
                        <div class="timeline-block">
                            <span class="timeline-step badge-danger">
                                <i class="far fa-envelope"></i>
                            </span>

                            <div class="timeline-content">
                                <?php echo $__env->yieldPushContent('timeline_sent_head_start'); ?>
                                    <h2 class="font-weight-500">
                                        <?php echo e(trans($textTimelineSentTitle)); ?>

                                    </h2>
                                <?php echo $__env->yieldPushContent('timeline_sent_head_end'); ?>

                                <?php echo $__env->yieldPushContent('timeline_sent_body_start'); ?>
                                    <?php if($document->status != 'sent' && $document->status != 'partial' && $document->status != 'viewed' && $document->status != 'received'): ?>
                                        <?php echo $__env->yieldPushContent('timeline_sent_body_message_start'); ?>
                                            <small>
                                                <?php echo e(trans_choice('general.statuses', 1) . ':'); ?>

                                            </small>
                                            <small>
                                                <?php echo e(trans($textTimelineSentStatusDraft)); ?>

                                            </small>
                                        <?php echo $__env->yieldPushContent('timeline_sent_body_message_end'); ?>

                                        <div class="mt-3">
                                            <?php echo $__env->yieldPushContent('timeline_sent_body_button_sent_start'); ?>
                                                <?php if(!$hideButtonSent): ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($permissionUpdate)): ?>
                                                        <?php if($document->status == 'draft'): ?>
                                                            <a href="<?php echo e(route($routeButtonSent, $document->id)); ?>" class="btn btn-white btn-sm header-button-top">
                                                                <?php echo e(trans($textTimelineSentStatusMarkSent)); ?>

                                                            </a>
                                                        <?php else: ?>
                                                            <button type="button" class="btn btn-secondary btn-sm header-button-top" disabled="disabled">
                                                                <?php echo e(trans($textTimelineSentStatusMarkSent)); ?>

                                                            </button>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php echo $__env->yieldPushContent('timeline_sent_body_button_sent_end'); ?>

                                            <?php echo $__env->yieldPushContent('timeline_receive_body_button_received_start'); ?>
                                                <?php if(!$hideButtonReceived): ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($permissionUpdate)): ?>
                                                        <?php if($document->status == 'draft'): ?>
                                                            <a href="<?php echo e(route($routeButtonReceived, $document->id)); ?>" class="btn btn-danger btn-sm btn-alone header-button-top">
                                                                <?php echo e(trans($textTimelineSentStatusReceived)); ?>

                                                            </a>
                                                        <?php else: ?>
                                                            <button type="button" class="btn btn-secondary btn-sm header-button-top" disabled="disabled">
                                                                <?php echo e(trans($textTimelineSentStatusReceived)); ?>

                                                            </button>
                                                        <?php endif; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php echo $__env->yieldPushContent('timeline_receive_body_button_received_end'); ?>
                                    <?php elseif($document->status == 'viewed'): ?>
                                        <?php echo $__env->yieldPushContent('timeline_viewed_invoice_body_message_start'); ?>
                                            <small><?php echo e(trans_choice('general.statuses', 1) . ':'); ?></small>
                                            <small><?php echo e(trans('invoices.messages.status.viewed')); ?></small>
                                        <?php echo $__env->yieldPushContent('timeline_viewed_invoice_body_message_end'); ?>
                                    <?php elseif($document->status == 'received'): ?>
                                        <?php echo $__env->yieldPushContent('timeline_receive_bill_body_message_start'); ?>
                                            <small><?php echo e(trans_choice('general.statuses', 1) .  ':'); ?></small>
                                            <small><?php echo e(trans('bills.messages.status.receive.received', ['date' => Date::parse($document->received_at)->format($date_format)])); ?></small>
                                        <?php echo $__env->yieldPushContent('timeline_receive_bill_body_message_end'); ?>
                                    <?php else: ?>
                                        <?php echo $__env->yieldPushContent('timeline_sent_body_message_start'); ?>
                                            <small><?php echo e(trans_choice('general.statuses', 1) . ':'); ?></small>
                                            <small><?php echo e(trans('invoices.messages.status.send.sent', ['date' => Date::parse($document->sent_at)->format($date_format)])); ?></small>
                                        <?php echo $__env->yieldPushContent('timeline_sent_body_message_end'); ?>
                                    <?php endif; ?>

                                    <?php if(!($document->status != 'sent' && $document->status != 'partial' && $document->status != 'viewed' && $document->status != 'received')): ?>
                                    <div class="mt-3">
                                    <?php endif; ?>

                                    <?php echo $__env->yieldPushContent('timeline_sent_body_button_email_start'); ?>
                                        <?php if(!$hideButtonEmail): ?>
                                            <?php if($document->contact_email): ?>
                                                <a href="<?php echo e(route($routeButtonEmail, $document->id)); ?>" class="btn btn-danger btn-sm header-button-top">
                                                    <?php echo e(trans($textTimelineSendStatusMail)); ?>

                                                </a>
                                            <?php else: ?>
                                                <el-tooltip content="<?php echo e(trans('invoices.messages.email_required')); ?>" placement="top">
                                                    <button type="button" class="btn btn-danger btn-sm btn-tooltip disabled header-button-top">
                                                        <?php echo e(trans($textTimelineSendStatusMail)); ?>

                                                    </button>
                                                </el-tooltip>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php echo $__env->yieldPushContent('timeline_sent_body_button_email_end'); ?>

                                    <?php echo $__env->yieldPushContent('timeline_sent_body_button_share_start'); ?>
                                        <?php if(!$hideButtonShare): ?>
                                            <?php if($document->status != 'cancelled'): ?>
                                                <a href="<?php echo e($signedUrl); ?>" target="_blank" class="btn btn-white btn-sm header-button-top">
                                                    <?php echo e(trans('general.share')); ?>

                                                </a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    <?php echo $__env->yieldPushContent('timeline_sent_body_button_share_end'); ?>

                                    </div>

                                <?php echo $__env->yieldPushContent('timeline_sent_body_end'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php echo $__env->yieldPushContent('timeline_sent_end'); ?>

                <?php echo $__env->yieldPushContent('timeline_get_paid_start'); ?>
                    <?php if(!$hideTimelinePaid): ?>
                        <div class="timeline-block">
                            <span class="timeline-step badge-success">
                                <i class="far fa-money-bill-alt"></i>
                            </span>

                            <div class="timeline-content">
                                <?php echo $__env->yieldPushContent('timeline_get_paid_head_start'); ?>
                                    <h2 class="font-weight-500">
                                        <?php echo e(trans($textTimelineGetPaidTitle)); ?>

                                    </h2>
                                <?php echo $__env->yieldPushContent('timeline_get_paid_head_end'); ?>

                                <?php echo $__env->yieldPushContent('timeline_get_paid_body_start'); ?>
                                    <?php echo $__env->yieldPushContent('timeline_get_paid_body_message_start'); ?>
                                        <?php if($document->status != 'paid' && empty($document->transactions->count())): ?>
                                            <small>
                                                <?php echo e(trans_choice('general.statuses', 1) . ':'); ?>

                                            </small>
                                            <small>
                                                <?php echo e(trans($textTimelineGetPaidStatusAwait)); ?>

                                            </small>
                                        <?php else: ?>
                                            <small>
                                                <?php echo e(trans_choice('general.statuses', 1) . ':'); ?>

                                            </small>
                                            <small>
                                                <?php echo e(trans($textTimelineGetPaidStatusPartiallyPaid)); ?>

                                            </small>
                                        <?php endif; ?>
                                    <?php echo $__env->yieldPushContent('timeline_get_paid_body_message_end'); ?>

                                    <div class="mt-3">
                                        <?php echo $__env->yieldPushContent('timeline_get_paid_body_button_pay_start'); ?>
                                            <?php if(!$hideButtonPaid): ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($permissionUpdate)): ?>
                                                    <a href="<?php echo e(route($routeButtonPaid, $document->id)); ?>" class="btn btn-white btn-sm header-button-top">
                                                        <?php echo e(trans($textTimelineGetPaidMarkPaid)); ?>

                                                    </a>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php echo $__env->yieldPushContent('timeline_get_paid_body_button_pay_end'); ?>

                                        <?php echo $__env->yieldPushContent('timeline_get_paid_body_button_payment_start'); ?>
                                            <?php if(!$hideButtonAddPayment): ?>
                                                <?php if(empty($document->transactions->count()) || (!empty($document->transactions->count()) && $document->paid != $document->amount)): ?>
                                                    <button @click="onPayment" id="button-payment" class="btn btn-success btn-sm header-button-bottom">
                                                        <?php echo e(trans($textTimelineGetPaidAddPayment)); ?>

                                                    </button>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php echo $__env->yieldPushContent('timeline_get_paid_body_button_payment_end'); ?>
                                    </div>
                                <?php echo $__env->yieldPushContent('timeline_get_paid_body_end'); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php echo $__env->yieldPushContent('timeline_get_paid_end'); ?>
            </div>
        </div>
    </div>
<?php echo $__env->yieldPushContent('timeline_body_end'); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/documents/show/timeline.blade.php ENDPATH**/ ?>