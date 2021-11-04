<?php $__env->startSection('title', trans('general.title.new', ['type' => trans_choice('general.reconciliations', 1)])); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <?php echo Form::open([
            'method' => 'GET',
            'route' => 'reconciliations.create',
            'id' => 'form-create-reconciliation',
            'files' => true,
            'role' => 'form',
            'class' => 'form-loading-button mb-0',
            'novalidate' => true
        ]); ?>


            <div class="card-body">
                <div class="row align-items-center">
                    <?php echo e(Form::dateGroup('started_at', trans('reconciliations.start_date'), 'calendar', ['id' => 'started_at', 'class' => 'form-control datepicker', 'required' => 'required', 'show-date-format' => company_date_format(), 'date-format' => 'Y-m-d', 'autocomplete' => 'off', 'change' => 'setDueMinDate'], request('started_at', Date::now()->firstOfMonth()->toDateString()), 'col-xl-3')); ?>


                    <?php echo e(Form::dateGroup('ended_at', trans('reconciliations.end_date'), 'calendar', ['id' => 'ended_at', 'class' => 'form-control datepicker', 'required' => 'required', 'show-date-format' => company_date_format(), 'date-format' => 'Y-m-d', 'autocomplete' => 'off', 'min-date' => 'form.started_at', 'min-date-dynamic' => 'min_due_date', 'data-value-min' => true, 'period' => 30], request('ended_at', Date::now()->endOfMonth()->toDateString()), 'col-xl-3')); ?>


                    <?php echo e(Form::moneyGroup('closing_balance', trans('reconciliations.closing_balance'), 'balance-scale', ['required' => 'required', 'autofocus' => 'autofocus', 'currency' => $currency, 'dynamic-currency' => 'currency', 'input' => 'onCalculate'], request('closing_balance', 0.00), 'col-xl-2')); ?>


                    <?php echo e(Form::selectAddNewGroup('account_id', trans_choice('general.accounts', 1), 'university', $accounts, request('account_id', setting('default.account')), ['required' => 'required', 'path' => route('modals.accounts.create'), 'change' => 'onChangeAccount'], 'col-xl-2')); ?>


                    <div class="col-xl-2">
                        <?php echo Form::button(trans('reconciliations.transactions'), ['type' => 'button', '@click' => 'onReconcilition', 'class' => 'btn btn-outline-primary']); ?>

                    </div>
                </div>
            </div>

        <?php echo Form::close(); ?>

    </div>

    <div id="reconciliations-table" class="card">
        <div class="card-header border-0">
            <h3 class="mb-0"><?php echo e(trans_choice('general.transactions', 2)); ?></h3>
        </div>

        <?php echo Form::open([
            'id' => 'reconciliation',
            'route' => 'reconciliations.store',
            '@submit.prevent' => 'onSubmit',
            '@keydown' => 'form.errors.clear($event.target.name)',
            'role' => 'form',
            'class' => 'form-loading-button mb-0',
        ]); ?>


            <?php echo e(Form::hidden('account_id', $account->id)); ?>

            <?php echo e(Form::hidden('currency_code', $currency->code, ['id' => 'currency_code'])); ?>

            <?php echo e(Form::hidden('opening_balance', $opening_balance, ['id' => 'opening_balance'])); ?>

            <?php echo e(Form::hidden('closing_balance', request('closing_balance', '0'), ['id' => 'closing_balance'])); ?>

            <?php echo e(Form::hidden('started_at', request('started_at'))); ?>

            <?php echo e(Form::hidden('ended_at', request('ended_at'))); ?>

            <?php echo e(Form::hidden('reconcile', '0', ['id' => 'hidden-reconcile'])); ?>


            <div class="table-responsive">
                <table class="table table-flush table-hover">
                    <thead class="thead-light">
                        <tr class="row table-head-line">
                            <th class="col-xs-4 col-sm-3 col-md-2 long-texts"><?php echo e(trans('general.date')); ?></th>
                            <th class="col-md-2 text-center d-none d-md-block"><?php echo e(trans('general.description')); ?></th>
                            <th class="col-md-2 col-sm-3 col-md-3 d-none d-sm-block"><?php echo e(trans_choice('general.contacts', 1)); ?></th>
                            <th class="col-xs-4 col-sm-3 col-md-2 text-right"><?php echo e(trans('reconciliations.deposit')); ?></th>
                            <th class="col-xs-4 col-sm-3 col-md-2 text-right long-texts"><?php echo e(trans('reconciliations.withdrawal')); ?></th>
                            <th class="col-md-1 text-right d-none d-md-block"><?php echo e(trans('general.clear')); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="row align-items-center border-top-1">
                                <td class="col-xs-4 col-sm-3 col-md-2 long-texts"><?php echo company_date($item->paid_at); ?></td>
                                <td class="col-md-2 text-center d-none d-md-block"><?php echo e($item->description); ?></td>
                                <td class="col-md-2 col-sm-3 col-md-3 d-none d-sm-block"><?php echo e($item->contact->name); ?></td>
                                <?php if($item->isIncome()): ?>
                                    <td class="col-xs-4 col-sm-3 col-md-2 text-right"><?php echo money($item->amount, $item->currency_code, true); ?></td>
                                    <td class="col-xs-4 col-sm-3 col-md-2 text-right">N/A</td>
                                <?php else: ?>
                                    <td class="col-xs-4 col-sm-3 col-md-2 text-right">N/A</td>
                                    <td class="col-xs-4 col-sm-3 col-md-2 text-right"><?php echo money($item->amount, $item->currency_code, true); ?></td>
                                <?php endif; ?>
                                <td class="col-md-1 text-right d-none d-md-block">
                                    <div class="custom-control custom-checkbox">
                                        <?php $type = $item->isIncome() ? 'income' : 'expense'; ?>
                                        <?php echo e(Form::checkbox($type . '_' . $item->id, $item->amount_for_account, $item->reconciled, [
                                            'data-field' => 'transactions',
                                            'v-model' => 'form.transactions.' . $type . '_' . $item->id,
                                            'id' => 'transaction-' . $item->id . '-'. $type,
                                            'class' => 'custom-control-input',
                                            '@change' => 'onCalculate'
                                        ])); ?>

                                        <label class="custom-control-label" for="transaction-<?php echo e($item->id . '-'. $type); ?>"></label>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <?php if($transactions->count()): ?>
                    <table class="table">
                        <tbody>
                            <tr class="row">
                                <th class="col-md-9 col-lg-11 text-right d-none d-md-block"><?php echo e(trans('reconciliations.opening_balance')); ?>:</th>
                                <td id="closing-balance" class="col-md-3 col-lg-1 text-right d-none d-md-block">
                                    <span class="w-auto position-absolute right-4 text-sm"><?php echo money($opening_balance, $account->currency_code, true); ?></span>
                                </td>
                            </tr>
                            <tr class="row">
                                <th class="col-md-9 col-lg-11 text-right d-none d-md-block"><?php echo e(trans('reconciliations.closing_balance')); ?>:</th>
                                <td id="closing-balance" class="col-md-3 col-lg-1 text-right d-none d-md-block pt-0">
                                    <div class="mt-1">
                                        <?php echo e(Form::moneyGroup('closing_balance_total', '', '', ['disabled' => true, 'row-input' => 'true', 'v-model' => 'totals.closing_balance', 'currency' => $currency, 'dynamic-currency' => 'currency', 'money-class' => 'text-right disabled-money banking-price-text w-auto position-absolute right-4 text-sm js-conversion-input'], 0.00, 'text-right disabled-money')); ?>

                                    </div>
                                </td>
                            </tr>
                            <tr class="row">
                                <th class="col-md-9 col-lg-11 text-right d-none d-md-block"><?php echo e(trans('reconciliations.cleared_amount')); ?>:</th>
                                <td id="cleared-amount" class="col-md-3 col-lg-1 text-right d-none d-md-block pt-0">
                                    <div class="mt-1">
                                        <?php echo e(Form::moneyGroup('cleared_amount_total', '', '', ['disabled' => true, 'row-input' => 'true', 'v-model' => 'totals.cleared_amount', 'currency' => $currency, 'dynamic-currency' => 'currency', 'money-class' => 'text-right disabled-money banking-price-text w-auto position-absolute right-4 text-sm js-conversion-input'], 0.00, 'text-right disabled-money')); ?>

                                    </div>
                                </td>
                            </tr>
                            <tr :class="difference" class="row">
                                <th class="col-md-9 col-lg-11 text-right d-none d-md-block"><?php echo e(trans('general.difference')); ?>:</th>
                                <td id="difference" class="col-md-3 col-lg-1 text-right d-none d-md-block pt-0">
                                    <div class="mt-1 difference-money">
                                        <?php echo e(Form::moneyGroup('difference_total', '', '', ['disabled' => true, 'row-input' => 'true', 'v-model' => 'totals.difference', 'currency' => $currency, 'dynamic-currency' => 'currency', 'money-class' => 'text-right disabled-money banking-price-text w-auto position-absolute right-4 text-sm js-conversion-input'], 0.00, 'text-right disabled-money')); ?>

                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>

            <div class="card-footer">
                <div class="row">
                    <div class="col-md-12">
                        <?php if($transactions->count()): ?>
                            <div class="float-right">
                                <a href="<?php echo e(route('reconciliations.index')); ?>" class="btn btn-outline-secondary"><?php echo e(trans('general.cancel')); ?></a>

                                <?php echo Form::button(
                                    '<span v-if="form.loading" class="btn-inner--icon"><i class="aka-loader"></i></span> <span :class="[{\'opacity-10\': reconcile}]" class="btn-inner--text">' . trans('reconciliations.reconcile') . '</span>',
                                    [':disabled' => 'reconcile || form.loading', '@click' => 'onReconcileSubmit', 'type' => 'button', 'class' => 'btn btn-icon btn-info']); ?>


                                <?php echo Form::button(
                                    '<span v-if="form.loading" class="btn-inner--icon"><i class="aka-loader"></i></span> <span :class="[{\'ml-0\': form.loading}]" class="btn-inner--text">' . trans('general.save') . '</span>',
                                    [':disabled' => 'form.loading', 'type' => 'submit', 'class' => 'btn btn-icon btn-success']); ?>

                            </div>
                        <?php else: ?>
                            <div class="text-sm text-muted" id="datatable-basic_info" role="status" aria-live="polite">
                                <small><?php echo e(trans('general.no_records')); ?></small>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        <?php echo Form::close(); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script src="<?php echo e(asset('public/js/banking/reconciliations.js?v=' . version('short'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/banking/reconciliations/create.blade.php ENDPATH**/ ?>