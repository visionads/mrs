<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/8/16
 * Time: 10:57 AM
 */

/*Route::get('test', function () {
       return "Hello";
   });*/

//-------| For solution TYpe |----//
Route::any('solution-type', [
    'middleware' => 'acl_access:user/solution-type',
    'as' => 'solution-type',
    'uses' => 'SolutionTypeController@index'
]);
Route::any('solution-type-store', [
    'middleware' => 'acl_access:user/solution-type-store',
    'as' => 'solution-type-store',
    'uses' => 'SolutionTypeController@store'
]);
Route::get('solution-type-view/{id}', [
    'middleware' => 'acl_access:user/solution-type-view',
    'as' => 'solution-type-view',
    'uses' => 'SolutionTypeController@show'
]);
Route::get('solution-type-edit/{id}', [
    'middleware' => 'acl_access:user/solution-type-edit',
    'as' => 'solution-type-edit',
    'uses' => 'SolutionTypeController@edit'
]);
Route::any('solution-type-update/{id}', [
    'middleware' => 'acl_access:user/solution-type-update',
    'as' => 'solution-type-update',
    'uses' => 'SolutionTypeController@update'
]);
Route::any('solution-type-delete/{id}', [
    'middleware' => 'acl_access:user/solution-type-delete',
    'as' => 'solution-type-delete',
    'uses' => 'SolutionTypeController@destroy'
]);
Route::any('solution-type-search',[
    'middleware' => 'acl_access:user/solution-type-search',
    'as'    =>  'solution-type-search',
    'uses'  =>  'SolutionTypeController@search'
]);

// ------------| For Digital Media |----//
Route::any('digital-media',[
    'middleware' => 'acl_access:user/digital-media',
    'as'    =>  'digital-media',
    'uses'  =>  'DigitalMediaController@index'
]);
Route::any('digital-media-store',[
    'middleware' => 'acl_access:user/digital-media-store',
    'as'    =>  'digital-media-store',
    'uses'  =>  'DigitalMediaController@store'
]);
Route::any('digital-media-view/{id}',[
    'middleware' => 'acl_access:user/digital-media-view',
    'as'    =>  'digital-media-view',
    'uses'  =>  'DigitalMediaController@show'
]);
Route::any('digital-media-edit/{id}',[
    'middleware' => 'acl_access:user/digital-media-edit',
    'as'    =>  'digital-media-edit',
    'uses'  =>  'DigitalMediaController@edit'
]);
Route::any('digital-media-update/{id}',[
    'middleware' => 'acl_access:user/digital-media-update',
    'as'    =>  'digital-media-update',
    'uses'  =>  'DigitalMediaController@update'
]);
Route::any('digital-media-delete/{id}',[
    'middleware' => 'acl_access:user/digital-media-delete',
    'as'    =>  'digital-media-delete',
    'uses'  =>  'DigitalMediaController@destroy'
]);
Route::any('digital-media-search',[
    'middleware' => 'acl_access:user/digital-media-search',
    'as'    =>  'digital-media-search',
    'uses'  =>  'DigitalMediaController@search'
]);

// ------------| For Local Media |----//
Route::any('local-media',[
    'middleware' => 'acl_access:user/local-media',
    'as'    =>  'local-media',
    'uses'  =>  'LocalMediaController@index'
]);
Route::any('local-media-store',[
    'middleware' => 'acl_access:user/local-media-store',
    'as'    =>  'local-media-store',
    'uses'  =>  'LocalMediaController@store'
]);
Route::any('local-media-view/{id}',[
    'middleware' => 'acl_access:user/local-media-view',
    'as'    =>  'local-media-view',
    'uses'  =>  'LocalMediaController@show'
]);
Route::any('local-media-edit/{id}',[
    'middleware' => 'acl_access:user/local-media-edit',
    'as'    =>  'local-media-edit',
    'uses'  =>  'LocalMediaController@edit'
]);
Route::any('local-media-update/{id}',[
    'middleware' => 'acl_access:user/local-media-update',
    'as'    =>  'local-media-update',
    'uses'  =>  'LocalMediaController@update'
]);
Route::any('local-media-delete/{id}',[
    'middleware' => 'acl_access:user/local-media-delete',
    'as'    =>  'local-media-delete',
    'uses'  =>  'LocalMediaController@destroy'
]);
Route::any('local-media-search',[
    'middleware' => 'acl_access:user/local-media-search',
    'as'    =>  'local-media-search',
    'uses'  =>  'LocalMediaController@search'
]);

// ------------| For print material distribution |----//
Route::any('print-material-distribution',[
    'middleware' => 'acl_access:user/print-material-distribution',
    'as'    =>  'print-material-distribution',
    'uses'  =>  'PrintMaterialDistributionController@index'
]);
Route::any('print-material-distribution-store',[
    'middleware' => 'acl_access:user/print-material-distribution-store',
    'as'    =>  'print-material-distribution-store',
    'uses'  =>  'PrintMaterialDistributionController@store'
]);
Route::any('print-material-distribution-view/{id}',[
    'middleware' => 'acl_access:user/print-material-distribution-view',
    'as'    =>  'print-material-distribution-view',
    'uses'  =>  'PrintMaterialDistributionController@show'
]);
Route::any('print-material-distribution-edit/{id}',[
    'middleware' => 'acl_access:user/print-material-distribution-edit',
    'as'    =>  'print-material-distribution-edit',
    'uses'  =>  'PrintMaterialDistributionController@edit'
]);
Route::any('print-material-distribution-update/{id}',[
    'middleware' => 'acl_access:user/print-material-distribution-update',
    'as'    =>  'print-material-distribution-update',
    'uses'  =>  'PrintMaterialDistributionController@update'
]);
Route::any('print-material-distribution-delete/{id}',[
    'middleware' => 'acl_access:user/print-material-distribution-delete',
    'as'    =>  'print-material-distribution-delete',
    'uses'  =>  'PrintMaterialDistributionController@destroy'
]);
Route::any('print-material-distribution-search',[
    'middleware' => 'acl_access:user/print-material-distribution-search',
    'as'    =>  'print-material-distribution-search',
    'uses'  =>  'PrintMaterialDistributionController@search'
]);

// --------------------- Settings Route --------------------//
Route::any('settings-table',[
    'middleware' => 'acl_access:user/settings-table',
    'as'    =>  'settings-table',
    'uses'  =>  'SettingsController@settings_table'
]);
Route::any('settings-edit/{id}',[
    'middleware' => 'acl_access:user/settings-edit',
    'as'    =>  'settings-edit',
    'uses'  =>  'SettingsController@settings_edit'
]);
Route::any('settings-update/{id}',[
    'middleware' => 'acl_access:user/settings-update',
    'as'    =>  'settings-update',
    'uses'  =>  'SettingsController@settings_update'
]);

