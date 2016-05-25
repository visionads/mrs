<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 1/14/16
 * Time: 3:59 PM
 */

Route::group(array('prefix'=>'admin','modules'=>'Admin', 'namespace' => 'Modules\Admin\Controllers'), function() {
    //Your routes belong to this module.

    /*Master Layouts*/
    /*Route::get('get-user-login', function () {
        return view('user::layouts.login');
    });*/

    /*-----Photography Package and Photography options-------*/

    Route::any('photography-package', [
        //'middleware' => 'acl_access:user/role',
        'middleware' => 'acl_access:admin/photography-package',
        'as' => 'photography-package',
        'uses' => 'PhotographyPackageController@index'
    ]);

    Route::any('store-photography-package', [
        //'middleware' => 'acl_access:user/store-role',
        'middleware' => 'acl_access:admin/store-photography-package',
        'as' => 'store-photography-package',
        'uses' => 'PhotographyPackageController@store'
    ]);

    Route::any('view-photography-package/{id}', [
        //'middleware' => 'acl_access:user/view-role/{slug}',
        'middleware' => 'acl_access:admin/view-photography-package',
        'as' => 'view-photography-package',
        'uses' => 'PhotographyPackageController@show'
    ]);

    Route::any('edit-photography-package/{id}', [
        //'middleware' => 'acl_access:user/edit-role/{slug}',
        'middleware' => 'acl_access:admin/edit-photography-package',
        'as' => 'edit-photography-package',
        'uses' => 'PhotographyPackageController@edit'
    ]);

    Route::any('update-photography-package/{id}', [
        //'middleware' => 'acl_access:user/update-role/{slug}',
        'middleware' => 'acl_access:admin/update-photography-package',
        'as' => 'update-photography-package',
        'uses' => 'PhotographyPackageController@update'
    ]);

    Route::any('delete-photography-package/{id}', [
        //'middleware' => 'acl_access:user/delete-role/{slug}',
        'middleware' => 'acl_access:admin/delete-photography-package',
        'as' => 'delete-photography-package',
        'uses' => 'PhotographyPackageController@destroy'
    ]);

    Route::get('photography-search', [
        //'middleware' => 'acl_access:role',
        'middleware' => 'acl_access:admin/photography-search',
        'as' => 'photography-search',
        'uses' => 'PhotographyPackageController@photography_search'
    ]);



    /*-----Print Material and Print Material Size-------*/

    Route::any('print-material', [
        //'middleware' => 'acl_access:user/role',
        'middleware' => 'acl_access:admin/print-material',
        'as' => 'print-material',
        'uses' => 'PrintMaterialController@index'
    ]);

    Route::any('store-print-material', [
        //'middleware' => 'acl_access:user/store-role',
        'middleware' => 'acl_access:admin/store-print-material',
        'as' => 'store-print-material',
        'uses' => 'PrintMaterialController@store'
    ]);

    Route::any('view-print-material/{id}', [
        //'middleware' => 'acl_access:user/view-role/{slug}',
        'middleware' => 'acl_access:admin/view-print-material',
        'as' => 'view-print-material',
        'uses' => 'PrintMaterialController@show'
    ]);

    Route::any('print-image-show/{id}', [
        //'middleware' => 'acl_access:user/view-role/{slug}',
        'middleware' => 'acl_access:admin/print-image-show',
        'as' => 'print-image-show',
        'uses' => 'PrintMaterialController@image_show'
    ]);

    Route::any('edit-print-material/{id}', [
        //'middleware' => 'acl_access:user/edit-role/{slug}',
        'middleware' => 'acl_access:admin/edit-print-material',
        'as' => 'edit-print-material',
        'uses' => 'PrintMaterialController@edit'
    ]);

    Route::any('update-print-material/{id}', [
        //'middleware' => 'acl_access:user/update-role/{slug}',
        'middleware' => 'acl_access:admin/update-print-material',
        'as' => 'update-print-material',
        'uses' => 'PrintMaterialController@update'
    ]);

    Route::any('delete-print-material/{id}', [
        //'middleware' => 'acl_access:user/delete-role/{slug}',
        'middleware' => 'acl_access:admin/delete-print-material',
        'as' => 'delete-print-material',
        'uses' => 'PrintMaterialController@destroy'
    ]);

    Route::get('print-material-search', [
        //'middleware' => 'acl_access:role',
        'middleware' => 'acl_access:admin/print-material-search',
        'as' => 'print-material-search',
        'uses' => 'PrintMaterialController@print_material_search'
    ]);


    /*-----Signboard Package and SignboardPackage Size-------*/

    Route::any('signboard-package', [
        //'middleware' => 'acl_access:user/role',
        'middleware' => 'acl_access:admin/signboard-package',
        'as' => 'signboard-package',
        'uses' => 'SignboardPackageController@index'
    ]);

    Route::any('store-signboard-package', [
        //'middleware' => 'acl_access:user/store-role',
        'middleware' => 'acl_access:admin/store-signboard-package',
        'as' => 'store-signboard-package',
        'uses' => 'SignboardPackageController@store'
    ]);

    Route::any('view-signboard-package/{id}', [
        //'middleware' => 'acl_access:user/view-role/{slug}',
        'middleware' => 'acl_access:admin/view-signboard-package',
        'as' => 'view-signboard-package',
        'uses' => 'SignboardPackageController@show'
    ]);

    Route::any('signboard-image-show/{id}', [
        //'middleware' => 'acl_access:user/view-role/{slug}',
        'middleware' => 'acl_access:admin/signboard-image-show',
        'as' => 'signboard-image-show',
        'uses' => 'SignboardPackageController@image_show'
    ]);

    Route::any('edit-signboard-package/{id}', [
        //'middleware' => 'acl_access:user/edit-role/{slug}',
        'middleware' => 'acl_access:admin/edit-signboard-package',
        'as' => 'edit-signboard-package',
        'uses' => 'SignboardPackageController@edit'
    ]);

    Route::any('update-signboard-package/{id}', [
        //'middleware' => 'acl_access:user/update-role/{slug}',
        'middleware' => 'acl_access:admin/update-signboard-package',
        'as' => 'update-signboard-package',
        'uses' => 'SignboardPackageController@update'
    ]);

    Route::any('delete-signboard-package/{id}', [
        //'middleware' => 'acl_access:user/delete-role/{slug}',
        'middleware' => 'acl_access:admin/delete-signboard-package',
        'as' => 'delete-signboard-package',
        'uses' => 'SignboardPackageController@destroy'
    ]);

    Route::get('signboard-package-search', [
        //'middleware' => 'acl_access:role',
        'middleware' => 'acl_access:admin/signboard-package-search',
        'as' => 'signboard-package-search',
        'uses' => 'SignboardPackageController@signboard_package_search'
    ]);


    /*---------Settings-------------------*/

    Route::get('settings', [
        //'middleware' => 'acl_access:role',
        'middleware' => 'acl_access:admin/settings',
        'as' => 'settings',
        'uses' => 'SettingsController@dashboard_index'
    ]);



    //-------| For solution TYpe |----//
    Route::any('solution-type', [
        'middleware' => 'acl_access:admin/solution-type',
        'as' => 'solution-type',
        'uses' => 'SolutionTypeController@index'
    ]);
    Route::any('solution-type-store', [
        'middleware' => 'acl_access:admin/solution-type-store',
        'as' => 'solution-type-store',
        'uses' => 'SolutionTypeController@store'
    ]);
    Route::get('solution-type-view/{id}', [
        'middleware' => 'acl_access:admin/solution-type-view',
        'as' => 'solution-type-view',
        'uses' => 'SolutionTypeController@show'
    ]);
    Route::get('solution-type-edit/{id}', [
        'middleware' => 'acl_access:admin/solution-type-edit',
        'as' => 'solution-type-edit',
        'uses' => 'SolutionTypeController@edit'
    ]);
    Route::any('solution-type-update/{id}', [
        'middleware' => 'acl_access:admin/solution-type-update',
        'as' => 'solution-type-update',
        'uses' => 'SolutionTypeController@update'
    ]);
    Route::any('solution-type-delete/{id}', [
        'middleware' => 'acl_access:admin/solution-type-delete',
        'as' => 'solution-type-delete',
        'uses' => 'SolutionTypeController@destroy'
    ]);
    Route::any('solution-type-search',[
        'middleware' => 'acl_access:admin/solution-type-search',
        'as'    =>  'solution-type-search',
        'uses'  =>  'SolutionTypeController@search'
    ]);

    // ------------| For Digital Media |----//
    Route::any('digital-media',[
        'middleware' => 'acl_access:admin/digital-media',
        'as'    =>  'digital-media',
        'uses'  =>  'DigitalMediaController@index'
    ]);
    Route::any('digital-media-store',[
        'middleware' => 'acl_access:admin/digital-media-store',
        'as'    =>  'digital-media-store',
        'uses'  =>  'DigitalMediaController@store'
    ]);
    Route::any('digital-media-view/{id}',[
        'middleware' => 'acl_access:admin/digital-media-view',
        'as'    =>  'digital-media-view',
        'uses'  =>  'DigitalMediaController@show'
    ]);
    Route::any('digital-media-edit/{id}',[
        'middleware' => 'acl_access:admin/digital-media-edit',
        'as'    =>  'digital-media-edit',
        'uses'  =>  'DigitalMediaController@edit'
    ]);
    Route::any('digital-media-update/{id}',[
        'middleware' => 'acl_access:admin/digital-media-update',
        'as'    =>  'digital-media-update',
        'uses'  =>  'DigitalMediaController@update'
    ]);
    Route::any('digital-media-delete/{id}',[
        'middleware' => 'acl_access:admin/digital-media-delete',
        'as'    =>  'digital-media-delete',
        'uses'  =>  'DigitalMediaController@destroy'
    ]);
    Route::any('digital-media-search',[
        'middleware' => 'acl_access:admin/digital-media-search',
        'as'    =>  'digital-media-search',
        'uses'  =>  'DigitalMediaController@search'
    ]);

    // ------------| For Local Media |----//
    Route::any('local-media',[
        'middleware' => 'acl_access:admin/local-media',
        'as'    =>  'local-media',
        'uses'  =>  'LocalMediaController@index'
    ]);
    Route::any('local-media-store',[
        'middleware' => 'acl_access:admin/local-media-store',
        'as'    =>  'local-media-store',
        'uses'  =>  'LocalMediaController@store'
    ]);
    Route::any('local-media-view/{id}',[
        'middleware' => 'acl_access:admin/local-media-view',
        'as'    =>  'local-media-view',
        'uses'  =>  'LocalMediaController@show'
    ]);
    Route::any('local-media-edit/{id}',[
        'middleware' => 'acl_access:admin/local-media-edit',
        'as'    =>  'local-media-edit',
        'uses'  =>  'LocalMediaController@edit'
    ]);
    Route::any('local-media-update/{id}',[
        'middleware' => 'acl_access:admin/local-media-update',
        'as'    =>  'local-media-update',
        'uses'  =>  'LocalMediaController@update'
    ]);
    Route::any('local-media-delete/{id}',[
        'middleware' => 'acl_access:admin/local-media-delete',
        'as'    =>  'local-media-delete',
        'uses'  =>  'LocalMediaController@destroy'
    ]);
    Route::any('local-media-search',[
        'middleware' => 'acl_access:admin/local-media-search',
        'as'    =>  'local-media-search',
        'uses'  =>  'LocalMediaController@search'
    ]);

    // ------------| For print material distribution |----//
    Route::any('print-material-distribution',[
        'middleware' => 'acl_access:admin/print-material-distribution',
        'as'    =>  'print-material-distribution',
        'uses'  =>  'PrintMaterialDistributionController@index'
    ]);
    Route::any('print-material-distribution-store',[
        'middleware' => 'acl_access:admin/print-material-distribution-store',
        'as'    =>  'print-material-distribution-store',
        'uses'  =>  'PrintMaterialDistributionController@store'
    ]);
    Route::any('print-material-distribution-view/{id}',[
        'middleware' => 'acl_access:admin/print-material-distribution-view',
        'as'    =>  'print-material-distribution-view',
        'uses'  =>  'PrintMaterialDistributionController@show'
    ]);
    Route::any('print-material-distribution-edit/{id}',[
        'middleware' => 'acl_access:admin/print-material-distribution-edit',
        'as'    =>  'print-material-distribution-edit',
        'uses'  =>  'PrintMaterialDistributionController@edit'
    ]);
    Route::any('print-material-distribution-update/{id}',[
        'middleware' => 'acl_access:admin/print-material-distribution-update',
        'as'    =>  'print-material-distribution-update',
        'uses'  =>  'PrintMaterialDistributionController@update'
    ]);
    Route::any('print-material-distribution-delete/{id}',[
        'middleware' => 'acl_access:admin/print-material-distribution-delete',
        'as'    =>  'print-material-distribution-delete',
        'uses'  =>  'PrintMaterialDistributionController@destroy'
    ]);
    Route::any('print-material-distribution-search',[
        'middleware' => 'acl_access:admin/print-material-distribution-search',
        'as'    =>  'print-material-distribution-search',
        'uses'  =>  'PrintMaterialDistributionController@search'
    ]);

    // --------------------- Settings Route --------------------//
    Route::any('settings-table',[
        'middleware' => 'acl_access:admin/settings-table',
        'as'    =>  'settings-table',
        'uses'  =>  'SettingsController@settings_table'
    ]);
    Route::any('settings-edit/{id}',[
        'middleware' => 'acl_access:admin/settings-edit',
        'as'    =>  'settings-edit',
        'uses'  =>  'SettingsController@settings_edit'
    ]);
    Route::any('settings-update/{id}',[
        'middleware' => 'acl_access:admin/settings-update',
        'as'    =>  'settings-update',
        'uses'  =>  'SettingsController@settings_update'
    ]);


});




