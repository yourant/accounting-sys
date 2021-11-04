<?php

namespace Modules\Inventory\Models;

use App\Abstracts\Model;
use Bkwld\Cloner\Cloneable;

class History extends Model
{
    use Cloneable;

    protected $table = 'inventory_histories';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'user_id', 'item_id', 'warehouse_id', 'type_id', 'type_type', 'quantity'];

    public function type()
    {
        return $this->morphTo();
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Common\Item')->withDefault(['name' => trans('general.na')]);
    }

    public function warehouse()
    {
        return $this->belongsTo('Modules\Inventory\Models\Warehouse')->withDefault(['name' => trans('general.na')]);
    }

    public function getActionTextAttribute()
    {
        $types = explode("\\", $this->type_type);
        $type = end($types);

        switch ($type) {
            case 'Item':
                return '#' . $this->type->id;
                break;
            case 'DocumentItem':
                return $this->type->document->document_number;
                break;
        }
    }

    public function getActionUrlAttribute()
    {
        $types = explode("\\", $this->type_type);
        $type = end($types);

        $url = '#';

        switch ($type) {
            case 'Item':
                $url = 'inventory/items/' . $this->type->id;

                break;
            case 'DocumentItem':
                $document_type = $this->type->document->type;

                $route = '';
                $parameter = $this->type->document->id;
                $alias = config('type.' . $document_type . '.alias');
                $prefix = config('type.' . $document_type . '.route.prefix');

                // if use module set module alias
                if (!empty($alias)) {
                    $route .= $alias . '.';
                }

                if (!empty($prefix)) {
                    $route .= $prefix . '.';
                }

                $route .= 'show';

                $url = route($route, $parameter);
                break;
        }

        return $url;
    }

    public function getActionRouteAttribute()
    {
        $types = explode("\\", $this->type_type);
        $type = end($types);

        $routes = [];

        switch ($type) {
            case 'Item':
                $routes = [
                    'inventory.items.show',
                    $this->type->id,
                ];

                break;
            case 'DocumentItem':
                $document_type = $this->type->document->type;

                $route = '';
                $parameter = $this->type->document->id;
                $alias = config('type.' . $document_type . '.alias');
                $prefix = config('type.' . $document_type . '.route.prefix');

                // if use module set module alias
                if (!empty($alias)) {
                    $route .= $alias . '.';
                }

                if (!empty($prefix)) {
                    $route .= $prefix . '.';
                }

                $route .= 'show';

                $routes = [$route, $parameter];
                break;
        }

        return $routes;
    }
}
