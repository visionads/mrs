<?php
namespace Modules\Main\Controllers;

/**
 * Created by PhpStorm.
 * User: sr
 * Date: 5/8/16
 * Time: 1:55 PM
 */

use App\UserImage;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;



class MarketingMaterialController extends Controller
{
    public function index()
    {
       //$data['pageTitle'] = 'Marketing Material Printing';
       $data['pageTitle'] = 'Agency Marketing Material';
       return view('main::marketing_material.index',$data);
    }

    public function proceed()
    {
        $data['pageTitle'] = 'Proceed';
        return view('main::marketing_material.proceed',$data);
    }

    /*public function order()
    {
        $pageTitle = 'MRS - Order';
        $user_image = UserImage::where('user_id',Auth::user()->id)->first();

        return view('main::main_pages.order',['pageTitle'=>$pageTitle,'user_image'=>$user_image]);
    }*/

}