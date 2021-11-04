<?php $__env->startSection('title', trans_choice('general.transfers', 2)); ?>

<?php $__env->startSection('new_button'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-banking-transfers')): ?>
        <a href="<?php echo e(route('transfers.create')); ?>" class="btn btn-success btn-sm"><?php echo e(trans('general.add_new')); ?></a>
    <?php endif; ?>
    <a href="<?php echo e(route('import.create', ['banking', 'transfers'])); ?>" class="btn btn-white btn-sm"><?php echo e(trans('import.import')); ?></a>
    <a href="<?php echo e(route('transfers.export', request()->input())); ?>" class="btn btn-white btn-sm"><?php echo e(trans('general.export')); ?></a>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if($transfers->count() || request()->get('search', false)): ?>
        <div class="card">
            <div class="card-header border-bottom-0" :class="[{'bg-gradient-primary': bulk_action.show}]">
                <?php echo Form::open([
                    'method' => 'GET',
                    'route' => 'transfers.index',
                    'role' => 'form',
                    'class' => 'mb-0'
                ]); ?>

                    <div class="align-items-center" v-if="!bulk_action.show">
                        <?php if (isset($component)) { $__componentOriginaldec57d2dc7c3b62478d574f9a4a67fba694d4f23 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\SearchString::class, ['model' => 'App\Models\Banking\Transfer']); ?>
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

                    <?php echo e(Form::bulkActionRowGroup('general.transfers', $bulk_actions, ['group' => 'banking', 'type' => 'transfers'])); ?>

                <?php echo Form::close(); ?>

            </div>

            <div class="table-responsive">
                <table class="table table-flush table-hover">
                    <thead class="thead-light">
                        <tr class="row table-head-line">
                            <th class="col-sm-2 col-md-1 d-none d-sm-block"><?php echo e(Form::bulkActionAllGroup()); ?></th>
                            <th class="col-md-2 d-none d-md-block"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('expense_transaction.paid_at', trans('general.date'), ['filter' => 'active, visible'], ['class' => 'col-aka', 'rel' => 'nofollow']));?></th>
                            <th class="col-sm-2 col-md-3 d-none d-sm-block"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('expense_transaction.name', trans('transfers.from_account')));?></th>
                            <th class="col-xs-4 col-sm-4 col-md-2"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('income_transaction.name', trans('transfers.to_account')));?></th>
                            <th class="col-xs-4 col-sm-2 col-md-2 text-right"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('expense_transaction.amount', trans('general.amount')));?></th>
                            <th class="col-xs-4 col-sm-2 col-md-2 text-center"><?php echo e(trans('general.actions')); ?></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $transfers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                            $item->name = trans('transfers.messages.delete', [
                                'from' => $item->expense_transaction->account->name,
                                'to' => $item->income_transaction->account->name,
                                'amount' => money($item->expense_transaction->amount, $item->expense_transaction->currency_code, true)
                            ]);
                            ?>
                            <tr class="row align-items-center border-top-1">
                                <td class="col-sm-2 col-md-1 d-none d-sm-block"><?php echo e(Form::bulkActionGroup($item->id, $item->expense_transaction->account->name)); ?></td>
                                <td class="col-md-2 d-none d-md-block"><a class="col-aka" href="<?php echo e(route('transfers.show', $item->id)); ?>"><?php echo company_date($item->expense_transaction->paid_at); ?></a></td>
                                <td class="col-sm-2 col-md-3 d-none d-sm-block long-texts"><?php echo e($item->expense_transaction->account->name); ?></td>
                                <td class="col-xs-4 col-sm-4 col-md-2 long-texts"><?php echo e($item->income_transaction->account->name); ?></td>
                                <td class="col-xs-4 col-sm-2 col-md-2 text-right long-texts"><?php echo money($item->expense_transaction->amount, $item->expense_transaction->currency_code, true); ?></td>
                                <td class="col-xs-4 col-sm-2 col-md-2 text-center">
                                    <div class="dropdown">
                                        <a class="btn btn-neutral btn-sm text-light items-align-center py-2" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa fa-ellipsis-h text-muted"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                            <a class="dropdown-item" href="<?php echo e(route('transfers.show', $item->id)); ?>"><?php echo e(trans('general.show')); ?></a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="<?php echo e(route('transfers.edit', $item->id)); ?>"><?php echo e(trans('general.edit')); ?></a>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-banking-transfers')): ?>
                                                <div class="dropdown-divider"></div>
                                                <?php echo Form::deleteLink($item, 'transfers.destroy'); ?>

                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <div class="card-footer table-action">
                <div class="row">
                    <?php echo $__env->make('partials.admin.pagination', ['items' => $transfers], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                </div>
            </div>
        </div>
    <?php else: ?>
        <?php if (isset($component)) { $__componentOriginald468e2fade69e67273028f1262ac2cab98f9a730 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\EmptyPage::class, ['group' => 'banking','page' => 'transfers']); ?>
<?php $component->withName('empty-page'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginald468e2fade69e67273028f1262ac2cab98f9a730)): ?>
<?php $component = $__componentOriginald468e2fade69e67273028f1262ac2cab98f9a730; ?>
<?php unset($__componentOriginald468e2fade69e67273028f1262ac2cab98f9a730); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script src="<?php echo e(asset('public/js/banking/transfers.js?v=' . version('short'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/banking/transfers/index.blade.php ENDPATH**/ ?>