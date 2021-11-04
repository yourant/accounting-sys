<?php echo Form::open([
    'id' => 'form-transaction',
    '@submit.prevent' => 'onSubmit',
    '@keydown' => 'form.errors.clear($event.target.name)',
    'role' => 'form',
    'class' => 'form-loading-button',
    'route' => ['modals.documents.document.transactions.store', $document->id],
    'novalidate' => true
]); ?>

    <base-alert type="warning" v-if="typeof form.response !== 'undefined' && form.response.error" v-html="form.response.message"></base-alert>

    <div class="row">
        <?php echo e(Form::dateGroup('paid_at', trans('general.date'), 'calendar', ['id' => 'paid_at', 'required' => 'required', 'show-date-format' => company_date_format(), 'date-format' => 'Y-m-d', 'autocomplete' => 'off'], Date::now()->toDateString())); ?>


        <?php echo e(Form::moneyGroup('amount', trans('general.amount'), 'money-bill-alt', ['required' => 'required', 'autofocus' => 'autofocus', 'currency' => $currency, 'dynamic-currency' => 'currency'], $document->grand_total)); ?>


        <?php echo e(Form::selectGroup('account_id', trans_choice('general.accounts', 1), 'university', $accounts, setting('default.account'), ['required' => 'required', 'change' => 'onChangePaymentAccount'])); ?>


        <?php echo e(Form::textGroup('currency', trans_choice('general.currencies', 1), 'exchange-alt', ['disabled' => 'true'], $currencies[$document->currency_code])); ?>


        <?php echo e(Form::textareaGroup('description', trans('general.description'), '', null, ['rows' => '3'])); ?>


        <?php echo e(Form::selectGroup('payment_method', trans_choice('general.payment_methods', 1), 'credit-card', $payment_methods, setting('default.payment_method'), ['required' => 'requied'])); ?>


        <?php echo e(Form::textGroup('reference', trans('general.reference'), 'fa fa-file', [])); ?>


        <?php echo Form::hidden('document_id', $document->id, ['id' => 'document_id', 'class' => 'form-control', 'required' => 'required']); ?>

        <?php echo Form::hidden('category_id', $document->category->id, ['id' => 'category_id', 'class' => 'form-control', 'required' => 'required']); ?>

        <?php echo Form::hidden('amount', $document->grand_total, ['id' => 'amount', 'class' => 'form-control', 'required' => 'required']); ?>

        <?php echo Form::hidden('currency_code', $document->currency_code, ['id' => 'currency_code', 'class' => 'form-control', 'required' => 'required']); ?>

        <?php echo Form::hidden('currency_rate', $document->currency_rate, ['id' => 'currency_rate', 'class' => 'form-control', 'required' => 'required']); ?>


        <?php echo Form::hidden('type', config('type.' . $document->type . '.transaction_type')); ?>

    </div>
<?php echo Form::close(); ?>

<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/modals/documents/payment.blade.php ENDPATH**/ ?>