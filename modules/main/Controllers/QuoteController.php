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
use App\PropertyDetail;
use App\Quote;
use App\PrintMaterialDistribution;
use Auth;
use DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Mockery\CountValidator\Exception;

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
//        $data = DB::table('quote')->orderBy('id','DESC')->paginate(30);
        $data = Quote::with('relSolutionType')->orderBy('id','DESC')->paginate(30);
//        dd($data);
        return view('main::quote.retrieve_quote',['pageTitle'=>$pageTitle, 'data'=>$data]);
    }

    public function retrieve_details($id)
    {
        $pageTitle = 'MRS - Retrieve Quote Details';
        $data = DB::table('quote')->where('id', $id)->orderBy('id','DESC')->get();
        return view('main::quote.retrieve_quote',['pageTitle'=>$pageTitle, 'data'=>$data]);
    }
    public function retrieve_details_demo($quote_id, $quote_number)
    {

        $pageTitle = 'MRS - Retrieve Quote Details-demo';
        $quote = Quote::with('relPropertyDetail', 'relPrintMaterialDistribution')->where('id', $quote_id)->get();
        return view('main::quote.retrieve_quote_details',[
            'pageTitle'=>$pageTitle,
            'quote'=>$quote
        ]);
    }

    public function quote_summary($quote_id, $quote_number)
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
        \DB::beginTransaction();
        $received=$request->except('_token');

        try {
            $data['solution_type_id'] = $received['solution_type_id'];

            /*
             * store property details
             * */
            $property['owner_name'] = $received['owner_name'];
            $property['address'] = $received['address'];
            $property['vendor_name'] = $received['vendor_name'];
            $property['vendor_email'] = $received['vendor_email'];
            $property['vendor_phone'] = $received['vendor_phone'];
            $property_id = PropertyDetail::create($property);
            $data['property_detail_id'] = $property_id->id;

            /*
             * getting photography info
             * */
            if (isset($received['pro-photographyChooseBtn']) && !empty($received['pro-photographyChooseBtn']) && $received['pro-photographyChooseBtn'] == 1) {
                if(isset($received['photography_package_id']))
                {
                    $data['photography_package_id'] = $received['photography_package_id'];
                }
                $data['photography_package_comments'] = $received['photography_package_comments'];
            }
            /*
             * getting signboard info
             * */
            if (isset($received['signboardChooseBtn']) && !empty($received['signboardChooseBtn']) && $received['signboardChooseBtn'] == 1) {
                if(isset($received['signboard_package_id'])){

                    $data['signboard_package_id'] = $received['signboard_package_id'];

                    if(isset($received['signboard_package_size_id'])){

                        $data['signboard_package_size_id'] = $received['signboard_package_size_id'][$received['signboard_package_id']];
                    }
                }
                $data['signboard_package_comments'] = $received['signboard_package_comments'];
            }
            /*
             * getting print material info
             * */
            if (isset($received['printMaterialChooseBtn']) && !empty($received['printMaterialChooseBtn']) && $received['printMaterialChooseBtn'] == 1) {
                if(isset($received['print_material_id'])){
                    $data['print_material_id'] = $received['print_material_id'];

                    if(isset($received['print_material_size_id']))
                    {

                        $data['print_material_size_id'] = $received['print_material_size_id'][$received["print_material_id"]];
                    }
                }
                if(isset($received['is_distributed']))
                {
                    foreach ($received['is_distributed'] as $print_id) {
                        if($print_id==$received['print_material_id'])
                        {
                            $data['is_distributed'] = 1;
                        }else{
                            $data['is_distributed'] = 0;
                        }
                    }

                }
                $data['print_material_comments'] = $received['print_material_comments'];
            }
            /*
             * getting distributed print material info
             * */
            if (isset($received['distributedPrintMaterialChooseBtn']) && !empty($received['distributedPrintMaterialChooseBtn']) && $received['distributedPrintMaterialChooseBtn'] == 1) {
                $distribution['quantity'] = $received['quantity'];
                $distribution['note'] = $received['note'];
                $distribution_id=PrintMaterialDistribution::create($distribution);
                $data['print_material_distribution_id']=$distribution_id->id;

            }
            /*
             * getting distributed print material info
             * */
            if (isset($received['digitalMediaChooseBtn']) && !empty($received['digitalMediaChooseBtn']) && $received['digitalMediaChooseBtn'] == 1) {
                if(isset($received['digital_media_id']))
                {
                    $data['digital_media_id'] = $received['digital_media_id'];
                }
                $data['digital_media_note'] = $received['digital_media_note'];
            }
            /*
             * getting local media info
             * */
            if (isset($received['localMediaChooseBtn']) && !empty($received['localMediaChooseBtn']) && $received['localMediaChooseBtn'] == 1) {
                if(isset($received['local_media_id']))
                {
                    $data['local_media_id'] = $received['local_media_id'];

                    if(isset($received['local_media_option_id']))
                    {
                        $data['local_media_option_id'] = $received['local_media_option_id'][$received['local_media_id']];
                    }
                }
                $data['local_media_note'] = $received['local_media_note'];
            }
//            dd($data);
            Quote::create($data);
            \DB::commit();
            Session::flash('message','Data has been successfully stored');
            if(isset($received['quote']))
            {
                return Redirect::to('main/place-order');
            }else{
                return Redirect::to('main/quote-list');
            }

        }catch (Exception $e)
        {
            \DB::rollback();
            Session::flash('danger',$e->getMessage());
            return Redirect::back();
        }
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
        $pageTitle = 'MRS - Edit Quote';
        $user_image = UserImage::where('user_id',Auth::user()->id)->first();
        $data['solution_types']= SolutionType::get();
        $data['photography_packages']= PhotographyPackage::with('relPhotographyPackage')->get();
        $data['signboard_packages']= SignboardPackage::with('relSignboardPackage')->get();
        $data['print_materials']= PrintMaterial::with('relPrintMaterial')->get();
        $data['local_medias']= LocalMedia::with('relLocalMedia')->get();
        $data['digital_medias']= DigitalMedia::get();
        $data['quote']= Quote::where('id',$id)->with('relPropertyDetail','relPrintMaterialDistribution')->first();
//        dd($data['quote']);
        return view('main::quote.edit',['pageTitle'=>$pageTitle,'user_image'=>$user_image,'data'=>$data]);
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
        \DB::beginTransaction();
        $received=$request->except('_token');
        $quote= Quote::find($id);
//        dd($received);
        try {
            $data['solution_type_id'] = $received['solution_type_id'];

            /*
             * store property details
             * */
            $property['owner_name'] = $received['owner_name'];
            $property['address'] = $received['address'];
            $property['vendor_name'] = $received['vendor_name'];
            $property['vendor_email'] = $received['vendor_email'];
            $property['vendor_phone'] = $received['vendor_phone'];

            $property_id = PropertyDetail::find($quote->property_detail_id);
            $property_id->update($property);

            /*
             * getting photography info
             * */
            if (isset($received['pro-photographyChooseBtn']) && !empty($received['pro-photographyChooseBtn']) && $received['pro-photographyChooseBtn'] == 1) {
                if(isset($received['photography_package_id']))
                {
                    $data['photography_package_id'] = $received['photography_package_id'];
                }
                $data['photography_package_comments'] = $received['photography_package_comments'];
            }else{
                $data['photography_package_id'] = null;
                $data['photography_package_comments'] = '';
            }
            /*
             * getting signboard info
             * */
            if (isset($received['signboardChooseBtn']) && !empty($received['signboardChooseBtn']) && $received['signboardChooseBtn'] == 1) {
                if(isset($received['signboard_package_id'])){

                    $data['signboard_package_id'] = $received['signboard_package_id'];

                    if(isset($received['signboard_package_size_id'])){

                        $data['signboard_package_size_id'] = $received['signboard_package_size_id'][$received['signboard_package_id']];
                    }
                }
                $data['signboard_package_comments'] = $received['signboard_package_comments'];
            }else{
                $data['signboard_package_id'] = null;
                $data['signboard_package_size_id'] = null;
                $data['signboard_package_comments'] = '';
            }
            /*
             * getting print material info
             * */
            if (isset($received['printMaterialChooseBtn']) && !empty($received['printMaterialChooseBtn']) && $received['printMaterialChooseBtn'] == 1) {
                if(isset($received['print_material_id'])){
                    $data['print_material_id'] = $received['print_material_id'];

                    if(isset($received['print_material_size_id']))
                    {

                        $data['print_material_size_id'] = $received['print_material_size_id'][$received["print_material_id"]];
                    }
                }
                if(isset($received['is_distributed']))
                {
                    foreach ($received['is_distributed'] as $print_id) {
                        if($print_id==$received['print_material_id'])
                        {
                            $data['is_distributed'] = 1;
                        }else{
                            $data['is_distributed'] = 0;
                        }
                    }

                }
                $data['print_material_comments'] = $received['print_material_comments'];
            }else{
                $data['print_material_id'] = null;
                $data['print_material_size_id'] = null;
                $data['is_distributed'] = 0;
                $data['print_material_comments'] = '';

            }
            /*
             * getting distributed print material info
             * */
            if (isset($received['distributedPrintMaterialChooseBtn']) && !empty($received['distributedPrintMaterialChooseBtn']) && $received['distributedPrintMaterialChooseBtn'] == 1) {
                $distribution['quantity'] = $received['quantity'];
                $distribution['note'] = $received['note'];
                $distribution_id=PrintMaterialDistribution::find($quote->print_material_distribution_id);
                $distribution_id->update($distribution);
            }else{
                $distribution_id=PrintMaterialDistribution::find($quote->print_material_distribution_id);
                $distribution_id->delete();
                $data['print_material_distribution_id']=null;
            }
            /*
             * getting distributed print material info
             * */
            if (isset($received['digitalMediaChooseBtn']) && !empty($received['digitalMediaChooseBtn']) && $received['digitalMediaChooseBtn'] == 1) {
                if(isset($received['digital_media_id']))
                {
                    $data['digital_media_id'] = $received['digital_media_id'];
                }
                $data['digital_media_note'] = $received['digital_media_note'];
            }else{
                $data['digital_media_id'] = null;
                $data['digital_media_note'] = '';

            }
            /*
             * getting local media info
             * */
            if (isset($received['localMediaChooseBtn']) && !empty($received['localMediaChooseBtn']) && $received['localMediaChooseBtn'] == 1) {
                if(isset($received['local_media_id']))
                {
                    $data['local_media_id'] = $received['local_media_id'];

                    if(isset($received['local_media_option_id']))
                    {
                        $data['local_media_option_id'] = $received['local_media_option_id'][$received['local_media_id']];
                    }
                }
                $data['local_media_note'] = $received['local_media_note'];
            }else{
                $data['local_media_id'] = null;
                $data['local_media_option_id'] = null;
                $data['local_media_note'] = '';

            }
//            dd($data);
            $quote->update($data);
            \DB::commit();
            Session::flash('message','Data has been successfully updated');
                return Redirect::to('main/quote-list');

        }catch (Exception $e)
        {
            \DB::rollback();
            Session::flash('danger',$e->getMessage());
            return Redirect::back();
        }
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
