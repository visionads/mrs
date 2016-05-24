<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/18/16
 * Time: 9:39 AM
 */



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
