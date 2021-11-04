<?php $__env->startSection('title', trans_choice('general.transactions', 2)); ?>

<?php $__env->startSection('new_button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-sales-revenues')): ?>
        <a href="<?php echo e(route('revenues.create')); ?>" class="btn btn-success btn-sm"><?php echo e(trans('general.add_income')); ?></a>
    <?php endif; ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-purchases-payments')): ?>
        <a href="<?php echo e(route('payments.create')); ?>" class="btn btn-success btn-sm"><?php echo e(trans('general.add_expense')); ?></a>
    <?php endif; ?>
    <a href="<?php echo e(route('import.create', ['banking', 'transactions'])); ?>" class="btn btn-white btn-sm"><?php echo e(trans('import.import')); ?></a>
    <a href="<?php echo e(route('transactions.export', request()->input())); ?>" class="btn btn-white btn-sm"><?php echo e(trans('general.export')); ?></a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header border-bottom-0" :class="[{'bg-gradient-primary': bulk_action.show}]">
            <?php echo Form::open([
                'method' => 'GET',
                'route' => 'transactions.index',
                'role' => 'form',
                'class' => 'mb-0'
            ]); ?>

                <div class="align-items-center" v-if="!bulk_action.show">
                    <?php if (isset($component)) { $__componentOriginaldec57d2dc7c3b62478d574f9a4a67fba694d4f23 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\SearchString::class, ['model' => 'App\Models\Banking\Transaction']); ?>
<?php $component->withName('search-string'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginaldec57d2dc7c3b62478d574f9a4a67fba694d4f23)): ?>
<?php $component = $__componentOriginaldec57d2dc7c3b62478d574f9a4a67fba694d4f23; ?>
<?php unset($__componentOriginaldec57d2dc7c3b62478d574f9a4a67fba694d4f23); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                </div>

                <?php echo e(Form::bulkActionRowGroup('general.transactions', $bulk_actions, ['group' => 'banking', 'type' => 'transactions'])); ?>

            <?php echo Form::close(); ?>

        </div>

        <div class="table-responsive">
            <table class="table table-flush table-hover">
                <thead class="thead-light">
                    <tr class="row table-head-line">
                        <th class="col-sm-2 col-md-2 col-lg-1 col-xl-1 d-none d-sm-block"><?php echo e(Form::bulkActionAllGroup()); ?></th>
                        <th class="col-xs-4 col-sm-4 col-md-3 col-lg-1 col-xl-1"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('paid_at', trans('general.date'), ['filter' => 'active, visible'], ['class' => 'col-aka', 'rel' => 'nofollow']));?></th>
                        <th class="col-xs-4 col-sm-4 col-md-3 col-lg-2 col-xl-2 text-right"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('amount', trans('general.amount')));?></th>
                        <th class="col-md-2 col-lg-1 col-xl-1 d-none d-md-block text-left"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('type', trans_choice('general.types', 1)));?></th>
                        <th class="col-lg-2 col-xl-2 d-none d-lg-block text-left"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('category.name', trans_choice('general.categories', 1)));?></th>
                        <th class="col-lg-2 col-xl-2 d-none d-lg-block text-left"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('account.name', trans_choice('general.accounts', 1)));?></th>
                        <th class="col-xs-4 col-sm-2 col-md-2 col-lg-3 col-xl-3 d-none d-md-block"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('description', trans('general.description')));?></th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="row align-items-center border-top-1">
                            <td class="col-sm-2 col-md-2 col-lg-1 col-xl-1 d-none d-sm-block"><?php echo e(Form::bulkActionGroup($item->id, $item->contact->name)); ?></td>
                            <td class="col-xs-4 col-sm-4 col-md-3 col-lg-1 col-xl-1">
                                <a class="col-aka" href="<?php echo e(route($item->route_name, $item->route_id)); ?>">
                                    <?php echo company_date($item->paid_at); ?>
                                </a>
                            </td>
                            <td class="col-xs-4 col-sm-4 col-md-3 col-lg-2 col-xl-2 text-right"><?php echo money($item->amount, $item->currency_code, true); ?></td>
                            <td class="col-md-2 col-lg-1 col-xl-1 d-none d-md-block text-left"><?php echo e($item->type_title); ?></td>
                            <td class="col-lg-2 col-xl-2 d-none d-lg-block text-left"><?php echo e($item->category->name); ?></td>
                            <td class="col-lg-2 col-xl-2 d-none d-lg-block text-left long-texts"><?php echo e($item->account->name); ?></td>
                            <td class="col-xs-4 col-sm-2 col-md-2 col-lg-3 col-xl-3 d-none d-md-block long-texts"><?php echo e($item->description); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="card-footer table-action">
            <div class="row">
                <?php echo $__env->make('partials.admin.pagination', ['items' => $transactions], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script src="<?php echo e(asset('public/js/banking/transactions.js?v=' . version('short'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/banking/transactions/index.blade.php ENDPATH**/ ?>