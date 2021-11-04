<tr v-for="(row, index) in items"
    :index="index">
    <?php echo $__env->yieldPushContent('name_td_start'); ?>
        <td class="border-right-0 border-bottom-0 p-0"
            :class="[{'has-error': form.errors.has('items.' + index + '.name') }]"
            colspan="7">
            <table class="w-100">
                <colgroup>
                    <col class="document-item-40-px">
                    <col class="document-item-25">
                    <col class="document-item-30 description">
                    <col class="document-item-10">
                    <col class="document-item-10">
                    <col class="document-item-20">
                    <col class="document-item-40-px">
                </colgroup>
                <tbody>
                    <tr>
                        <?php echo $__env->yieldPushContent('move_td_start'); ?>
                            <td class="pl-3 pb-3 align-middle border-bottom-0 move" style="max-width: 40px;" style="color: #8898aa;">
                                <div>
                                    <i class="fas fa-grip-vertical"></i>
                                </div>
                            </td>
                        <?php echo $__env->yieldPushContent('move_td_end'); ?>

                        <?php echo $__env->yieldPushContent('items_td_start'); ?>
                            <?php if(!$hideItems || (!$hideName && !$hideDescription)): ?>
                                <?php echo $__env->yieldPushContent('name_td_start'); ?>
                                    <td class="pb-3 align-middle border-bottom-0 name">
                                        <?php if(!$hideName): ?>
                                            <span class="aka-text aka-text--body" tabindex="0" v-html="row.name" v-if="row.item_id"></span>
                                            <div v-else>
                                                <?php echo $__env->yieldPushContent('name_input_start'); ?>
                                                <input type="text"
                                                    class="form-control"
                                                    :name="'items.' + index + '.name'"
                                                    autocomplete="off"
                                                    required="required"
                                                    data-item="name"
                                                    v-model="row.name"
                                                    @input="onBindingItemField(index, 'name')"
                                                    @change="form.errors.clear('items.' + index + '.name')">

                                                <div class="invalid-feedback d-block"
                                                    v-if="form.errors.has('items.' + index + '.name')"
                                                    v-html="form.errors.get('items.' + index + '.name')">
                                                </div>
                                                <?php echo $__env->yieldPushContent('name_input_end'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                <?php echo $__env->yieldPushContent('name_td_end'); ?>

                                <?php echo $__env->yieldPushContent('description_td_start'); ?>
                                    <td class="pb-3 border-bottom-0 description">
                                        <?php if(!$hideDescription): ?>
                                            <textarea
                                                class="form-control"
                                                placeholder="<?php echo e(trans('items.enter_item_description')); ?>"
                                                style="height: 46px; overflow: hidden;"
                                                :name="'items.' + index + '.description'"
                                                v-model="row.description"
                                                data-item="description"
                                                resize="none"
                                                @input="onBindingItemField(index, 'description')"
                                            ></textarea>
                                        <?php endif; ?>
                                    </td>
                                <?php echo $__env->yieldPushContent('description_td_end'); ?>
                            <?php endif; ?>
                        <?php echo $__env->yieldPushContent('items_td_end'); ?>

                        <?php echo $__env->yieldPushContent('quantity_td_start'); ?>
                            <td class="pb-3 pl-0 pr-2 border-bottom-0 quantity">
                                <?php if(!$hideQuantity): ?>
                                    <div>
                                        <?php echo $__env->yieldPushContent('quantity_input_start'); ?>
                                        <input 
                                            type="number"
                                            min="0"
                                            class="form-control text-center p-0 input-number-disabled"
                                            :name="'items.' + index + '.quantity'"
                                            autocomplete="off"
                                            required="required"
                                            data-item="quantity"
                                            v-model="row.quantity"
                                            @input="onCalculateTotal"
                                            @change="form.errors.clear('items.' + index + '.quantity')">

                                        <div class="invalid-feedback d-block"
                                            v-if="form.errors.has('items.' + index + '.quantity')"
                                            v-html="form.errors.get('items.' + index + '.quantity')">
                                        </div>
                                        <?php echo $__env->yieldPushContent('quantity_input_end'); ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                        <?php echo $__env->yieldPushContent('quantity_td_end'); ?>

                        <?php echo $__env->yieldPushContent('price_td_start'); ?>
                            <td class="pb-3 pl-0 pr-0 border-bottom-0 price" style="padding-right: 5px; padding-left: 5px;">
                                <?php if(!$hidePrice): ?>
                                    <div>
                                        <?php echo $__env->yieldPushContent('price_input_start'); ?>
                                            <?php echo e(Form::moneyGroup('price', '', '', ['required' => 'required', 'row-input' => 'true', 'v-model' => 'row.price', 'v-error' => 'form.errors.get(\'items.\' + index + \'.price\')', 'v-error-message' => 'form.errors.get(\'items.\' + index + \'.price\')' , 'data-item' => 'price', 'currency' => $currency, 'dynamic-currency' => 'currency', 'change' => 'row.price = $event; form.errors.clear(\'items.\' + index + \'.price\'); onCalculateTotal'], 0.00, 'text-right input-price p-0')); ?>

                                        <?php echo $__env->yieldPushContent('price_input_end'); ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                        <?php echo $__env->yieldPushContent('price_td_end'); ?>

                        <?php echo $__env->yieldPushContent('total_td_start'); ?>
                            <td class="text-right long-texts pb-3 border-bottom-0 total">
                                <?php if(!$hideAmount): ?>
                                    <div>
                                        <?php echo e(Form::moneyGroup('total', '', '', ['required' => 'required', 'disabled' => 'true' , 'row-input' => 'true', 'v-model' => 'row.total', 'data-item' => 'total', 'currency' => $currency, 'dynamic-currency' => 'currency'], 0.00, 'text-right input-price disabled-money')); ?>

                                    </div>
                                <?php endif; ?>
                            </td>
                        <?php echo $__env->yieldPushContent('total_td_end'); ?>

                        <?php echo $__env->yieldPushContent('delete_td_start'); ?>
                            <td class="pb-3 pl-2 align-middle border-bottom-0 delete" style="max-width: 40px;" >
                                <div>
                                    <button type="button" @click="onDeleteItem(index)" class="btn btn-link btn-delete p-0">
                                        <i class="far fa-trash-alt"></i>
                                    </button>
                                </div>
                            </td>
                        <?php echo $__env->yieldPushContent('delete_td_end'); ?>
                    </tr>
                    <tr>
                        <td class="border-top-0" colspan="3">
                            <?php echo $__env->yieldPushContent('item_custom_fields'); ?>
                        </td>
                        <td class="border-top-0 p-0" colspan="4">
                            <?php if(!$hideDiscount && in_array(setting('localisation.discount_location'), ['item', 'both'])): ?>
                            <div v-if="!row.add_tax || !row.add_discount" class="line-item-link-container position-relative">
                            <div v-if="!row.add_tax || !row.add_discount" class="line-item-link position-absolute">
                                <div class="text-left border-0 p-0 mr-5">
                                    <div>
                                        <button type="button" class="btn btn-link btn-sm p-0" @click="onAddLineDiscount(index)" v-if="!row.add_discount">
                                            <?php echo e(trans('general.title.add', ['type' => trans('invoices.discount')])); ?>

                                        </button>
                                    </div>
                                </div>
                                <div class="text-right border-0 p-0 pr-4">
                                    <div style="float:left;">
                                        <button type="button" class="btn btn-link btn-sm p-0" @click="onAddTax(index)" v-if="!row.add_tax">
                                            <?php echo e(trans('general.title.add', ['type' => trans_choice('general.taxes', 1)])); ?>

                                        </button>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div v-if="row.add_discount" class="line-item-area pb-3">
                                <div class="line-item-content">
                                    <div class="long-texts line-item-text" style="float: left; margin-top: 15px; position: absolute; left: -65px;">
                                        <?php echo e(trans('invoices.discount')); ?>

                                    </div>
                                            <?php echo $__env->yieldPushContent('discount_input_start'); ?>
                                    <div class="form-group mb-0 w-100" style="display: inline-block; position: relative;">
                                        <div class="input-group input-group-merge mb-0 select-tax">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="input-discount">
                                                    <i class="fa fa-percent"></i>
                                                </span>
                                            </div>
                                            <input type="number"
                                                max="100"
                                                min="0"
                                                class="form-control text-center"
                                                :name="'items.' + index + '.discount'"
                                                autocomplete="off"
                                                required="required"
                                                data-item="discount"
                                                v-model="row.discount"
                                                @input="onCalculateTotal"
                                                @change="form.errors.clear('items.' + index + '.discount')">

                                            <div class="invalid-feedback d-block"
                                                v-if="form.errors.has('items.' + index + '.discount')"
                                                v-html="form.errors.get('items.' + index + '.discount')">
                                            </div>
                                            </div>
                                        </div>
                                            <?php echo $__env->yieldPushContent('discount_input_end'); ?>
                                    </div>
                                        <div class="line-item-content-right">
                                    <div class="line-item-content-right-price long-texts text-right">
                                        <?php echo e(Form::moneyGroup('discount_amount', '', '', ['required' => 'required', 'disabled' => 'true' , 'row-input' => 'true', 'v-model' => 'row.discount_amount', 'data-item' => 'discount_amount', 'currency' => $currency, 'dynamic-currency' => 'currency'], 0.00, 'text-right input-price disabled-money')); ?>

                                    </div>
                                    <div class="line-item-content-right-delete pl-2">
                                        <button type="button" @click="onDeleteDiscount(index)" class="btn btn-link btn-delete p-0">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="line-item-area pb-3" v-for="(row_tax, row_tax_index) in row.tax_ids"
                            :index="row_tax_index">
                                <div class="line-item-content">
                                    <div class="long-texts line-item-text" style="float: left; margin-top: 15px; margin-right:2px; position: absolute; left: -63px;">
                                        <?php echo e(trans_choice('general.taxes', 1)); ?>

                                    </div>

                                    <?php echo $__env->yieldPushContent('taxes_input_start'); ?>
                                    <akaunting-select
                                        class="mb-0 select-tax"
                                        :form-classes="[{'has-error': form.errors.has('items.' + index + '.taxes') }]"
                                        :icon="''"
                                        :title="''"
                                        :placeholder="'<?php echo e(trans('general.form.select.field', ['field' => trans_choice('general.taxes', 1)])); ?>'"
                                        :name="'items.' + index + '.taxes.' + row_tax_index"
                                        :options="<?php echo e(json_encode($taxes->pluck('title', 'id'))); ?>"
                                        :dynamic-options="dynamic_taxes"
                                        :disabled-options="form.items[index].tax_ids"
                                        :value="row_tax.id"
                                        @interface="row_tax.id = $event"
                                        @change="onCalculateTotal()"
                                        @new="dynamic_taxes.push($event)"
                                        :form-error="form.errors.get('items.' + index + '.taxes')"
                                        :no-data-text="'<?php echo e(trans('general.no_data')); ?>'"
                                        :no-matching-data-text="'<?php echo e(trans('general.no_matching_data')); ?>'"
                                    ></akaunting-select>
                                    <?php echo $__env->yieldPushContent('taxes_input_end'); ?>
                                </div>
                            
                                <div class="line-item-content-right">
                                    <div class="line-item-content-right-price long-texts text-right">
                                        <?php echo e(Form::moneyGroup('tax', '', '', ['required' => 'required', 'disabled' => 'true' , 'row-input' => 'true', 'v-model' => 'row_tax.price', 'data-item' => 'total', 'currency' => $currency, 'dynamic-currency' => 'currency'], 0.00, 'text-right input-price disabled-money')); ?>

                                    </div>
                                    <div class="line-item-content-right-delete pl-2">
                                        <button type="button" @click="onDeleteTax(index, row_tax_index)" class="btn btn-link btn-delete p-0">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div v-if="row.add_tax" class="line-item-area pb-3" :class="{'pt-2' : row.add_discount}">
                                <div class="line-item-content">
                                    <div class="long-texts line-item-text" style="float: left; margin-top: 15px; margin-right:2px; position: absolute; left: -63px;">
                                        <?php echo e(trans_choice('general.taxes', 1)); ?> 
                                    </div>

                                    <?php echo $__env->yieldPushContent('taxes_input_start'); ?>
                                    <akaunting-select
                                        class="mb-0 select-tax"
                                        style="margin-left: 1px; margin-right: -2px;"
                                        :form-classes="[{'has-error': form.errors.has('items.' + index + '.taxes') }]"
                                        :icon="''"
                                        :title="''"
                                        :placeholder="'<?php echo e(trans('general.form.select.field', ['field' => trans_choice('general.taxes', 1)])); ?>'"
                                        :name="'items.' + index + '.taxes.999'"
                                        :options="<?php echo e(json_encode($taxes->pluck('title', 'id'))); ?>"
                                        :dynamic-options="dynamic_taxes"
                                        :disabled-options="form.items[index].tax_ids"
                                        :value="tax_id"
                                        :add-new="<?php echo e(json_encode([
                                            'status' => true,
                                            'text' => trans('general.add_new'),
                                            'path' => route('modals.taxes.create'),
                                            'type' => 'modal',
                                            'field' => [
                                                'key' => 'id',
                                                'value' => 'title'
                                            ],
                                            'new_text' => trans('modules.new'),
                                            'buttons' => [
                                                'cancel' => [
                                                    'text' => trans('general.cancel'),
                                                    'class' => 'btn-outline-secondary'
                                                ],
                                                'confirm' => [
                                                    'text' => trans('general.save'),
                                                    'class' => 'btn-success'
                                                ]
                                            ]
                                        ])); ?>"
                                        @interface="tax_id = $event"
                                        @visible-change="onSelectedTax(index)"
                                        @new="dynamic_taxes.push($event)"
                                        :form-error="form.errors.get('items.' + index + '.taxes')"
                                        :no-data-text="'<?php echo e(trans('general.no_data')); ?>'"
                                        :no-matching-data-text="'<?php echo e(trans('general.no_matching_data')); ?>'"
                                    ></akaunting-select>
                                    <?php echo $__env->yieldPushContent('taxes_input_end'); ?>
                                </div>
                                <div class="line-item-content-right">
                                    <div class="line-item-content-right-price long-texts text-right">
                                        <div>
                                            <div class="required disabled text-right input-price disabled-money">
                                            <input type="tel" class="v-money form-control text-right" name="discount_amount" disabled="disabled" value="__">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line-item-content-right-delete pl-2">
                                        <?php if(!$hideDiscount && in_array(setting('localisation.discount_location'), ['item', 'both'])): ?>
                                        <button type="button" @click="onDeleteTax(index, 999)" class="btn btn-link btn-delete p-0">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    <?php echo $__env->yieldPushContent('name_td_end'); ?>
</tr>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/documents/form/line-item.blade.php ENDPATH**/ ?>