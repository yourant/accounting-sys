<?php if(!isset($field->show) || (isset($field->show) && $field->show == 'always') || (isset($field->show) && $field->show == 'if_filled' && !empty($field_value))): ?>
    <?php if($show_type == 'default'): ?>
        <strong>
            <?php echo e($field->name); ?>:
        </strong>
        <span class="float-right">
            <?php echo e($field_value); ?>

        </span>
        <br>
        <br>
    <?php elseif($show_type == 'items'): ?>
        <br>
        <small>
            <?php echo e($field->name); ?>:<?php echo e($field_value); ?>

        </small>
    <?php elseif($show_type == 'transactions'): ?>
        <tr>
            <td style="width: 20%; padding-bottom:3px; font-size:14px; font-weight: bold;">
                <?php echo e($field->name); ?>:
            </td>

            <td class="border-bottom-1" style="width:80%; padding-bottom:3px; font-size:14px;">
                <?php echo e($field_value); ?>

            </td>
        </tr>
    <?php elseif($show_type == 'contacts'): ?>
        <li class="list-group-item border-0 border-top-1">
            <div class="font-weight-600"><?php echo e($field->name); ?></div>
            <div><small><?php echo e($field_value); ?></small></div>
        </li>
    <?php endif; ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\modules\CustomFields\Providers/../Resources/views/field_show.blade.php ENDPATH**/ ?>