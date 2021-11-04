<?php $__env->startSection('title', $dashboard->name); ?>

<?php $__env->startSection('dashboard_action'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['create-common-widgets', 'read-common-dashboards'])): ?>
        <span class="dashboard-action">
            <div class="dropdown">
                <a class="btn btn-sm items-align-center py-2 mt--1" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-ellipsis-v"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-sm-right dropdown-menu-xs-right dropdown-menu-arrow">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-common-widgets')): ?>
                        <?php echo Form::button(trans('general.title.add', ['type' => trans_choice('general.widgets', 1)]), [
                            'type'    => 'button',
                            'class'   => 'dropdown-item',
                            'title'   => trans('general.title.add', ['type' => trans_choice('general.widgets', 1)]),
                            '@click'  => 'onCreateWidget()',
                        ]); ?>

                    <?php endif; ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update-common-dashboards')): ?>
                        <div class="dropdown-divider"></div>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create-common-dashboards')): ?>
                            <a class="dropdown-item" href="<?php echo e(route('dashboards.create')); ?>"><?php echo e(trans('general.title.create', ['type' => trans_choice('general.dashboards', 1)])); ?></a>
                        <?php endif; ?>
                        <a class="dropdown-item" href="<?php echo e(route('dashboards.index')); ?>"><?php echo e(trans('general.title.manage', ['type' => trans_choice('general.dashboards', 2)])); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </span>
    <?php endif; ?>

    <?php
        $text = json_encode([
            'name' => trans('general.name'),
            'type' => trans_choice('general.types', 1),
            'width' => trans('general.width'),
            'sort' => trans('general.sort'),
            'enabled' => trans('general.enabled'),
            'yes' => trans('general.yes'),
            'no' => trans('general.no'),
            'save' => trans('general.save'),
            'cancel' => trans('general.cancel')
        ]);

        $placeholder = json_encode([
            'name' => trans('general.form.enter', ['field' => trans('general.name')]),
            'type' => trans('general.form.select.field', ['field' => trans_choice('general.types', 1)]),
            'width' => trans('general.form.select.field', ['field' => trans('general.width')]),
            'sort' => trans('general.form.enter', ['field' => trans('general.sprt')])
        ]);
    ?>

    <akaunting-widget
        v-if="widget_modal"
        :title="'<?php echo e(trans_choice('general.widgets', 1)); ?>'"
        :show="widget_modal"
        :widget_id="widget.id"
        :name="widget.name"
        :width="widget.width"
        :action="widget.action"
        :type="widget.class"
        :types="widgets"
        :sort="widget.sort"
        :dashboard_id="<?php echo e($dashboard->id); ?>"
        :text="<?php echo e($text); ?>"
        :placeholder="<?php echo e($placeholder); ?>"
        @cancel="onCancel">
    </akaunting-widget>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('new_button'); ?>
    <!--Dashboard General Filter-->
    <el-date-picker
        v-model="filter_date"
        type="daterange"
        align="right"
        unlink-panels
        :format="'yyyy-MM-dd'"
        value-format="yyyy-MM-dd"
        @change="onChangeFilterDate"
        range-separator=">>"
        start-placeholder="<?php echo e($date_picker_shortcuts[trans("reports.this_year")]["start"]); ?>"
        end-placeholder="<?php echo e($date_picker_shortcuts[trans("reports.this_year")]["end"]); ?>"
        :picker-options="{
            shortcuts: [
                {
                    text: '<?php echo e(trans("reports.this_year")); ?>',
                    onClick(picker) {
                        const start = new Date('<?php echo e($date_picker_shortcuts[trans("reports.this_year")]["start"]); ?>');
                        const end = new Date('<?php echo e($date_picker_shortcuts[trans("reports.this_year")]["end"]); ?>');

                        picker.$emit('pick', [start, end]);
                    }
                },
                {
                    text: '<?php echo e(trans("reports.previous_year")); ?>',
                    onClick(picker) {
                        const start = new Date('<?php echo e($date_picker_shortcuts[trans("reports.previous_year")]["start"]); ?>');
                        const end = new Date('<?php echo e($date_picker_shortcuts[trans("reports.previous_year")]["end"]); ?>');

                        picker.$emit('pick', [start, end]);
                    }
                },
                {
                    text: '<?php echo e(trans("reports.this_quarter")); ?>',
                    onClick(picker) {
                        const start = new Date('<?php echo e($date_picker_shortcuts[trans("reports.this_quarter")]["start"]); ?>');
                        const end = new Date('<?php echo e($date_picker_shortcuts[trans("reports.this_quarter")]["end"]); ?>');

                        picker.$emit('pick', [start, end]);
                    }
                },
                {
                    text: '<?php echo e(trans("reports.previous_quarter")); ?>',
                    onClick(picker) {
                        const start = new Date('<?php echo e($date_picker_shortcuts[trans("reports.previous_quarter")]["start"]); ?>');
                        const end = new Date('<?php echo e($date_picker_shortcuts[trans("reports.previous_quarter")]["end"]); ?>');

                        picker.$emit('pick', [start, end]);
                    }
                },
                {
                    text: '<?php echo e(trans("reports.last_12_months")); ?>',
                    onClick(picker) {
                        const start = new Date('<?php echo e($date_picker_shortcuts[trans("reports.last_12_months")]["start"]); ?>');
                        const end = new Date('<?php echo e($date_picker_shortcuts[trans("reports.last_12_months")]["end"]); ?>');

                        picker.$emit('pick', [start, end]);
                    }
                }
            ]
        }">
    </el-date-picker>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php $__currentLoopData = $widgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php echo show_widget($widget); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script src="<?php echo e(asset('public/js/common/dashboards.js?v=' . version('short'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/common/dashboards/show.blade.php ENDPATH**/ ?>