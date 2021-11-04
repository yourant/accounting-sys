<?php $__env->startSection('title', trans('general.title.edit', ['type' => trans_choice('general.reports', 1)])); ?>

<?php $__env->startSection('content'); ?>
    <div class="card">
        <?php echo Form::model($report, [
            'id' => 'report',
            'method' => 'PATCH',
            'route' => ['reports.update', $report->id],
            '@submit.prevent' => 'onSubmit',
            '@keydown' => 'form.errors.clear($event.target.name)',
            'role' => 'form',
            'class' => 'form-loading-button',
            'novalidate' => true,
        ]); ?>


            <div class="card-body">
                <div class="row">
                    <?php echo e(Form::textGroup('name', trans('general.name'), 'font')); ?>


                    <?php echo e(Form::textGroup('class_disabled', trans_choice('general.types', 1), 'bars', ['required' => 'required', 'disabled' => 'true'], $classes[$report->class])); ?>

                    <?php echo e(Form::hidden('class', $report->class)); ?>


                    <?php echo e(Form::textareaGroup('description', trans('general.description'), null, null, ['rows' => '3', 'required' => 'required'])); ?>


                    <?php echo e(Form::hidden('report', 'invalid', ['data-field' => 'settings'])); ?>


                    <?php $__currentLoopData = $class->getFields(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $type = $field['type']; ?>

                        <?php if(($type == 'textGroup') || ($type == 'emailGroup') || ($type == 'passwordGroup')): ?>
                            <?php echo e(Form::$type($field['name'], $field['title'], $field['icon'], array_merge([
                                    'data-field' => 'settings'
                                ],
                                $field['attributes'])
                            )); ?>

                        <?php elseif($type == 'textareaGroup'): ?>
                            <?php echo e(Form::$type($field['name'], $field['title'])); ?>

                        <?php elseif($type == 'dateGroup'): ?>
                            <?php echo e(Form::$type($field['name'], $field['title'], $field['icon'], array_merge([
                                   'data-field' => 'settings',
                                   'show-date-format' => company_date_format(),
                               ],
                               $field['attributes']),
                               isset($report->settings->{$field['name']}) ? $report->settings->{$field['name']}: null
                           )); ?>

                        <?php elseif($type == 'selectGroup'): ?>
                            <?php echo e(Form::$type($field['name'], $field['title'], $field['icon'], $field['values'], isset($report->settings->{$field['name']}) ? $report->settings->{$field['name']} : $field['selected'], array_merge([
                                    'data-field' => 'settings'
                                ],
                                $field['attributes'])
                            )); ?>

                        <?php elseif($type == 'radioGroup'): ?>
                            <?php echo e(Form::$type($field['name'], $field['title'], isset($report->settings->{$field['name']}) ? $report->settings->{$field['name']} : true, $field['enable'], $field['disable'], array_merge([
                                    'data-field' => 'settings'
                                ],
                                $field['attributes'])
                            )); ?>

                        <?php elseif($type == 'checkboxGroup'): ?>
                            <?php echo e(Form::$type($field['name'], $field['title'], $field['items'], $report->settings->{$field['name']}, $field['id'], $report->settings->{$field['name']}, array_merge([
                                    'data-field' => 'settings'
                                ],
                                $field['attributes'])
                            )); ?>

                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update-common-reports')): ?>
                <div class="card-footer">
                    <div class="row save-buttons">
                        <?php echo e(Form::saveButtons('reports.index')); ?>

                    </div>
                </div>
            <?php endif; ?>

        <?php echo Form::close(); ?>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script src="<?php echo e(asset('public/js/common/reports.js?v=' . version('short'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/common/reports/edit.blade.php ENDPATH**/ ?>