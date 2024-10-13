<?php


return [
    // table column and field type
    'menu_columns' => [
        'title' => 'string',
        'menu_id' => 'string',
        'order' => 'integer',
        'permission' => 'json'
    ],
    // extra field here
    'extra_field' => [
        'html' => 'text',
        'menu_active' => 'json',
        'parent_menu_id' => 'string',
        'route' => 'string',
        'class' => 'string',
        'user_type' => 'string'
        // Add additional fields here
    ]
];
