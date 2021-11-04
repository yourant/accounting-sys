<?php

namespace Modules\Inventory\Models;

use App\Traits\Media;
use App\Abstracts\Model;
use Bkwld\Cloner\Cloneable;
use Illuminate\Notifications\Notifiable;
use Modules\Inventory\Database\Factories\ItemGroups;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ItemGroup extends Model
{
    use Cloneable, Notifiable, Media, HasFactory;

    protected $table = 'inventory_item_groups';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'name', 'description', 'category_id', 'tax_id', 'enabled'];

    /**
     * Sortable columns.
     *
     * @var array
     */
    public $sortable = ['name', 'description', 'enabled'];

    /**
     * Clonable relationships.
     *
     * @var array
     */
    public $cloneable_relations = ['items', 'options', 'option_values'];

    public function values()
    {
        return $this->hasMany('Modules\Inventory\Models\OptionValue');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Setting\Category');
    }

    public function options()
    {
        return $this->hasMany('Modules\Inventory\Models\ItemGroupOption');
    }

    public function option_values()
    {
        return $this->hasMany('Modules\Inventory\Models\ItemGroupOptionValue');
    }

    public function items()
    {
        return $this->hasMany('Modules\Inventory\Models\ItemGroupOptionItem');
    }

    public function bill_items()
    {
        return $this->hasMany('App\Models\Purchase\BillItem');
    }

    public function invoice_items()
    {
        return $this->hasMany('App\Models\Sale\InvoiceItem');
    }

    /**
     * Get the current balance.
     *
     * @return string
     */
    public function getPictureAttribute($value)
    {
        if (!empty($value) && !$this->hasMedia('picture')) {
            return $value;
        } elseif (!$this->hasMedia('picture')) {
            return false;
        }

        return $this->getMedia('picture')->last();
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return ItemGroups::new();
    }
}
