<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/8/16
 * Time: 4:52 PM
 */

namespace Modules\Admin\Controllers;

use App\PrintMaterial;
use App\PrintMaterialSize;
use App\Helpers\LogFileHelper;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Input;
use Illuminate\Support\Facades\Session;
use Modules\Admin\Helpers\ImageResize;
use Validator;



class PrintMaterialController extends Controller
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
        $pageTitle = "Print Material Informations";
        $data = PrintMaterial::paginate(20);
        return view('admin::print_material.index',[
            'data'=>$data, 'pageTitle'=>$pageTitle
        ]);

    }


    public function print_material_search(){

        $pageTitle = 'Print Material Informations';
        $title = Input::get('title');
        $data = PrintMaterial::where('title', 'LIKE', '%'.$title.'%')->paginate(7);

        return view('admin::print_material.index',['data' => $data,'pageTitle'=>$pageTitle]);
    }



    public function store(Requests\PrintMaterialRequest $request)
    {
        $input = $request->all();
        $image=Input::file('image');

        if(count($image)>0) {
            $file_type_required = 'png,jpeg,jpg';
            $destinationPath = 'uploads/print_material/';

            $uploadfolder = 'uploads/';

            if ( !file_exists($uploadfolder) ) {
                $oldmask = umask(0);  // helpful when used in linux server
                mkdir ($uploadfolder, 0777);
            }

            if ( !file_exists($destinationPath) ) {
                $oldmask = umask(0);  // helpful when used in linux server
                mkdir ($destinationPath, 0777);
            }

            $file_name = PrintMaterialController::image_upload($image,$file_type_required,$destinationPath);
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
        $input_head =[
            'title'=>$input['title'],
            'is_distribution'=>$input['is_distribution'],
            'image_path'=>$input['image_path'],
            'image_thumb'=>$input['image_thumb']
        ];

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
            $vh = PrintMaterial::create($input_head);

            // Store data into voucher detail
            foreach($i_detail as $value){

                if($value['title_size'] != null) {

                    //detail data
                    $data = [
                        'print_material_id' => $vh['id'],
                        'title' => $value['title_size'],
                        'price' => $value['price'],
                        'description' => $value['description'],
                    ];
                    // insert data into voucher detail table
                    PrintMaterialSize::create($data);
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

        return redirect()->route('print-material');
    }


    public function show($id)
    {
        $pageTitle = 'Print Material Informations';
        $pageTitleOptions = 'Sizes';
        $data = PrintMaterial::with('relPrintMaterial')->where('id',$id)->get();

        //print_r($data);exit;

        return view('admin::print_material.view', ['data' => $data, 'pageTitle'=> $pageTitle, 'pageTitleOptions'=> $pageTitleOptions]);
    }

    public function edit($id)
    {
        $pageTitle = "Update Print Material Informations";
        $data = PrintMaterial::with('relPrintMaterial')->where('id',$id)->get();

        //print_r($data);exit;

        return view('admin::print_material.update', ['data' => $data,'pageTitle'=> $pageTitle]);
    }

    public function image_show($id){
        $pageTitle = 'Image';
        $image = PrintMaterial::where('id','=',$id)->get();
        return view('admin::print_material.view_image', [
            'pageTitle'=> $pageTitle, 'image'=>$image
        ]);
    }

    public function update(Request $request, $id)
    {
        $model = PrintMaterial::where('id',$id)->first();

        $input = $request->all();

        $image=Input::file('image');

        if(count($image)>0) {
            $file_type_required = 'png,jpeg,jpg';
            $destinationPath = 'uploads/print_material/';

            $uploadfolder = 'uploads/';

            if ( !file_exists($uploadfolder) ) {
                $oldmask = umask(0);  // helpful when used in linux server
                mkdir ($uploadfolder, 0777);
            }

            if ( !file_exists($destinationPath) ) {
                $oldmask = umask(0);  // helpful when used in linux server
                mkdir ($destinationPath, 0777);
            }

            $file_name = PrintMaterialController::image_upload($image, $file_type_required, $destinationPath);

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
                'image_path'=>@$input['image_path'],
                'image_thumb'=>@$input['image_thumb'],
                'is_distribution'=>@$input['is_distribution']
            ];
        }else{
            $input_head =[
                'id'=>@$id,
                'title'=>@$input['title'],
                'is_distribution'=>@$input['is_distribution']
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
                $dt_model = $value['dt_id'] ? PrintMaterialSize::findOrNew($value['dt_id']) : new PrintMaterialSize();

                if($value['title_size'] !=null ){

                    //detail data
                    $data = [
                        'print_material_id' => $id,
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

        return redirect()->route('print-material');
    }



    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $model_package = PrintMaterialSize::where('print_material_id',$id)->get();
            if(count($model_package)>0){
                foreach($model_package as $value) {
                    $case = PrintMaterialSize::find($value['id']);
                    $case->delete();
                }
            }

            DB::commit();
            Session::flash('message', 'Successfully deleted! ');

        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('flash_message_error', 'Invalid Delete Process !');
        }

        $model_package = PrintMaterial::where('id',$id)->first();

        DB::beginTransaction();
        try
        {
            if ($model_package->delete())
            {
                if(file_exists($model_package->image_path) || file_exists($model_package->image_thumb)){
                    unlink(public_path()."/".$model_package->image_path);
                    unlink(public_path()."/".$model_package->image_thumb);
                }
            }
            DB::commit();
            Session::flash('message', 'Successfully deleted!');

        }
        catch(\Exception $e)
        {
            DB::rollback();
            Session::flash('flash_message_error', 'Invalid Delete Process !');
        }


        return redirect()->route('print-material');
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