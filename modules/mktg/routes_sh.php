<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 3/15/16
 * Time: 1:07 PM
 */



Route::any('agency-stationary-material/{slug}',[
    //'middleware' => 'acl_access:main/agency-stationary-material/{slug}',
    'as'    =>  'agency-stationary-material',
    'uses'  =>  'AgencyMarketingController@agency_stationary_material'
]);


