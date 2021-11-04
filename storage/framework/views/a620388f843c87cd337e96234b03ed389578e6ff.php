<div class="table-responsive">
    <table class="table table-flush table-hover">
        <thead class="thead-light">
            <tr class="row table-head-line">
                <?php if(!$hideBulkAction): ?>
                    <th class="<?php echo e($classBulkAction); ?>">
                        <?php echo e(Form::bulkActionAllGroup()); ?>

                    </th>
                <?php endif; ?>

                <?php echo $__env->yieldPushContent('document_number_th_start'); ?>
                <?php if(!$hideDocumentNumber): ?>
                    <th class="<?php echo e($classDocumentNumber); ?>">
                        <?php echo $__env->yieldPushContent('document_number_th_inside_start'); ?>

                        <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('document_number', trans_choice($textDocumentNumber, 1), ['filter' => 'active, visible'], ['class' => 'col-aka', 'rel' => 'nofollow']));?>

                        <?php echo $__env->yieldPushContent('document_number_th_inside_end'); ?>
                    </th>
                <?php endif; ?>
                <?php echo $__env->yieldPushContent('document_number_th_end'); ?>

                <?php echo $__env->yieldPushContent('contact_name_th_start'); ?>
                <?php if(!$hideContactName): ?>
                    <th class="<?php echo e($classContactName); ?>">
                        <?php echo $__env->yieldPushContent('contact_name_th_inside_start'); ?>

                        <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('contact_name', trans_choice($textContactName, 1)));?>

                        <?php echo $__env->yieldPushContent('contact_name_th_inside_end'); ?>
                    </th>
                <?php endif; ?>
                <?php echo $__env->yieldPushContent('contact_name_th_end'); ?>

                <?php echo $__env->yieldPushContent('amount_th_start'); ?>
                <?php if(!$hideAmount): ?>
                    <th class="<?php echo e($classAmount); ?>">
                        <?php echo $__env->yieldPushContent('amount_th_inside_start'); ?>

                        <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('amount', trans('general.amount')));?>

                        <?php echo $__env->yieldPushContent('amount_th_inside_end'); ?>
                    </th>
                <?php endif; ?>
                <?php echo $__env->yieldPushContent('amount_th_end'); ?>

                <?php echo $__env->yieldPushContent('issued_at_th_start'); ?>
                <?php if(!$hideIssuedAt): ?>
                    <th class="<?php echo e($classIssuedAt); ?>">
                        <?php echo $__env->yieldPushContent('issued_at_th_inside_start'); ?>

                        <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('issued_at', trans($textIssuedAt)));?>

                        <?php echo $__env->yieldPushContent('issued_at_th_inside_end'); ?>
                    </th>
                <?php endif; ?>
                <?php echo $__env->yieldPushContent('issued_at_th_end'); ?>

                <?php echo $__env->yieldPushContent('due_at_th_start'); ?>
                <?php if(!$hideDueAt): ?>
                    <th class="<?php echo e($classDueAt); ?>">
                        <?php echo $__env->yieldPushContent('due_at_th_inside_start'); ?>

                        <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('due_at', trans($textDueAt)));?>

                        <?php echo $__env->yieldPushContent('due_at_th_inside_end'); ?>
                    </th>
                <?php endif; ?>
                <?php echo $__env->yieldPushContent('due_at_th_end'); ?>

                <?php echo $__env->yieldPushContent('status_th_start'); ?>
                <?php if(!$hideStatus): ?>
                    <th class="<?php echo e($classStatus); ?>">
                        <?php echo $__env->yieldPushContent('status_th_inside_start'); ?>

                        <?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('status', trans_choice('general.statuses', 1)));?>

                        <?php echo $__env->yieldPushContent('status_th_inside_end'); ?>
                    </th>
                <?php endif; ?>
                <?php echo $__env->yieldPushContent('status_th_end'); ?>

                <?php if(!$hideActions): ?>
                    <th class="<?php echo e($classActions); ?>">
                        <a><?php echo e(trans('general.actions')); ?></a>
                    </th>
                <?php endif; ?>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('partials.documents.index.card-table-row', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/documents/index/card-body.blade.php ENDPATH**/ ?>