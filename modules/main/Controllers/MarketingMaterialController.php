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

    //===== For Agency Stationary Material ***//
    public function letterhead()
    {
        $data['pageTitle'] = 'Letterhead / Followers';
        return view('main::marketing_material.agency_stationary_materials.letterhead',$data);
    }
    public function presentation()
    {
        $data['pageTitle'] = 'Presentation folders';
        return view('main::marketing_material.agency_stationary_materials.presentation',$data);
    }
    public function withcomp()
    {
        $data['pageTitle'] = 'Withcomp Slips';
        return view('main::marketing_material.agency_stationary_materials.withcomp',$data);
    }
    public function envelopes()
    {
        $data['pageTitle'] = 'Envelopes';
        return view('main::marketing_material.agency_stationary_materials.envelopes',$data);
    }
    public function forms()
    {
        $data['pageTitle'] = 'Forms';
        return view('main::marketing_material.agency_stationary_materials.forms',$data);
    }
    public function carbon()
    {
        $data['pageTitle'] = 'Carbon Books (NCR)';
        return view('main::marketing_material.agency_stationary_materials.carbon',$data);
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