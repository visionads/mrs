<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/10/16
 * Time: 2:54 PM
 */

namespace Modules\Admin\Controllers;

use App\SignboardPackage;
use App\SignboardPackageSize;
use App\Helpers\LogFileHelper;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Input;
use Illuminate\Support\Facades\Session;
use Modules\Admin\Helpers\ImageResize;
use Validator;


class SignboardPackageController extends Controller
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
        $pageTitle = "Signboard Package Informations";
        $data = SignboardPackage::paginate(7);
        return view('admin::signboard_package.index',['data'=>$data, 'pageTitle'=>$pageTitle]);
    }


    public function signboard_package_search(){

        $pageTitle = 'Signboard Package Informations';
        $title = Input::get('title');
        $data = SignboardPackage::where('title', 'LIKE', '%'.$title.'%')->paginate(7);

        return view('admin::signboard_package.index',['data' => $data,'pageTitle'=>$pageTitle]);
    }



    public function store(Requests\SignboardPackageRequest $request)
    {
        $input = $request->all();
        $image=Input::file('image');

        if(count($image)>0) {
            $file_type_required = 'png,jpeg,jpg';
            $destinationPath = 'uploads/signboard_package/';

            $uploadfolder = 'uploads/';

            if ( !file_exists($uploadfolder) ) {
                $oldmask = umask(0);  // helpful when used in linux server
                mkdir ($uploadfolder, 0777);
            }

            if ( !file_exists($destinationPath) ) {
                $oldmask = umask(0);  // helpful when used in linux server
                mkdir ($destinationPath, 0777);
            }

            $file_name = SignboardPackageController::image_upload($image,$file_type_required,$destinationPath);
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
                'image_path' => $input['image_path'],
                'image_thumb' => $input['image_thumb']
            ];
        }else{
            $input_head = [
                'title' => $input['title']
            ];
        }

        // input data for detail
        for($i=0; $i<count($input['title_size']); $i++){
            $i_detail[] = array(
                'title_size'=>$input['title_size'][$i],
                'price'=>$input['price'][$i],
                'description'=>$input['description'][$i]
            );
        }

        /* Transaction Start Here */
        DB::beginTransaction();
        try {
            //insert into head table
            $vh = SignboardPackage::create($input_head);

            // Store data into voucher detail
            foreach($i_detail as $value){

                if($value['title_size'] != null) {

                    //detail data
                    $data = [
                        'signboard_package_id' => $vh['id'],
                        'title' => $value['title_size'],
                        'price' => $value['price'],
                        'description' => $value['description'],
                    ];
                    // insert data into voucher detail table
                    SignboardPackageSize::create($data);
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

        return redirect()->route('signboard-package');
    }


    public function show($id)
    {
        $pageTitle = 'Signboard Package Informations';
        $pageTitleOptions = 'Sizes';
        $data = SignboardPackage::with('relSignboardPackage')->where('id',$id)->get();

        //print_r($data);exit;

        return view('admin::signboard_package.view', ['data' => $data, 'pageTitle'=> $pageTitle, 'pageTitleOptions'=> $pageTitleOptions]);
    }

    public function edit($id)
    {
        $pageTitle = "Update Signboard Package Informations";
        $data = SignboardPackage::with('relSignboardPackage')->where('id',$id)->get();

        //print_r($data);exit;

        return view('admin::signboard_package.update', ['data' => $data,'pageTitle'=> $pageTitle]);
    }

    public function image_show($id){
        $pageTitle = 'Image';
        $image = SignboardPackage::where('id','=',$id)->get();
        return view('admin::signboard_package.view_image', [
            'pageTitle'=> $pageTitle, 'image'=>$image
        ]);
    }

    public function update(Request $request, $id)
    {
        $model = SignboardPackage::where('id',$id)->first();

        $input = $request->all();

        $image=Input::file('image');

        if(count($image)>0) {
            $file_type_required = 'png,jpeg,jpg';
            $destinationPath = 'uploads/signboard_package/';

            $uploadfolder = 'uploads/';

            if ( !file_exists($uploadfolder) ) {
                $oldmask = umask(0);  // helpful when used in linux server
                mkdir ($uploadfolder, 0777);
            }

            if ( !file_exists($destinationPath) ) {
                $oldmask = umask(0);  // helpful when used in linux server
                mkdir ($destinationPath, 0777);
            }

            $file_name = SignboardPackageController::image_upload($image, $file_type_required, $destinationPath);

            if ($file_name != '') {
                unlink(public_path()."/".$model->image_path);
                unlink(public_path()."/".$model->image_thumb);
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
                'image_path'=>@$input['image_path'],
                'image_thumb'=>@$input['image_thumb']
            ];
        }else{
            $input_head =[
                'id'=>@$id,
                'title'=>@$input['title']
            ];
        }


        // input data for detail
        for($i=0; $i<count($input['title_size']); $i++){
            $i_detail[] = array(
                'dt_id'=>@$input['dt_id'][$i],
                'title_size'=>@$input['title_size'][$i],
                'price'=>@$input['price'][$i],
                'description'=>@$input['description'][$i],
            );
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
                $dt_model = $value['dt_id'] ? SignboardPackageSize::findOrNew($value['dt_id']) : new SignboardPackageSize();

                if($value['title_size'] !=null ){

                    //detail data
                    $data = [
                        'signboard_package_id' => $id,
                        'title' => $value['title_size'],
                        'price' => $value['price'],
                        'description' => $value['description'],
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

        return redirect()->route('signboard-package');
    }



    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $model_package = SignboardPackageSize::where('signboard_package_id',$id)->get();
            foreach($model_package as $value) {
                $case = SignboardPackageSize::find($value['id']);
                $case->delete();
                DB::commit();
            }

        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('flash_message_error', 'Invalid Delete Process !');
        }

        $model_package = SignboardPackage::where('id',$id)->first();

        DB::beginTransaction();
        try {
            if ($model_package->delete()) {
                unlink(public_path()."/".$model_package->image_path);
                unlink(public_path()."/".$model_package->image_thumb);
                DB::commit();
                Session::flash('message', 'Successfully deleted!');
            }
        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('flash_message_error', 'Invalid Delete Process !');
        }


        return redirect()->route('signboard-package');
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

}