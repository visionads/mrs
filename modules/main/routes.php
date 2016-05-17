<?php
/**
 * Created by PhpStorm.
 * User: selim
 * Date: 12/8/2015
 * Time: 5:54 PM
 */



Route::group(array('prefix' => 'main','modules'=>'Main', 'namespace' => 'Modules\Main\Controllers'), function() {
    //Your routes belong to this module.

    include 'routes_ram.php';


    Route::any('test', [
        //'middleware' => 'acl_access:user/user-list',
        'as' => 'test',
        'uses' => 'MainController@index'
    ]);

    /*------------Home page---------------*/

    Route::get('order', [
        //'middleware' => 'acl_access:role',
            'as' => 'order',
            'uses' => 'MainController@order'
    ]);

    /*------------New Order---------------*/

    Route::get('new-order', [
        //'middleware' => 'acl_access:role',
            'as' => 'new-order',
            'uses' => 'NewOrderController@index'
    ]);

    Route::get('store-property-detail', [
        //'middleware' => 'acl_access:role',
        'as' => 'store-property-detail',
        'uses' => 'NewOrderController@store'
    ]);


});
