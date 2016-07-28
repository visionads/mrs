<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 3/15/16
 * Time: 1:07 PM
 */



Route::post('add-to-cart/{product_id}',[
    //'middleware' => 'acl_access:marketing/add-to-cart/{product_id}',
    'as'    =>  'add-to-cart',
    'uses'  =>  'OrderController@add_to_cart'
]);


