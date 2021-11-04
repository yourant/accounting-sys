<?php

return [

    'name' => 'Inventory',
    'description' => 'Accounting and inventory management under one roof',

    'menu' => [
        'inventory' => 'Inventory',
        'item_groups' => 'Groups',
        'options' => 'Options',
        'manufacturers' => 'Manufacturer',
        'warehouses' => 'Warehouses',
        'histories' => 'Histories',
        'reports' => 'Reports',
    ],

    'items' => 'Item|Items',
    'inventories' => 'Inventory|Inventories',
    'options' => 'Option|Options',
    'manufacturers' => 'Manufacturer|Manufacturers',
    'transfer_orders' => 'Transfer Stock|Transfer Stocks',
    'warehouses' => 'Warehouse|Warehouses',
    'histories' => 'History|Histories',
    'item_groups' => 'Group|Groups',
    'sku' => 'SKU',
    'quantity' => 'Quantity',
    'edit_warehouse' => 'Edit :type Warehouse',
    'default' => 'Default',
    'stock' => 'Stock',

    'information' => 'Information',
    'default_warehouse' => 'Default Warehouse',
    'track_inventory' => 'Track Inventory',
    'negatif_stock' => 'Negatif Stock',
    'expented_income' => 'Expented Income',
    'sale_item_quantity' => 'Sale Item Quantity',
    'sale_item_amount' => 'Sale Item Amount',
    'purchase_item_quantity' => 'Purchase Item Quantity',
    'purchase_item_amount' => 'Purchase Item Amount',
    'income' => 'Income',

    'invalid_stock'      => 'Stock in warehouse :stock',
    'low_stock'    => ':name Low Stock (:count :warehouse)',


    'document' => [
        'detail' => 'An :class warehouse is used for proper bookkeeping of your :type and to keep your reports accurate.',
    ],

    'reports' => [
        'name' => [
            'stock_status'      => 'Stock Status',
            'sale_summary'      => 'Sale Summary',
            'purchase_summary'  => 'Purchase Summary',
            'income_status'     => 'Income Status',
            'profit_loss'       => 'Profit & Loss (Inventory)',
            'income_summary'    => 'Income Summary (Inventory)',
            'expense_summary'   => 'Expense Summary (Inventory)',
            'income_expense'    => 'Income vs Expense (Inventory)',

        ],

        'description' => [
            'stock_status'      => 'Stock tracking of items',
            'sale_summary'      => 'Stock tracking of sales items',
            'purchase_summary'  => 'Stock tracking of purchases items',
            'income_status'     => 'Income Status',
            'profit_loss'       => 'Quarterly profit & loss by inventory.',
            'income_summary'    => 'Monthly income summary by inventory.',
            'expense_summary'   => 'Monthly expense summary by inventory.',
            'income_expense'    => 'Monthly income vs expense by inventory.',
        ],
    ],
];
