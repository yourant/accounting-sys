<?php

namespace Modules\Inventory\Providers;

use App\Models\Common\Item;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\ServiceProvider;

class Macro extends ServiceProvider
{

    public function register()
    {
        Builder::macro('inventory', function () {
            $model = $this->getModel();

            if ($model instanceof Item) {
                return $model->belongsTo('Modules\Inventory\Models\Item', 'id', 'item_id');
            }

            unset(static::$macros['inventory']);

            return $model->inventory();
        });
    }
}
