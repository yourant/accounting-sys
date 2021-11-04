<?php echo $__env->yieldPushContent('button_group_start'); ?>
<?php if(!$hideButtonMoreActions): ?>
    <div class="dropup header-drop-top">
        <button type="button" class="btn btn-white btn-sm" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-chevron-down"></i>&nbsp; <?php echo e(trans('general.more_actions')); ?>

        </button>

        <div class="dropdown-menu" role="menu">
            <?php echo $__env->yieldPushContent('button_dropdown_start'); ?>
            <?php if(in_array($document->status, $hideTimelineStatuses)): ?>
                <?php echo $__env->yieldPushContent('edit_button_start'); ?>
                    <?php if(!$hideButtonEdit): ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($permissionUpdate)): ?>
                            <a class="dropdown-item" href="<?php echo e(route($routeButtonEdit, $document->id)); ?>">
                                <?php echo e(trans('general.edit')); ?>

                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php echo $__env->yieldPushContent('edit_button_end'); ?>
            <?php endif; ?>

            <?php echo $__env->yieldPushContent('duplicate_button_start'); ?>
                <?php if(!$hideButtonDuplicate): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($permissionCreate)): ?>
                        <a class="dropdown-item" href="<?php echo e(route($routeButtonDuplicate, $document->id)); ?>">
                            <?php echo e(trans('general.duplicate')); ?>

                        </a>
                    <?php endif; ?>
                <?php endif; ?>
            <?php echo $__env->yieldPushContent('duplicate_button_end'); ?>

            <?php echo $__env->yieldPushContent('button_dropdown_divider_1_start'); ?>
                <?php if(!$hideButtonGroupDivider1): ?>
                    <div class="dropdown-divider"></div>
                <?php endif; ?>
            <?php echo $__env->yieldPushContent('button_dropdown_divider_1_end'); ?>

            <?php if(!$hideButtonPrint): ?>
                <?php if($checkButtonCancelled): ?>
                    <?php if($document->status != 'cancelled'): ?>
                        <?php echo $__env->yieldPushContent('button_print_start'); ?>
                        <a class="dropdown-item" href="<?php echo e(route($routeButtonPrint, $document->id)); ?>" target="_blank">
                            <?php echo e(trans('general.print')); ?>

                        </a>
                        <?php echo $__env->yieldPushContent('button_print_end'); ?>
                    <?php endif; ?>
                <?php else: ?>
                    <?php echo $__env->yieldPushContent('button_print_start'); ?>
                    <a class="dropdown-item" href="<?php echo e(route($routeButtonPrint, $document->id)); ?>" target="_blank">
                        <?php echo e(trans('general.print')); ?>

                    </a>
                    <?php echo $__env->yieldPushContent('button_print_end'); ?>
                <?php endif; ?>
            <?php endif; ?>

            <?php if(in_array($document->status, $hideTimelineStatuses)): ?>
                <?php echo $__env->yieldPushContent('share_button_start'); ?>
                    <?php if(!$hideButtonShare): ?>
                        <?php if($document->status != 'cancelled'): ?>
                            <a class="dropdown-item" href="<?php echo e($signedUrl); ?>" target="_blank">
                                <?php echo e(trans('general.share')); ?>

                            </a>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php echo $__env->yieldPushContent('share_button_end'); ?>

                <?php echo $__env->yieldPushContent('edit_button_start'); ?>
                    <?php if(!$hideButtonEmail): ?>
                        <?php if($document->contact_email): ?>
                            <a class="dropdown-item" href="<?php echo e(route($routeButtonEmail, $document->id)); ?>">
                                <?php echo e(trans($textTimelineSendStatusMail)); ?>

                            </a>
                        <?php else: ?>
                            <el-tooltip content="<?php echo e(trans('invoices.messages.email_required')); ?>" placement="right">
                                <button type="button" class="dropdown-item btn-tooltip">
                                    <span class="text-disabled"><?php echo e(trans($textTimelineSendStatusMail)); ?></span>
                                </button>
                            </el-tooltip>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php echo $__env->yieldPushContent('edit_button_end'); ?>
            <?php endif; ?>

            <?php echo $__env->yieldPushContent('button_pdf_start'); ?>
                <?php if(!$hideButtonPdf): ?>
                    <a class="dropdown-item" href="<?php echo e(route($routeButtonPdf, $document->id)); ?>">
                        <?php echo e(trans('general.download_pdf')); ?>

                    </a>
                <?php endif; ?>
            <?php echo $__env->yieldPushContent('button_pdf_end'); ?>

            <?php if(!$hideButtonCancel): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($permissionUpdate)): ?>
                    <?php if($checkButtonCancelled): ?>
                        <?php if($document->status != 'cancelled'): ?>
                            <?php echo $__env->yieldPushContent('button_cancelled_start'); ?>
                            <a class="dropdown-item" href="<?php echo e(route($routeButtonCancelled, $document->id)); ?>">
                                <?php echo e(trans('general.cancel')); ?>

                            </a>
                            <?php echo $__env->yieldPushContent('button_cancelled_end'); ?>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php echo $__env->yieldPushContent('button_cancelled_start'); ?>
                        <a class="dropdown-item" href="<?php echo e(route($routeButtonCancelled, $document->id)); ?>">
                            <?php echo e(trans('general.cancel')); ?>

                        </a>
                        <?php echo $__env->yieldPushContent('button_cancelled_end'); ?>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>

            <?php echo $__env->yieldPushContent('button_dropdown_divider_2_start'); ?>
                <?php if(!$hideButtonGroupDivider2): ?>
                    <div class="dropdown-divider"></div>
                <?php endif; ?>
            <?php echo $__env->yieldPushContent('button_dropdown_divider_2_end'); ?>

            <?php if(!$hideButtonCustomize): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($permissionButtonCustomize)): ?>
                    <?php echo $__env->yieldPushContent('button_customize_start'); ?>
                    <a class="dropdown-item" href="<?php echo e(route($routeButtonCustomize)); ?>">
                        <?php echo e(trans('general.customize')); ?>

                    </a>
                    <?php echo $__env->yieldPushContent('button_customize_end'); ?>
                <?php endif; ?>
            <?php endif; ?>

            <?php echo $__env->yieldPushContent('button_dropdown_divider_3_start'); ?>
                <?php if(!$hideButtonGroupDivider3): ?>
                    <div class="dropdown-divider"></div>
                <?php endif; ?>
            <?php echo $__env->yieldPushContent('button_dropdown_divider_3_end'); ?>

            <?php echo $__env->yieldPushContent('delete_button_start'); ?>
                <?php if(!$hideButtonDelete): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($permissionDelete)): ?>
                        <?php if($checkButtonReconciled): ?>
                            <?php if(!$document->reconciled): ?>
                                <?php echo Form::deleteLink($document, $routeButtonDelete, $textDeleteModal, 'document_number'); ?>

                            <?php endif; ?>
                        <?php else: ?>
                            <?php echo Form::deleteLink($document, $routeButtonDelete, $textDeleteModal, 'document_number'); ?>

                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            <?php echo $__env->yieldPushContent('delete_button_end'); ?>
            <?php echo $__env->yieldPushContent('button_dropdown_end'); ?>
        </div>
    </div>
<?php endif; ?>
<?php echo $__env->yieldPushContent('button_group_end'); ?>

<?php echo $__env->yieldPushContent('add_new_button_start'); ?>
<?php if(!$hideButtonAddNew): ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($permissionCreate)): ?>
        <a href="<?php echo e(route($routeButtonAddNew)); ?>" class="btn btn-white btn-sm">
            <?php echo e(trans('general.add_new')); ?>

        </a>
    <?php endif; ?>
<?php endif; ?>
<?php echo $__env->yieldPushContent('add_new_button_end'); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/documents/show/top-buttons.blade.php ENDPATH**/ ?>