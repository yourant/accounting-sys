<div class="accordion">
    <div class="card border-1 box-shadow-none">
        <div class="card-header background-none collapsed" id="accordion-recurring-and-more-header" data-toggle="collapse" data-target="#accordion-recurring-and-more-body" aria-expanded="false" aria-controls="accordion-recurring-and-more-body">
            <h4 class="mb-0"><?php echo e(trans($textAdvancedAccordion)); ?></h4>
        </div>

        <div id="accordion-recurring-and-more-body" class="collapse hide" aria-labelledby="accordion-recurring-and-more-header">
            <div class="card-body">
                <div class="row">
                    <?php echo $__env->yieldPushContent('recurring_row_start'); ?>
                    <?php if(!$hideRecurring): ?>
                        <div class="<?php echo e($recurring_class); ?>">
                            <?php if(!empty($document)): ?>
                                <?php echo e(Form::recurring('edit', $document, 'col-md-12')); ?>

                            <?php else: ?>
                                <?php echo e(Form::recurring('create', null, 'col-md-12')); ?>

                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php echo $__env->yieldPushContent('recurring_row_end'); ?>

                    <?php echo $__env->yieldPushContent('more_row_start'); ?>
                    <?php if(!$hideCategory): ?>
                    <div class="<?php echo e($more_class); ?>">
                        <?php if(!$hideCategory): ?>
                            <?php echo e(Form::selectRemoteAddNewGroup('category_id', trans_choice('general.categories', 1), 'folder', $categories, $document->category_id ?? setting('default.' . $categoryType . '_category'), ['required' => 'required', 'path' => route('modals.categories.create') . '?type=' . $categoryType, 'remote_action' => route('categories.index'). '?search=type:' . $categoryType], $more_form_class)); ?>

                        <?php endif; ?>
                    </div>
                    <?php else: ?>
                    <?php echo e(Form::hidden('category_id', $document->category_id ?? setting('default.' . $categoryType . '_category'))); ?>

                    <?php endif; ?>
                    <?php echo $__env->yieldPushContent('more_row_end'); ?>

                    <?php if(!$hideAttachment): ?>
                    <div class="col-md-12">
                        <?php echo e(Form::fileGroup('attachment', trans('general.attachment'), '', ['dropzone-class' => 'w-100', 'multiple' => 'multiple', 'options' => ['acceptedFiles' => $file_types]], !empty($document) ? $document->attachment : null , 'col-md-12')); ?>

                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/documents/form/advanced.blade.php ENDPATH**/ ?>