<div class="accordion">
    <div class="card">
        <div class="card-header" id="accordion-histories-header" data-toggle="collapse" data-target="#accordion-histories-body" aria-expanded="false" aria-controls="accordion-histories-body">
            <h4 class="mb-0"><?php echo e(trans($textHistories)); ?></h4>
        </div>

        <div id="accordion-histories-body" class="collapse hide" aria-labelledby="accordion-histories-header">
            <div class="table-responsive">
                <table class="table table-flush table-hover">
                    <thead class="thead-light">
                        <?php echo $__env->yieldPushContent('row_footer_histories_head_tr_start'); ?>
                        <tr class="row table-head-line">
                            <?php echo $__env->yieldPushContent('row_footer_histories_head_start'); ?>
                            <th class="col-xs-4 col-sm-3">
                                <?php echo e(trans('general.date')); ?>

                            </th>
                            <th class="col-xs-4 col-sm-3 text-left">
                                <?php echo e(trans_choice('general.statuses', 1)); ?>

                            </th>
                            <th class="col-xs-4 col-sm-6 text-left long-texts">
                                <?php echo e(trans('general.description')); ?>

                            </th>
                            <?php echo $__env->yieldPushContent('row_footer_histories_head_end'); ?>
                        </tr>
                        <?php echo $__env->yieldPushContent('row_footer_histories_head_tr_end'); ?>
                    </thead>

                    <tbody>
                        <?php echo $__env->yieldPushContent('row_footer_histories_body_tr_start'); ?>
                        <?php $__currentLoopData = $histories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="row align-items-center border-top-1 tr-py">
                                <?php echo $__env->yieldPushContent('row_footer_histories_body_td_start'); ?>
                                <td class="col-xs-4 col-sm-3">
                                    <?php echo company_date($history->created_at); ?>
                                </td>
                                <td class="col-xs-4 col-sm-3 text-left">
                                    <?php echo e(trans($textHistoryStatus . $history->status)); ?>

                                </td>
                                <td class="col-xs-4 col-sm-6 text-left long-texts">
                                    <?php echo e($history->description); ?>

                                </td>
                                <?php echo $__env->yieldPushContent('row_footer_histories_body_td_end'); ?>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php echo $__env->yieldPushContent('row_footer_histories_body_tr_end'); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/documents/show/histories.blade.php ENDPATH**/ ?>