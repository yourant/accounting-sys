<?php $__env->startSection('title', trans('general.email')); ?>

<?php $__env->startSection('content'); ?>
    <?php echo Form::open([
        'id' => 'setting',
        'method' => 'PATCH',
        'route' => 'settings.email.update',
        '@submit.prevent' => 'onSubmit',
        '@keydown' => 'form.errors.clear($event.target.name)',
        'files' => true,
        'role' => 'form',
        'class' => 'form-loading-button',
        'novalidate' => true,
    ]); ?>


    <?php $card = 1; ?>

    <div class="row">

    <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            if (!class_exists($template->class)) {
                continue;
            }
            $aria_expanded_status = in_array($card, [1, 2]) ? 'true' : 'false';
            $collapse_status = in_array($card, [1, 2]) ? 'show' : '';
        ?>

        <div class="col-md-6">
            <div class="accordion" id="accordion-<?php echo e($card); ?>">
                <div class="card">
                    <div class="card-header" id="heading-<?php echo e($card); ?>" data-toggle="collapse" data-target="#collapse-<?php echo e($card); ?>" aria-expanded="<?php echo e($aria_expanded_status); ?>" aria-controls="collapse-<?php echo e($card); ?>">
                        <div class="align-items-center">
                            <h4 class="mb-0"><?php echo e(trans($template->name)); ?></h4>
                        </div>
                    </div>

                    <div id="collapse-<?php echo e($card); ?>" class="collapse <?php echo e($collapse_status); ?>" aria-labelledby="heading-<?php echo e($card); ?>" data-parent="#accordion-<?php echo e($card); ?>">
                        <div class="card-body">
                            <div class="row">
                                <?php echo e(Form::textGroup('template_' . $template->alias . '_subject', trans('settings.email.templates.subject'), 'font', ['required' => 'required'], $template->subject, 'col-md-12')); ?>


                                <?php echo e(Form::textEditorGroup('template_' . $template->alias . '_body', trans('settings.email.templates.body'), null, $template->body, ['required' => 'required', 'rows' => '5', 'data-toggle' => 'quill'], 'col-md-12 mb-0')); ?>


                                <div class="col-md-12">
                                    <div class="bg-secondary border-radius-default border-1 p-2">
                                        <small class="text-default"><?php echo trans('settings.email.templates.tags', ['tag_list' => implode(', ', app($template->class)->getTags())]); ?></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php $card++; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <div class="col-md-12">
            <div class="accordion" id="accordion-<?php echo e($card); ?>">
                <div class="card">
                    <div class="card-header" id="heading-<?php echo e($card); ?>" data-toggle="collapse" data-target="#collapse-<?php echo e($card); ?>" aria-expanded="false" aria-controls="collapse-<?php echo e($card); ?>">
                        <div class="align-items-center">
                            <h4 class="mb-0"><?php echo e(trans('settings.email.protocol')); ?></h4>
                        </div>
                    </div>

                    <div id="collapse-<?php echo e($card); ?>" class="collapse hide" aria-labelledby="heading-<?php echo e($card); ?>" data-parent="#accordion-<?php echo e($card); ?>">
                        <div class="card-body">
                            <div class="row">
                                <?php echo e(Form::selectGroup('protocol', trans('settings.email.protocol'), 'share', $email_protocols, setting('email.protocol'), ['change' => 'onChangeProtocol'])); ?>


                                <?php echo e(Form::textGroup('sendmail_path', trans('settings.email.sendmail_path'), 'road', [':disabled'=> 'email.sendmailPath'], setting('email.sendmail_path'))); ?>


                                <?php echo e(Form::textGroup('smtp_host', trans('settings.email.smtp.host'), 'paper-plane', [':disabled' => 'email.smtpHost'], setting('email.smtp_host'))); ?>


                                <?php echo e(Form::textGroup('smtp_port', trans('settings.email.smtp.port'), 'paper-plane', [':disabled' => 'email.smtpPort'], setting('email.smtp_port'))); ?>


                                <?php echo e(Form::textGroup('smtp_username', trans('settings.email.smtp.username'), 'paper-plane', [':disabled' => 'email.smtpUsername'], setting('email.smtp_username'))); ?>


                                <?php echo e(Form::textGroup('smtp_password', trans('settings.email.smtp.password'), 'paper-plane', ['type' => 'password', ':disabled' => 'email.smtpPassword'], setting('email.smtp_password'))); ?>


                                <?php echo e(Form::selectGroup('smtp_encryption', trans('settings.email.smtp.encryption'), 'paper-plane', ['' => trans('settings.email.smtp.none'), 'ssl' => 'SSL', 'tls' => 'TLS'], setting('email.smtp_encryption', null), ['disabled' => 'email.smtpEncryption'])); ?>

                             </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update-settings-settings')): ?>
        <div class="row ml-0 mr-0">
            <div class="card col-md-12">
                <div class="card-body mr--3">
                    <div class="row save-buttons">
                        <?php echo e(Form::saveButtons('settings.index')); ?>

                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php echo Form::hidden('_prefix', 'email'); ?>


    <?php echo Form::close(); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts_start'); ?>
    <script src="<?php echo e(asset('public/js/settings/settings.js?v=' . version('short'))); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/settings/email/edit.blade.php ENDPATH**/ ?>