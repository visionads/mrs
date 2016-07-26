<?php
/**
 * Created by PhpStorm.
 * User: selim
 * Date: 12/8/2015
 * Time: 5:54 PM
 */



Route::group(array('prefix' => 'marketing','modules'=>'Mktg', 'namespace' => 'Modules\Main\Controllers'), function() {

/*--------------------Marketing Material (Printing)-----*/

    Route::get('marketing-material-printing',[
        //'middleware' => 'acl_access:main/marketing-material-printing',
        'as' => 'marketing-material-printing',
        'uses' => 'MarketingMaterialController@index'
    ]);
    Route::get('marketing-material-proceed',[
        //'middleware' => 'acl_access:main/marketing-material-printing',
        'as' => 'marketing-material-proceed',
        'uses' => 'MarketingMaterialController@proceed'
    ]);

    //===== For Agency Stationary Materials ***//
    Route::get('letterhead',[
        //'middleware' => 'acl_access:main/letterhead',
        'as' => 'letterhead',
        'uses' => 'MarketingMaterialController@letterhead'
    ]);
    Route::get('presentation',[
        //'middleware' => 'acl_access:main/presentation',
        'as' => 'presentation',
        'uses' => 'MarketingMaterialController@presentation'
    ]);
    Route::get('withcomp',[
        //'middleware' => 'acl_access:main/withcomp',
        'as' => 'withcomp',
        'uses' => 'MarketingMaterialController@withcomp'
    ]);
    Route::get('envelopes',[
        //'middleware' => 'acl_access:main/envelopes',
        'as' => 'envelopes',
        'uses' => 'MarketingMaterialController@envelopes'
    ]);
    Route::get('forms',[
        //'middleware' => 'acl_access:main/forms',
        'as' => 'forms',
        'uses' => 'MarketingMaterialController@forms'
    ]);
    Route::get('carbon',[
        //'middleware' => 'acl_access:main/carbon',
        'as' => 'carbon',
        'uses' => 'MarketingMaterialController@carbon'
    ]);

    //===== For Agency /Agent Marketing ***//
    Route::get('teardrop',[
        //'middleware' => 'acl_access:main/teardrop',
        'as' => 'teardrop',
        'uses' => 'MarketingMaterialController@teardrop'
    ]);
    Route::get('directional',[
        //'middleware' => 'acl_access:main/directional',
        'as' => 'directional',
        'uses' => 'MarketingMaterialController@directional'
    ]);
    Route::get('vynle',[
        //'middleware' => 'acl_access:main/vynle',
        'as' => 'vynle',
        'uses' => 'MarketingMaterialController@vynle'
    ]);
    Route::get('pullup',[
        //'middleware' => 'acl_access:main/pullup',
        'as' => 'pullup',
        'uses' => 'MarketingMaterialController@pullup'
    ]);
    Route::get('business',[
        //'middleware' => 'acl_access:main/business',
        'as' => 'business',
        'uses' => 'MarketingMaterialController@business'
    ]);
    Route::get('brochure',[
        //'middleware' => 'acl_access:main/brochure',
        'as' => 'brochure',
        'uses' => 'MarketingMaterialController@brochure'
    ]);
    Route::get('fridge',[
        //'middleware' => 'acl_access:main/fridge',
        'as' => 'fridge',
        'uses' => 'MarketingMaterialController@fridge'
    ]);
    Route::get('magazine',[
        //'middleware' => 'acl_access:main/magazine',
        'as' => 'magazine',
        'uses' => 'MarketingMaterialController@magazine'
    ]);
    Route::get('calender',[
        //'middleware' => 'acl_access:main/calender',
        'as' => 'calender',
        'uses' => 'MarketingMaterialController@calender'
    ]);
    Route::get('letterdrop',[
        //'middleware' => 'acl_access:main/letterdrop',
        'as' => 'letterdrop',
        'uses' => 'MarketingMaterialController@letterdrop'
    ]);

    //===== For Agency /Agent Marketing ***//
    Route::get('property-cards',[
        //'middleware' => 'acl_access:main/property-cards',
        'as' => 'property-cards',
        'uses' => 'MarketingMaterialController@property_cards'
    ]);
    Route::get('pvc-sign',[
        //'middleware' => 'acl_access:main/pvc-sign',
        'as' => 'pvc-sign',
        'uses' => 'MarketingMaterialController@pvc_sign'
    ]);
    Route::get('sold',[
        //'middleware' => 'acl_access:main/sold',
        'as' => 'sold',
        'uses' => 'MarketingMaterialController@sold'
    ]);
    Route::get('congratulation',[
        //'middleware' => 'acl_access:main/congratulation',
        'as' => 'congratulation',
        'uses' => 'MarketingMaterialController@congratulation'
    ]);

    //===== Form Menu Items ***//
    Route::get('mktg-menu-item',[
        //'middleware' => 'acl_access:main/congratulation',
        'as' => 'mktg-menu-item',
        'uses' => 'MarketingMaterialController@mktg_menu_item_index'
    ]);
    Route::post('store-menu-item',[
        //'middleware' => 'acl_access:main/congratulation',
        'as' => 'store-menu-item',
        'uses' => 'MarketingMaterialController@mktg_menu_item_store'
    ]);
    Route::get('mktg-menu-item-view/{id}',[
        //'middleware' => 'acl_access:main/congratulation',
        'as' => 'mktg-menu-item-view',
        'uses' => 'MarketingMaterialController@mktg_menu_item_view'
    ]);
    Route::get('mktg-menu-item-details/{id}',[
        //'middleware' => 'acl_access:main/congratulation',
        'as' => 'mktg-menu-item-details',
        'uses' => 'MarketingMaterialController@mktg_menu_item_details'
    ]);
    Route::get('mktg-menu-item-edit/{id}',[
        //'middleware' => 'acl_access:main/congratulation',
        'as' => 'mktg-menu-item-edit',
        'uses' => 'MarketingMaterialController@mktg_menu_item_edit'
    ]);
    Route::get('mktg-menu-item-update/{id}',[
        //'middleware' => 'acl_access:main/congratulation',
        'as' => 'mktg-menu-item-update',
        'uses' => 'MarketingMaterialController@mktg_menu_item_update'
    ]);
    Route::get('mktg-menu-item-delete/{id}',[
        //'middleware' => 'acl_access:main/congratulation',
        'as' => 'mktg-menu-item-delete',
        'uses' => 'MarketingMaterialController@mktg_menu_item_delete'
    ]);

    //=== Item value
    Route::get('mktg-item-option-add-value/{id}',[
        //'middleware' => 'acl_access:main/congratulation',
        'as' => 'mktg-item-option-add-value',
        'uses' => 'MarketingMaterialController@mktg_item_option_add_value'
    ]);
    Route::patch('mktg-item-option-add-value-store/{id}',[
        //'middleware' => 'acl_access:main/congratulation',
        'as' => 'mktg-item-option-add-value-store',
        'uses' => 'MarketingMaterialController@mktg_item_option_add_value_store'
    ]);
    Route::patch('mktg-item-option-add-value-update/{id}',[
        //'middleware' => 'acl_access:main/congratulation',
        'as' => 'mktg-item-option-add-value-update',
        'uses' => 'MarketingMaterialController@mktg_item_option_add_value_update'
    ]);

});
