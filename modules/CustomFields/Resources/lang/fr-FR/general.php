<?php

return [

    'name'              => 'Champs personnalisés',
    'description'       => 'Ajoutez un nombre illimité de champs personnalisés à différentes pages',

    'fields'            => 'Champ|Champs',
    'locations'         => 'Emplacement|Emplacements',
    'sort'              => 'Trier',
    'order'             => 'Emplacement',
    'depend'            => 'Dépendance',
    'show'              => 'Montrer',

    'form' => [
        'name'          => 'Nom',
        'code'          => 'Code',
        'icon'          => 'Icône FontAwesome',
        'class'         => 'Classe CSS',
        'required'      => 'Obligatoire',
        'rule'          => 'Validation',
        'before'        => 'Avant',
        'after'         => 'Après',
        'value'         => 'Valeur',
        'shows'         => [
            'always'    => 'Toujours',
            'never'     => 'Jamais',
            'if_filled' => 'Si completé'
        ]
    ],

    'type' => [
        'select'        => 'Sélection',
        'radio'         => 'Radio',
        'checkbox'      => 'Case à cocher',
        'text'          => 'Texte',
        'textarea'      => 'Zone de texte',
        'date'          => 'Date',
        'time'          => 'Heure',
        'date&time'     => 'Date & Heure'
    ],

    'item' => [
        'action'   => 'Action de l\'article',
        'name'     => 'Nom de l\'article',
        'quantity' => 'Nombre d\'articles',
        'price'    => 'Prix de l\'article',
        'taxes'    => 'TVA de l\'article',
        'total'    => 'Total articles',
    ],
];
