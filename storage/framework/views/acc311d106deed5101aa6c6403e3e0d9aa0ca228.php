<?php if($paginator->hasPages()): ?>
    <ul class="pagination mb-0">
        
        <?php if($paginator->onFirstPage()): ?>
            <li class="page-item disabled"><span class="page-link">«</span></li>
        <?php else: ?>
            <li class="page-item"><a class="page-link" href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev">«</a></li>
        <?php endif; ?>

        <?php if($paginator->currentPage() > 3): ?>
            <li class="page-item d-none d-sm-block"><a class="page-link" href="<?php echo e($paginator->url(1)); ?>">1</a></li>
        <?php endif; ?>
        <?php if($paginator->currentPage() > 4): ?>
            <li class="page-item"><span class="page-link">...</span></li>
        <?php endif; ?>
        <?php $__currentLoopData = range(1, $paginator->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($i >= $paginator->currentPage() - 2 && $i <= $paginator->currentPage() + 2): ?>
                <?php if($i == $paginator->currentPage()): ?>
                    <li class="page-item active"><span class="page-link"><?php echo e($i); ?></span></li>
                <?php else: ?>
                    <li class="page-item"><a class="page-link" href="<?php echo e($paginator->url($i)); ?>"><?php echo e($i); ?></a></li>
                <?php endif; ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php if($paginator->currentPage() < $paginator->lastPage() - 3): ?>
            <li class="page-item"><span class="page-link">...</span></li>
        <?php endif; ?>
        <?php if($paginator->currentPage() < $paginator->lastPage() - 2): ?>
            <li class="page-item d-none d-sm-block"><a class="page-link" href="<?php echo e($paginator->url($paginator->lastPage())); ?>"><?php echo e($paginator->lastPage()); ?></a></li>
        <?php endif; ?>

        
        <?php if($paginator->hasMorePages()): ?>
            <li class="page-item"><a class="page-link" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next">»</a></li>
        <?php else: ?>
            <li class="page-item disabled"><span class="page-link">»</span></li>
        <?php endif; ?>
    </ul>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/vendor/pagination/bootstrap-4.blade.php ENDPATH**/ ?>