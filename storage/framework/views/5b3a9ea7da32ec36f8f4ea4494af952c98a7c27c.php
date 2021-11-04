<div class="accordion">
    <div class="card">
        <div class="card-header" id="accordion-transactions-header" data-toggle="collapse" data-target="#accordion-transactions-body" aria-expanded="false" aria-controls="accordion-transactions-body">
            <h4 class="mb-0"><?php echo e(trans_choice('general.transactions', 2)); ?></h4>
        </div>

        <div id="accordion-transactions-body" class="collapse hide" aria-labelledby="accordion-transactions-header">
            <div class="table-responsive">
                <table class="table table-flush table-hover">
                    <thead class="thead-light">
                        <?php echo $__env->yieldPushContent('row_footer_transactions_head_tr_start'); ?>
                            <tr class="row table-head-line">
                                <?php echo $__env->yieldPushContent('row_footer_transactions_head_td_start'); ?>
                                    <?php $class = 'col-sm-3'; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->denies($permissionTransactionDelete)): ?>
                                        <?php $class = 'col-sm-4'; ?>
                                    <?php endif; ?>

                                    <th class="col-xs-4 <?php echo e($class); ?>">
                                        <?php echo e(trans('general.date')); ?>

                                    </th>

                                    <th class="col-xs-4 <?php echo e($class); ?>">
                                        <?php echo e(trans('general.amount')); ?>

                                    </th>

                                    <th class="<?php echo e($class); ?> d-none d-sm-block">
                                        <?php echo e(trans_choice('general.accounts', 1)); ?>

                                    </th>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($permissionTransactionDelete)): ?>
                                        <th class="col-xs-4 col-sm-3">
                                            <?php echo e(trans('general.actions')); ?>

                                        </th>
                                    <?php endif; ?>
                                <?php echo $__env->yieldPushContent('row_footer_transactions_head_td_end'); ?>
                            </tr>
                        <?php echo $__env->yieldPushContent('row_footer_transactions_head_tr_end'); ?>
                    </thead>

                    <tbody>
                        <?php echo $__env->yieldPushContent('row_footer_transactions_body_tr_start'); ?>
                            <?php if($transactions->count()): ?>
                                <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="row align-items-center border-top-1 tr-py">
                                        <?php echo $__env->yieldPushContent('row_footer_transactions_body_td_start'); ?>
                                            <td class="col-xs-4 <?php echo e($class); ?>">
                                                <?php echo company_date($transaction->paid_at); ?>
                                            </td>

                                            <td class="col-xs-4 <?php echo e($class); ?>">
                                                <?php echo money($transaction->amount, $transaction->currency_code, true); ?>
                                            </td>

                                            <td class="<?php echo e($class); ?> d-none d-sm-block">
                                                <?php echo e($transaction->account->name); ?>

                                            </td>

                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check($permissionTransactionDelete)): ?>
                                                <td class="col-xs-4 col-sm-3 py-0">
                                                    <?php if($transaction->reconciled): ?>
                                                        <button type="button" class="btn btn-default btn-sm">
                                                            <?php echo e(trans('reconciliations.reconciled')); ?>

                                                        </button>
                                                    <?php else: ?>
                                                        <?php $message = trans('general.delete_confirm', [
                                                            'name' => '<strong>' . Date::parse($transaction->paid_at)->format($date_format) . ' - ' . money($transaction->amount, $transaction->currency_code, true) . ' - ' . $transaction->account->name . '</strong>',
                                                            'type' => strtolower(trans_choice('general.transactions', 1))
                                                            ]);
                                                        ?>

                                                        <?php echo Form::button(trans('general.delete'), array(
                                                            'type'    => 'button',
                                                            'class'   => 'btn btn-danger btn-sm',
                                                            'title'   => trans('general.delete'),
                                                            '@click'  => 'confirmDelete("' . route('transactions.destroy', $transaction->id) . '", "' . trans_choice('general.transactions', 2) . '", "' . $message. '",  "' . trans('general.cancel') . '", "' . trans('general.delete') . '")'
                                                        )); ?>

                                                    <?php endif; ?>
                                                </td>
                                            <?php endif; ?>
                                        <?php echo $__env->yieldPushContent('row_footer_transactions_body_td_end'); ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="4">
                                        <div class="text-muted nr-py" id="datatable-basic_info" role="status" aria-live="polite">
                                            <?php echo e(trans('general.no_records')); ?>

                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php echo $__env->yieldPushContent('row_footer_transactions_body_tr_end'); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/documents/show/transactions.blade.php ENDPATH**/ ?>