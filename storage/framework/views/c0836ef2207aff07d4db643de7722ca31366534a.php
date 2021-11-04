<?php echo $__env->yieldPushContent('bulk_action_row_input_start'); ?>

    <?php
        if (is_array($path)) {
            $path = route('bulk-actions.action', $path);
        } else {
            $path = url('common/bulk-actions/' . $path);
        }

        $actions_to_show = [];
        foreach ($actions as $key => $action) {
            if ((isset($action['permission']) && !user()->can($action['permission']))) {
                continue;
            }

            $actions_to_show[$key] = true;
        }
    ?>

    <?php if(!empty($actions_to_show)): ?>
        <div class="align-items-center d-none mt-2"
             v-if="bulk_action.show"
             :class="[{'show': bulk_action.show}]">
            <div class="mr-6">
                <span class="text-white d-none d-sm-block">
                    <b v-text="bulk_action.count"></b>
                    <span v-if="bulk_action.count === 1">
                        <?php echo e(strtolower(trans_choice($text, 1))); ?>

                    </span>
                    <span v-else-if="bulk_action.count > 1">
                        <?php echo e(strtolower(trans_choice($text, 2))); ?>

                    </span>
                    <?php echo e(trans('bulk_actions.selected')); ?>

                </span>
            </div>

            <div class="w-25 mr-4" v-if="bulk_action.count">
                <div class="form-group mb-0">
                    <select
                        class="form-control form-control-sm"
                        v-model="<?php echo e(!empty($attributes['v-model']) ? $attributes['v-model'] : 'bulk_action.value'); ?>"
                        @change="onChange">
                        <option value="*"><?php echo e(trans_choice('bulk_actions.bulk_actions', 2)); ?></option>
                        <?php $__currentLoopData = $actions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($actions_to_show[$key])): ?>
                            <option
                                value="<?php echo e($key); ?>"
                                <?php if(!empty($action['message'])): ?>
                                data-message="<?php echo e(trans_choice($action['message'], 2, ['type' => strtolower(trans_choice($text, 2))])); ?>"
                                <?php endif; ?>
                                <?php if(isset($action['path']) && !empty($action['path'])): ?>
                                    data-path="<?php echo e(route('bulk-actions.action', $action['path'])); ?>"
                                <?php else: ?>
                                    data-path=""
                                <?php endif; ?>
                                <?php if(isset($action['type']) && !empty($action['type'])): ?>
                                    data-type="<?php echo e($action['type']); ?>"
                                <?php else: ?>
                                    data-type=""
                                <?php endif; ?>
                            ><?php echo e(trans($action['name'])); ?></option>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    <input type="hidden" name="bulk_action_path" value="<?php echo e($path); ?>" />
                </div>
            </div>

            <div class="mr-4" v-if="bulk_action.count">
                <button type="button" class="btn btn-sm btn-outline-confirm"
                        :disabled="bulk_action.value == '*'"
                        v-if="bulk_action.message.length"
                        @click="bulk_action.modal=true">
                    <span><?php echo e(trans('general.confirm')); ?></span>
                </button>
                <button type="button" class="btn btn-sm btn-outline-confirm"
                        :disabled="bulk_action.value == '*'"
                        v-if="!bulk_action.message.length"
                        @click="onAction">
                    <span><?php echo e(trans('general.confirm')); ?></span>
                </button>
            </div>

            <div class="mr-4" v-if="bulk_action.count">
                <button type="button" class="btn btn-outline-clear btn-sm"
                        @click="onClear">
                    <span><?php echo e(trans('general.clear')); ?></span>
                </button>
            </div>
        </div>

        <akaunting-modal
            :show="bulk_action.modal"
            :title="`<?php echo e(trans_choice($text, 2)); ?>`"
            :message="bulk_action.message"
            @cancel="onCancel"
            v-if='bulk_action.message && bulk_action.modal'>
            <template #card-footer>
                <div class="float-right">
                    <button type="button" class="btn btn-outline-secondary" @click="onCancel">
                        <span><?php echo e(trans('general.cancel')); ?></span>
                    </button>

                    <button :disabled="bulk_action.loading" type="button" class="btn btn-success button-submit" @click="onAction">
                        <div class="aka-loader d-none"></div>
                        <span><?php echo e(trans('general.confirm')); ?></span>
                    </button>
                </div>
            </template>
        </akaunting-modal>
    <?php else: ?>
        <div class="text-white d-none" :class="[{'show': bulk_action.show}]"><?php echo e(trans('bulk_actions.no_action')); ?></div>
    <?php endif; ?>

<?php echo $__env->yieldPushContent('bulk_action_row_input_end'); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/form/bulk_action_row_group.blade.php ENDPATH**/ ?>