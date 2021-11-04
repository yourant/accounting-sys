<tr>
    <?php echo $__env->yieldPushContent('name_td_start'); ?>
        <?php if(!$hideItems || (!$hideName && !$hideDescription)): ?>
            <td class="item">
                <?php if(!$hideName): ?>
                    <?php echo e($item->name); ?>

                <?php endif; ?>

                <?php if(!$hideDescription): ?>
                    <?php if(!empty($item->description)): ?>
                        <br><small><?php echo \Illuminate\Support\Str::limit($item->description, 500); ?></small>
                    <?php endif; ?>
                <?php endif; ?>

                <?php echo $__env->yieldPushContent('item_custom_fields'); ?>
                <?php echo $__env->yieldPushContent('item_custom_fields_' . $item->id); ?>
            </td>
        <?php endif; ?>
    <?php echo $__env->yieldPushContent('name_td_end'); ?>

    <?php echo $__env->yieldPushContent('quantity_td_start'); ?>
        <?php if(!$hideQuantity): ?>
            <td class="quantity"><?php echo e($item->quantity); ?></td>
        <?php endif; ?>
    <?php echo $__env->yieldPushContent('quantity_td_end'); ?>

    <?php echo $__env->yieldPushContent('price_td_start'); ?>
        <?php if(!$hidePrice): ?>
            <td class="price"><?php echo money($item->price, $document->currency_code, true); ?></td>
        <?php endif; ?>
    <?php echo $__env->yieldPushContent('price_td_end'); ?>

    <?php if(!$hideDiscount): ?>
        <?php if(in_array(setting('localisation.discount_location', 'total'), ['item', 'both'])): ?>
            <?php echo $__env->yieldPushContent('discount_td_start'); ?>
                <td class="discount"><?php echo e($item->discount); ?></td>
            <?php echo $__env->yieldPushContent('discount_td_end'); ?>
        <?php endif; ?>
    <?php endif; ?>

    <?php echo $__env->yieldPushContent('total_td_start'); ?>
        <?php if(!$hideAmount): ?>
            <td class="total"><?php echo money($item->total, $document->currency_code, true); ?></td>
        <?php endif; ?>
    <?php echo $__env->yieldPushContent('total_td_end'); ?>
</tr>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/documents/template/line-item.blade.php ENDPATH**/ ?>