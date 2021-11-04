<?php

return [

    Modules\Inventory\Models\ItemGroup::class => [
        'columns' => [
            'name' => ['searchable' => true],
            'enabled' => ['boolean' => true],
            'category_id' => [
                'route' => ['categories.index', 'search=type:item']
            ],
        ],
    ],

    Modules\Inventory\Models\Option::class => [
        'columns' => [
            'name' => ['searchable' => true],
            'enabled' => ['boolean' => true],
        ],
    ],

    Modules\Inventory\Models\TransferOrder::class => [
        'columns' => [
            'transfer_order' => ['searchable' => true],
            'transfer_quantity' => ['searchable' => true],
            'source_warehouse' => ['searchable' => true],
            'destination_warehouse' => ['searchable' => true],
            'date' => ['date' => true],
        ],
    ],

    Modules\Inventory\Models\Warehouse::class => [
        'columns' => [
            'name' => ['searchable' => true],
            'email' => ['searchable' => true],
            'phone' => ['searchable' => true],
            'enabled' => ['boolean' => true],
        ],
    ],

    Modules\Inventory\Models\History::class => [
        'columns' => [
            'item' => ['searchable' => true],
            'warehouse' => ['searchable' => true],
        ],
    ],
];
