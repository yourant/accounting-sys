<div class="card-header">
    <?php echo Form::open([
        'method' => 'GET',
        'route' => ['reports.show', $class->model->id],
        'role' => 'form',
        'class' => 'mb-0'
    ]); ?>

        <?php
            $filters = [];
            $filtered = [];

            $skipped = [
                'keys', 'names', 'types', 'routes'
            ];

            foreach ($class->filters as $filter_name => $filter_values) {
                if (in_array($filter_name, $skipped)) {
                    continue;
                }

                $key = $filter_name;

                if (isset($class->filters['keys']) && !empty($class->filters['keys'][$filter_name])) {
                    $key = $class->filters['keys'][$filter_name];
                } else if ($key == 'years') {
                    $key = 'year';
                } else if ($key == 'customers' || $key == 'vendors') {
                    $key = 'contact_id';
                } else {
                    $key = Str::singular($key) . '_id';
                }

                $value = '';

                if (isset($class->filters['names']) && !empty($class->filters['names'][$filter_name])) {
                    $value = $class->filters['names'][$filter_name];
                } else if (trans('reports.' . $filter_name) != 'reports.' . $filter_name) {
                    $value = (strpos(trans('reports.' . $filter_name), '|') !== false) ? trans_choice('reports.' . $filter_name, 1) : trans('reports.' . $filter_name);
                } else {
                    $value = (strpos(trans('general.' . $filter_name), '|') !== false) ? trans_choice('general.' . $filter_name, 1) : trans('general.' . $filter_name);
                }

                if ($key == 'year') {
                    $value = trans('general.financial_year');
                }

                $type = 'select';

                if (isset($class->filters['types']) && !empty($class->filters['types'][$filter_name])) {
                    $type = $class->filters['types'][$filter_name];
                }

                $url = '';

                if (isset($class->filters['routes']) && !empty($class->filters['routes'][$filter_name])) {
                    $route = $class->filters['routes'][$filter_name];

                    $url =  (is_array($route)) ? route($route[0], $route[1]) : route($route);
                }

                $filters[] = [
                    'key' => $key,
                    'value' => $value,
                    'type' => $type,
                    'url' => $url,
                    'values' => $filter_values,
                ];

                if ($key == 'year') {
                    $filtered[] = [
                        'option' => $key,
                        'operator' => '=',
                        'value' => \Date::now()->year,
                    ];
                }

                if (old($key) || request()->get($key)) {
                    $filtered[] = [
                        'option' => $key,
                        'operator' => '=',
                        'value' => old($key, request()->get($key)),
                    ];
                }
            }
        ?>

        <div class="align-items-center">
            <?php if (isset($component)) { $__componentOriginaldec57d2dc7c3b62478d574f9a4a67fba694d4f23 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\SearchString::class, ['filters' => $filters,'filtered' => $filtered]); ?>
<?php $component->withName('search-string'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginaldec57d2dc7c3b62478d574f9a4a67fba694d4f23)): ?>
<?php $component = $__componentOriginaldec57d2dc7c3b62478d574f9a4a67fba694d4f23; ?>
<?php unset($__componentOriginaldec57d2dc7c3b62478d574f9a4a67fba694d4f23); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
        </div>
    <?php echo Form::close(); ?>

</div>
<?php /**PATH C:\xampp\htdocs\akaunting-master-from-mbp\resources\views/partials/reports/filter.blade.php ENDPATH**/ ?>