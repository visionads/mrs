<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 1/14/16
 * Time: 3:59 PM
 */

Route::group(array('prefix'=>'admin','modules'=>'Admin', 'namespace' => 'Modules\Admin\Controllers'), function() {
    //Your routes belong to this module.

    include 'routes_rk.php';

    /*Master Layouts*/
    /*Route::get('get-user-login', function () {
        return view('user::layouts.login');
    });*/

    /*-----Photography Package and Photography options-------*/

    Route::any('photography-package', [
        //'middleware' => 'acl_access:user/role',
        'middleware' => 'acl_access:user/photography-package',
        'as' => 'photography-package',
        'uses' => 'PhotographyPackageController@index'
    ]);

    Route::any('store-photography-package', [
        //'middleware' => 'acl_access:user/store-role',
        'middleware' => 'acl_access:user/store-photography-package',
        'as' => 'store-photography-package',
        'uses' => 'PhotographyPackageController@store'
    ]);

    Route::any('view-photography-package/{id}', [
        //'middleware' => 'acl_access:user/view-role/{slug}',
        'middleware' => 'acl_access:user/view-photography-package',
        'as' => 'view-photography-package',
        'uses' => 'PhotographyPackageController@show'
    ]);

    Route::any('edit-photography-package/{id}', [
        //'middleware' => 'acl_access:user/edit-role/{slug}',
        'middleware' => 'acl_access:user/edit-photography-package',
        'as' => 'edit-photography-package',
        'uses' => 'PhotographyPackageController@edit'
    ]);

    Route::any('update-photography-package/{id}', [
        //'middleware' => 'acl_access:user/update-role/{slug}',
        'middleware' => 'acl_access:user/update-photography-package',
        'as' => 'update-photography-package',
        'uses' => 'PhotographyPackageController@update'
    ]);

    Route::any('delete-photography-package/{id}', [
        //'middleware' => 'acl_access:user/delete-role/{slug}',
        'middleware' => 'acl_access:user/delete-photography-package',
        'as' => 'delete-photography-package',
        'uses' => 'PhotographyPackageController@destroy'
    ]);

    Route::get('photography-search', [
        //'middleware' => 'acl_access:role',
        'middleware' => 'acl_access:user/photography-search',
        'as' => 'photography-search',
        'uses' => 'PhotographyPackageController@photography_search'
    ]);



    /*-----Print Material and Print Material Size-------*/

    Route::any('print-material', [
        //'middleware' => 'acl_access:user/role',
        'middleware' => 'acl_access:user/print-material',
        'as' => 'print-material',
        'uses' => 'PrintMaterialController@index'
    ]);

    Route::any('store-print-material', [
        //'middleware' => 'acl_access:user/store-role',
        'middleware' => 'acl_access:user/store-print-material',
        'as' => 'store-print-material',
        'uses' => 'PrintMaterialController@store'
    ]);

    Route::any('view-print-material/{id}', [
        //'middleware' => 'acl_access:user/view-role/{slug}',
        'middleware' => 'acl_access:user/view-print-material',
        'as' => 'view-print-material',
        'uses' => 'PrintMaterialController@show'
    ]);

    Route::any('print-image-show/{id}', [
        //'middleware' => 'acl_access:user/view-role/{slug}',
        'middleware' => 'acl_access:user/print-image-show',
        'as' => 'print-image-show',
        'uses' => 'PrintMaterialController@image_show'
    ]);

    Route::any('edit-print-material/{id}', [
        //'middleware' => 'acl_access:user/edit-role/{slug}',
        'middleware' => 'acl_access:user/edit-print-material',
        'as' => 'edit-print-material',
        'uses' => 'PrintMaterialController@edit'
    ]);

    Route::any('update-print-material/{id}', [
        //'middleware' => 'acl_access:user/update-role/{slug}',
        'middleware' => 'acl_access:user/update-print-material',
        'as' => 'update-print-material',
        'uses' => 'PrintMaterialController@update'
    ]);

    Route::any('delete-print-material/{id}', [
        //'middleware' => 'acl_access:user/delete-role/{slug}',
        'middleware' => 'acl_access:user/delete-print-material',
        'as' => 'delete-print-material',
        'uses' => 'PrintMaterialController@destroy'
    ]);

    Route::get('print-material-search', [
        //'middleware' => 'acl_access:role',
        'middleware' => 'acl_access:user/print-material-search',
        'as' => 'print-material-search',
        'uses' => 'PrintMaterialController@print_material_search'
    ]);


    /*-----Signboard Package and SignboardPackage Size-------*/

    Route::any('signboard-package', [
        //'middleware' => 'acl_access:user/role',
        'middleware' => 'acl_access:user/signboard-package',
        'as' => 'signboard-package',
        'uses' => 'SignboardPackageController@index'
    ]);

    Route::any('store-signboard-package', [
        //'middleware' => 'acl_access:user/store-role',
        'middleware' => 'acl_access:user/store-signboard-package',
        'as' => 'store-signboard-package',
        'uses' => 'SignboardPackageController@store'
    ]);

    Route::any('view-signboard-package/{id}', [
        //'middleware' => 'acl_access:user/view-role/{slug}',
        'middleware' => 'acl_access:user/view-signboard-package',
        'as' => 'view-signboard-package',
        'uses' => 'SignboardPackageController@show'
    ]);

    Route::any('signboard-image-show/{id}', [
        //'middleware' => 'acl_access:user/view-role/{slug}',
        'middleware' => 'acl_access:user/signboard-image-show',
        'as' => 'signboard-image-show',
        'uses' => 'SignboardPackageController@image_show'
    ]);

    Route::any('edit-signboard-package/{id}', [
        //'middleware' => 'acl_access:user/edit-role/{slug}',
        'middleware' => 'acl_access:user/edit-signboard-package',
        'as' => 'edit-signboard-package',
        'uses' => 'SignboardPackageController@edit'
    ]);

    Route::any('update-signboard-package/{id}', [
        //'middleware' => 'acl_access:user/update-role/{slug}',
        'middleware' => 'acl_access:user/update-signboard-package',
        'as' => 'update-signboard-package',
        'uses' => 'SignboardPackageController@update'
    ]);

    Route::any('delete-signboard-package/{id}', [
        //'middleware' => 'acl_access:user/delete-role/{slug}',
        'middleware' => 'acl_access:user/delete-signboard-package',
        'as' => 'delete-signboard-package',
        'uses' => 'SignboardPackageController@destroy'
    ]);

    Route::get('signboard-package-search', [
        //'middleware' => 'acl_access:role',
        'middleware' => 'acl_access:user/signboard-package-search',
        'as' => 'signboard-package-search',
        'uses' => 'SignboardPackageController@signboard_package_search'
    ]);


    /*---------Settings-------------------*/

    Route::get('settings', [
        //'middleware' => 'acl_access:role',
        'middleware' => 'acl_access:user/settings',
        'as' => 'settings',
        'uses' => 'SettingsController@dashboard_index'
    ]);


});




