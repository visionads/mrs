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
