<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => config('sidemenu.controller_namespace','Player\Sidemenu\Controllers')], function () {
    Route::get(config('sidemenu.url'), 'MenuController@index');
    Route::post('/menu/order/change', 'MenuController@changeSideMenuOrder')->name(config('sidemenu.route_name'));
});
