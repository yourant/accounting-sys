<?php $__env->startSection('title', trans_choice('general.bills', 2)); ?>

<?php $__env->startSection('new_button'); ?>
    <?php if (isset($component)) { $__componentOriginal6af3772f2eb1c160ce49592ee32bc8f328bd9e53 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Index\TopButtons::class, ['type' => 'bill']); ?>
<?php $component->withName('documents.index.top-buttons'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal6af3772f2eb1c160ce49592ee32bc8f328bd9e53)): ?>
<?php $component = $__componentOriginal6af3772f2eb1c160ce49592ee32bc8f328bd9e53; ?>
<?php unset($__componentOriginal6af3772f2eb1c160ce49592ee32bc8f328bd9e53); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginal646689016314cef4cc7c210e646c4927a4b2c422 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Index\Content::class, ['type' => 'bill','documents' => $bills]); ?>
<?php $component->withName('documents.index.content'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal646689016314cef4cc7c210e646c4927a4b2c422)): ?>
<?php $component = $__componentOriginal646689016314cef4cc7c210e646c4927a4b2c422; ?>
<?php unset($__componentOriginal646689016314cef4cc7c210e646c4927a4b2c422); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <?php if (isset($component)) { $__componentOriginal91e872910bc77530ae90fd36b7e9262661a0942c = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Script::class, ['type' => 'bill']); ?>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/purchases/bills/index.blade.php ENDPATH**/ ?>