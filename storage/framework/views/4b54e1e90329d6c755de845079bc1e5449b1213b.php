<div class="card">
    <div class="document-loading" v-if="!page_loaded">
        <div><i class="fas fa-spinner fa-pulse fa-7x"></i></div>
    </div>

    <div class="card-body">
        <?php if (isset($component)) { $__componentOriginal69d41561e5f5d2e48d310a0c9d1965898b9b3675 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Form\Metadata::class, ['type' => ''.e($type).'','document' => $document,'hideContact' => ''.e($hideContact).'','contactType' => ''.e($contactType).'','contact' => $contact,'contacts' => $contacts,'hideIssuedAt' => ''.e($hideIssuedAt).'','textIssuedAt' => ''.e($textIssuedAt).'','issuedAt' => ''.e($issuedAt).'','hideDocumentNumber' => ''.e($hideDocumentNumber).'','textDocumentNumber' => ''.e($textDocumentNumber).'','documentNumber' => ''.e($documentNumber).'','hideDueAt' => ''.e($hideDueAt).'','textDueAt' => ''.e($textDueAt).'','dueAt' => ''.e($dueAt).'','hideOrderNumber' => ''.e($hideOrderNumber).'','textOrderNumber' => ''.e($textOrderNumber).'','orderNumber' => ''.e($orderNumber).'']); ?>
<?php $component->withName('documents.form.metadata'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['search_route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contactSearchRoute),'create_route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contactCreateRoute)]); ?>
<?php if (isset($__componentOriginal69d41561e5f5d2e48d310a0c9d1965898b9b3675)): ?>
<?php $component = $__componentOriginal69d41561e5f5d2e48d310a0c9d1965898b9b3675; ?>
<?php unset($__componentOriginal69d41561e5f5d2e48d310a0c9d1965898b9b3675); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

        <?php if (isset($component)) { $__componentOriginale69086b2fe6e0afb05f0ba0914db48a863cef5bd = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Form\Items::class, ['type' => ''.e($type).'','document' => $document,'hideEditItemColumns' => ''.e($hideEditItemColumns).'','hideItems' => ''.e($hideItems).'','hideName' => ''.e($hideName).'','hideDescription' => ''.e($hideDescription).'','textItems' => ''.e($textItems).'','hideQuantity' => ''.e($hideQuantity).'','textQuantity' => ''.e($textQuantity).'','hidePrice' => ''.e($hidePrice).'','textPrice' => ''.e($textPrice).'','hideDiscount' => ''.e($hideDiscount).'','hideAmount' => ''.e($hideAmount).'','textAmount' => ''.e($textAmount).'','isSalePrice' => ''.e($isSalePrice).'','isPurchasePrice' => ''.e($isPurchasePrice).'','searchCharLimit' => ''.e($searchCharLimit).'']); ?>
<?php $component->withName('documents.form.items'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginale69086b2fe6e0afb05f0ba0914db48a863cef5bd)): ?>
<?php $component = $__componentOriginale69086b2fe6e0afb05f0ba0914db48a863cef5bd; ?>
<?php unset($__componentOriginale69086b2fe6e0afb05f0ba0914db48a863cef5bd); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

        <?php if (isset($component)) { $__componentOriginal2fe7aae83324e67789cb47f1790340f969df8811 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Form\Totals::class, ['type' => ''.e($type).'','document' => $document]); ?>
<?php $component->withName('documents.form.totals'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal2fe7aae83324e67789cb47f1790340f969df8811)): ?>
<?php $component = $__componentOriginal2fe7aae83324e67789cb47f1790340f969df8811; ?>
<?php unset($__componentOriginal2fe7aae83324e67789cb47f1790340f969df8811); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

        <?php if (isset($component)) { $__componentOriginal25295f3cb1f350474d1e1127544a9badf25ff831 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Form\Note::class, ['type' => ''.e($type).'','document' => $document,'notesSetting' => ''.e($notesSetting).'']); ?>
<?php $component->withName('documents.form.note'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal25295f3cb1f350474d1e1127544a9badf25ff831)): ?>
<?php $component = $__componentOriginal25295f3cb1f350474d1e1127544a9badf25ff831; ?>
<?php unset($__componentOriginal25295f3cb1f350474d1e1127544a9badf25ff831); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/documents/form/main.blade.php ENDPATH**/ ?>