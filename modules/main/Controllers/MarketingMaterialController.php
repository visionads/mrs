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

    //===== For Agency / Agent Marketing ***//
    public function teardrop()
    {
        $data['pageTitle'] = 'Tear Drop flag';
        return view('main::marketing_material.agent_marketing.teardrop',$data);
    }
    public function directional()
    {
        $data['pageTitle'] = 'Directional Signs';
        return view('main::marketing_material.agent_marketing.directional',$data);
    }
    public function vynle()
    {
        $data['pageTitle'] = 'Vynle Banner (Outdoor)';
        return view('main::marketing_material.agent_marketing.vynle',$data);
    }
    public function pullup()
    {
        $data['pageTitle'] = 'Pull up Banner (Indoor)';
        return view('main::marketing_material.agent_marketing.pullup',$data);
    }
    public function business()
    {
        $data['pageTitle'] = 'Business Card';
        return view('main::marketing_material.agent_marketing.business',$data);
    }
    public function brochure()
    {
        $data['pageTitle'] = 'Flyer / Brochure';
        return view('main::marketing_material.agent_marketing.brochure',$data);
    }
    public function fridge()
    {
        $data['pageTitle'] = 'Fridge Magnet';
        return view('main::marketing_material.agent_marketing.fridge',$data);
    }
    public function magazine()
    {
        $data['pageTitle'] = 'Magazine / Newsletter';
        return view('main::marketing_material.agent_marketing.magazine',$data);
    }
    public function calender()
    {
        $data['pageTitle'] = 'Tent Calender';
        return view('main::marketing_material.agent_marketing.calender',$data);
    }
    public function letterdrop()
    {
        $data['pageTitle'] = 'Letterdrop';
        return view('main::marketing_material.agent_marketing.letterdrop',$data);
    }


    public function image_upload($image,$file_type_required,$destinationPath)
    {
        if ($image != '') {

            $img_name = ($_FILES['image']['name']);
            $random_number = rand(111, 999);

            $thumb_name = 'thumb_400x400_'.$random_number.'_'.$img_name;

            $newWidth=400;
            $targetFile=$destinationPath.$thumb_name;
            $originalFile=$image;

            $resizedImages 	= ImageResize::resize($newWidth, $targetFile,$originalFile);

            $thumb_image_destination=$destinationPath;
            $thumb_image_name=$thumb_name;

            //$rules = array('image' => 'required|mimes:png,jpeg,jpg');
            $rules = array('image' => 'required|mimes:'.$file_type_required);
            $validator = Validator::make(array('image' => $image), $rules);
            if ($validator->passes()) {
                // Files destination
                //$destinationPath = 'uploads/slider_image/';
                // Create folders if they don't exist
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $image_original_name = $image->getClientOriginalName();
                $image_name = rand(111, 999) . $image_original_name;
                $upload_success = $image->move($destinationPath, $image_name);

                $file=array($destinationPath . $image_name, $thumb_image_destination.$thumb_image_name);

                if ($upload_success) {
                    return $file_name = $file;
                }
                else{
                    return $file_name = '';
                }
            }
            else{
                return $file_name = '';
            }
        }
    }






    //===== Old Code ***//
    public function proceed()
    {
        $data['pageTitle'] = 'Proceed';
        return view('main::marketing_material.trash.proceed',$data);
    }

    /*public function order()
    {
        $pageTitle = 'MRS - Order';
        $user_image = UserImage::where('user_id',Auth::user()->id)->first();

        return view('main::main_pages.order',['pageTitle'=>$pageTitle,'user_image'=>$user_image]);
    }*/

}