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

    Route::get('retrieve-quote', [
        'as'    => 'retrieve-quote',
        'uses'  => 'QuoteController@retrieve'
    ]);

    Route::get('retrieve-quote-details/{id}', [
        'as'    => 'retrieve-quote-details',
        'uses'  => 'QuoteController@retrieve_details'
    ]);

    Route::get('retrieve-quote-details-demo', [
        'as'    => 'retrieve-quote-details-demo',
        'uses'  => 'QuoteController@retrieve_details_demo'
    ]);
    Route::get('quote-summary',[
        'as'    =>  'quote_summary',
        'uses'  =>  'QuoteController@quote_summary'
    ]);

    /*------------Order Router---------------*/

    Route::get('place-order', [
        'as'    => 'place-order',
        'uses'  => 'OrderController@index'
    ]);
    Route::get('property-details',[
        'as'    =>  'property-details',
        'uses'  =>  'OrderController@property_details'
    ]);
    Route::get('place-order-store',[
        'as'    =>  'place-order-store',
        'uses'  =>  'OrderController@store'
    ]);

    /*-----------Payment Router--------------*/
    Route::get('payment',[
        'as'    =>  'payment',
        'uses'  =>  'PaymentController@index'
    ]);



