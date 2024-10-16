<?php


return [

    // table name
    'table_name' => 'menus',
    
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
    ],

    // controller namespace 
    'controller_namespace' => 'App\Http\Controllers',

    // model namespace
    'model_namespace' => 'App\Models',

    // url for open sidebar
    'url' => 'sortable-menu',

    // route name for open sidebar
    
    // route name for change order of menu in ajax
    'route_name' => 'menu.update.order',

    
];
