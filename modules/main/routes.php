<?php
/**
 * Created by PhpStorm.
 * User: selim
 * Date: 12/8/2015
 * Time: 5:54 PM
 */



Route::group(array('prefix' => 'main','modules'=>'Main', 'namespace' => 'Modules\Main\Controllers'), function() {
    //Your routes belong to this module.

    //include 'routes_ram.php';
    //include 'routes_sha1.php';


    Route::any('test', [
        //'middleware' => 'acl_access:user/user-list',
        'middleware' => 'acl_access:main/test',
        'as' => 'test',
        'uses' => 'MainController@index'
    ]);

    /*------------Home page---------------*/

    Route::get('order', [
        //'middleware' => 'acl_access:role',
        'middleware' => 'acl_access:main/order',
        'as' => 'order',
        'uses' => 'MainController@order'
    ]);

    /*------------New Order---------------*/

    /*Route::get('new-order', [
        //'middleware' => 'acl_access:role',
        'middleware' => 'acl_access:main/new-order',
        'as' => 'new-order',
        'uses' => 'NewOrderController@index'
    ]);*/

    Route::get('store-property-detail', [
        //'middleware' => 'acl_access:role',
        'middleware' => 'acl_access:main/store-property-detail',
        'as' => 'store-property-detail',
        'uses' => 'NewOrderController@store'
    ]);



    /*==================Ram's Routes=====================*/
    /*------------Invoice---------------*/

    /*Route::get('invoice/{transaction_id}', [
        'middleware' => 'acl_access:main/invoice',
        'as' => 'invoice',
        'uses' => 'InvoiceController@invoice'
    ]);*/
    Route::get('invoice/{transaction_id}', [
        'middleware' => 'acl_access:main/invoice',
        'as' => 'invoice',
        'uses' => 'InvoiceController@invoice'
    ]);
    Route::get('invoice-print/{id}', [
        'middleware' => 'acl_access:main/invoice-print',
        'as' => 'invoice-print',
        'uses' => 'InvoiceController@invoice_print'
    ]);
    Route::get('invoice-list', [
        'middleware' => 'acl_access:main/invoice-list',
        'as' => 'invoice-list',
        'uses' => 'InvoiceController@invoice_list'
    ]);

    /*------------Pages Router---------------*/

    Route::get('what-we-do', [
        'middleware' => 'acl_access:main/what-we-do',
        'as' => 'what-we-do',
        'uses' => 'PagesController@what_we_do'
    ]);
    Route::get('need-help', [
        'middleware' => 'acl_access:main/need-help',
        'as' => 'need-help',
        'uses' => 'PagesController@need_help'
    ]);

    /*------------Quote Router---------------*/

    Route::get('new-quote', [
        'middleware' => 'acl_access:main/new-quote',
        'as' => 'new-quote',
        'uses' => 'QuoteController@create'
    ]);

    Route::get('quote-list', [
        'middleware' => 'acl_access:main/quote-list',
        'as'    => 'quote-list',
        'uses'  => 'QuoteController@retrieve'
    ]);


    Route::get('quote-details/{quote_id}/{quote_no}', [
        'middleware' => 'acl_access:main/quote-details',
        'as'    => 'quote-details',
        'uses'  => 'QuoteController@retrieve_details_demo'
    ]);

    Route::get('quote-summary/{quote_id}/{quote_no}',[
        'middleware' => 'acl_access:main/quote-summary',
        'as'    =>  'quote_summary',
        'uses'  =>  'QuoteController@quote_summary'
    ]);

    /*------------Order Router---------------*/

    // page for quote confirm
    Route::any('quote-confirm/{quote_id}/{quote_no}', [
        'middleware' => 'acl_access:main/quote-confirm',
        'as'    => 'quote-confirm',
        'uses'  => 'OrderController@quote_confirm'
    ]);
    Route::any('new-order', [
        'middleware' => 'acl_access:main/new-order',
        'as'    => 'new-order',
        'uses'  => 'OrderController@new_order'
    ]);

    //page for place order
    /*Route::any('page-place-order/{quote_id}/{quote_no}/{total}/{gst}/{total_with_gst}',[
        'middleware' => 'acl_access:main/page-place-order',
        'as'    =>  'page-place-order',
        'uses'  =>  'OrderController@page_place_order'
    ]);*/
    Route::any('page-place-order/{quote_id}/{quote_no}',[
        'middleware' => 'acl_access:main/page-place-order',
        'as'    =>  'page-place-order',
        'uses'  =>  'OrderController@page_place_order'
    ]);


    Route::any('page-place-order-edit/{quote_id}/{quote_no}',[
        #'middleware' => 'acl_access:main/page-place-order-edit',
        'as'    =>  'page-place-order-edit',
        'uses'  =>  'OrderController@page_place_order_edit'
    ]);





    Route::any('property-details/{quote_id}/{quote_no}',[
        'middleware' => 'acl_access:main/property-details',
        'as'    =>  'property-details',
        'uses'  =>  'OrderController@property_details'
    ]);



    Route::any('place-order',[
        'middleware' => 'acl_access:main/place-order',
        'as'    =>  'place-order',
        'uses'  =>  'OrderController@place_order'
    ]);


    Route::any('place-order-store',[
        'middleware' => 'acl_access:main/place-order-store',
        'as'    =>  'place-order-store',
        'uses'  =>  'OrderController@store'
    ]);

    Route::any('place-order-update/{id}',[
        #'middleware' => 'acl_access:main/place-order-update',
        'as'    =>  'place-order-update',
        'uses'  =>  'OrderController@update'
    ]);




    /*-----------Payment Router--------------*/

    Route::any('payment-procedure/{quote_id}/{quote_no}',[
        'middleware' => 'acl_access:main/payment-procedure',
        'as'    =>  'payment-procedure',
        'uses'  =>  'OrderController@payment_procedure'
    ]);

    Route::get('payment',[
        'middleware' => 'acl_access:main/payment',
        'as'    =>  'payment',
        'uses'  =>  'PaymentController@index_payment'
    ]);

    /*=================Shamim's Routes=================*/
    Route::post('new-quote-store', [
        'as' => 'new-quote-store',
        'uses' => 'QuoteController@store'
    ]);

    Route::get('edit_quote/{id}', [
        'as' => 'edit_quote',
        'uses' => 'QuoteController@edit'
    ]);
    Route::patch('new_quote_store/{id}', [
        'as' => 'new_quote_store',
        'uses' => 'QuoteController@update'
    ]);
    Route::get('payment-success/{id}/{amount}', [
        'as' => 'payment-success',
        'uses' => 'PaymentController@store'
    ]);
    Route::get('quotes', [
        'as' => 'quotes',
        'uses' => 'QuoteController@view_quote'
    ]);
    Route::get('quote-detail/{id}', [
        'as' => 'quote-detail',
        'uses' => 'QuoteController@quote_details'
    ]);
    Route::get('payment-list', [
        'as' => 'payment-list',
        'uses' => 'PaymentController@index'
    ]);
    Route::get('view-payment-detail/{id}', [
        'as' => 'view-payment-detail',
        'uses' => 'PaymentController@show'
    ]);


});
