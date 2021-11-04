<?php if($hideEmptyPage || ($documents->count() || request()->get('search', false))): ?>
    <div class="card">
        <?php if (isset($component)) { $__componentOriginal0c37636905d428c4be2576698e3942e394761bf0 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Index\CardHeader::class, ['type' => ''.e($type).'','hideBulkAction' => ''.e($hideBulkAction).'','formCardHeaderRoute' => $formCardHeaderRoute,'hideSearchString' => ''.e($hideSearchString).'','searchStringModel' => ''.e($searchStringModel).'','textBulkAction' => ''.e($textBulkAction).'','bulkActionClass' => ''.e($bulkActionClass).'','bulkActions' => $bulkActions,'bulkActionRouteParameters' => $bulkActionRouteParameters]); ?>
<?php $component->withName('documents.index.card-header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal0c37636905d428c4be2576698e3942e394761bf0)): ?>
<?php $component = $__componentOriginal0c37636905d428c4be2576698e3942e394761bf0; ?>
<?php unset($__componentOriginal0c37636905d428c4be2576698e3942e394761bf0); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

        <?php if (isset($component)) { $__componentOriginalb0194c8801966de8f15f93de73490f9910aa45fe = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Index\CardBody::class, ['type' => ''.e($type).'','documents' => $documents,'hideBulkAction' => ''.e($hideBulkAction).'','classBulkAction' => ''.e($classBulkAction).'','hideDocumentNumber' => ''.e($hideDocumentNumber).'','textDocumentNumber' => ''.e($textDocumentNumber).'','classDocumentNumber' => ''.e($classDocumentNumber).'','hideContactName' => ''.e($hideContactName).'','textContactName' => ''.e($textContactName).'','classContactName' => ''.e($classContactName).'','hideAmount' => ''.e($hideAmount).'','classAmount' => ''.e($classAmount).'','hideIssuedAt' => ''.e($hideIssuedAt).'','textIssuedAt' => ''.e($textIssuedAt).'','classIssuedAt' => ''.e($classIssuedAt).'','hideDueAt' => ''.e($hideDueAt).'','classDueAt' => ''.e($classDueAt).'','textDueAt' => ''.e($textDueAt).'','hideStatus' => ''.e($hideStatus).'','classStatus' => ''.e($classStatus).'','hideActions' => ''.e($hideActions).'','classActions' => ''.e($classActions).'','textDocumentStatus' => ''.e($textDocumentStatus).'','hideButtonShow' => ''.e($hideButtonShow).'','routeButtonShow' => ''.e($routeButtonShow).'','hideButtonEdit' => ''.e($hideButtonEdit).'','checkButtonReconciled' => ''.e($checkButtonReconciled).'','routeButtonEdit' => ''.e($routeButtonEdit).'','checkButtonCancelled' => ''.e($checkButtonCancelled).'','hideButtonDuplicate' => ''.e($hideButtonDuplicate).'','permissionCreate' => ''.e($permissionCreate).'','routeButtonDuplicate' => ''.e($routeButtonDuplicate).'','hideButtonCancel' => ''.e($hideButtonCancel).'','permissionUpdate' => ''.e($permissionUpdate).'','routeButtonCancelled' => ''.e($routeButtonCancelled).'','hideButtonDelete' => ''.e($hideButtonDelete).'','permissionDelete' => ''.e($permissionDelete).'','routeButtonDelete' => ''.e($routeButtonDelete).'','textModalDelete' => ''.e($textModalDelete).'','valueModalDelete' => ''.e($valueModalDelete).'']); ?>
<?php $component->withName('documents.index.card-body'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalb0194c8801966de8f15f93de73490f9910aa45fe)): ?>
<?php $component = $__componentOriginalb0194c8801966de8f15f93de73490f9910aa45fe; ?>
<?php unset($__componentOriginalb0194c8801966de8f15f93de73490f9910aa45fe); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

        <?php if (isset($component)) { $__componentOriginal72b266f2ebbe384278ffeb0c82386a717137e6ad = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Index\CardFooter::class, ['type' => ''.e($type).'','documents' => $documents]); ?>
<?php $component->withName('documents.index.card-footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginal72b266f2ebbe384278ffeb0c82386a717137e6ad)): ?>
<?php $component = $__componentOriginal72b266f2ebbe384278ffeb0c82386a717137e6ad; ?>
<?php unset($__componentOriginal72b266f2ebbe384278ffeb0c82386a717137e6ad); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
    </div>
<?php else: ?>
    <?php if (isset($component)) { $__componentOriginalf89c10c4e2055ce34f10f93567dfdadab5770eb3 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\Documents\Index\EmptyPage::class, ['type' => ''.e($type).'','imageEmptyPage' => ''.e($imageEmptyPage).'','textEmptyPage' => ''.e($textEmptyPage).'','urlDocsPath' => ''.e($urlDocsPath).'','createRoute' => ''.e($createRoute).'','checkPermissionCreate' => ''.e($checkPermissionCreate).'','permissionCreate' => ''.e($permissionCreate).'']); ?>
<?php $component->withName('documents.index.empty-page'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginalf89c10c4e2055ce34f10f93567dfdadab5770eb3)): ?>
<?php $component = $__componentOriginalf89c10c4e2055ce34f10f93567dfdadab5770eb3; ?>
<?php unset($__componentOriginalf89c10c4e2055ce34f10f93567dfdadab5770eb3); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/components/documents/index/content.blade.php ENDPATH**/ ?>