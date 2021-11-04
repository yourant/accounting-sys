<?php

namespace Modules\Inventory\Models;

use App\Abstracts\Model;

class DocumentItem extends Model
{
    protected $table = 'inventory_document_items';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'type', 'document_id', 'item_id', 'warehouse_id', 'quantity'];
}
