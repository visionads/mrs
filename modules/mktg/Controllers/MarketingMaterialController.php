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
use Modules\Admin\Helpers\ImageResize;
use App\MktgMaterial;
use App\MktgArtwork;
use App\MktgMenuItem;
use App\MktgItemOption;
use App\MktgMenuItemImage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Validator;



class MarketingMaterialController extends Controller
{
    public function index()
    {
        //$data['pageTitle'] = 'Marketing Material Printing';
        $data['pageTitle'] = 'Agency Marketing Material';
        $data['data'] = MktgMaterial::orderBy('id','ASC')->get();
        //print_r($data['data']); exit();
        return view('mktg::marketing_material.index',$data);
    }

    //===== For Agency Stationary Material ***//
    public function letterhead()
    {
        $data['pageTitle'] = 'Letterhead / Followers';
        $data['artwork'] = MktgArtwork::orderBy('slug','ASC')->get();
        return view('mktg::marketing_material.agency_stationary_materials.letterhead',$data);
    }
    public function presentation()
    {
        $data['pageTitle'] = 'Presentation folders';
        $data['artwork'] = MktgArtwork::orderBy('slug','ASC')->get();
        return view('mktg::marketing_material.agency_stationary_materials.presentation',$data);
    }
    public function withcomp()
    {
        $data['pageTitle'] = 'Withcomp Slips';
        $data['artwork'] = MktgArtwork::orderBy('slug','ASC')->get();
        return view('mktg::marketing_material.agency_stationary_materials.withcomp',$data);
    }
    public function envelopes()
    {
        $data['pageTitle'] = 'Envelopes';
        $data['artwork'] = MktgArtwork::orderBy('slug','ASC')->get();
        return view('mktg::marketing_material.agency_stationary_materials.envelopes',$data);
    }
    public function forms()
    {
        $data['pageTitle'] = 'Forms';
        $data['artwork'] = MktgArtwork::orderBy('slug','ASC')->get();
        return view('mktg::marketing_material.agency_stationary_materials.forms',$data);
    }
    public function carbon()
    {
        $data['pageTitle'] = 'Carbon Books (NCR)';
        $data['artwork'] = MktgArtwork::orderBy('slug','ASC')->get();
        return view('mktg::marketing_material.agency_stationary_materials.carbon',$data);
    }

    //===== For Agency / Agent Marketing ***//
    public function teardrop()
    {
        $data['pageTitle'] = 'Tear Drop flag';
        $data['artwork'] = MktgArtwork::orderBy('slug','ASC')->get();
        return view('mktg::marketing_material.agent_marketing.teardrop',$data);
    }
    public function directional()
    {
        $data['pageTitle'] = 'Directional Signs';
        $data['artwork'] = MktgArtwork::orderBy('slug','ASC')->get();
        return view('mktg::marketing_material.agent_marketing.directional',$data);
    }
    public function vynle()
    {
        $data['pageTitle'] = 'Outdoor Vynle Banner';
        $data['artwork'] = MktgArtwork::orderBy('slug','ASC')->get();
        return view('mktg::marketing_material.agent_marketing.vynle',$data);
    }
    public function pullup()
    {
        $data['pageTitle'] = 'Pull up Banner (Indoor)';
        $data['artwork'] = MktgArtwork::orderBy('slug','ASC')->get();
        return view('mktg::marketing_material.agent_marketing.pullup',$data);
    }
    public function business()
    {
        $data['pageTitle'] = 'Business Card';
        $data['artwork'] = MktgArtwork::orderBy('slug','ASC')->get();
        return view('mktg::marketing_material.agent_marketing.business',$data);
    }
    public function brochure()
    {
        $data['pageTitle'] = 'Flyer / Brochure';
        $data['artwork'] = MktgArtwork::orderBy('slug','ASC')->get();
        return view('mktg::marketing_material.agent_marketing.brochure',$data);
    }
    public function fridge()
    {
        $data['pageTitle'] = 'Fridge Magnet';
        $data['artwork'] = MktgArtwork::orderBy('slug','ASC')->get();
        return view('mktg::marketing_material.agent_marketing.fridge',$data);
    }
    public function magazine()
    {
        $data['pageTitle'] = 'Magazine / Newsletter';
        $data['artwork'] = MktgArtwork::orderBy('slug','ASC')->get();
        return view('mktg::marketing_material.agent_marketing.magazine',$data);
    }
    public function calender()
    {
        $data['pageTitle'] = 'Tent Calender';
        $data['artwork'] = MktgArtwork::orderBy('slug','ASC')->get();
        return view('mktg::marketing_material.agent_marketing.calender',$data);
    }
    public function letterdrop()
    {
        $data['pageTitle'] = 'Letterdrop';
        $data['artwork'] = MktgArtwork::orderBy('slug','ASC')->get();
        return view('mktg::marketing_material.agent_marketing.letterdrop',$data);
    }


    //===== Property Marketing ***//
    public function property_cards()
    {
        $data['pageTitle'] = 'Property Cards';
        $data['artwork'] = MktgArtwork::orderBy('slug','ASC')->get();
        return view('mktg::marketing_material.property_marketing.property_cards',$data);
    }
    public function pvc_sign()
    {
        $data['pageTitle'] = 'Corflute / PVC Sign';
        $data['artwork'] = MktgArtwork::orderBy('slug','ASC')->get();
        return view('mktg::marketing_material.property_marketing.pvc_sign',$data);
    }
    public function sold()
    {
        //$data['pageTitle'] = 'Sold / Leased Stickers (Custom & Genric)';
        $data['pageTitle'] = 'Vynle stickers outdoor (SOLD)';
        $data['artwork'] = MktgArtwork::orderBy('slug','ASC')->get();
        return view('mktg::marketing_material.property_marketing.sold',$data);
    }
    public function congratulation()
    {
        //$data['pageTitle'] = 'Congratulations Pack';
        $data['pageTitle'] = 'Congratulatory Pack';
        $data['artwork'] = MktgArtwork::orderBy('slug','ASC')->get();
        return view('mktg::marketing_material.property_marketing.congratulation',$data);
    }

//======================================================================================================================
    //===== For Menu Items CRUD ***//
    public function mktg_menu_item_index()
    {
        $data['pageTitle'] = 'Marketing Menu Item';
        $data['material'] = MktgMaterial::orderBy('id','ASC')->get();
        $data['data'] = MktgMenuItem::with('relMktgMaterial','relMktgMenuItemImage')->orderBy('id','DESC')->paginate(30);
        //print_r($data['data']);exit();
        return view('mktg::marketing_material_crud.menu_item.index',$data);
    }

    public function mktg_menu_item_view($id)
    {
        $data['pageTitle'] = 'Marketing Material Details';
        $data['data'] = MktgMenuItem::with('relMktgMaterial','relMktgMenuItemImage','relMktgItemOption')->where('id',$id)->first();

        return view('mktg::marketing_material_crud.menu_item.view',$data);
    }
    /*public function print_material_search(){

        $pageTitle = 'Print Material Informations';
        $title = Input::get('title');
        $data = PrintMaterial::where('title', 'LIKE', '%'.$title.'%')->paginate(7);

        return view('admin::print_material.index',['data' => $data,'pageTitle'=>$pageTitle]);
    }*/

    /*public function mktg_menu_item_store(Requests\PrintMaterialRequest $request)*/
    public function mktg_menu_item_store(Requests\MarketingMaterialRequest $request)
    {
        //exit('Exit');
        $input = $request->all();
        $image=Input::file('image');

        //print_r($input);exit();

        if(count($image)>0) {
            $file_type_required = 'png,jpeg,jpg';
            $destinationPath = 'uploads/mktg_menu_item_image/';

            $uploadfolder = 'uploads/';

            if ( !file_exists($uploadfolder) ) {
                $oldmask = umask(0);  // helpful when used in linux server
                mkdir ($uploadfolder, 0777);
            }

            if ( !file_exists($destinationPath) ) {
                $oldmask = umask(0);  // helpful when used in linux server
                mkdir ($destinationPath, 0777);
            }

            $file_name = MarketingMaterialController::image_upload($image,$file_type_required,$destinationPath);
            //print_r($file_name);exit();
            if($file_name != '') {
                /*$input['image'] = $file_name[0];
                $input['image_thumb'] = $file_name[1];*/
                $menu_item_img = $file_name[0];
                $menu_item_img_thumb = $file_name[1];
                //print_r($menu_item_img_thumb);exit();
            }
            else{
                Session::flash('flash_message_error', 'Some thing error in image file type! Please Try again');
                return redirect()->back();
            }
        }
        //print_r($input);exit;


        //===== input data for head ***//
        $input_mktg_menu_item =[
            'mktg_material_id'=>$input['mktg_material_id'],
            'title'=>$input['title'],
            'slug'=>$input['slug'],
            'status'=>$input['status'],
            'description'=>$input['description']
        ];
        //print_r($input_head);exit();


        //===== input data for Menu Options [ table :: item_option ] ***//
        for($i=0; $i<count($input['title_option']); $i++) {

            /*$image_option = Input::file('image_option');
            //print_r($image_option);exit();
            if(count($image_option)>0)
            {
                $file_type_required = 'png,jpeg,jpg';
                $destinationPath = 'uploads/mktg_menu_item_options_image/';

                $uploadfolder = 'uploads/';

                 if ( !file_exists($uploadfolder) ) {
                     $oldmask = umask(0);  // helpful when used in linux server
                     mkdir ($uploadfolder, 0777);
                 }

                 if ( !file_exists($destinationPath) ) {
                     $oldmask = umask(0);  // helpful when used in linux server
                     mkdir ($destinationPath, 0777);
                 }

                 $file_name = MarketingMaterialController::image_upload_options($image_option,$file_type_required,$destinationPath);
                 if($file_name != '') {
                     $input['image_option'][$i] = $file_name[0];
                     //$input['image_thumb'] = $file_name[1];
                 }
                 else{
                     Session::flash('flash_message_error', 'Some thing error in image file type! Please Try again');
                     return redirect()->back();
                 }
            }*/

            $i_detail[] = array(
                'title' => $input['title_option'][$i],
                'type' => $input['type_option'][$i],
                'slug' => $input['slug_option'][$i],
                'image' => $input['image_option'][$i]
            );
        }
        //print_r($i_detail);exit();

        /* Transaction Start Here */
        DB::beginTransaction();
        try {
            //===== insert into head table
            $vh = MktgMenuItem::create($input_mktg_menu_item);

            //===== Input data for mktg_menu_item_img ***//
            $input_mktg_menu_item_img = [
                'mktg_menu_item_id' => $vh['id'],
                'image'=>$menu_item_img,
                'image_thumb'=>$menu_item_img_thumb,
            ];
            MktgMenuItemImage::create($input_mktg_menu_item_img);

            // Store data into item_option table
            foreach($i_detail as $value){

                if($value['title'] != null) {
                    //Menu options
                    $data = [
                        //'mktg_material_id' => $vh['id'],
                        'mktg_menu_item_id' => $vh['id'],
                        'title' => $value['title'],
                        'type' => $value['type'],
                        'slug' => $value['slug'],
                        'image' => $value['image'],
                    ];
                    // insert data into item_option table
                    MktgItemOption::create($data);
                }
            }

            //Commit the transaction
            DB::commit();
            Session::flash('message', 'Successfully added!');

        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());

        }

        return redirect()->route('mktg-menu-item');
    }
    public function mktg_menu_item_edit($id)
    {
        $data['pageTitle'] = 'Edit Marketing Material Menu Item';
        $data['data'] = MktgMenuItem::with('relMktgMaterial','relMktgMenuItemImage','relMktgItemOption')->where('id',$id)->first();
        //$data['image']->relMktgMenuItemImage[0]['image'];
        //$data['image_id']->relMktgMenuItemImage[0]['id'];
        return view('mktg::marketing_material_crud.menu_item.update',$data);
    }

    /*public function mktg_menu_item_store()
    {
        $data['pageTitle'] = 'Marketing Menu Item';
        $data['material'] = MktgMaterial::orderBy('id','ASC')->get();
        $data['data'] = MktgMenuItem::orderBy('id','ASC')->paginate(30);

        return view('mktg::marketing_material_crud.menu_item.index',$data);
    }*/

    //===== For Image Upload Common Function ***//
    /*For menu Item Images*/
    public function image_upload($image,$file_type_required,$destinationPath)
    {
        if ($image != '') {

            $img_name = ($_FILES['image']['name']);
            $random_number = rand(111, 999);

            $thumb_name = 'thumb_400x400_'.$random_number.'_'.$img_name;

            $newWidth=80;
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
    /*For menu item options images*/
    /*public function image_upload_options($image,$file_type_required,$destinationPath)
    {
        if ($image != '') {

            $img_name = ($_FILES['image_option']['name']);
            $random_number = rand(111, 999);

            $thumb_name = 'thumb_400x400_'.$random_number.'_'.$img_name;

            $newWidth=80;
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
    }*/






    //===== Old Code ***//
    public function proceed()
    {
        $data['pageTitle'] = 'Proceed';
        $data['artwork'] = MktgArtwork::orderBy('slug','ASC')->get();
        return view('mktg::marketing_material.trash.proceed',$data);
    }

    /*public function order()
    {
        $pageTitle = 'MRS - Order';
        $user_image = UserImage::where('user_id',Auth::user()->id)->first();

        return view('mktg::main_pages.order',['pageTitle'=>$pageTitle,'user_image'=>$user_image]);
    }*/

}