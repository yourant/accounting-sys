<?php

return [

    'name' => 'Stok Yönetimi',
    'description' => 'Tek bir çatı altında muhasebe ve stok yönetimi',

    'menu' => [
        'inventory' => 'Stok Yönetimi',
        'item_groups' => 'Gruplar',
        'options' => 'Seçenekler',
        'manufacturers' => 'Üreticiler',
        'warehouses' => 'Depolar',
        'histories' => 'Geçmiş',
        'reports' => 'Raporlar',
    ],

    'inventories' => 'Stok Yönetimi|Stok Yönetimi',
    'options' => 'Seçenek|Seçenekler',
    'manufacturers' => 'Üretici|Üreticiler',
    'warehouses' => 'Depo|Depolar',
    'histories' => 'Geçmiş|Geçmiş',
    'item_groups' => 'Grup|Gruplar',
    'sku' => 'Ürün Kodu',
    'quantity' => 'Adet',

    'information' => 'Hakkında',
    'default_warehouse' => 'Ana Depo',

    'reports' => [
        'name' => [
            'profit_loss'       => 'Kar & Zarar (Stok Yönetimi)',
            'income_summary'    => 'Gelir Özeti (Stok Yönetimi)',
            'expense_summary'   => 'Gider Özeti (Stok Yönetimi)',
            'income_expense'    => 'Gelir ve Gider Özeti (Stok Yönetimi)',
        ],

        'description' => [
            'profit_loss'       => 'Çeyrek dönemlik kar ve zarar.',
            'income_summary'    => 'Aylık gelir özeti.',
            'expense_summary'   => 'Aylık gider özeti.',
            'income_expense'    => 'Aylık gelir ve gider özeti.',
        ],
    ],
];
