<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/8/16
 * Time: 4:52 PM
 */

namespace Modules\Admin\Controllers;

use App\Package;
use App\PackageOption;
use App\Helpers\LogFileHelper;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Input;
use Illuminate\Support\Facades\Session;
use Modules\Admin\Helpers\ImageResize;
use Validator;



class PackageController extends Controller
{
    protected function isGetRequest()
    {
        return Input::server("REQUEST_METHOD") == "GET";
    }
    protected function isPostRequest()
    {
        return Input::server("REQUEST_METHOD") == "POST";
    }

    public function index()
    {
        $pageTitle = "Packages";
        $data = Package::paginate(7);
        return view('admin::package.index',['data'=>$data, 'pageTitle'=>$pageTitle]);
    }


    public function package_search(){

        $pageTitle = 'Package';
        $title = Input::get('title');
        $data = Package::where('title', 'LIKE', '%'.$title.'%')->paginate(7);

        return view('admin::package.index',['data' => $data,'pageTitle'=>$pageTitle]);
    }



    public function store(Requests\PackageRequest $request)
    {
        $input = $request->all();
        $image=Input::file('image');
        if(count($image)>0) {
            $file_type_required = 'png,jpeg,jpg';
            $destinationPath = 'uploads/package_image/';

            $uploadfolder = 'uploads/';

            if ( !file_exists($uploadfolder) ) {
                $oldmask = umask(0);  // helpful when used in linux server
                mkdir ($uploadfolder, 0777);
            }

            if ( !file_exists($destinationPath) ) {
                $oldmask = umask(0);  // helpful when used in linux server
                mkdir ($destinationPath, 0777);
            }

            $file_name = $this->image_upload($image,$file_type_required,$destinationPath);
            if($file_name != '') {
                $input['image_path'] = $file_name[0];
                $input['image_thumb'] = $file_name[1];
            }
            else{
                Session::flash('flash_message_error', 'Some thing error in image file type! Please Try again');
                return redirect()->back();
            }
        }

        //print_r($input);exit;

        // input data for head
        if(count($image)>0) {
            $input_head = [
                'title' => $input['title'],
                'slug' => str_slug($input['title']),
                'price' => $input['price'],
                'status' => $input['status'],
                'is_distributed_package' => $input['is_distributed_package'],
                'type' => $input['type'],
                'image_path' => $input['image_path'],
                'image_thumb' => $input['image_thumb']
            ];
        }else{
            $input_head = [
                'title' => $input['title'],
                'slug' => str_slug($input['title']),
                'price' => $input['price'],
                'type' => $input['type'],
                'is_distributed_package' => $input['is_distributed_package'],
                'status' => $input['status']
            ];
        }
        //print_r($input_head);exit();



        // input data for detail
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
                    'title'=>$input['title_option'][$i],
                    'price'=>$input['price_option'][$i],
                    'description'=>$input['description'][$i],
                    'image' => isset($option_image[0]['image'])?$option_image[0]['image']:null,
                    'image_thumb' => isset($option_image[0]['image_thumb'])?$option_image[0]['image_thumb']:null,
                );
            }

        }

        /* Transaction Start Here */
        DB::beginTransaction();
        try {
            //insert into head table
            $vh = Package::create($input_head);

            // Store data into package_option
            foreach($i_detail as $value){

                if($value['title'] != null) {

                    //detail data
                    $data = [
                        'package_id' => $vh['id'],
                        'title' => $value['title'],
                        'price' => $value['price'],
                        'description' => $value['description'],
                        'image' => $value['image'],
                        'image_thumb' => $value['image_thumb'],
                    ];
                    PackageOption::create($data);
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
        return redirect()->route('package');
    }


    public function show($id)
    {
        $pageTitle = 'Package Details';
        $pageTitleOptions = 'Package Options';
        $data = Package::with('relPackageOption')->where('id',$id)->get();

        /*foreach($data[0]['relPackageOption'] as $values )
        {
            $ttl[] = $values['title'];
            $values['price'];
        }
        print_r($ttl);exit();*/


        //print_r($data);exit;

        return view('admin::package.view', ['data' => $data, 'pageTitle'=> $pageTitle, 'pageTitleOptions'=> $pageTitleOptions]);
    }

    public function edit($id)
    {
        $pageTitle = "Update Package Informations";
        $data = Package::with('relPackageOption')->where('id',$id)->get();

        //print_r($data);exit;

        return view('admin::package.update', ['data' => $data,'pageTitle'=> $pageTitle]);
    }

    public function image_show($id){
        $pageTitle = 'Image';
        $image = Package::where('id','=',$id)->get();
        return view('admin::package.view_image', [
            'pageTitle'=> $pageTitle, 'image'=>$image
        ]);
    }

    public function update(Request $request, $id)
    {
        $model = Package::where('id',$id)->first();

        $input = $request->all();

        $image=Input::file('image');

        if(count($image)>0) {
            $file_type_required = 'png,jpeg,jpg';
            $destinationPath = 'uploads/package_image/';

            $uploadfolder = 'uploads/';

            if ( !file_exists($uploadfolder) ) {
                $oldmask = umask(0);  // helpful when used in linux server
                mkdir ($uploadfolder, 0777);
            }

            if ( !file_exists($destinationPath) ) {
                $oldmask = umask(0);  // helpful when used in linux server
                mkdir ($destinationPath, 0777);
            }

            $file_name = $this->image_upload($image, $file_type_required, $destinationPath);

            if ($file_name != '') {
                if (file_exists($model->image_path)) {
                    unlink(public_path()."/".$model->image_path);
                }
                if (file_exists($model->image_thumb)) {
                    unlink(public_path()."/".$model->image_thumb);
                }

                $input['image_path'] = $file_name[0];
                $input['image_thumb'] = $file_name[1];
            } else {
                Session::flash('flash_message_error', 'Some thing error in image file type! Please Try again');
            }
        }

        // input data for head

        if(count($image)>0) {
            $input_head =[
                'id'=>@$id,
                'title'=>@$input['title'],
                'price'=>@$input['price'],
                'status'=>@$input['status'],
                'type'=>@$input['type'],
                'is_distributed_package'=>@$input['is_distributed_package'],
                'image_path'=>@$input['image_path'],
                'image_thumb'=>@$input['image_thumb']
            ];
        }else{
            $input_head =[
                'id'=>@$id,
                'title'=>@$input['title'],
                'price'=>@$input['price'],
                'type'=>@$input['type'],
                'is_distributed_package'=>@$input['is_distributed_package'],
                'status'=>@$input['status']
            ];
        }

        // input data for detail
        $i_detail = array();
        for($i=0; $i<count($input['title_option']); $i++) {

            $image_option = $_FILES['image_option']['name'][$i];
            $image_data = Input::file('image_option')[$i];
            //$del_option_img = $input['del_option_img'][$i];
            //$del_option_img_thumb = $input['del_option_img_thumb'][$i];

            //$image_option_edit = $_FILES['image_option_edit']['name'][$i];
            $option_image = array();

            if (count($image_option) > 0) //if($image_option !== null)
            {
                $file_type_required = 'png,jpeg,jpg';
                $destinationPath = 'uploads/mktg_menu_item_options_image/';
                $uploadfolder = 'uploads/';

                if (!file_exists($uploadfolder)) {
                    $oldmask = umask(0);  // helpful when used in linux server
                    mkdir($uploadfolder, 0777);
                }
                if (!file_exists($destinationPath)) {
                    $oldmask = umask(0);  // helpful when used in linux server
                    mkdir($destinationPath, 0777);
                }
                $file_name = $this->image_upload_options($image_option, $image_data, $file_type_required, $destinationPath);
                if ($file_name != '') {
                    //unlink(public_path()."/".$model->image);
                    //unlink(public_path()."/".$model->image_thumb);

                    $option_image [] = array(
                        'image' => $file_name[0],
                        'image_thumb' => $file_name[1],
                    );
                }
            }

            if ($input['title_option'][$i] != null) {

                $i_detail[] = array(
                    'dt_id' => @$input['dt_id'][$i],
                    'title_option' => @$input['title_option'][$i],
                    'price_option' => @$input['price_option'][$i],
                    'description' => @$input['description'][$i],
                    'image' => isset($option_image[0]['image'])?$option_image[0]['image']:@$input['del_option_img'][$i],
                    'image_thumb' => isset($option_image[0]['image_thumb'])?$option_image[0]['image_thumb']:@$input['del_option_img_thumb'][$i],
                );
            }
        }



        /* Transaction Start Here */
        DB::beginTransaction();
        try {
            //insert into voucher head table
            //$vh_model = PhotographyPackage::findOrNew($id);
            $vh = $model->update($input_head);
            //print_r($vh_model);exit;
            // Store data into voucher detail
            foreach($i_detail as $value){
                $dt_model = $value['dt_id'] ? PackageOption::findOrNew($value['dt_id']) : new PackageOption();

                if($value['title_option'] !=null ){
                    //detail data
                    $data = [
                        'package_id' => $id,
                        'title' => $value['title_option'],
                        'price' => $value['price_option'],
                        'description' => $value['description'],
                        'image' => $value['image'],
                        'image_thumb' => $value['image_thumb'],
                    ];

                    // insert data into voucher detail table
                    if($value['dt_id']){
                        $dt_model->update($data);
                    }else{
                        $dt_model->create($data);
                    }
                }
            }

            //Commit the transaction
            DB::commit();
            Session::flash('message', 'Successfully updated!');

        } catch (\Exception $e) {
            //If there are any exceptions, rollback the transaction`
            DB::rollback();
            Session::flash('danger', $e->getMessage());

        }

        return redirect()->route('package');
    }



    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $model_package = PackageOption::where('package_id',$id)->get();
            foreach($model_package as $value) {
                $case = PackageOption::find($value['id']);
                $case->delete();
                DB::commit();
            }

        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('flash_message_error', 'Invalid Delete Process !');
        }

        $model_package = Package::where('id',$id)->first();

        DB::beginTransaction();
        try {
            if ($model_package->delete()) {
                if (file_exists($model_package->image_path)) {
                    unlink(public_path()."/".$model_package->image_path);
                }
                if (file_exists($model_package->image_path)) {
                    unlink(public_path()."/".$model_package->image_thumb);
                }
                DB::commit();
                Session::flash('message', 'Successfully deleted!');
            }
        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('flash_message_error', 'Invalid Delete Process !');
        }


        return redirect()->route('package');
    }

    public function image_upload($image,$file_type_required,$destinationPath)
    {
        if ($image != '') {

            $img_name = ($_FILES['image']['name']);
            $random_number = rand(111, 999);

            $thumb_name = 'thumb_400x400_'.$random_number.'_'.$img_name;

            $newWidth=100;
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
}