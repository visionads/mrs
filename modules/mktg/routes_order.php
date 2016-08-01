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
Route::get('order-details/{order_id}',[
    //'middleware' => 'acl_access:marketing/order-details/{order_id}',
    'as'    =>  'order-details',
    'uses'  =>  'OrderController@order_details'
]);
Route::get('delete-order-details/{order_id}',[
    //'middleware' => 'acl_access:marketing/delete-order-details/{order_id}',
    'as'    =>  'delete-order-details',
    'uses'  =>  'OrderController@delete_order_details'
]);
Route::get('delete-order/{order_id}',[
    //'middleware' => 'acl_access:marketing/delete-order/{order_id}',
    'as'    =>  'delete-order',
    'uses'  =>  'OrderController@delete_order'
]);
// payment route
Route::get('payment-success/{id}/{amount}', [
    //'middleware' => 'acl_access:marketing/payment-success/{id}/{amount}',
    'as' => 'payment-success',
    'uses' => 'PaymentController@store'
]);
Route::get('payments', [
    //'middleware' => 'acl_access:marketing/payments',
    'as' => 'payments',
    'uses' => 'PaymentController@index'
]);
Route::get('change_status/{id}/{status}', [
    //'middleware' => 'acl_access:marketing/change_status/{id}/{status}',
    'as' => 'change_payment_status_for_mtkg_payment',
    'uses' => 'PaymentController@change_status'
]);


