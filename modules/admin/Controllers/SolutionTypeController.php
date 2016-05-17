<?php

namespace Modules\Admin\Controllers;

use App\Helpers\LogFileHelper;
use App\SolutionType;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;




class SolutionTypeController extends Controller
{
    public function index(){
        //$data = SolutionType::orderBy('id','DESC')->paginate();
        $pageTitle = "Solution Type";
        $data = DB::table('solution_type')->orderBy('id','DESC')->paginate(30);
        return view('admin::solution_type.index',['data'=>$data,'pageTitle'=>$pageTitle]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        DB::beginTransaction();
        try{
            SolutionType::create($input);
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
        return redirect()->back();

    }

    public function show($id)
    {
        $pageTitle = 'Solution Type';
        $data = SolutionType::where('id',$id)->first();
        return view('admin::solution_type.view',['data'=>$data,'pageTitle'=>$pageTitle]);
    }

    public function search()
    {
        $pageTitle = 'Solution Type Search';
        $title = Input::get('title');
        $description = Input::get('description');
        $srcresult = DB::table('solution_type');
        if($title)
        {
            $srcresult = $srcresult->where('title','LIKE', '%'.$title.'%');
        }
        if($description)
        {
            $srcresult = $srcresult->Where('description','LIKE','%'.$description.'%');
        }
        $srcresult = $srcresult->paginate(30);
        //$srcresult = DigitalMedia::where('title','LIKE', '%'.$itemval.'%')->orWhere('url','LIKE','%'.$itemval.'%')->paginate(30);
        return view('admin::solution_type.index',['data'=>$srcresult,'pageTitle'=>$pageTitle]);
    }

    public function edit($id)
    {
        $pageTitle = 'Solution Type';
        $data = SolutionType::where('id',$id)->first();
        return view('admin::solution_type.update',['data'=>$data,'pageTitle'=>$pageTitle]);
    }

    public function update(Request $request,$id)
    {
        $model = SolutionType::where('id',$id)->first();
        $input = $request->all();
        DB::beginTransaction();
        try{
            $model->update($input);
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
        return redirect()->back();

    }

    public function destroy($id)
    {
        $model = SolutionType::findOrFail($id);
        DB::beginTransaction();
        try{
            $model->delete();
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
        return redirect()->back();
    }

}