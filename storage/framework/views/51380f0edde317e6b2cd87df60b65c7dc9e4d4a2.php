
    <div class="accordion">
        <div class="card border-1 box-shadow-none">
            <div class="card-header background-none collapsed" id="accordion-footer-header" data-toggle="collapse" data-target="#accordion-footer-body" aria-expanded="false" aria-controls="accordion-footer-body">
                <h4 class="mb-0"><?php echo e(trans('general.footer')); ?></h4>
            </div>

            <div id="accordion-footer-body" class="collapse hide" aria-labelledby="accordion-footer-header">
                <?php echo e(Form::textareaGroup('footer', '', '', $footerSetting, ['rows' => '3'], 'embed-acoordion-textarea')); ?>

            </div>
        </div>
    </div>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/documents/form/footer.blade.php ENDPATH**/ ?>