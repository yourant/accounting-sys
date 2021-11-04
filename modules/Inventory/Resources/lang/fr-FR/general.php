<?php

return [

    'name' => 'Inventaire',
    'description' => 'Comptabilité et gestion des stocks au même emplacement',

    'menu' => [
        'inventory' => 'Inventaire',
        'item_groups' => 'Groupes',
        'options' => 'Options',
        'manufacturers' => 'Fabricant',
        'warehouses' => 'Entrepôts',
        'histories' => 'Historiques',
        'reports' => 'Rapports',
    ],

    'items' => 'Article|Articles',
    'inventories' => 'Inventaire|Inventaires',
    'options' => 'Option|Options',
    'manufacturers' => 'Fabricant|Fabricants',
    'transfer_orders' => 'Ordre de transfert|Ordres de transfert\'',
    'warehouses' => 'Entrepôt|Entrepôts',
    'histories' => 'Historique|Historiques',
    'item_groups' => 'Groupe|Groupes',
    'sku' => 'Référence',
    'quantity' => 'Quantité',
    'edit_warehouse' => 'Modifier: type d\'entrepôt',
    'default' => 'Défaut',
    'stock' => 'Stock',

    'information' => 'Informations',
    'default_warehouse' => 'Entrepôt par défaut',
    'track_inventory' => 'Suivre l\'inventaire',
    'negatif_stock' => 'Stock Négatif',
    'expented_income' => 'Revenu dépensé',
    'sale_item_quantity' => 'Quantité d\'articles vendus',
    'sale_item_amount' => 'Montant d\'articles vendus',
    'purchase_item_quantity' => 'Quantité d\'articles commandés',
    'purchase_item_amount' => 'Montant d\'articles commandés',
    'income' => 'Revenu',

    'invalid_stock'      => 'Stock en entrepôt :stock',


    'document' => [
        'detail' => 'Une classe d\'entrepôt est utilisée pour la comptabilité appropriée au type d\'entrepôt et pour maintenir l\'exactitude de vos rapports.',
    ],

    'reports' => [
        'name' => [
            'stock_status'      => 'Etat du stock',
            'sale_summary'      => 'Résumé des ventes',
            'purchase_summary'  => 'Résumé des commandes',
            'income_status'     => 'Etat des revenus',
            'profit_loss'       => 'Profit & Perte (inventaire)',
            'income_summary'    => 'Résumé des recettes (inventaire)',
            'expense_summary'   => 'Résumé des dépenses (inventaire)',
            'income_expense'    => 'Recettes vs dépenses (inventaire)',

        ],

        'description' => [
            'stock_status'      => 'Suivi du stock',
            'sale_summary'      => 'Suivi des articles vendus',
            'purchase_summary'  => 'Suivi des articles commandés',
            'income_status'     => 'Etat des revenus',
            'profit_loss'       => 'Gains et pertes trimestriels par inventaire.',
            'income_summary'    => 'Résumé des revenus mensuels par inventaire.',
            'expense_summary'   => 'Résumé des dépenses mensuelles par inventaire.',
            'income_expense'    => 'Revenus mensuels vs charges par inventaire.',
        ],
    ],
];
