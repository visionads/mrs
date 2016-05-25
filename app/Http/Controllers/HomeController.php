<?php

namespace App\Http\Controllers;

use App\User;
use App\UserImage;
use App\Quote;
use App\UserProfile;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $pageTitle = 'MRS - Dashboard';
        $user_profile = UserProfile::where('user_id', Auth::user()->id)->first();
        $user_image = UserImage::where('user_id',Auth::user()->id)->first();
        //$last_quote = Quote::all()->last()->pluck('quote_number');
        $last_quote = Quote::orderBy('id', 'desc')->first();
        //print_r($user_profile); exit();
        return view('admin::layouts.dashboard',[
            'pageTitle'=>$pageTitle,
            'user_image'=>$user_image,
            'last_quote'=>$last_quote ,
            'user_profile'=>$user_profile

        ]);
    }

    public function all_routes_uri(){

        $routeCollection = Route::getRoutes();

        foreach ($routeCollection as $value) {
            $routes_list[] = Str::lower($value->getPath());
        }
        print_r($routes_list);exit;
    }
}
