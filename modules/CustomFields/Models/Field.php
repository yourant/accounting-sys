<?php

namespace Modules\CustomFields\Models;

use App\Abstracts\Model;
use Bkwld\Cloner\Cloneable;
use Illuminate\Notifications\Notifiable;

class Field extends Model
{
    use Cloneable, Notifiable;

    protected $table = 'custom_fields_fields';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'name', 'code', 'icon', 'class', 'type_id', 'required', 'rule', 'enabled', 'locations', 'show'];

    /**
     * Clonable relationships.
     *
     * @var array
     */
    public $cloneable_relations = ['fieldTypeOption'];

    public function type()
    {
        return $this->belongsTo('Modules\CustomFields\Models\Type');
    }

    public function location()
    {
        return $this->belongsTo('Modules\CustomFields\Models\Location', 'locations', 'id');
    }

    public function fieldTypeOption()
    {
        return $this->hasMany('Modules\CustomFields\Models\FieldTypeOption', 'field_id', 'id');
    }

    public function fieldLocation()
    {
        return $this->hasOne('Modules\CustomFields\Models\FieldLocation', 'field_id', 'id');
    }

    public function field_values()
    {
        return $this->hasMany('Modules\CustomFields\Models\FieldValue', 'field_id', 'id');
    }

    public function scopeByLocation($query, $location_id)
    {
        return $query->where('locations', $location_id);
    }

    public function onCloning($src, $child = null)
    {
    }
}
