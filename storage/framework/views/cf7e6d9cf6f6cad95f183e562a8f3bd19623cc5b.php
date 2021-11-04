

<div class="card" style="padding: 0; padding-left: 15px; padding-right: 15px; border-radius: 0; box-shadow: 0 4px 16px rgba(0,0,0,.2);">
    <div class="card-body">
        <?php if($documentTemplate): ?>
            <?php switch($documentTemplate):
                case ('classic'): ?>
                    <?php if (isset($component)) { $__componentOriginalfc61e2a9b2fe5cbb4cf458f95c1824610fd7b0c3 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Template\Classic::class, ['type' => ''.e($type).'','document' => $document,'documentTemplate' => ''.e($documentTemplate).'','logo' => ''.e($logo).'','backgroundColor' => ''.e($backgroundColor).'','hideFooter' => ''.e($hideFooter).'','hideCompanyLogo' => ''.e($hideCompanyLogo).'','hideCompanyDetails' => ''.e($hideCompanyDetails).'','hideCompanyName' => ''.e($hideCompanyName).'','hideCompanyAddress' => ''.e($hideCompanyAddress).'','hideCompanyTaxNumber' => ''.e($hideCompanyTaxNumber).'','hideCompanyPhone' => ''.e($hideCompanyPhone).'','hideCompanyEmail' => ''.e($hideCompanyEmail).'','hideContactInfo' => ''.e($hideContactInfo).'','hideContactName' => ''.e($hideContactName).'','hideContactAddress' => ''.e($hideContactAddress).'','hideContactTaxNumber' => ''.e($hideContactTaxNumber).'','hideContactPhone' => ''.e($hideContactPhone).'','hideContactEmail' => ''.e($hideContactEmail).'','hideOrderNumber' => ''.e($hideOrderNumber).'','hideDocumentNumber' => ''.e($hideDocumentNumber).'','hideIssuedAt' => ''.e($hideIssuedAt).'','hideDueAt' => ''.e($hideDueAt).'','textContactInfo' => ''.e($textContactInfo).'','textIssuedAt' => ''.e($textIssuedAt).'','textDocumentNumber' => ''.e($textDocumentNumber).'','textDueAt' => ''.e($textDueAt).'','textOrderNumber' => ''.e($textOrderNumber).'','textDocumentTitle' => ''.e($textDocumentTitle).'','textDocumentSubheading' => ''.e($textDocumentSubheading).'','hideItems' => ''.e($hideItems).'','hideName' => ''.e($hideName).'','hideDescription' => ''.e($hideDescription).'','hideQuantity' => ''.e($hideQuantity).'','hidePrice' => ''.e($hidePrice).'','hideAmount' => ''.e($hideAmount).'','hideNote' => ''.e($hideNote).'','textItems' => ''.e($textItems).'','textQuantity' => ''.e($textQuantity).'','textPrice' => ''.e($textPrice).'','textAmount' => ''.e($textAmount).'']); ?>
<?php $component->withName('documents.template.classic'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalfc61e2a9b2fe5cbb4cf458f95c1824610fd7b0c3)): ?>
<?php $component = $__componentOriginalfc61e2a9b2fe5cbb4cf458f95c1824610fd7b0c3; ?>
<?php unset($__componentOriginalfc61e2a9b2fe5cbb4cf458f95c1824610fd7b0c3); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                    <?php break; ?>
                <?php case ('modern'): ?>
                    <?php if (isset($component)) { $__componentOriginalea219b3fc1db965b18ff499ace598dc2dc222350 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Template\Modern::class, ['type' => ''.e($type).'','document' => $document,'documentTemplate' => ''.e($documentTemplate).'','logo' => ''.e($logo).'','backgroundColor' => ''.e($backgroundColor).'','hideFooter' => ''.e($hideFooter).'','hideCompanyLogo' => ''.e($hideCompanyLogo).'','hideCompanyDetails' => ''.e($hideCompanyDetails).'','hideCompanyName' => ''.e($hideCompanyName).'','hideCompanyAddress' => ''.e($hideCompanyAddress).'','hideCompanyTaxNumber' => ''.e($hideCompanyTaxNumber).'','hideCompanyPhone' => ''.e($hideCompanyPhone).'','hideCompanyEmail' => ''.e($hideCompanyEmail).'','hideContactInfo' => ''.e($hideContactInfo).'','hideContactName' => ''.e($hideContactName).'','hideContactAddress' => ''.e($hideContactAddress).'','hideContactTaxNumber' => ''.e($hideContactTaxNumber).'','hideContactPhone' => ''.e($hideContactPhone).'','hideContactEmail' => ''.e($hideContactEmail).'','hideOrderNumber' => ''.e($hideOrderNumber).'','hideDocumentNumber' => ''.e($hideDocumentNumber).'','hideIssuedAt' => ''.e($hideIssuedAt).'','hideDueAt' => ''.e($hideDueAt).'','textContactInfo' => ''.e($textContactInfo).'','textIssuedAt' => ''.e($textIssuedAt).'','textDocumentNumber' => ''.e($textDocumentNumber).'','textDueAt' => ''.e($textDueAt).'','textOrderNumber' => ''.e($textOrderNumber).'','textDocumentTitle' => ''.e($textDocumentTitle).'','textDocumentSubheading' => ''.e($textDocumentSubheading).'','hideItems' => ''.e($hideItems).'','hideName' => ''.e($hideName).'','hideDescription' => ''.e($hideDescription).'','hideQuantity' => ''.e($hideQuantity).'','hidePrice' => ''.e($hidePrice).'','hideAmount' => ''.e($hideAmount).'','hideNote' => ''.e($hideNote).'','textItems' => ''.e($textItems).'','textQuantity' => ''.e($textQuantity).'','textPrice' => ''.e($textPrice).'','textAmount' => ''.e($textAmount).'']); ?>
<?php $component->withName('documents.template.modern'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalea219b3fc1db965b18ff499ace598dc2dc222350)): ?>
<?php $component = $__componentOriginalea219b3fc1db965b18ff499ace598dc2dc222350; ?>
<?php unset($__componentOriginalea219b3fc1db965b18ff499ace598dc2dc222350); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                    <?php break; ?>
                <?php default: ?>
                    <?php if (isset($component)) { $__componentOriginalb1f13d81219ca0f8f9b479b18578783800b17464 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Template\Ddefault::class, ['type' => ''.e($type).'','document' => $document,'documentTemplate' => ''.e($documentTemplate).'','logo' => ''.e($logo).'','backgroundColor' => ''.e($backgroundColor).'','hideFooter' => ''.e($hideFooter).'','hideCompanyLogo' => ''.e($hideCompanyLogo).'','hideCompanyDetails' => ''.e($hideCompanyDetails).'','hideCompanyName' => ''.e($hideCompanyName).'','hideCompanyAddress' => ''.e($hideCompanyAddress).'','hideCompanyTaxNumber' => ''.e($hideCompanyTaxNumber).'','hideCompanyPhone' => ''.e($hideCompanyPhone).'','hideCompanyEmail' => ''.e($hideCompanyEmail).'','hideContactInfo' => ''.e($hideContactInfo).'','hideContactName' => ''.e($hideContactName).'','hideContactAddress' => ''.e($hideContactAddress).'','hideContactTaxNumber' => ''.e($hideContactTaxNumber).'','hideContactPhone' => ''.e($hideContactPhone).'','hideContactEmail' => ''.e($hideContactEmail).'','hideOrderNumber' => ''.e($hideOrderNumber).'','hideDocumentNumber' => ''.e($hideDocumentNumber).'','hideIssuedAt' => ''.e($hideIssuedAt).'','hideDueAt' => ''.e($hideDueAt).'','textContactInfo' => ''.e($textContactInfo).'','textIssuedAt' => ''.e($textIssuedAt).'','textDocumentNumber' => ''.e($textDocumentNumber).'','textDueAt' => ''.e($textDueAt).'','textOrderNumber' => ''.e($textOrderNumber).'','textDocumentTitle' => ''.e($textDocumentTitle).'','textDocumentSubheading' => ''.e($textDocumentSubheading).'','hideItems' => ''.e($hideItems).'','hideName' => ''.e($hideName).'','hideDescription' => ''.e($hideDescription).'','hideQuantity' => ''.e($hideQuantity).'','hideDiscount' => ''.e($hideDiscount).'','hidePrice' => ''.e($hidePrice).'','hideAmount' => ''.e($hideAmount).'','hideNote' => ''.e($hideNote).'','textItems' => ''.e($textItems).'','textQuantity' => ''.e($textQuantity).'','textPrice' => ''.e($textPrice).'','textAmount' => ''.e($textAmount).'']); ?>
<?php $component->withName('documents.template.ddefault'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalb1f13d81219ca0f8f9b479b18578783800b17464)): ?>
<?php $component = $__componentOriginalb1f13d81219ca0f8f9b479b18578783800b17464; ?>
<?php unset($__componentOriginalb1f13d81219ca0f8f9b479b18578783800b17464); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
            <?php endswitch; ?>
        <?php else: ?>
            <?php echo $__env->make($documentTemplate, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/documents/show/document.blade.php ENDPATH**/ ?>