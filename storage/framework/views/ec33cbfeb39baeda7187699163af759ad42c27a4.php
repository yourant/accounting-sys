<div class="row">
    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <?php if(!$hideContact): ?>
        <div class="row">
            <?php if (isset($component)) { $__componentOriginal3005c86d17fdb5b44d5aee9efe00ed821b783d14 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\SelectContactCard::class, ['type' => ''.e($contactType).'','contact' => $contact,'contacts' => $contacts,'error' => 'form.errors.get(\'contact_name\')','textAddContact' => $textAddContact,'textCreateNewContact' => $textCreateNewContact,'textEditContact' => $textEditContact,'textContactInfo' => $textContactInfo,'textChooseDifferentContact' => $textChooseDifferentContact]); ?>
<?php $component->withName('select-contact-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['search_route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contactSearchRoute),'create_route' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($contactCreateRoute)]); ?>
<?php if (isset($__componentOriginal3005c86d17fdb5b44d5aee9efe00ed821b783d14)): ?>
<?php $component = $__componentOriginal3005c86d17fdb5b44d5aee9efe00ed821b783d14; ?>
<?php unset($__componentOriginal3005c86d17fdb5b44d5aee9efe00ed821b783d14); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
        </div>
        <?php endif; ?>
    </div>

    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
        <div class="row">
            <?php if(!$hideIssuedAt): ?>
            <?php echo e(Form::dateGroup('issued_at', trans($textIssuedAt), 'calendar', ['id' => 'issued_at', 'class' => 'form-control datepicker', 'required' => 'required', 'show-date-format' => company_date_format(), 'date-format' => 'Y-m-d', 'autocomplete' => 'off', 'change' => 'setDueMinDate'], $issuedAt)); ?>

            <?php endif; ?>

            <?php if(!$hideDocumentNumber): ?>
            <?php echo e(Form::textGroup('document_number', trans($textDocumentNumber), 'file', ['required' => 'required'], $documentNumber)); ?>

            <?php endif; ?>

            <?php if(!$hideDueAt): ?>
                <?php if($type == 'invoice'): ?>
                    <?php echo e(Form::dateGroup('due_at', trans($textDueAt), 'calendar', ['id' => 'due_at', 'class' => 'form-control datepicker', 'required' => 'required', 'show-date-format' => company_date_format(), 'period' => setting('invoice.payment_terms'), 'date-format' => 'Y-m-d', 'autocomplete' => 'off', 'min-date' => 'form.issued_at', 'min-date-dynamic' => 'min_due_date', 'data-value-min' => true], $dueAt)); ?>

                <?php else: ?>
                    <?php echo e(Form::dateGroup('due_at', trans($textDueAt), 'calendar', ['id' => 'due_at', 'class' => 'form-control datepicker', 'required' => 'required', 'show-date-format' => company_date_format(), 'date-format' => 'Y-m-d', 'autocomplete' => 'off', 'min-date' => 'form.issued_at', 'min-date-dynamic' => 'min_due_date', 'data-value-min' => true], $dueAt)); ?>

                <?php endif; ?>
            <?php else: ?>
            <?php echo e(Form::hidden('due_at', old('issued_at', $issuedAt), ['id' => 'due_at', 'v-model' => 'form.issued_at'])); ?>

            <?php endif; ?>

            <?php if(!$hideOrderNumber): ?>
            <?php echo e(Form::textGroup('order_number', trans($textOrderNumber), 'shopping-cart', [], $orderNumber)); ?>

            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/documents/form/metadata.blade.php ENDPATH**/ ?>