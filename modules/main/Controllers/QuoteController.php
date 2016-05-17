<?php

namespace Modules\Main\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\UserImage;
use App\SolutionType;
use App\SignboardPackage;
use App\PhotographyPackage;
use App\PrintMaterial;
use App\DigitalMedia;
use App\LocalMedia;
use Auth;
use DB;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'MRS - Quote';
        $user_image = UserImage::where('user_id',Auth::user()->id)->first();
        $data['solution_types']= SolutionType::get();
        $data['photography_packages']= PhotographyPackage::with('relPhotographyPackage')->get();
        $data['signboard_packages']= SignboardPackage::with('relSignboardPackage')->get();
        $data['print_materials']= PrintMaterial::with('relPrintMaterial')->get();
        $data['local_medias']= LocalMedia::with('relLocalMedia')->get();
        $data['digital_medias']= DigitalMedia::get();
//        dd($data['photography_packages']);
        return view('main::quote.create',['pageTitle'=>$pageTitle,'user_image'=>$user_image,'data'=>$data]);
    }


    public function retrieve()
    {
        $pageTitle = 'MRS - Retrieve Quote';
        $data = DB::table('quote')->orderBy('id','DESC')->paginate(30);
        return view('main::quote.retrieve_quote',['pageTitle'=>$pageTitle, 'data'=>$data]);
    }

    public function retrieve_details($id)
    {
        $pageTitle = 'MRS - Retrieve Quote Details';
        $data = DB::table('quote')-where('id', $id)->orderBy('id','DESC')->get();
        return view('main::quote.retrieve_quote',['pageTitle'=>$pageTitle, 'data'=>$data]);
    }
    public function retrieve_details_demo()
    {
        $pageTitle = 'MRS - Retrieve Quote Details-demo';
        $data = '';
        return view('main::quote.retrieve_quote_details',['pageTitle'=>$pageTitle, 'data'=>$data]);
    }

    public function quote_summary()
    {
        $pageTitle = 'Summary of Marketing';
        $data = '';
        return view('main::quote.quote_summary',['pageTitle'=>$pageTitle, 'data'=>$data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
