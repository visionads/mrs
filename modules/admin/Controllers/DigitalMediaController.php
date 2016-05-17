<?php

namespace Modules\Admin\Controllers;

use App\Helpers\LogFileHelper;
use App\DigitalMedia;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;




class DigitalMediaController extends Controller
{
    public function index(){
        //$data = SolutionType::orderBy('id','DESC')->paginate();
        $pageTitle = "Digital Media";
        $data = DB::table('digital_media')->orderBy('id','DESC')->paginate(30);
        return view('admin::digital_media.index',['data'=>$data,'pageTitle'=>$pageTitle]);
    }

    public function store(Requests\DigitalMediaRequest $request)
    {
        $input = $request->all();
        $model = new DigitalMedia();
        DB::beginTransaction();
        try{
            $model->create($input);
            DB::commit();
            Session::flash('message', 'Successfully added!');
        }catch(\Exception $e){
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }
        return redirect()->back();

    }

    public function show($id)
    {
        $pageTitle = 'Digital Media';
        $data = DigitalMedia::where('id',$id)->first();
        return view('admin::digital_media.view',['data'=>$data,'pageTitle'=>$pageTitle]);
    }

    public function search()
    {
        $pageTitle = 'Digital Media Search';
        $title = Input::get('title');
        $url = Input::get('url');
        //$srcresult = new DigitalMedia();
        $srcresult = DB::table('digital_media');
        if($title)
        {
            $srcresult = $srcresult->where('title','LIKE', '%'.$title.'%');
        }
        if($url)
        {
            $srcresult = $srcresult->where('url','LIKE','%'.$url.'%');
        }
        $srcresult = $srcresult->paginate(30);

        //$srcresult = DigitalMedia::where('title','LIKE', '%'.$itemval.'%')->orWhere('url','LIKE','%'.$itemval.'%')->paginate(30);
        return view('admin::digital_media.index',['data'=>$srcresult,'pageTitle'=>$pageTitle]);
    }

    public function edit($id)
    {
        $pageTitle = 'Digital Media';
        $data = DigitalMedia::where('id',$id)->first();
        return view('admin::digital_media.update',['data'=>$data,'pageTitle'=>$pageTitle]);
    }

    public function update(Request $request,$id)
    {
        $model = DigitalMedia::where('id',$id)->first();
        $input = $request->all();
        DB::beginTransaction();
        try{
            $model->update($input);
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->back();

    }

    public function destroy($id)
    {
        $model = DigitalMedia::findOrFail($id);
        DB::beginTransaction();
        try{
            $model->delete();
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
        }
        return redirect()->back();
    }

}