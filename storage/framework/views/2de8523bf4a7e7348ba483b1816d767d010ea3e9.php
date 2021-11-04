<?php echo $__env->yieldPushContent($name . '_input_start'); ?>

    <div
        class="form-group <?php echo e($col); ?><?php echo e(isset($attributes['required']) ? ' required' : ''); ?><?php echo e(isset($attributes['readonly']) ? ' readonly' : ''); ?><?php echo e(isset($attributes['disabled']) ? ' disabled' : ''); ?>"
        :class="[{'has-error': errors.<?php echo e($name); ?>}]"
        <?php if(isset($attributes['show'])): ?>
        v-if="<?php echo e($attributes['show']); ?>"
        <?php endif; ?>
        >
        <?php if(!empty($text)): ?>
            <?php echo Form::label($name, $text, ['class' => 'form-control-label']); ?>

        <?php endif; ?>

        <div class="input-group input-group-merge">
            <akaunting-dropzone-file-upload
                text-drop-file="<?php echo e(trans('general.form.drop_file')); ?>"
                text-choose-file="<?php echo e(trans('general.form.choose_file')); ?>"

                <?php if(!empty($attributes['dropzone-class'])): ?>
                class="<?php echo e($attributes['dropzone-class']); ?>"
                <?php endif; ?>

                <?php if(!empty($attributes['options'])): ?>
                :options=<?php echo e(json_encode($attributes['options'])); ?>

                <?php endif; ?>

                <?php if(!empty($attributes['preview'])): ?>
                :preview=<?php echo e(json_encode($attributes['preview'])); ?>

                <?php endif; ?>

                <?php if(!empty($attributes['multiple'])): ?>
                multiple
                <?php endif; ?>

                <?php if(!empty($attributes['previewClasses'])): ?>
                preview-classes="<?php echo e($attributes['previewClasses']); ?>"
                <?php endif; ?>

                <?php if(!empty($attributes['url'])): ?>
                url="<?php echo e($attributes['url']); ?>"
                <?php endif; ?>

                <?php if(!empty($value)): ?>
                    <?php
                        $attachments = [];
                    ?>

                    <?php if(is_array($value)): ?>
                        <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $attachments[] = [
                                    'id' => $attachment->id,
                                    'name' => $attachment->filename . '.' . $attachment->extension, 
                                    'path' => route('uploads.get', $attachment->id),
                                    'type' => $attachment->mime_type,
                                    'size' => $attachment->size,
                                    'downloadPath' => route('uploads.download', $attachment->id),
                                ];
                            ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php elseif($value instanceof \Plank\Mediable\Media): ?>
                        <?php
                            $attachments[] = [
                                'id' => $value->id,
                                'name' => $value->filename . '.' . $value->extension,
                                'path' => route('uploads.get', $value->id),
                                'type' => $value->mime_type,
                                'size' => $value->size,
                                'downloadPath' => false,
                            ];
                        ?>
                    <?php else: ?>
                        <?php
                            $attachment = \Plank\Mediable\Media::find($value);

                            $attachments[] = [
                                'id' => $attachment->id,
                                'name' => $attachment->filename . '.' . $attachment->extension,
                                'path' => route('uploads.get', $attachment->id),
                                'type' => $attachment->mime_type,
                                'size' => $attachment->size,
                                'downloadPath' => false,
                            ];
                        ?>
                    <?php endif; ?>

                :attachments="<?php echo e(json_encode($attachments)); ?>"
                <?php endif; ?>

                v-model="<?php echo e(!empty($attributes['v-model']) ? $attributes['v-model'] : (!empty($attributes['data-field']) ? 'form.' . $attributes['data-field'] . '.'. $name : 'form.' . $name)); ?>"
            ></akaunting-dropzone-file-upload>
        </div>

        <div class="invalid-feedback d-block"
            v-if="<?php echo e(isset($attributes['v-error']) ? $attributes['v-error'] : 'form.errors.has("' . $name . '")'); ?>"
            v-html="<?php echo e(isset($attributes['v-error-message']) ? $attributes['v-error-message'] : 'form.errors.get("' . $name . '")'); ?>">
        </div>
    </div>

<?php echo $__env->yieldPushContent($name . '_input_end'); ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/form/file_group.blade.php ENDPATH**/ ?>