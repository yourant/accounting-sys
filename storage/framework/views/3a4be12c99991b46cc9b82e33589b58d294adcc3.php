<div class="row justify-content-center apps-store-bar">
    <div class="col-xs-12 col-sm-12">
        <div class="card">
            <div class="card-body p-2">
                <div class="row align-items-center">
                    <div class="col-xs-12 col-sm-2 pl-0 pr-0">
                        <akaunting-select
                            class="form-control-sm d-inline-block w-100"
                            placeholder="<?php echo e(trans('general.form.select.field', ['field' => trans_choice('general.categories', 1)])); ?>"
                            name="category"
                            :icon="''"
                            :options="<?php echo e(json_encode($categories)); ?>"
                            :value="'<?php echo e(request('category')); ?>'"
                            @change="onChangeCategory($event)"
                        ></akaunting-select>
                        <?php echo e(Form::hidden('category_page', url(company_id() . "/apps/categories"), ['id' => 'category_page'])); ?>

                    </div>

                    <div class="vr d-none d-sm-block"></div>

                    <div class="col-xs-12 col-sm-6">
                        <?php echo Form::open(['route' => 'apps.search', 'role' => 'form', 'method' => 'GET', 'class' => 'm-0']); ?>

                            <div class="searh-field tags-input__wrapper">
                                <input name="keyword" value="<?php echo e(isset($keyword) ? $keyword : ''); ?>" type="text" class="form-control form-control-sm d-inline-block w-100" placeholder="<?php echo e(trans('general.search_placeholder')); ?>" autocomplete="off">
                            </div>
                        <?php echo Form::close(); ?>

                    </div>

                    <div class="col-xs-12 col-sm-4 text-center">
                        <a href="<?php echo e(route('apps.paid')); ?>" class="btn btn-sm btn-white"><?php echo e(trans('modules.top_paid')); ?></a>
                        <a href="<?php echo e(route('apps.new')); ?>" class="btn btn-sm btn-white"><?php echo e(trans('modules.new')); ?></a>
                        <a href="<?php echo e(route('apps.free')); ?>" class="btn btn-sm btn-white"><?php echo e(trans('modules.top_free')); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/modules/bar.blade.php ENDPATH**/ ?>