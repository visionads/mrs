<?php
/**
 * Created by PhpStorm.
 * User: selim
 * Date: 12/8/2015
 * Time: 5:54 PM
 */





    /*------------Invoice---------------*/

    Route::get('invoice', [
        //'middleware' => 'acl_access:role',
        'as' => 'invoice',
        'uses' => 'InvoiceController@index'
    ]);
    Route::get('invoice-print', [
        //'middleware' => 'acl_access:role',
        'as' => 'invoice-print',
        'uses' => 'InvoiceController@invoice_print'
    ]);
    Route::get('invoice-list', [
        //'middleware' => 'acl_access:role',
        'as' => 'invoice-list',
        'uses' => 'InvoiceController@invoice_list'
    ]);

    /*------------Pages Router---------------*/

    Route::get('what-we-do', [
        //'middleware' => 'acl_access:role',
        'as' => 'what-we-do',
        'uses' => 'PagesController@what_we_do'
    ]);
    Route::get('need-help', [
        //'middleware' => 'acl_access:role',
        'as' => 'need-help',
        'uses' => 'PagesController@need_help'
    ]);

    /*------------Quote Router---------------*/

    Route::get('new-quote', [
        'as' => 'new-quote',
        'uses' => 'QuoteController@create'
    ]);

    Route::get('quote-list', [
        'as'    => 'quote-list',
        'uses'  => 'QuoteController@retrieve'
    ]);

    /*Route::get('retrieve-quote-details/{id}', [
        'as'    => 'retrieve-quote-details',
        'uses'  => 'QuoteController@retrieve_details'
    ]);*/

    Route::get('quote-details/{quote_id}/{quote_no}', [
        'as'    => 'quote-details',
        'uses'  => 'QuoteController@retrieve_details_demo'
    ]);

    Route::get('quote-summary/{quote_id}/{quote_no}',[
        'as'    =>  'quote_summary',
        'uses'  =>  'QuoteController@quote_summary'
    ]);

    /*------------Order Router---------------*/

    // page for quote confirm
    Route::any('quote-confirm/{quote_id}/{quote_no}', [
        'as'    => 'quote-confirm',
        'uses'  => 'OrderController@quote_confirm'
    ]);

    //page for place order
    Route::any('page-place-order/{quote_id}/{quote_no}',[
        'as'    =>  'page-place-order',
        'uses'  =>  'OrderController@page_place_order'
    ]);

    Route::any('property-details/{quote_id}/{quote_no}',[
        'as'    =>  'property-details',
        'uses'  =>  'OrderController@property_details'
    ]);



    Route::any('place-order/{quote_id}/{quote_no}',[
        'as'    =>  'place-order',
        'uses'  =>  'OrderController@place_order'
    ]);


    Route::any('place-order-store',[
        'as'    =>  'place-order-store',
        'uses'  =>  'OrderController@store'
    ]);

    /*Route::any('agreement',[
        'as'    =>  'agreement',
        'uses'  =>  'OrderController@agreement'
    ]);*/

    /*-----------Payment Router--------------*/

    Route::any('payment-procedure/{quote_id}/{quote_no}',[
        'as'    =>  'payment-procedure',
        'uses'  =>  'OrderController@payment_procedure'
    ]);

    Route::get('payment',[
        'as'    =>  'payment',
        'uses'  =>  'PaymentController@index'
    ]);



