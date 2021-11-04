<?php echo $__env->yieldPushContent('content_header_start'); ?>
<?php if(!$hideHeader): ?>
    <?php if (isset($component)) { $__componentOriginal423fee4a6910172f4a7c907ec7d3b91058a5d428 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Show\Header::class, ['type' => ''.e($type).'','document' => $document,'hideHeaderStatus' => ''.e($hideHeaderStatus).'','textHistoryStatus' => ''.e($textHistoryStatus).'','classHeaderStatus' => ''.e($classHeaderStatus).'','hideHeaderContact' => ''.e($hideHeaderContact).'','textHeaderContact' => ''.e($textHeaderContact).'','classHeaderContact' => ''.e($classHeaderContact).'','routeContactShow' => ''.e($routeContactShow).'','hideHeaderAmount' => ''.e($hideHeaderAmount).'','textHeaderAmount' => ''.e($textHeaderAmount).'','classHeaderAmount' => ''.e($classHeaderAmount).'','hideHeaderDueAt' => ''.e($hideHeaderDueAt).'','textHeaderDueAt' => ''.e($textHeaderDueAt).'','classHeaderDueAt' => ''.e($classHeaderDueAt).'']); ?>
<?php $component->withName('documents.show.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal423fee4a6910172f4a7c907ec7d3b91058a5d428)): ?>
<?php $component = $__componentOriginal423fee4a6910172f4a7c907ec7d3b91058a5d428; ?>
<?php unset($__componentOriginal423fee4a6910172f4a7c907ec7d3b91058a5d428); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php endif; ?>
<?php echo $__env->yieldPushContent('content_header_end'); ?>

<?php echo $__env->yieldPushContent('recurring_message_start'); ?>
<?php if(!$hideRecurringMessage): ?>
    <?php if (isset($component)) { $__componentOriginal494d16cff8bfadbc168f635fc683e4766fa1f16f = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Show\RecurringMessage::class, ['type' => ''.e($type).'','document' => $document,'textRecurringType' => ''.e($textRecurringType).'']); ?>
<?php $component->withName('documents.show.recurring-message'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal494d16cff8bfadbc168f635fc683e4766fa1f16f)): ?>
<?php $component = $__componentOriginal494d16cff8bfadbc168f635fc683e4766fa1f16f; ?>
<?php unset($__componentOriginal494d16cff8bfadbc168f635fc683e4766fa1f16f); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php endif; ?>
<?php echo $__env->yieldPushContent('recurring_message_end'); ?>

<?php echo $__env->yieldPushContent('status_message_start'); ?>
<?php if(!$hideStatusMessage): ?>
    <?php if (isset($component)) { $__componentOriginaldc446d8bb129bb9e0ce68b34b2b663b7b41c233a = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Show\StatusMessage::class, ['type' => ''.e($type).'','document' => $document,'textStatusMessage' => ''.e($textStatusMessage).'']); ?>
<?php $component->withName('documents.show.status-message'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginaldc446d8bb129bb9e0ce68b34b2b663b7b41c233a)): ?>
<?php $component = $__componentOriginaldc446d8bb129bb9e0ce68b34b2b663b7b41c233a; ?>
<?php unset($__componentOriginaldc446d8bb129bb9e0ce68b34b2b663b7b41c233a); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php endif; ?>
<?php echo $__env->yieldPushContent('status_message_end'); ?>

<?php echo $__env->yieldPushContent('timeline_start'); ?>
    <?php if(!$hideTimeline): ?>
        <?php if (isset($component)) { $__componentOriginal6cb28289a2ebc2d914f7a721322a627d80f66861 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Show\Timeline::class, ['type' => ''.e($type).'','document' => $document,'hideTimelineStatuses' => $hideTimelineStatuses,'hideTimelineCreate' => ''.e($hideTimelineCreate).'','textTimelineCreateTitle' => ''.e($textTimelineCreateTitle).'','textTimelineCreateMessage' => ''.e($textTimelineCreateMessage).'','hideButtonEdit' => ''.e($hideButtonEdit).'','permissionUpdate' => ''.e($permissionUpdate).'','routeButtonEdit' => ''.e($routeButtonEdit).'','hideTimelineSent' => ''.e($hideTimelineSent).'','textTimelineSentTitle' => ''.e($textTimelineSentTitle).'','textTimelineSentStatusDraft' => ''.e($textTimelineSentStatusDraft).'','hideButtonSent' => ''.e($hideButtonSent).'','routeButtonSent' => ''.e($routeButtonSent).'','textTimelineSentStatusMarkSent' => ''.e($textTimelineSentStatusMarkSent).'','hideButtonReceived' => ''.e($hideButtonReceived).'','routeButtonReceived' => ''.e($routeButtonReceived).'','textTimelineSentStatusReceived' => ''.e($textTimelineSentStatusReceived).'','hideButtonEmail' => ''.e($hideButtonEmail).'','routeButtonEmail' => ''.e($routeButtonEmail).'','textTimelineSendStatusMail' => ''.e($textTimelineSendStatusMail).'','hideButtonShare' => ''.e($hideButtonShare).'','signedUrl' => $signedUrl,'hideTimelinePaid' => ''.e($hideTimelinePaid).'','textTimelineGetPaidTitle' => ''.e($textTimelineGetPaidTitle).'','textTimelineGetPaidStatusAwait' => ''.e($textTimelineGetPaidStatusAwait).'','textTimelineGetPaidStatusPartiallyPaid' => ''.e($textTimelineGetPaidStatusPartiallyPaid).'','hideButtonPaid' => ''.e($hideButtonPaid).'','routeButtonPaid' => ''.e($routeButtonPaid).'','textTimelineGetPaidMarkPaid' => ''.e($textTimelineGetPaidMarkPaid).'','textTimelineGetPaidAddPayment' => ''.e($textTimelineGetPaidAddPayment).'']); ?>
<?php $component->withName('documents.show.timeline'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['hide-button-add-payment' => ''.e($hideButtonAddPayment).'']); ?>
<?php if (isset($__componentOriginal6cb28289a2ebc2d914f7a721322a627d80f66861)): ?>
<?php $component = $__componentOriginal6cb28289a2ebc2d914f7a721322a627d80f66861; ?>
<?php unset($__componentOriginal6cb28289a2ebc2d914f7a721322a627d80f66861); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
    <?php endif; ?>
<?php echo $__env->yieldPushContent('timeline_end'); ?>

<?php echo $__env->yieldPushContent('document_start'); ?>
    <?php if (isset($component)) { $__componentOriginala4c1f4156bcbe130e9461957dbdd42d7de2562f0 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Show\Document::class, ['type' => ''.e($type).'','document' => $document,'documentTemplate' => ''.e($documentTemplate).'','logo' => ''.e($logo).'','backgroundColor' => ''.e($backgroundColor).'','hideFooter' => ''.e($hideFooter).'','hideCompanyLogo' => ''.e($hideCompanyLogo).'','hideCompanyDetails' => ''.e($hideCompanyDetails).'','hideCompanyName' => ''.e($hideCompanyName).'','hideCompanyAddress' => ''.e($hideCompanyAddress).'','hideCompanyTaxNumber' => ''.e($hideCompanyTaxNumber).'','hideCompanyPhone' => ''.e($hideCompanyPhone).'','hideCompanyEmail' => ''.e($hideCompanyEmail).'','hideContactInfo' => ''.e($hideContactInfo).'','hideContactName' => ''.e($hideContactName).'','hideContactAddress' => ''.e($hideContactAddress).'','hideContactTaxNumber' => ''.e($hideContactTaxNumber).'','hideContactPhone' => ''.e($hideContactPhone).'','hideContactEmail' => ''.e($hideContactEmail).'','hideOrderNumber' => ''.e($hideOrderNumber).'','hideDocumentNumber' => ''.e($hideDocumentNumber).'','hideIssuedAt' => ''.e($hideIssuedAt).'','hideDueAt' => ''.e($hideDueAt).'','textContactInfo' => ''.e($textContactInfo).'','textIssuedAt' => ''.e($textIssuedAt).'','textDocumentNumber' => ''.e($textDocumentNumber).'','textDueAt' => ''.e($textDueAt).'','textOrderNumber' => ''.e($textOrderNumber).'','textDocumentTitle' => ''.e($textDocumentTitle).'','textDocumentSubheading' => ''.e($textDocumentSubheading).'','hideItems' => ''.e($hideItems).'','hideName' => ''.e($hideName).'','hideDescription' => ''.e($hideDescription).'','hideQuantity' => ''.e($hideQuantity).'','hidePrice' => ''.e($hidePrice).'','hideAmount' => ''.e($hideAmount).'','hideNote' => ''.e($hideNote).'','textItems' => ''.e($textItems).'','textQuantity' => ''.e($textQuantity).'','textPrice' => ''.e($textPrice).'','textAmount' => ''.e($textAmount).'']); ?>
<?php $component->withName('documents.show.document'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginala4c1f4156bcbe130e9461957dbdd42d7de2562f0)): ?>
<?php $component = $__componentOriginala4c1f4156bcbe130e9461957dbdd42d7de2562f0; ?>
<?php unset($__componentOriginala4c1f4156bcbe130e9461957dbdd42d7de2562f0); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php echo $__env->yieldPushContent('document_end'); ?>

<?php echo $__env->yieldPushContent('attachment_start'); ?>
    <?php if(!$hideAttachment): ?>
        <?php if (isset($component)) { $__componentOriginal279c23732a15d51c929e7e8082c97405dd34043d = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Show\Attachment::class, ['type' => ''.e($type).'','document' => $document,'attachment' => $attachment]); ?>
<?php $component->withName('documents.show.attachment'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal279c23732a15d51c929e7e8082c97405dd34043d)): ?>
<?php $component = $__componentOriginal279c23732a15d51c929e7e8082c97405dd34043d; ?>
<?php unset($__componentOriginal279c23732a15d51c929e7e8082c97405dd34043d); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
    <?php endif; ?>
<?php echo $__env->yieldPushContent('attachment_end'); ?>

<?php echo $__env->yieldPushContent('row_footer_start'); ?>
    <?php if(!$hideFooter): ?>
        <?php if (isset($component)) { $__componentOriginale007bc1950b4ac34157c0177ba692ba9bfbd3785 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Show\Footer::class, ['type' => ''.e($type).'','document' => $document,'histories' => $histories,'transactions' => $transactions,'classFooterHistories' => ''.e($classFooterHistories).'','hideFooterHistories' => ''.e($hideFooterHistories).'','textHistories' => ''.e($textHistories).'','textHistoryStatus' => ''.e($textHistoryStatus).'','hideFooterTransactions' => ''.e($hideFooterTransactions).'','classFooterTransactions' => ''.e($classFooterTransactions).'']); ?>
<?php $component->withName('documents.show.footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginale007bc1950b4ac34157c0177ba692ba9bfbd3785)): ?>
<?php $component = $__componentOriginale007bc1950b4ac34157c0177ba692ba9bfbd3785; ?>
<?php unset($__componentOriginale007bc1950b4ac34157c0177ba692ba9bfbd3785); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
    <?php endif; ?>
<?php echo $__env->yieldPushContent('row_footer_end'); ?>

<?php echo e(Form::hidden('document_id', $document->id, ['id' => 'document_id'])); ?>

<?php echo e(Form::hidden($type . '_id', $document->id, ['id' => $type . '_id'])); ?>

<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/documents/show/content.blade.php ENDPATH**/ ?>