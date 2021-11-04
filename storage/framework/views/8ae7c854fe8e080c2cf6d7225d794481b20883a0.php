<div class="accordion">
    <div class="card border-1 box-shadow-none">
        <div class="card-header background-none collapsed" id="accordion-company-header" data-toggle="collapse" data-target="#accordion-company-body" aria-expanded="false" aria-controls="accordion-company-body">
            <h4 class="mb-0"><?php echo e(trans_choice('general.companies', 1)); ?></h4>
        </div>

        <div id="accordion-company-body" class="collapse hide" aria-labelledby="accordion-company-header">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <?php if(!$hideLogo): ?>
                            <?php echo e(Form::fileGroup('company_logo', trans('settings.company.logo'), 'file-image-o', ['data-field' => 'setting'], setting('company.logo'))); ?>

                        <?php endif; ?>
                    </div>

                    <div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
                        <?php if(!$hideDocumentTitle): ?>
                            <?php echo e(Form::textGroup('title', trans('settings.invoice.title'), 'font', ['data-field' => 'setting'], $titleSetting, 'col-md-12')); ?>

                        <?php endif; ?>

                        <?php if(!$hideDocumentSubheading): ?>
                            <?php echo e(Form::textGroup('subheading', trans('settings.invoice.subheading'), 'font', ['data-field' => 'setting'], $subheadingSetting, 'col-md-12')); ?>

                        <?php endif; ?>

                        <?php if(!$hideCompanyEdit): ?>
                            <akaunting-company-edit company-id="<?php echo e(company_id()); ?>"
                            button-text="<?php echo e(trans('settings.company.edit_your_business_address')); ?>"
                            tax-number-text="<?php echo e(trans('general.tax_number')); ?>"
                            :company="<?php echo e(json_encode($company)); ?>"
                            :company-form="<?php echo e(json_encode([
                                'show' => true,
                                'text' => trans('settings.company.edit_your_business_address'),
                                'buttons' => [
                                    'cancel' => [
                                        'text' => trans('general.cancel'),
                                        'class' => 'btn-outline-secondary'
                                    ],
                                    'confirm' => [
                                        'text' => trans('general.save'),
                                        'class' => 'btn-success'
                                    ]
                                ]
                            ])); ?>"
                            ></akaunting-company-edit>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/documents/form/company.blade.php ENDPATH**/ ?>