<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/8/16
 * Time: 11:52 AM
 */

namespace Modules\Admin\Controllers;

use App\Helpers\LogFileHelper;
use App\PhotographyPackage;
use App\PhotographyOptions;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;



class PhotographyPackageController extends Controller
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
        $photography_title = Input::get('title');
        $pageTitle = "Photography Informations";
        $data = PhotographyPackage::paginate(7);
        return view('admin::photography_package.index',['data'=>$data, 'pageTitle'=>$pageTitle]);
    }


    public function photography_search(){

        $pageTitle = 'Photography Informations';
        $title = Input::get('title');
        $data = PhotographyPackage::where('title', 'LIKE', '%'.$title.'%')->paginate(7);

        return view('admin::photography_package.index',['data' => $data,'pageTitle'=>$pageTitle]);
    }



    public function store(Requests\PhotographyPackageRequest $request)
    {
        $input = $request->all();

        // input data for head
        $input_head =[
            'title'=>$input['title'],
            'price'=>$input['price']
        ];

        // input data for detail
        for($i=0; $i<count($input['items']); $i++){
            $i_detail[] = array(
                'items'=>$input['items'][$i],
                'description'=>$input['description'][$i]
            );
        }

        /* Transaction Start Here */
        DB::beginTransaction();
        try {
            //insert into head table
            $vh = PhotographyPackage::create($input_head);

            // Store data into voucher detail
            foreach($i_detail as $value){

                if($value['items'] != null) {

                    //detail data
                    $data = [
                        'photography_package_id' => $vh['id'],
                        'items' => $value['items'],
                        'description' => $value['description'],
                    ];
                    // insert data into voucher detail table
                    PhotographyOptions::create($data);
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

        return redirect()->route('photography-package');
    }


    public function show($id)
    {
        $pageTitle = 'Photography Informations';
        $pageTitleOptions = 'Options';
        $model = new PhotographyPackage();
        $data = $model->with('relPhotographyPackage')->where('id',$id)->get();

        //print_r($data);exit;

        return view('admin::photography_package.view', ['data' => $data, 'pageTitle'=> $pageTitle, 'pageTitleOptions'=> $pageTitleOptions]);
    }

    public function edit($id)
    {
        $pageTitle = "Update Photography Package Informations";
        $model = new PhotographyPackage();
        $data = $model->with('relPhotographyPackage')->where('id',$id)->get();

        return view('admin::photography_package.update', ['data' => $data,'pageTitle'=> $pageTitle]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();


        // input data for head
        $input_head =[
            'id'=>@$id,
            'title'=>@$input['title'],
            'price'=>$input['price']
        ];



        // input data for detail
        for($i=0; $i<count($input['items']); $i++){
            $i_detail[] = array(
                'dt_id'=>@$input['dt_id'][$i],
                'items'=>@$input['items'][$i],
                'description'=>@$input['description'][$i],
            );
        }

        /* Transaction Start Here */
        DB::beginTransaction();
        try {
            //insert into voucher head table
            $vh_model = PhotographyPackage::findOrNew($id);
            $vh = $vh_model->update($input_head);
            //print_r($vh_model);exit;
            // Store data into voucher detail
            foreach($i_detail as $value){
                $dt_model = $value['dt_id'] ? PhotographyOptions::findOrNew($value['dt_id']) : new PhotographyOptions();


                if($value['items'] !=null ){

                    //detail data
                    $data = [
                        'photography_package_id'=>$id,
                        'items'=> $value['items'],
                        'description'=> $value['description'],
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

        return redirect()->route('photography-package');
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $model_package = PhotographyOptions::where('photography_package_id',$id)->get();
            foreach($model_package as $value) {
                $case = PhotographyOptions::find($value['id']);
                $case->delete();
                DB::commit();
            }

        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('flash_message_error', 'Invalid Delete Process !');
        }

        $model_package = PhotographyPackage::where('id',$id)->first();

        DB::beginTransaction();
        try {
            if ($model_package->delete()) {
                DB::commit();
                Session::flash('message', 'Successfully deleted!');
            }
        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('flash_message_error', 'Invalid Delete Process !');
        }


        return redirect()->route('photography-package');
    }

}