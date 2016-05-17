<?php

namespace Modules\Admin\Controllers;

use App\Helpers\LogFileHelper;
use App\PrintMaterialDistribution;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;




class PrintMaterialDistributionController extends Controller
{
    public function index(){
        //$data = SolutionType::orderBy('id','DESC')->paginate();
        $pageTitle = "Print Material Distribution";
        $data = DB::table('print_material_distribution')->orderBy('id','DESC')->paginate(30);
        return view('admin::print_material_distribution.index',['data'=>$data,'pageTitle'=>$pageTitle]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $model = new PrintMaterialDistribution();
        DB::beginTransaction();
        try{
            $model->create($input);
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
        }
        return redirect()->back();

    }

    public function show($id)
    {
        $pageTitle = 'Print Material Distribution';
        $data = PrintMaterialDistribution::where('id',$id)->first();
        return view('admin::print_material_distribution.view',['data'=>$data,'pageTitle'=>$pageTitle]);
    }

    public function search()
    {
        $pageTitle = 'Print Material Distribution Search Result';
        $quantity = Input::get('quantity');
        //$url = Input::get('url');
        $surrounded = Input::get('is_surrounded');
        //return $surrounded;
        //exit();
        //$srcresult = new DigitalMedia();
        $srcresult = DB::table('print_material_distribution');
        if($quantity)
        {
            $srcresult = $srcresult->where('quantity','LIKE', '%'.$quantity.'%');
        }
        if($surrounded)
        {
            $srcresult = $srcresult->where('is_surrounded','LIKE','%'.$surrounded.'%');
        }
        $srcresult = $srcresult->paginate(30);

        //$srcresult = DigitalMedia::where('title','LIKE', '%'.$itemval.'%')->orWhere('url','LIKE','%'.$itemval.'%')->paginate(30);
        return view('admin::print_material_distribution.index',['data'=>$srcresult,'pageTitle'=>$pageTitle]);
    }

    public function edit($id)
    {
        $pageTitle = 'Print Material Distribution';
        $data = PrintMaterialDistribution::where('id',$id)->first();
        return view('admin::print_material_distribution.update',['data'=>$data,'pageTitle'=>$pageTitle]);
    }

    public function update(Request $request,$id)
    {
        $model = PrintMaterialDistribution::where('id',$id)->first();
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
        $model = PrintMaterialDistribution::findOrFail($id);
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