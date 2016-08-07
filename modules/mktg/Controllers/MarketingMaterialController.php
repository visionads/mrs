<?php
namespace Modules\Mktg\Controllers;

/**
 * Created by PhpStorm.
 * User: sr
 * Date: 5/8/16
 * Time: 1:55 PM
 */

use App\MktgArtworkImage;
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
use App\MktgItemValue;
use App\MktgOrder;
use App\MktgOrderDetail;
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
        //$data['data'] = MktgMaterial::orderBy('id','ASC')->get();
        $data['data'] = MktgMaterial::with('relMktgMenuItem','relMktgMenuItem.relMktgMenuItemImage')->orderBy('id','ASC')->get();
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
        $data['data'] = MktgMenuItem::with('relMktgMaterial','relMktgMenuItemImage')->where('status','open')->orderBy('id','DESC')->paginate(30);
        //print_r($data['data']);exit();
        return view('mktg::marketing_material_crud.menu_item.index',$data);
    }

    public function mktg_menu_item_view($id)
    {
        $data['pageTitle'] = 'Marketing Material Details';
        $data['data'] = MktgMenuItem::with('relMktgMaterial','relMktgMenuItemImage','relMktgItemOption')->where('id',$id)->first();

        return view('mktg::marketing_material_crud.menu_item.view',$data);
    }
    public function mktg_menu_item_details($id)
    {
        $data['pageTitle'] = 'Marketing Material Details';
        $data['data'] = MktgMenuItem::with('relMktgMaterial','relMktgMenuItemImage','relMktgItemOption')->where('id',$id)->first();
        //$data['option_value'] = MktgItemValue::orderBy('id','ASC')->get();
        //print_r($data['option_value']);exit();
        return view('mktg::marketing_material_crud.menu_item.details',$data);
    }
    public function mktg_menu_item_search(){

        $data['pageTitle'] = 'Marketing Material Menu Item Search Item';
        $title = Input::get('title');
        $data['data'] = MktgMenuItem::where('title', 'LIKE', '%'.$title.'%')->paginate(7);

        return view('mktg::marketing_material_crud.menu_item.index',$data);
    }

    /*public function mktg_menu_item_store(Requests\PrintMaterialRequest $request)*/
    public function mktg_menu_item_store(Requests\MarketingMaterialRequest $request)
    {
        $input = $request->all();

        //===Multiple Image Upload for Menu Item ***//
        $image_input_arr=Input::file('image');
        //print_r($image_input_arr);exit();
        //print_r(count($image_input_arr));exit();
        $image_arr = array();
        for($i=0; $i<count($image_input_arr); $i++)
        {
            $image_option_head = $_FILES['image']['name'][$i];
            //print_r($image_option_head);exit();
            $image_data_head = Input::file('image')[$i];

            if(count($image_option_head)>0)
            {
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

                $file_name = $this->image_upload($image_option_head,$image_data_head, $file_type_required,$destinationPath);
                //print_r($file_name);exit;
                if($file_name != '') {
                    $image_arr [] = array(
                        'menu_item_img'=>$file_name[0],
                        'menu_item_img_thumb'=>$file_name[1],
                    );
                }
            }
        }
        //print_r($image_arr);exit;

        //===== input data for head ***//
        $input_mktg_menu_item =[
            'mktg_material_id'=>$input['mktg_material_id'],
            'title'=>$input['title'],
            'slug'=>str_slug($input['title']),
            'status'=>$input['status'],
            'description'=>$input['description']
        ];
        //print_r($input_mktg_menu_item);exit();

        //===== input data for Menu Options [ table :: item_option ] ***//
        $i_detail = array();
        for($i=0; $i<count($input['title_option']); $i++)
        {
            $image_option = $_FILES['image_option']['name'][$i];
            $image_data = Input::file('image_option')[$i];

            $option_image = array();
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

                 $file_name = $this->image_upload_options($image_option,$image_data, $file_type_required,$destinationPath);

                 if($file_name != '') {
                     $option_image [] = array(
                         'image'=>$file_name[0],
                         'image_thumb'=>$file_name[1],

                     );
                 }

            }
            // index checking if not null
            if($input['title_option'][$i] != null){
                $i_detail[] = array(
                    'title' => $input['title_option'][$i],
                    'type' => $input['type_option'][$i],
                    'slug' => str_slug($input['title_option'][$i]),
                    'icon' => $input['icon_option'][$i],
                    'status' => $input['status_option'][$i],
                    'image' => isset($option_image[0]['image'])?$option_image[0]['image']:null,
                    'image_thumb' => isset($option_image[0]['image_thumb'])?$option_image[0]['image_thumb']:null,
                );
            }
        }

        /* Transaction Start Here */
        DB::beginTransaction();
        try {
            //===== insert into head table
            if($vh = MktgMenuItem::create($input_mktg_menu_item)){
                //===== Input data for mktg_menu_item_img ***//
                foreach($image_arr as $imgrow){
                    $input_mktg_menu_item_img = [
                        'mktg_menu_item_id' => $vh['id'],
                        'image'=>isset($imgrow['menu_item_img'])?$imgrow['menu_item_img']:null,
                        'image_thumb'=>isset($imgrow['menu_item_img_thumb'])?$imgrow['menu_item_img_thumb']:null,
                    ];
                    MktgMenuItemImage::create($input_mktg_menu_item_img);
                }

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
                            'icon' => $value['icon'],
                            'status' => $value['status'],
                            'image' => $value['image'],
                            'image_thumb' => $value['image_thumb'],
                        ];
                        //print_r($data);exit();
                        // insert data into item_option table
                        MktgItemOption::create($data);
                    }
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
    /*====For Edit Menu Item*/
    public function mktg_menu_item_edit($id)
    {
        $data['pageTitle'] = 'Edit Marketing Material Menu Item';
        $data['data'] = MktgMenuItem::with('relMktgMaterial','relMktgMenuItemImage','relMktgItemOption')->where('id',$id)->first();
        $data['material'] = MktgMaterial::orderBy('id','ASC')->get();
        return view('mktg::marketing_material_crud.menu_item.update',$data);
    }
    /*===== For Menu Item Update*/
    public function mktg_menu_item_update(Requests\MarketingMaterialRequest $request, $id)
    {
        //exit('got it');
        $model = MktgMenuItem::where('id',$id)->first();

        $input = $request->all();
        //print_r($input);exit();

        //===Multiple Image Upload for Menu Item ***//
        $image_input_arr=Input::file('image');
        //print_r($image_input_arr);exit();
        $image_arr = array();
        for($i=0; $i<count($image_input_arr); $i++)
        {
            $image_option_head = $_FILES['image']['name'][$i];
            //print_r($image_option_head);exit();
            $image_data_head = Input::file('image')[$i];

            if(count($image_option_head)>0)
            {
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

                $file_name = $this->image_upload($image_option_head,$image_data_head, $file_type_required,$destinationPath);
                //print_r($file_name);exit;
                if($file_name != '') {
                    $image_arr [] = array(
                        'menu_item_img'=>$file_name[0],
                        'menu_item_img_thumb'=>$file_name[1],
                    );
                }
            }
        }
        //print_r($image_arr);exit;

        //===== Delete Menu Item Image ****//
        $delete_menu_item_image_arr = array();
        if(isset($input['img_delete'])){
            $delete_menu_item_image_arr =  $input['img_delete'];
        }
        //print_r($delete_menu_item_image_arr);exit();

        //===== input data for head ***//
        /*$input_mktg_menu_item =[
            'mktg_material_id'=>$input['mktg_material_id'],
            'title'=>$input['title'],
            'slug'=>str_slug($input['title']),
            'status'=>$input['status'],
            'description'=>$input['description']
        ];*/
        //print_r($input_mktg_menu_item);exit();

        //===== input data for Menu Options [ table :: item_option ] ***//
        $i_detail = array();
        //print_r($input['title_option']);exit();
        for($i=0; $i<count($input['title_option']); $i++)
        {
            $image_option = $_FILES['image_option']['name'][$i];
            $image_data = Input::file('image_option')[$i];
            //$del_option_img = $input['del_option_img'][$i];
            //$del_option_img_thumb = $input['del_option_img_thumb'][$i];

            //$image_option_edit = $_FILES['image_option_edit']['name'][$i];
            $option_image = array();

            if(count($image_option)>0)
            //if($image_option !== null)
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
                $file_name = $this->image_upload_options($image_option,$image_data, $file_type_required,$destinationPath);
                if($file_name != '') {
                    //unlink(public_path()."/".$model->image);
                    //unlink(public_path()."/".$model->image_thumb);

                    $option_image [] = array(
                        'image'=>$file_name[0],
                        'image_thumb'=>$file_name[1],
                    );
                }
            }

            //print_r($option_image); exit();
            // index checking if not null
            if($input['title_option'][$i] != null){
                $i_detail[] = array(
                    'opt_id' => @$input['opt_id'][$i],
                    'title' => @$input['title_option'][$i],
                    'type' => @$input['type_option'][$i],
                    'slug' => str_slug($input['title_option'][$i]),
                    'icon' => @$input['icon_option'][$i],
                    'status' => @$input['status_option'][$i],
                    'image' => isset($option_image[0]['image'])?$option_image[0]['image']:@$input['del_option_img'][$i],
                    'image_thumb' => isset($option_image[0]['image_thumb'])?$option_image[0]['image_thumb']:@$input['del_option_img_thumb'][$i],
                );
            }
        }//=== End of Option data with images
        //print_r($i_detail);exit();
        //print_r($option_image);exit();

        /* Transaction Start Here */
        DB::beginTransaction();
        try {
            //===== To Update head table ( table::mktg_menu_item )
            $model->mktg_material_id = $input['mktg_material_id'];
            $model->title = $input['title'];
            $model->slug = str_slug($input['title']);
            $model->status = $input['status'];
            $model->description = $input['description'];
            $model->save();
            //print_r($model->id);exit();
            if($model->save()){
                //===== To Create New Menu Item Image into mktg_menu_item_img table ***//
                foreach($image_arr as $imgrow){
                    $input_mktg_menu_item_img = [
                        'mktg_menu_item_id' => $model->id,
                        'image'=>isset($imgrow['menu_item_img'])?$imgrow['menu_item_img']:null,
                        'image_thumb'=>isset($imgrow['menu_item_img_thumb'])?$imgrow['menu_item_img_thumb']:null,
                    ];
                    MktgMenuItemImage::create($input_mktg_menu_item_img);
                }

                //=== To delete Menu Item image from mktg_menu_item_img table and directory ***//
                foreach($delete_menu_item_image_arr as $dltimg){
                    $getimgpath = MktgMenuItemImage::where('id',$dltimg)->first();
                    //print_r($getimgpath['image']);exit();
                    $deleted = MktgMenuItemImage::where('id',$dltimg)->delete();
                    if($deleted){
                        unlink(public_path()."/".$getimgpath['image']);
                        unlink(public_path()."/".$getimgpath['image_thumb']);
                    }
                }


                //=== To Update data of mktg_item_option table ***//
                foreach($i_detail as $value){
                    $opt_model = $value['opt_id'] ? MktgItemOption::findOrNew($value['opt_id']) : new MktgItemOption();
                    if($value['title'] != null) {
                        //Menu options
                        $data = [
                            //'mktg_material_id' => $vh['id'],
                            'mktg_menu_item_id' => $model->id,
                            'title' => $value['title'],
                            'type' => $value['type'],
                            'slug' => $value['slug'],
                            'status' => $value['status'],
                            'icon' => $value['icon'],
                            'image' => $value['image'],
                            'image_thumb' => $value['image_thumb'],
                        ];
                        //print_r($data);exit();
                        // insert data into item_option table
                        if($value['opt_id']){
                            $opt_model->update($data);
                        }else{
                            $opt_model->create($data);
                        }
                    }
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


    public function mktg_menu_item_delete($id)
    {
        DB::beginTransaction();
        try {
            //=== For Manue Item Delete ( to make inactive)
            $menu_item = MktgMenuItem::findOrFail($id);
            $menu_item->status = "close";
            $menu_item->save();
            if($menu_item->save())
            {
                //=== For Menu Item options Delete ( to make inactive)
                $menu_item_options = MktgItemOption::where('mktg_menu_item_id',$id)->get();
                //print_r($menu_item_options);exit();
                foreach($menu_item_options as $value) {
                    $case = MktgItemOption::find($value['id']);
                    //print_r($case);
                    $case->status = "close";
                    $case->save();
                    //unlink(public_path()."/".$value->image);
                    //unlink(public_path()."/".$value->image_thumb);
                }
            }
            DB::commit();
            Session::flash('message', 'Successfully deleted!');

        } catch(\Exception $e) { exit('ksdjflskdjklf');
            DB::rollback();
            Session::flash('flash_message_error', 'Invalid Delete Process !');
        }

        return redirect()->route('mktg-menu-item');
    }

    public function mktg_item_option_add_value($id)
    {
        //exit('OK');
        $data['pageTitle'] = 'Add / Edit Marketing Item  Value for an option';
        //$data['material'] = MktgMaterial::orderBy('id','ASC')->get();
        $data['data'] = MktgItemOption::where('id',$id)->first();
        $data['options'] = MktgItemValue::where('mktg_item_option_id',$id)->first();
        $data['options_edit'] = MktgItemValue::where('mktg_item_option_id',$id)->get();
        /*foreach($data['options'] as $val){
            print_r($val->title);
        }
        exit();*/
        //print_r($data['options']);exit();

        return view('mktg::marketing_material_crud.menu_item.item_option_value_add',$data);
    }
    public function mktg_item_option_add_value_store($id)
    {
        $input = Input::all();
        $input_value_arr = array();
        for($i=0; $i<count($input['title']); $i++)
        {
            // index checking if not null
            if($input['title'][$i] != null){
                //print_r($input['title'][$i]);
                $input_value_arr[] = array(
                    'title' => $input['title'][$i],
                    'price' => $input['price'][$i],
                    'mktg_item_option_id' => $id,
                    'status' => $input['status'][$i],
                    //'slug' => str_slug($input['title'])[$i],
                );
            }
        }
        //print_r($input_value_arr);exit();
        DB::beginTransaction();
        try {
            // Store data into item_option table
            foreach($input_value_arr as $value){
                if($value['title'] != null) {
                    //Menu options
                    $data = [
                        'title'=>$value['title'],
                        'price'=>$value['price'],
                        'mktg_item_option_id'=>$value['mktg_item_option_id'],
                        'slug'=>str_slug($value['title']),
                        'status'=>$value['status'],
                        //'slug'=>time(),
                    ];
                    MktgItemValue::create($data);
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
        return redirect()->back();
    }

    public function mktg_item_option_add_value_update($id)
    {
        //print_r($id);exit();
        $input = Input::all();
        //print_r($input);exit();
        $input_edit_value_arr = array();
        $input_edit_value_arr_del = array();
        for($i=0; $i<count($input['title']); $i++)
        {
            // index checking if not null
            if($input['title'][$i] != null){
                //print_r($input['title'][$i]);
                $input_edit_value_arr[] = array(
                    'val_id' => @$input['val_id'][$i],
                    'title' => $input['title'][$i],
                    'price' => $input['price'][$i],
                    'status' => $input['status'][$i],
                    'mktg_item_option_id' => $id,
                    //'slug' => str_slug($input['title'])[$i],
                );
            }
        }
        //print_r($input_edit_value_arr);exit();


        DB::beginTransaction();
        try {
            foreach($input_edit_value_arr as $value){
                $val_model = $value['val_id'] ? MktgItemValue::findOrNew($value['val_id']) : new MktgItemValue();
                if($value['title'] != null) {
                    //Menu options
                    $data = [
                        'title'=>$value['title'],
                        'price'=>$value['price'],
                        'status'=>$value['status'],
                        'mktg_item_option_id'=>$value['mktg_item_option_id'],
                        //'slug'=>str_slug($value['title']),
                        //'slug'=>time(),
                    ];
                    //print_r($data);exit();
                    // insert data into item_option table
                    if($value['val_id']){
                        $val_model->update($data);
                    }else{
                        $val_model->create($data);
                    }
                }
            }
            /*$model = MktgItemValue::findOrFail($id);
            $model->title = $input['title'];
            $model->price = $input['price'];
            $model->slug = str_slug($input['title']);
            $model->save();*/
            //Commit the transaction
            DB::commit();
            Session::flash('message', 'Successfully added!');

        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }

        return redirect()->back();
    }

    //===== For Image Upload Common Method ***//
    /*For menu Item Images*/
    public function image_upload($image_option_head,$image_data_head, $file_type_required,$destinationPath)
    {
        if ($image_option_head != '')
        {
            //exit('dfd');
            $img_name = $image_option_head;
            $image = $image_data_head;


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

    /*
     * For menu item options images
     */


    public function image_upload_options($image,$image_data, $file_type_required,$destinationPath)
    {
        if ($image != '')
        {

            $img_name = $image;
            $image = $image_data;


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






    //===== it will go to MKTG Order Controller ***//
    public function mktg_order()
    {
        $data['pageTitle'] = 'Marketing Material Order List';
        //$data['data'] = MktgOrder::with('relMktgMaterial','relMktgMenuItemImage','relMktgItemOption')->where('id',$id)->first();
        //$data['data'] = MktgOrderDetail::orderBy('id','DESC')->get();
        $data['data'] = MktgOrder::orderBy('id','DESC')->paginate(30);
        //print_r($data['data']);exit();

        return view('mktg::order.order_index',$data);
    }


    /*public function order()
    {
        $pageTitle = 'MRS - Order';
        $user_image = UserImage::where('user_id',Auth::user()->id)->first();

        return view('mktg::main_pages.order',['pageTitle'=>$pageTitle,'user_image'=>$user_image]);
    }*/

}