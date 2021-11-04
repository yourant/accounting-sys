<?php $paid = $item->paid; ?>

<tr class="row align-items-center border-top-1">
    <?php if(!$hideBulkAction): ?>
        <td class="<?php echo e($classBulkAction); ?>">
            <?php echo e(Form::bulkActionGroup($item->id, $item->document_number)); ?>

        </td>
    <?php endif; ?>

    <?php echo $__env->yieldPushContent('document_number_td_start'); ?>
    <?php if(!$hideDocumentNumber): ?>
        <td class="<?php echo e($classDocumentNumber); ?>">
            <?php echo $__env->yieldPushContent('document_number_td_inside_start'); ?>

            <a class="col-aka" href="<?php echo e(route($routeButtonShow , $item->id)); ?>"><?php echo e($item->document_number); ?></a>

            <?php echo $__env->yieldPushContent('document_number_td_inside_end'); ?>
        </td>
    <?php endif; ?>
    <?php echo $__env->yieldPushContent('document_number_td_end'); ?>

    <?php echo $__env->yieldPushContent('contact_name_td_start'); ?>
    <?php if(!$hideContactName): ?>
        <td class="<?php echo e($classContactName); ?>">
            <?php echo $__env->yieldPushContent('contact_name_td_inside_start'); ?>

            <?php echo e($item->contact_name); ?>


            <?php echo $__env->yieldPushContent('contact_name_td_inside_end'); ?>
        </td>
    <?php endif; ?>
    <?php echo $__env->yieldPushContent('contact_name_td_end'); ?>

    <?php echo $__env->yieldPushContent('amount_td_start'); ?>
    <?php if(!$hideAmount): ?>
        <td class="<?php echo e($classAmount); ?>">
            <?php echo $__env->yieldPushContent('amount_td_inside_start'); ?>

            <?php echo money($item->amount, $item->currency_code, true); ?>

            <?php echo $__env->yieldPushContent('amount_td_inside_end'); ?>
        </td>
    <?php endif; ?>
    <?php echo $__env->yieldPushContent('amount_td_end'); ?>

    <?php echo $__env->yieldPushContent('issued_at_td_start'); ?>
    <?php if(!$hideIssuedAt): ?>
        <td class="<?php echo e($classIssuedAt); ?>">
            <?php echo $__env->yieldPushContent('issued_at_td_inside_start'); ?>

            <?php echo company_date($item->issued_at); ?>

            <?php echo $__env->yieldPushContent('issued_at_td_inside_end'); ?>
        </td>
    <?php endif; ?>
    <?php echo $__env->yieldPushContent('issued_at_td_end'); ?>

    <?php echo $__env->yieldPushContent('due_at_td_start'); ?>
    <?php if(!$hideDueAt): ?>
        <td class="<?php echo e($classDueAt); ?>">
            <?php echo $__env->yieldPushContent('due_at_td_inside_start'); ?>

            <?php echo company_date($item->due_at); ?>

            <?php echo $__env->yieldPushContent('due_at_td_inside_end'); ?>
        </td>
    <?php endif; ?>
    <?php echo $__env->yieldPushContent('due_at_td_end'); ?>

    <?php echo $__env->yieldPushContent('status_td_start'); ?>
    <?php if(!$hideStatus): ?>
        <td class="<?php echo e($classStatus); ?>">
            <?php echo $__env->yieldPushContent('status_td_inside_start'); ?>

            <span class="badge badge-pill badge-<?php echo e($item->status_label); ?>"><?php echo e(trans($textDocumentStatus . $item->status)); ?></span>

            <?php echo $__env->yieldPushContent('status_td_inside_end'); ?>
        </td>
    <?php endif; ?>
    <?php echo $__env->yieldPushContent('status_td_end'); ?>

    <?php if(!$hideActions): ?>
        <td class="<?php echo e($classActions); ?>">
            <div class="dropdown">
                <a class="btn btn-neutral btn-sm text-light items-align-center py-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-ellipsis-h text-muted"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <?php echo $__env->yieldPushContent('show_button_start'); ?>
                    <?php if(!$hideButtonShow): ?>
                        <a class="dropdown-item" href="<?php echo e(route($routeButtonShow, $item->id)); ?>"><?php echo e(trans('general.show')); ?></a>
                    <?php endif; ?>
                    <?php echo $__env->yieldPushContent('show_button_end'); ?>

                    <?php echo $__env->yieldPushContent('edit_button_start'); ?>
                    <?php if(!$hideButtonEdit): ?>
                        <?php if($checkButtonReconciled): ?>
                            <?php if(!$item->reconciled): ?>
                                <a class="dropdown-item" href="<?php echo e(route($routeButtonEdit, $item->id)); ?>"><?php echo e(trans('general.edit')); ?></a>
                            <?php endif; ?>
                        <?php else: ?>
                            <a class="dropdown-item" href="<?php echo e(route($routeButtonEdit, $item->id)); ?>"><?php echo e(trans('general.edit')); ?></a>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php echo $__env->yieldPushContent('edit_button_end'); ?>

                    <?php if($checkButtonCancelled): ?>
                        <?php if($item->status != 'cancelled'): ?>
                            <?php echo $__env->yieldPushContent('duplicate_button_start'); ?>
                            <?php if(!$hideButtonDuplicate): ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($permissionCreate)): ?>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo e(route($routeButtonDuplicate, $item->id)); ?>"><?php echo e(trans('general.duplicate')); ?></a>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php echo $__env->yieldPushContent('duplicate_button_end'); ?>

                            <?php echo $__env->yieldPushContent('cancel_button_start'); ?>
                            <?php if(!$hideButtonCancel): ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($permissionUpdate)): ?>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="<?php echo e(route($routeButtonCancelled, $item->id)); ?>"><?php echo e(trans('general.cancel')); ?></a>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php echo $__env->yieldPushContent('cancel_button_end'); ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php echo $__env->yieldPushContent('duplicate_button_start'); ?>
                        <?php if(!$hideButtonDuplicate): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($permissionCreate)): ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo e(route($routeButtonDuplicate, $item->id)); ?>"><?php echo e(trans('general.duplicate')); ?></a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php echo $__env->yieldPushContent('duplicate_button_end'); ?>

                        <?php echo $__env->yieldPushContent('cancel_button_start'); ?>
                        <?php if(!$hideButtonCancel): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($permissionUpdate)): ?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="<?php echo e(route($routeButtonCancelled, $item->id)); ?>"><?php echo e(trans('general.cancel')); ?></a>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php echo $__env->yieldPushContent('cancel_button_end'); ?>
                    <?php endif; ?>

                    <?php echo $__env->yieldPushContent('delete_button_start'); ?>
                    <?php if(!$hideButtonDelete): ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($permissionDelete)): ?>
                            <?php if($checkButtonReconciled): ?>
                                <?php if(!$item->reconciled): ?>
                                    <?php echo Form::deleteLink($item, $routeButtonDelete, $textModalDelete, $valueModalDelete); ?>

                                <?php endif; ?>
                            <?php else: ?>
                                <?php echo Form::deleteLink($item, $routeButtonDelete, $textModalDelete, $valueModalDelete); ?>

                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <?php echo $__env->yieldPushContent('delete_button_end'); ?>
                </div>
            </div>
        </td>
    <?php endif; ?>
</tr>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/documents/index/card-table-row.blade.php ENDPATH**/ ?>