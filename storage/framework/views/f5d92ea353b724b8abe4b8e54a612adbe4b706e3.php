<?php if(empty($document)): ?>
    <?php echo Form::open([
        'route' => $routeStore,
        'id' => $formId,
        '@submit.prevent' => $formSubmit,
        '@keydown' => 'form.errors.clear($event.target.name)',
        'files' => true,
        'role' => 'form',
        'class' => 'form-loading-button',
        'novalidate' => true
    ]); ?>

<?php else: ?>
    <?php echo Form::model($document, [
        'route' => [$routeUpdate, $document->id],
        'id' => $formId,
        'method' => 'PATCH',
        '@submit.prevent' => $formSubmit,
        '@keydown' => 'form.errors.clear($event.target.name)',
        'files' => true,
        'role' => 'form',
        'class' => 'form-loading-button',
        'novalidate' => true
    ]); ?>

<?php endif; ?>
        <?php if(!$hideCompany): ?>
            <?php if (isset($component)) { $__componentOriginal6f449d1e93ca212b9aa604f49cff64c7bc9f3eb1 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Form\Company::class, ['type' => ''.e($type).'','hideLogo' => ''.e($hideLogo).'','hideDocumentTitle' => ''.e($hideDocumentTitle).'','hideDocumentSubheading' => ''.e($hideDocumentSubheading).'','hideCompanyEdit' => ''.e($hideCompanyEdit).'','titleSetting' => ''.e($titleSetting).'']); ?>
<?php $component->withName('documents.form.company'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal6f449d1e93ca212b9aa604f49cff64c7bc9f3eb1)): ?>
<?php $component = $__componentOriginal6f449d1e93ca212b9aa604f49cff64c7bc9f3eb1; ?>
<?php unset($__componentOriginal6f449d1e93ca212b9aa604f49cff64c7bc9f3eb1); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
        <?php endif; ?>

        <?php if (isset($component)) { $__componentOriginal93c9ecab1e3a5e6d74b4ab3c93c8de62ef781020 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Form\Main::class, ['type' => ''.e($type).'','document' => $document,'hideContact' => ''.e($hideContact).'','contactType' => ''.e($contactType).'','contact' => $contact,'contacts' => $contacts,'hideIssuedAt' => ''.e($hideIssuedAt).'','textIssuedAt' => ''.e($textIssuedAt).'','issuedAt' => ''.e($issuedAt).'','hideDocumentNumber' => ''.e($hideDocumentNumber).'','textDocumentNumber' => ''.e($textDocumentNumber).'','documentNumber' => ''.e($documentNumber).'','hideDueAt' => ''.e($hideDueAt).'','textDueAt' => ''.e($textDueAt).'','dueAt' => ''.e($dueAt).'','hideOrderNumber' => ''.e($hideOrderNumber).'','textOrderNumber' => ''.e($textOrderNumber).'','orderNumber' => ''.e($orderNumber).'','hideEditItemColumns' => ''.e($hideEditItemColumns).'','hideItems' => ''.e($hideItems).'','hideName' => ''.e($hideName).'','hideDescription' => ''.e($hideDescription).'','textItems' => ''.e($textItems).'','hideQuantity' => ''.e($hideQuantity).'','textQuantity' => ''.e($textQuantity).'','hidePrice' => ''.e($hidePrice).'','textPrice' => ''.e($textPrice).'','hideDiscount' => ''.e($hideDiscount).'','hideAmount' => ''.e($hideAmount).'','textAmount' => ''.e($textAmount).'','isSalePrice' => ''.e($isSalePrice).'','isPurchasePrice' => ''.e($isPurchasePrice).'','searchCharLimit' => ''.e($searchCharLimit).'','notesSetting' => ''.e($notesSetting).'']); ?>
<?php $component->withName('documents.form.main'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['search_route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contactSearchRoute),'create_route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contactCreateRoute)]); ?>
<?php if (isset($__componentOriginal93c9ecab1e3a5e6d74b4ab3c93c8de62ef781020)): ?>
<?php $component = $__componentOriginal93c9ecab1e3a5e6d74b4ab3c93c8de62ef781020; ?>
<?php unset($__componentOriginal93c9ecab1e3a5e6d74b4ab3c93c8de62ef781020); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

        <?php if(!$hideFooter): ?>
            <?php if (isset($component)) { $__componentOriginal4b7f8fa7783f15a725f13c5f764e156af651958e = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Form\Footer::class, ['type' => ''.e($type).'','document' => $document,'footerSetting' => ''.e($footerSetting).'']); ?>
<?php $component->withName('documents.form.footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal4b7f8fa7783f15a725f13c5f764e156af651958e)): ?>
<?php $component = $__componentOriginal4b7f8fa7783f15a725f13c5f764e156af651958e; ?>
<?php unset($__componentOriginal4b7f8fa7783f15a725f13c5f764e156af651958e); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
        <?php endif; ?>

        <?php if(!$hideAdvanced): ?>
            <?php if (isset($component)) { $__componentOriginal0e9f3fa5775eca7abab89e204afd8e69233fe1e4 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Form\Advanced::class, ['type' => ''.e($type).'','document' => $document,'categoryType' => ''.e($categoryType).'','hideRecurring' => ''.e($hideRecurring).'','hideCategory' => ''.e($hideCategory).'','hideAttachment' => ''.e($hideAttachment).'']); ?>
<?php $component->withName('documents.form.advanced'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal0e9f3fa5775eca7abab89e204afd8e69233fe1e4)): ?>
<?php $component = $__componentOriginal0e9f3fa5775eca7abab89e204afd8e69233fe1e4; ?>
<?php unset($__componentOriginal0e9f3fa5775eca7abab89e204afd8e69233fe1e4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
        <?php endif; ?>

        <?php if(!$hideButtons): ?>
            <?php if (isset($component)) { $__componentOriginal8902a33abbf395924488ba9c5e08338a46321dbc = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Form\Buttons::class, ['type' => ''.e($type).'','document' => $document,'routeCancel' => ''.e($routeCancel).'']); ?>
<?php $component->withName('documents.form.buttons'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal8902a33abbf395924488ba9c5e08338a46321dbc)): ?>
<?php $component = $__componentOriginal8902a33abbf395924488ba9c5e08338a46321dbc; ?>
<?php unset($__componentOriginal8902a33abbf395924488ba9c5e08338a46321dbc); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
        <?php endif; ?>

        <?php echo e(Form::hidden('type', old('type', $type), ['id' => 'type', 'v-model' => 'form.type'])); ?>

        <?php echo e(Form::hidden('status', old('status', $status), ['id' => 'status', 'v-model' => 'form.status'])); ?>

        <?php echo e(Form::hidden('amount', old('amount', '0'), ['id' => 'amount', 'v-model' => 'form.amount'])); ?>

    <?php echo Form::close(); ?>

<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/documents/form/content.blade.php ENDPATH**/ ?>