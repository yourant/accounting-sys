<div class="row document-item-body">
    <div class="col-sm-12 p-0" style="table-layout: fixed;">
        <?php if(!$hideEditItemColumns): ?>
            <?php if (isset($component)) { $__componentOriginal917eeda4926d8aa92f761d569efeba01add91c41 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\EditItemColumns::class, ['type' => $type]); ?>
<?php $component->withName('edit-item-columns'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal917eeda4926d8aa92f761d569efeba01add91c41)): ?>
<?php $component = $__componentOriginal917eeda4926d8aa92f761d569efeba01add91c41; ?>
<?php unset($__componentOriginal917eeda4926d8aa92f761d569efeba01add91c41); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
        <?php endif; ?>

        <div class="table-responsive overflow-x-scroll overflow-y-hidden">
            <table class="table" id="items" style="table-layout: fixed">
                <colgroup>
                    <col class="document-item-40-px">
                    <col class="document-item-25">
                    <col class="document-item-30 description">
                    <col class="document-item-10">
                    <col class="document-item-10">
                    <col class="document-item-20">
                    <col class="document-item-40-px">
                </colgroup>
                <thead class="thead-light">
                    <tr>
                        <?php echo $__env->yieldPushContent('move_th_start'); ?>
                            <th class="border-top-0 border-right-0 border-bottom-0" style="max-width: 40px">
                                <div></div>
                            </th>
                        <?php echo $__env->yieldPushContent('move_th_end'); ?>

                        <?php if(!$hideItems): ?>
                            <?php echo $__env->yieldPushContent('name_th_start'); ?>
                                <th class="text-left border-top-0 border-right-0 border-bottom-0">
                                    <?php echo e((trans_choice($textItems, 2) != $textItems) ? trans_choice($textItems, 2) : trans($textItems)); ?>

                                </th>
                            <?php echo $__env->yieldPushContent('name_th_end'); ?>

                            <?php echo $__env->yieldPushContent('move_th_start'); ?>
                                <th class="text-left border-top-0 border-right-0 border-bottom-0"></th>
                            <?php echo $__env->yieldPushContent('move_th_end'); ?>
                        <?php endif; ?>

                        <?php echo $__env->yieldPushContent('quantity_th_start'); ?>
                            <th class="text-center pl-2 border-top-0 border-right-0 border-bottom-0">
                                <?php if(!$hideQuantity): ?>
                                    <?php echo e(trans($textQuantity)); ?>

                                <?php endif; ?>
                            </th>
                        <?php echo $__env->yieldPushContent('quantity_th_end'); ?>

                        <?php echo $__env->yieldPushContent('price_th_start'); ?>
                            <th class="text-right border-top-0 border-right-0 border-bottom-0 pr-1" style="padding-left: 5px;">
                                <?php if(!$hidePrice): ?>
                                    <?php echo e(trans($textPrice)); ?>

                                <?php endif; ?>
                            </th>
                        <?php echo $__env->yieldPushContent('price_th_end'); ?>

                        <?php echo $__env->yieldPushContent('total_th_start'); ?>
                            <th class="text-right border-top-0 border-bottom-0 item-total">
                                <?php if(!$hideAmount): ?>
                                    <?php echo e(trans($textAmount)); ?>

                                <?php endif; ?>
                            </th>
                        <?php echo $__env->yieldPushContent('total_th_end'); ?>

                        <?php echo $__env->yieldPushContent('remove_th_start'); ?>
                            <th class="border-top-0 border-right-0 border-bottom-0" style="max-width: 40px">
                                <div></div>
                            </th>
                        <?php echo $__env->yieldPushContent('remove_th_end'); ?>
                    </tr>
                </thead>

                <tbody id="<?php echo e((!$hideDiscount && in_array(setting('localisation.discount_location', 'total'), ['item', 'both'])) ? 'invoice-item-discount-rows' : 'invoice-item-rows'); ?>" class="table-padding-05">
                    <?php echo $__env->make('components.documents.form.line-item', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                    <?php echo $__env->yieldPushContent('add_item_td_start'); ?>
                        <tr id="addItem">
                            <td class="text-right border-bottom-0 p-0" colspan="7">
                                <?php if (isset($component)) { $__componentOriginalb89c9febc6514733b20bd61486f2fcf542a56efc = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\SelectItemButton::class, ['type' => ''.e($type).'','isSale' => ''.e($isSalePrice).'','isPurchase' => ''.e($isPurchasePrice).'','searchCharLimit' => ''.e($searchCharLimit).'']); ?>
<?php $component->withName('select-item-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalb89c9febc6514733b20bd61486f2fcf542a56efc)): ?>
<?php $component = $__componentOriginalb89c9febc6514733b20bd61486f2fcf542a56efc; ?>
<?php unset($__componentOriginalb89c9febc6514733b20bd61486f2fcf542a56efc); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                            </td>
                        </tr>
                    <?php echo $__env->yieldPushContent('add_item_td_end'); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/documents/form/items.blade.php ENDPATH**/ ?>