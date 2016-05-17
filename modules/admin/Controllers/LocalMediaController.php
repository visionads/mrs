<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 5/8/16
 * Time: 11:52 AM
 */

namespace Modules\Admin\Controllers;

use App\Helpers\LogFileHelper;
use App\LocalMedia;
use App\LocalMediaOptions;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;



class LocalMediaController extends Controller
{

    protected function isGetRequest()
    {
        return Input::server("REQUEST_METHOD") == "GET";
    }
    protected function isPostRequest()
    {
        return Input::server("REQUEST_METHOD") == "POST";
    }

    public function index(){
        //$data = SolutionType::orderBy('id','DESC')->paginate();
        $pageTitle = "Local Media";
        $data = DB::table('local_media')->orderBy('id','DESC')->paginate(30);
        return view('admin::local_media.index',['data'=>$data,'pageTitle'=>$pageTitle]);
    }

    public function store(Requests\LocalMediaRequest $request)
    {
        $input = $request->all();

        // input data for head
        $input_head =[
            'title'=>$input['title'],
            'description'=>$input['description']
        ];

        // input data for detail
        for($i=0; $i<count($input['title_option']); $i++)
        {
            $i_detail[] = array(
                'title'=>$input['title_option'][$i],
                'price'=>$input['price'][$i]
            );
        }

        /* Transaction Start Here */
        DB::beginTransaction();
        try {
            //insert into head table
            $vh = LocalMedia::create($input_head);

            // Store data into voucher detail
            foreach($i_detail as $value){

                if($value['title'] != null) {

                    //detail data
                    $data = [
                        'local_media_id' => $vh['id'],
                        'title' => $value['title'],
                        'price' => $value['price'],
                    ];
                    // insert data into voucher detail table
                    LocalMediaOptions::create($data);
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
        return redirect()->route('local-media');

    }

    public function show($id)
    {
        $pageTitle = 'Local Media';
        $pageTitleOptions = 'Options';
        $model = new LocalMedia();
        $data = $model->with('relLocalMedia')->where('id',$id)->get();
        return view('admin::local_media.view',['data'=>$data,'pageTitle'=>$pageTitle,'pageTitleOptions'=> $pageTitleOptions]);
    }

    public function search()
    {
        $pageTitle = 'Local Media Search';
        $title = Input::get('title');
        $description = Input::get('description');
        $srcresult = DB::table('local_media');
        if($title)
        {
            $srcresult = $srcresult->where('title','LIKE', '%'.$title.'%');
        }
        if($description)
        {
            $srcresult = $srcresult->where('description','LIKE','%'.$description.'%');
        }
        $srcresult = $srcresult->paginate(30);

        //$srcresult = DigitalMedia::where('title','LIKE', '%'.$itemval.'%')->orWhere('url','LIKE','%'.$itemval.'%')->paginate(30);
        return view('admin::local_media.index',['data'=>$srcresult,'pageTitle'=>$pageTitle]);
    }

    public function edit($id)
    {
        $pageTitle = "Local Media";
        $model = new LocalMedia();
        $data = $model->with('relLocalMedia')->where('id',$id)->get();

        return view('admin::local_media.update', ['data' => $data,'pageTitle'=> $pageTitle]);
    }

    public function update(Request $request,$id)
    {
        $input = $request->all();


        // input data for head
        $input_head =[
            'id'=>@$id,
            'title'=>@$input['title'],
            'description'=>$input['description']
        ];

        // input data for detail
        for($i=0; $i<count($input['title_option']); $i++){
            $i_detail[] = array(
                'dt_id'=>@$input['dt_id'][$i],
                'title'=>@$input['title_option'][$i],
                'price'=>@$input['price'][$i],
            );
        }

        /* Transaction Start Here */
        DB::beginTransaction();
        try {
            //insert into voucher head table
            $vh_model = LocalMedia::findOrNew($id);
            $vh = $vh_model->update($input_head);
            //print_r($vh_model);exit;
            // Store data into voucher detail
            foreach($i_detail as $value){
                $dt_model = $value['dt_id'] ? LocalMediaOptions::findOrNew($value['dt_id']) : new LocalMediaOptions();

                if($value['title'] !=null ){

                    //detail data
                    $data = [
                        'local_media_id'=>$id,
                        'title'=> $value['title'],
                        'price'=> $value['price'],
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

        return redirect()->route('local-media');

    }

    public function destroy($id)
    {
        /*
        $model = LocalMedia::findOrFail($id);
        DB::beginTransaction();
        try{
            $model->delete();
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }*/
        DB::beginTransaction();
        try {
            $model_package = LocalMediaOptions::where('local_media_id',$id)->get();
            foreach($model_package as $value) {
                $case = LocalMediaOptions::find($value['id']);
                $case->delete();
                DB::commit();
            }

        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('flash_message_error', 'Invalid Delete Process !');
        }

        $model_package = LocalMedia::where('id',$id)->first();

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


        return redirect()->route('local-media');
        //return redirect()->back();
    }

}