<?php $__env->startSection('title', trans_choice('inventory::general.histories', 2)); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <div class="card-header border-bottom-0" :class="[{'bg-gradient-primary': bulk_action.show}]">
            <?php echo Form::open([
                'method' => 'GET',
                'route' => 'inventory.histories.index',
                'role' => 'form',
                'class' => 'mb-0'
            ]); ?>

                <div class="align-items-center" v-if="!bulk_action.show">
                    <?php if (isset($component)) { $__componentOriginaldec57d2dc7c3b62478d574f9a4a67fba694d4f23 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\SearchString::class, ['model' => 'Modules\Inventory\Models\History']); ?>
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

                <?php echo e(Form::bulkActionRowGroup('inventory::general.warehouses', $bulk_actions, ['group' => 'inventory', 'type' => 'histories'])); ?>

            <?php echo Form::close(); ?>

        </div>

        <div class="table-responsive">
            <table class="table table-flush table-hover" >
                <thead class="thead-light">
                    <tr class="row table-head-line">
                        <th class="col-md-5"><?php echo e(trans_choice('general.items', 1)); ?></th>
                        <th class="col-md-4"><?php echo e(trans_choice('inventory::general.warehouses', 1)); ?></th>
                        <th class="col-md-2"><?php echo e(trans('invoices.quantity')); ?></th>
                        <th class="col-md-1"><?php echo e(trans('general.actions')); ?></th>
                    </tr>
                </thead>

                <tbody>
                    <?php $__currentLoopData = $histories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="row align-items-center border-top-1">
                            <td class="col-md-5 border-0">
                                <a href="<?php echo e(route('inventory.items.show', $item->item_id)); ?>"><?php echo e($item->item->name); ?></a>
                            </td>
                            <td class="col-md-4 border-0">
                                <a href="<?php echo e(route('inventory.warehouses.show', $item->warehouse_id)); ?>"><?php echo e($item->warehouse->name); ?></a>
                            </td>
                            <td class="col-md-2 border-0">
                                <?php echo e($item->quantity); ?>

                            </td>
                            <td class="col-md-1 border-0">
                                <a href="<?php echo e(url($item->action_url)); ?>"><?php echo e($item->action_text); ?></a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

         <div class="card-footer table-action">
            <div class="row align-items-center">
                <?php echo $__env->make('partials.admin.pagination', ['items' => $histories, 'type' => 'histories'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script src="<?php echo e(asset('modules/Inventory/Resources/assets/js/histories.min.js?v=' . module_version('inventory'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\modules\Inventory\Providers/../Resources/views/histories/index.blade.php ENDPATH**/ ?>