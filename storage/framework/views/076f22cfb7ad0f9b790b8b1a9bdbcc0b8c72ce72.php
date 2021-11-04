<tr class="row" v-for="(row, index) in form.items"
    :index="index">
    <?php echo $__env->yieldPushContent('name_td_start'); ?>
    <td class="col-md-2 action-column border-right-0 border-bottom-0">
        <?php echo $__env->yieldPushContent('name_input_start'); ?>
          <input class="form-control"
            data-item="name"
            required="required"
            name="items[][name]"
            v-model="row.name"
            type="text"
            autocomplete="off">

        <input class="form-control"
            data-item="option_value_id"
            required="required"
            name="items[][option_value_id]"
            v-model="row.option_value_id"
            type="hidden"
            autocomplete="off">
        <?php echo $__env->yieldPushContent('name_input_end'); ?>
    </td>
    <?php echo $__env->yieldPushContent('name_td_end'); ?>

    <?php echo $__env->yieldPushContent('sku_td_start'); ?>
    <td class="col-md-1 action-column border-right-0 border-bottom-0">
        <?php echo $__env->yieldPushContent('sku_input_start'); ?>
        <input class="form-control"
            data-item="sku"
            required="required"
            name="items[][sku]"
            v-model="row.sku"
            type="text"
            autocomplete="off">
        <?php echo $__env->yieldPushContent('sku_input_end'); ?>
    </td>
    <?php echo $__env->yieldPushContent('sku_td_end'); ?>

    <?php echo $__env->yieldPushContent('opening_stock_td_start'); ?>
    <td class="col-md-2 action-column border-right-0 border-bottom-0">
        <?php echo $__env->yieldPushContent('opening_stock_input_start'); ?>
        <input class="form-control"
            data-item="opening_stock"
            required="required"
            name="items[][opening_stock]"
            v-model="row.opening_stock"
            type="text"
            autocomplete="off">
        <?php echo $__env->yieldPushContent('opening_stock_input_end'); ?>
    </td>
    <?php echo $__env->yieldPushContent('opening_stock_td_end'); ?>

    <?php echo $__env->yieldPushContent('opening_stock_value_td_start'); ?>
    <td class="col-md-2 action-column border-right-0 border-bottom-0">
        <?php echo $__env->yieldPushContent('opening_stock_value_input_start'); ?>
        <input class="form-control"
            data-item="opening_stock_value"
            required="required"
            name="items[][opening_stock_value]"
            v-model="row.opening_stock_value"
            type="text"
            autocomplete="off">
        <?php echo $__env->yieldPushContent('opening_stock_value_input_end'); ?>
    </td>
    <?php echo $__env->yieldPushContent('opening_stock_value_td_end'); ?>

    <?php echo $__env->yieldPushContent('sale_price_td_start'); ?>
    <td class="col-md-2 action-column border-right-0 border-bottom-0">
        <?php echo $__env->yieldPushContent('sale_price_input_start'); ?>
        <input class="form-control"
            data-item="sale_price"
            required="required"
            name="items[][sale_price]"
            v-model="row.sale_price"
            type="text"
            autocomplete="off">
        <?php echo $__env->yieldPushContent('sale_price_input_end'); ?>
    </td>
    <?php echo $__env->yieldPushContent('sale_price_td_end'); ?>

    <?php echo $__env->yieldPushContent('purchase_price_td_start'); ?>
    <td class="col-md-2 action-column border-right-0 border-bottom-0">
        <?php echo $__env->yieldPushContent('purchase_price_input_start'); ?>
        <input class="form-control"
            data-item="purchase_price"
            required="required"
            name="items[][purchase_price]"
            v-model="row.purchase_price"
            type="text"
            autocomplete="off">
        <?php echo $__env->yieldPushContent('purchase_price_input_end'); ?>
    </td>
    <?php echo $__env->yieldPushContent('purchase_price_td_end'); ?>

    <?php echo $__env->yieldPushContent('reorder_level_td_start'); ?>
    <td class="col-md-1 action-column border-right-0 border-bottom-0">
        <?php echo $__env->yieldPushContent('reorder_level_input_start'); ?>
        <input class="form-control"
            data-item="reorder_level"
            required="required"
            name="items[][reorder_level]"
            v-model="row.reorder_level"
            type="text"
            autocomplete="off">
        <?php echo $__env->yieldPushContent('reorder_level_input_end'); ?>
    </td>
    <?php echo $__env->yieldPushContent('reorder_level_td_end'); ?>
</tr>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\modules\Inventory\Providers/../Resources/views/item-groups/item.blade.php ENDPATH**/ ?>