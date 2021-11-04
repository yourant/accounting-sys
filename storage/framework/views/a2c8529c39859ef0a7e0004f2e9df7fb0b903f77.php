<div class="dropup header-drop-top">
    <button type="button" class="btn btn-white btn-sm" data-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-print"></i>&nbsp; <?php echo e(trans('print-template::general.title')); ?>

    </button>
    <div class="dropdown-menu" role="menu">
        <?php if(count($templates)): ?>
        <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a class="dropdown-item" target="_blank"
            href="<?php echo e(route('print-template.settings.print' , ['print_template'=>$template->id ,'invoice'=> $invoice_id] )); ?>"
            title="<?php echo e($template->name . ' ' .$template->pagesize); ?>"><?php echo e($template->name); ?></a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <a class="dropdown-item" href="<?php echo e(route('print-template.settings.create' )); ?>"
            title="<?php echo e(trans("print-template::general.header_create")); ?>"><?php echo e(trans("print-template::general.header_create")); ?></a>
        <?php endif; ?>
    </div>
</div><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\modules\PrintTemplate\Providers/../Resources/views/incomes/invoices/show.blade.php ENDPATH**/ ?>