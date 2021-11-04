<?php $__env->startSection('title', $module->getName()); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <?php echo Form::model($setting, [
            'id' => 'module',
            'method' => 'PATCH',
            'route' => ['settings.module.update', $module->getAlias()],
            '@submit.prevent' => 'onSubmit',
            '@keydown' => 'form.errors.clear($event.target.name)',
            'files' => true,
            'role' => 'form',
            'class' => 'form-loading-button',
            'novalidate' => true,
        ]); ?>


            <div class="card-body">
                <div class="row">
                    <?php $__currentLoopData = $module->get('settings'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $type = $field['type']; ?>

                        <?php if(($type == 'textGroup') || ($type == 'emailGroup') || ($type == 'passwordGroup') || ($type == 'numberGroup')): ?>
                            <?php echo e(Form::$type($field['name'], trans($field['title']), $field['icon'], $field['attributes'])); ?>

                        <?php elseif($type == 'textareaGroup'): ?>
                            <?php echo e(Form::$type($field['name'], trans($field['title']))); ?>

                        <?php elseif($type == 'selectGroup'): ?>
                            <?php echo e(Form::$type($field['name'], trans($field['title']), $field['icon'], $field['values'], $field['selected'], $field['attributes'])); ?>

                        <?php elseif($type == 'radioGroup'): ?>
                            <?php echo e(Form::$type($field['name'], trans($field['title']), isset($setting[$field['name']]) ? $setting[$field['name']] : 1, trans($field['enable']), trans($field['disable']), $field['attributes'])); ?>

                        <?php elseif($type == 'checkboxGroup'): ?>
                            <?php echo e(Form::$type($field['name'], trans($field['title']), $field['items'], $field['value'], $field['id'], $field['selected'], $field['attributes'])); ?>

                        <?php elseif($type == 'fileGroup'): ?>
                            <?php echo e(Form::$type($field['name'], trans($field['title']), $field['attributes'])); ?>

                        <?php elseif($type == 'dateGroup'): ?>
                            <?php echo e(Form::$type($field['name'], trans($field['title']), $field['icon'], array_merge(['id' => $field['name'], 'date-format' => 'Y-m-d', 'show-date-format' => company_date_format(), 'autocomplete' => 'off'], $field['attributes']), Date::parse($setting[$field['name']] ?? now())->toDateString())); ?>

                        <?php elseif($type == 'accountSelectGroup'): ?>
                            <?php echo e(Form::selectGroup($field['name'], trans_choice('general.accounts', 1), 'university', $accounts, setting($module->getAlias() . '.' . $field['name']), $field['attributes'])); ?>

                        <?php elseif($type == 'categorySelectGroup'): ?>
                            <?php echo e(Form::selectGroup($field['name'], trans_choice('general.categories', 1), 'folder', $categories, setting($module->getAlias() . '.' . $field['name']), $field['attributes'])); ?>

                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php echo e(Form::hidden('module_alias', $module->getAlias(), ['id' => 'module_alias'])); ?>

                </div>
            </div>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update-' . $module->getAlias() . '-settings')): ?>
                <div class="card-footer">
                    <div class="row save-buttons">
                        <?php echo e(Form::saveButtons('settings.index')); ?>

                    </div>
                </div>
            <?php endif; ?>

        <?php echo Form::close(); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script src="<?php echo e(asset('public/js/settings/modules.js?v=' . version('short'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/settings/modules/edit.blade.php ENDPATH**/ ?>