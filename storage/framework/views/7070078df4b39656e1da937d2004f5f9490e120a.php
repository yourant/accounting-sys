<?php $__env->startSection('title', trans('general.title.edit', ['type' => trans_choice('general.invoices', 1)])); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal65f407161587e1ef6fcf5e6721fd346b2050e09f = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Form\Content::class, ['type' => 'invoice','document' => $invoice]); ?>
<?php $component->withName('documents.form.content'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal65f407161587e1ef6fcf5e6721fd346b2050e09f)): ?>
<?php $component = $__componentOriginal65f407161587e1ef6fcf5e6721fd346b2050e09f; ?>
<?php unset($__componentOriginal65f407161587e1ef6fcf5e6721fd346b2050e09f); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <?php if (isset($component)) { $__componentOriginal91e872910bc77530ae90fd36b7e9262661a0942c = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Script::class, ['type' => 'invoice','items' => $invoice->items()->get(),'document' => $invoice]); ?>
<?php $component->withName('documents.script'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal91e872910bc77530ae90fd36b7e9262661a0942c)): ?>
<?php $component = $__componentOriginal91e872910bc77530ae90fd36b7e9262661a0942c; ?>
<?php unset($__componentOriginal91e872910bc77530ae90fd36b7e9262661a0942c); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/sales/invoices/edit.blade.php ENDPATH**/ ?>