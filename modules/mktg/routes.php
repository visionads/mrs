<?php
/**
 * Created by PhpStorm.
 * User: selim
 * Date: 12/8/2015
 * Time: 5:54 PM
 */



Route::group(array('prefix' => 'mktg','modules'=>'Mktg', 'namespace' => 'Modules\Main\Controllers'), function() {

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

});
