<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['update-common-widgets', 'delete-common-widgets'])): ?>
<div>
    <a class="btn btn-sm items-align-center card-action-button py-2 mr-0 shadow-none--hover" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-ellipsis-v text-white"></i>
    </a>

    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update-common-widgets')): ?>
        <?php echo Form::button(trans('general.edit'), [
            'type'    => 'button',
            'class'   => 'dropdown-item',
            'title'   => trans('general.edit'),
            '@click'  => 'onEditWidget(' . $class->model->id . ')'
        ]); ?>

        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete-common-widgets')): ?>
        <div class="dropdown-divider"></div>
        <?php echo Form::deleteLink($class->model, 'widgets.destroy'); ?>

        <?php endif; ?>
    </div>
</div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/widgets/stats_header.blade.php ENDPATH**/ ?>