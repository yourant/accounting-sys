<tr class="row mb-10">
    <?php echo $__env->yieldPushContent('name_td_start'); ?>
    <td class="col-md-3">
        <?php echo $__env->yieldPushContent('name_input_start'); ?>

        <?php echo e(Form::selectGroup('option_id', null, 'fas fa-align-justify', $options, null, ['required' => 'required', 'change' => 'getOptionsValue'], 'col-md-12')); ?>


        <?php echo $__env->yieldPushContent('name_input_end'); ?>
    </td>
    <?php echo $__env->yieldPushContent('name_td_end'); ?>

    <?php echo $__env->yieldPushContent('value_td_start'); ?>
    <td class="col-md-9">
        <?php echo $__env->yieldPushContent('value_input_start'); ?>
        
          <el-select :disabled="!option_values.length" v-model="form.option_values" @change="onAddOption" multiple @remove-tag="onDeleteOption" placeholder="Select Value">
            <el-option
              v-for="option in option_values"
              :disabled="form.option_values.includes(option.value)"
              :key="option.value"
              :label="option.label"
              :value="option.value">
            </el-option>
          </el-select>

        <?php echo $__env->yieldPushContent('value_input_end'); ?>
    </td>
    <?php echo $__env->yieldPushContent('value_td_end'); ?>
</tr>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\modules\Inventory\Providers/../Resources/views/item-groups/option.blade.php ENDPATH**/ ?>