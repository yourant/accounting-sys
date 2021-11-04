<form wire:click.stop class="navbar-search navbar-search-light form-inline mb-0" id="navbar-search-main" autocomplete="off">
    <div class="form-group mb-0 mr-sm-3">
        <div class="input-group input-group-alternative input-group-merge">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-search"></i></span>
            </div>

            <input type="text" name="search" wire:model.debounce.500ms="keyword" class="form-control" autocomplete="off" placeholder="<?php echo e(trans('general.search')); ?>">

            <?php if($results): ?>
            <div class="dropdown-menu dropdown-menu-xl dropdown-menu-center show" ref="menu">
                <div class="list-group list-group-flush">
                <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $result): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a class="list-group-item list-group-item-action" href="<?php echo e($result->href); ?>">
                    <div class="row align-items-center">
                        <div class="col ml--2">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="name"><?php echo e($result->name); ?></div>
                                </div>
                                <div class="text-muted">
                                    <span class="type"><?php echo e($result->type); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</form>

<?php $__env->startPush('scripts_end'); ?>
<script type="text/javascript">
    $(window).click(function() {
        if (Livewire.components.getComponentsByName('common.search')[0].data.results.length > 0) {
            Livewire.emit('resetKeyword');
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/livewire/common/search.blade.php ENDPATH**/ ?>