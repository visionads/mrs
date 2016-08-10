<?php
/**
 * Created by PhpStorm.
 * User: selim
 * Date: 12/8/2015
 * Time: 5:54 PM
 */


Route::group(array('modules'=>'Mktg', 'namespace' => 'Modules\Mktg\Controllers'), function()
{

    Route::post('marketing/add-to-cart/{product_id}',[
        'middleware' => 'acl_access:marketing/add-to-cart/{product_id}',
        'as'    =>  'add-to-cart',
        'uses'  =>  'MktgOrderController@add_to_cart'
    ]);
    Route::get('marketing/order-details/{order_id}',[
        'middleware' => 'acl_access:marketing/order-details/{order_id}',
        'as'    =>  'order-details',
        'uses'  =>  'MktgOrderController@order_details'
    ]);
    Route::get('marketing/delete-order-details/{order_id}',[
        'middleware' => 'acl_access:marketing/delete-order-details/{order_id}',
        'as'    =>  'delete-order-details',
        'uses'  =>  'MktgOrderController@delete_order_details'
    ]);
    Route::get('marketing/delete-order/{order_id}',[
        'middleware' => 'acl_access:marketing/delete-order/{order_id}',
        'as'    =>  'delete-order',
        'uses'  =>  'MktgOrderController@delete_order'
    ]);

    //Payment Section
    Route::any('marketing/payment-success/{id}/{amount}', [
        'middleware' => 'acl_access:marketing/payment-success/{id}/{amount}',
        'as' => 'payment-success',
        'uses' => 'MktgPaymentController@store'
    ]);

    Route::get('marketing/payments', [
        'middleware' => 'acl_access:marketing/payments',
        'as' => 'payments',
        'uses' => 'MktgPaymentController@index'
    ]);
    Route::get('marketing/change_status/{id}/{status}', [
        'middleware' => 'acl_access:marketing/change_status/{id}/{status}',
        'as' => 'change_payment_status_for_mtkg_payment',
        'uses' => 'MktgPaymentController@change_status'
    ]);



    Route::any('marketing/agency-stationary-material/{slug}',[
        'middleware' => 'acl_access:marketing/agency-stationary-material/{slug}',
        'as'    =>  'agency-stationary-material',
        'uses'  =>  'AgencyMarketingController@agency_stationary_material'
    ]);


    /*--------------------Marketing Material (Printing)-----*/

    Route::get('marketing/marketing-material-printing',[
        'middleware' => 'acl_access:marketing/marketing-material-printing',
        'as' => 'marketing-material-printing',
        'uses' => 'MarketingMaterialController@index'
    ]);
    Route::get('marketing/marketing-material-proceed',[
        'middleware' => 'acl_access:marketing/marketing-material-printing',
        'as' => 'marketing-material-proceed',
        'uses' => 'MarketingMaterialController@proceed'
    ]);

    //===== For Agency Stationary Materials ***//
    Route::get('marketing/letterhead',[
        'middleware' => 'acl_access:marketing/letterhead',
        'as' => 'letterhead',
        'uses' => 'MarketingMaterialController@letterhead'
    ]);
    Route::get('marketing/presentation',[
        'middleware' => 'acl_access:marketing/presentation',
        'as' => 'presentation',
        'uses' => 'MarketingMaterialController@presentation'
    ]);
    Route::get('marketing/withcomp',[
        'middleware' => 'acl_access:marketing/withcomp',
        'as' => 'withcomp',
        'uses' => 'MarketingMaterialController@withcomp'
    ]);
    Route::get('marketing/envelopes',[
        'middleware' => 'acl_access:marketing/envelopes',
        'as' => 'envelopes',
        'uses' => 'MarketingMaterialController@envelopes'
    ]);
    Route::get('marketing/forms',[
        'middleware' => 'acl_access:marketing/forms',
        'as' => 'forms',
        'uses' => 'MarketingMaterialController@forms'
    ]);
    Route::get('marketing/carbon',[
        'middleware' => 'acl_access:marketing/carbon',
        'as' => 'carbon',
        'uses' => 'MarketingMaterialController@carbon'
    ]);

    //===== For Agency /Agent Marketing ***//
    Route::get('marketing/teardrop',[
        'middleware' => 'acl_access:marketing/teardrop',
        'as' => 'teardrop',
        'uses' => 'MarketingMaterialController@teardrop'
    ]);
    Route::get('marketing/directional',[
        'middleware' => 'acl_access:marketing/directional',
        'as' => 'directional',
        'uses' => 'MarketingMaterialController@directional'
    ]);
    Route::get('marketing/vynle',[
        'middleware' => 'acl_access:marketing/vynle',
        'as' => 'vynle',
        'uses' => 'MarketingMaterialController@vynle'
    ]);
    Route::get('marketing/pullup',[
        'middleware' => 'acl_access:marketing/pullup',
        'as' => 'pullup',
        'uses' => 'MarketingMaterialController@pullup'
    ]);
    Route::get('marketing/business',[
        'middleware' => 'acl_access:marketing/business',
        'as' => 'business',
        'uses' => 'MarketingMaterialController@business'
    ]);
    Route::get('marketing/brochure',[
        'middleware' => 'acl_access:marketing/brochure',
        'as' => 'brochure',
        'uses' => 'MarketingMaterialController@brochure'
    ]);
    Route::get('marketing/fridge',[
        'middleware' => 'acl_access:marketing/fridge',
        'as' => 'fridge',
        'uses' => 'MarketingMaterialController@fridge'
    ]);
    Route::get('marketing/magazine',[
        'middleware' => 'acl_access:marketing/magazine',
        'as' => 'magazine',
        'uses' => 'MarketingMaterialController@magazine'
    ]);
    Route::get('marketing/calender',[
        'middleware' => 'acl_access:marketing/calender',
        'as' => 'calender',
        'uses' => 'MarketingMaterialController@calender'
    ]);
    Route::get('marketing/letterdrop',[
        'middleware' => 'acl_access:marketing/letterdrop',
        'as' => 'letterdrop',
        'uses' => 'MarketingMaterialController@letterdrop'
    ]);

    //===== For Agency /Agent Marketing ***//
    Route::get('marketing/property-cards',[
        'middleware' => 'acl_access:marketing/property-cards',
        'as' => 'property-cards',
        'uses' => 'MarketingMaterialController@property_cards'
    ]);
    Route::get('marketing/pvc-sign',[
        'middleware' => 'acl_access:marketing/pvc-sign',
        'as' => 'pvc-sign',
        'uses' => 'MarketingMaterialController@pvc_sign'
    ]);
    Route::get('marketing/sold',[
        'middleware' => 'acl_access:marketing/sold',
        'as' => 'sold',
        'uses' => 'MarketingMaterialController@sold'
    ]);
    Route::get('marketing/congratulation',[
        'middleware' => 'acl_access:marketing/congratulation',
        'as' => 'congratulation',
        'uses' => 'MarketingMaterialController@congratulation'
    ]);

    //===== Form Menu Items ***//
    Route::get('marketing/mktg-menu-item',[
        'middleware' => 'acl_access:marketing/mktg-menu-item',
        'as' => 'mktg-menu-item',
        'uses' => 'MarketingMaterialController@mktg_menu_item_index'
    ]);
    Route::post('marketing/store-menu-item',[
        'middleware' => 'acl_access:marketing/store-menu-item',
        'as' => 'store-menu-item',
        'uses' => 'MarketingMaterialController@mktg_menu_item_store'
    ]);
    Route::get('marketing/mktg-menu-item-view/{id}',[
        'middleware' => 'acl_access:marketing/mktg-menu-item-view/{id}',
        'as' => 'mktg-menu-item-view',
        'uses' => 'MarketingMaterialController@mktg_menu_item_view'
    ]);
    Route::get('marketing/mktg-menu-item-search',[
        'middleware' => 'acl_access:marketing/mktg-menu-item-search',
        'as' => 'mktg-menu-item-search',
        'uses' => 'MarketingMaterialController@mktg_menu_item_search'
    ]);
    Route::get('marketing/mktg-menu-item-details/{id}',[
        'middleware' => 'acl_access:marketing/mktg-menu-item-details/{id}',
        'as' => 'mktg-menu-item-details',
        'uses' => 'MarketingMaterialController@mktg_menu_item_details'
    ]);
    Route::get('marketing/mktg-menu-item-edit/{id}',[
        'middleware' => 'acl_access:marketing/mktg-menu-item-edit/{id}',
        'as' => 'mktg-menu-item-edit',
        'uses' => 'MarketingMaterialController@mktg_menu_item_edit'
    ]);
    Route::patch('marketing/mktg-menu-item-update/{id}',[
        'middleware' => 'acl_access:marketing/mktg-menu-item-update/{id}',
        'as' => 'mktg-menu-item-update',
        'uses' => 'MarketingMaterialController@mktg_menu_item_update'
    ]);
    Route::get('marketing/mktg-menu-item-delete/{id}',[
        'middleware' => 'acl_access:marketing/mktg-menu-item-delete/{id}',
        'as' => 'mktg-menu-item-delete',
        'uses' => 'MarketingMaterialController@mktg_menu_item_delete'
    ]);

    //=== Item value
    Route::get('marketing/mktg-item-option-add-value/{id}',[
        'middleware' => 'acl_access:marketing/mktg-item-option-add-value/{id}',
        'as' => 'mktg-item-option-add-value',
        'uses' => 'MarketingMaterialController@mktg_item_option_add_value'
    ]);
    Route::post('marketing/mktg-item-option-add-value-store/{id}',[
        'middleware' => 'acl_access:marketing/mktg-item-option-add-value-store/{id}',
        'as' => 'mktg-item-option-add-value-store',
        'uses' => 'MarketingMaterialController@mktg_item_option_add_value_store'
    ]);
    Route::patch('marketing/mktg-item-option-add-value-update/{id}',[
        'middleware' => 'acl_access:marketing/mktg-item-option-add-value-update/{id}',
        'as' => 'mktg-item-option-add-value-update',
        'uses' => 'MarketingMaterialController@mktg_item_option_add_value_update'
    ]);


    //===== Order Details
    Route::get('marketing/mktg-order',[
        'middleware' => 'acl_access:marketing/mktg-order',
        'as' => 'mktg-order',
        'uses' => 'MarketingMaterialController@mktg_order'
    ]);

    //==== Invoice
    Route::get('marketing/mktg-invoice-list',[
        #'middleware' => 'acl_access:marketing/mktg-invoice-list',
        'as' => 'mktg-invoice-list',
        'uses' => 'MktgInvoiceController@index'
    ]);
    Route::get('marketing/make-invoice/{order_id}',[
        'middleware' => 'acl_access:marketing/make-invoice/{order_id}',
        'as' => 'make-invoice',
        'uses' => 'MktgInvoiceController@make_invoice'
    ]);
    Route::post('get-price',[
        'as' => 'get-price',
        'uses'=>'MktgOrderController@get_price'
    ]);

});
