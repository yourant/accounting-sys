<?php $__env->startSection('title', trans('auth.login')); ?>

<?php $__env->startSection('message', trans('auth.login_to')); ?>

<?php $__env->startSection('content'); ?>
    <div role="alert" class="alert alert-danger d-none" :class="(form.response.error) ? 'show' : ''" v-if="form.response.error" v-html="form.response.message"></div>

    <?php echo Form::open([
        'route' => 'login',
        'id' => 'login',
        '@submit.prevent' => 'onSubmit',
        '@keydown' => 'form.errors.clear($event.target.name)',
        'files' => true,
        'role' => 'form',
        'class' => 'form-loading-button',
        'novalidate' => true
    ]); ?>


        <?php echo e(Form::emailGroup('email', false, 'envelope', ['placeholder' => trans('general.email')], null, 'has-feedback', 'input-group-alternative')); ?>


        <?php echo e(Form::passwordGroup('password', false, 'unlock-alt', ['placeholder' => trans('install.database.password')], 'has-feedback', 'input-group-alternative')); ?>


        <div class="row align-items-center">
            <?php echo $__env->yieldPushContent('remember_input_start'); ?>
                <div class="col-xs-12 col-sm-8">
                    <div class="custom-control custom-control-alternative custom-checkbox">
                        <?php echo e(Form::checkbox('remember', 1, null, [
                            'id' => 'checkbox-remember',
                            'class' => 'custom-control-input',
                            'v-model' => 'form.remember'
                        ])); ?>

                        <label class="custom-control-label" for="checkbox-remember">
                            <span class="text-white"><?php echo e(trans('auth.remember_me')); ?></span>
                        </label>
                    </div>
                </div>
            <?php echo $__env->yieldPushContent('remember_input_end'); ?>

            <div class="col-xs-12 col-sm-4">
                <?php echo Form::button(
                '<div class="aka-loader"></div> <span>' . trans('auth.login') . '</span>',
                [':disabled' => 'form.loading', 'type' => 'submit', 'class' => 'btn btn-success float-right', 'data-loading-text' => trans('general.loading')]); ?>

            </div>
        </div>

        <?php echo $__env->yieldPushContent('forgotten-password-start'); ?>
            <div class="mt-5 mb--4">
                <a href="<?php echo e(route('forgot')); ?>" class="text-white"><small><?php echo e(trans('auth.forgot_password')); ?></small></a>
            </div>
        <?php echo $__env->yieldPushContent('forgotten-password-end'); ?>
    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script src="<?php echo e(asset('public/js/auth/login.js?v=' . version('short'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/auth/login/create.blade.php ENDPATH**/ ?>