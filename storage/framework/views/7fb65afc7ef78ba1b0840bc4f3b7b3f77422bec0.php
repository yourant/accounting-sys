<?php echo $__env->yieldPushContent('content_start'); ?>
    <div id="app">
        <?php echo $__env->yieldPushContent('content_content_start'); ?>

            <?php echo $__env->yieldContent('content'); ?>

        <?php echo $__env->yieldPushContent('content_content_end'); ?>

        <notifications></notifications>

        <form id="form-dynamic-component" method="POST" action="#"></form>

        <component v-bind:is="component"></component>
    </div>
<?php echo $__env->yieldPushContent('content_end'); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/admin/content.blade.php ENDPATH**/ ?>