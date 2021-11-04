<?php $__env->startSection('title', setting('invoice.title', trans_choice('general.invoices', 1)) . ': ' . $invoice->document_number); ?>

<?php $__env->startSection('new_button'); ?>
    <?php if (isset($component)) { $__componentOriginale972011868b1174ce26941ef8ab555616856c4a3 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Show\TopButtons::class, ['type' => 'invoice','document' => $invoice]); ?>
<?php $component->withName('documents.show.top-buttons'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginale972011868b1174ce26941ef8ab555616856c4a3)): ?>
<?php $component = $__componentOriginale972011868b1174ce26941ef8ab555616856c4a3; ?>
<?php unset($__componentOriginale972011868b1174ce26941ef8ab555616856c4a3); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal778df7e5316940e9a16de286ce9c99fa694189b4 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Show\Content::class, ['type' => 'invoice','document' => $invoice,'hideButtonReceived' => true]); ?>
<?php $component->withName('documents.show.content'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal778df7e5316940e9a16de286ce9c99fa694189b4)): ?>
<?php $component = $__componentOriginal778df7e5316940e9a16de286ce9c99fa694189b4; ?>
<?php unset($__componentOriginal778df7e5316940e9a16de286ce9c99fa694189b4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('public/css/print.css?v=' . version('short'))); ?>" type="text/css">

    <?php if (isset($component)) { $__componentOriginal91e872910bc77530ae90fd36b7e9262661a0942c = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Script::class, ['type' => 'invoice']); ?>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/sales/invoices/show.blade.php ENDPATH**/ ?>