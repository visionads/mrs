<?php
namespace Modules\Main\Controllers;
use App\DigitalMedia;
use App\GenerateNumber;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\LocalMedia;
use App\LocalMediaOptions;
use App\PhotographyPackage;
use App\PrintMaterial;
use App\PrintMaterialDistribution;
use App\PrintMaterialSize;
use App\PropertyDetail;
use App\Quote;
use App\QuoteDigitalMedia;
use App\QuoteLocalMedia;
use App\QuotePhotography;
use App\QuotePrintMaterial;
use App\QuoteSignboard;
use App\SignboardPackage;
use App\SignboardPackageSize;
use App\SolutionType;
use App\UserImage;
use Auth;
use DB;
use Illuminate\Http\Request;
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
    public function view_quote()
    {
        $pageTitle = 'MRS - View Quotes';
        $data = Quote::with('relSolutionType')->orderBy('id','DESC')->paginate(10);
        return view('main::quote.view_quote',['pageTitle'=>$pageTitle, 'data'=>$data]);
    }
    public function quote_details($id)
    {
        $pageTitle = 'MRS - Quote Details';
        $user_image = UserImage::where('user_id',Auth::user()->id)->first();
        $data['solution_types']= SolutionType::get();
        $data['photography_packages']= PhotographyPackage::with('relPhotographyPackage')->get();
        $data['signboard_packages']= SignboardPackage::with('relSignboardPackage')->get();
        $data['print_materials']= PrintMaterial::with('relPrintMaterial')->get();
        $data['local_medias']= LocalMedia::with('relLocalMedia')->get();
        $data['digital_medias']= DigitalMedia::get();
        $data['quote']= Quote::where('id',$id)->with('relPropertyDetail','relPrintMaterialDistribution','relQuotePhotography','relQuoteSignboard','relQuotePrintMaterial','relQuoteDigitalMedia','relQuoteLocalMedia')->first();
//        dd($data['quote']);
        return view('main::quote.details',['pageTitle'=>$pageTitle,'user_image'=>$user_image,'data'=>$data]);
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
//        dd($data['signboard_packages']);
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
    public function retrieve_details_demo($quote_id, $quote_number)
    {
        $pageTitle = 'MRS - Quote Details';
        $quote = Quote::with(
            'relPropertyDetail',
            'relPrintMaterialDistribution' ,
            'relQuoteLocalMedia',
            'relQuotePhotography',
            'relQuoteSignboard',
            'relQuotePrintMaterial'
            )->where('id', $quote_id)->first();

        // To get the selling_price from property_details table
        //$selling_price = $quote->relPropertyDetail ? $quote->relPropertyDetail->selling_price: '0.00';
        $vendor_name = $quote->relPropertyDetail ? $quote->relPropertyDetail->vendor_name: null;
        $vendor_phone = $quote->relPropertyDetail ? $quote->relPropertyDetail->vendor_phone: null;
        $vendor_signature_path = $quote->relPropertyDetail ? $quote->relPropertyDetail->vendor_signature_path: null;
        $agent_signature_path = $quote->relPropertyDetail ? $quote->relPropertyDetail->agent_signature_path: null;
        $agent_signature_date = $quote->relPropertyDetail ? $quote->relPropertyDetail->signature_date: null;

        // For Local Media Price ------------------------------------------
        $local_media_price = 0;
        foreach($quote->relQuoteLocalMedia as $local_media_p)
        {
            $local_media_price += $local_media_p->price;
        }

        // For Photography Price ----------------------------------------
        $photography_price = 0;
        foreach($quote->relQuotePhotography as $photography_p)
        {
            $photography_price += $photography_p->price;
        }

        // For Signboard Price ------------------------------------------
        $signboard_price = 0;
        foreach($quote->relQuoteSignboard as $signboard_p)
        {
            $signboard_price +=  $signboard_p->price;
        }

        // For Print Material Price -------------------------------------
        $print_material_price = 0;
        foreach($quote->relQuotePrintMaterial as $print_material_p)
        {
            $print_material_price += $print_material_p->price;
        }

        // For Total Selling Price --------------------------------------
        $selling_price = $local_media_price + $photography_price + $signboard_price + $print_material_price;

        // For Goods Service Tax ----------------------------------------
        $gst = $selling_price * 0.1;
        $total_with_gst = $selling_price + $gst;

        // Return to view Page-------------------------------------------
        return view('main::quote.retrieve_quote_details',[
            'pageTitle'=>$pageTitle,
            'quote'=>$quote,
            'quote_number'=>$quote_number,
            'total'=>$selling_price,
            'gst'=>$gst,
            'total_with_gst'=>$total_with_gst,
            'vendor_name' => $vendor_name,
            'vendor_phone' => $vendor_phone,
            'vendor_signature_path'=>$vendor_signature_path,
            'agent_signature_path'=>$agent_signature_path,
            'agent_signature_date'=>$agent_signature_date,
            'local_media_price' => $local_media_price,
            'photography_price'=>$photography_price,
            'signboard_price'=>$signboard_price,
            'print_material_price'=>$print_material_price
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
            $property_id = PropertyDetail::create($property);
            $data['property_detail_id'] = $property_id->id;
            /*
             * Store Quote
             * */
            $quote_number=GenerateNumber::generate_number('quote-number');
            $data['quote_number']=$quote_number['generated_number'];
//            dd($data);
            $quote=Quote::create($data);
            GenerateNumber::update_row($quote_number['setting_id'],$quote_number['number']);
//            dd($quote->id);
//            $quote=Quote::findOrFail(30);
            /*
             * getting photography info
             * */
            if (isset($received['pro-photographyChooseBtn']) && !empty($received['pro-photographyChooseBtn']) && $received['pro-photographyChooseBtn'] == 1) {
                if(isset($received['photography_package_id']))
                {
                    foreach ($received['photography_package_id'] as $ppi) {
                        $qp=new QuotePhotography;
                        $qp->quote_id=$quote->id;
                        $qp->price= PhotographyPackage::findOrFail($ppi)->price;
                        $qp->photography_package_id=$ppi;
                        $qp->save();
                    }
                }
                $data['photography_package_id'] = 1;
                $data['photography_package_comments'] = $received['photography_package_comments'];
            }
            /*
             * getting signboard info
             * */
            if (isset($received['signboardChooseBtn']) && !empty($received['signboardChooseBtn']) && $received['signboardChooseBtn'] == 1) {
                if(isset($received['signboard_package_id'])){
                    foreach ($received['signboard_package_id'] as $spi) {
                        $sp=new QuoteSignboard;
                        $sp->quote_id=$quote->id;
                        $sp->signboard_package_id=$spi;
                        if(isset($received['signboard_package_size_id'])){
                            $sp->signboard_size_id=$received['signboard_package_size_id'][$spi];
                            $sp->price=SignboardPackageSize::findOrFail($received['signboard_package_size_id'][$spi])->price;
                        }
                        $sp->save();
                    }
                }
                $data['signboard_package_id'] = 1;
                $data['signboard_package_comments'] = $received['signboard_package_comments'];
            }
            /*
             * getting print material info
             * */
            if (isset($received['printMaterialChooseBtn']) && !empty($received['printMaterialChooseBtn']) && $received['printMaterialChooseBtn'] == 1) {
                if(isset($received['print_material_id'])){
                    foreach ($received['print_material_id'] as $pmi) {
                        $pm=new QuotePrintMaterial;
                        $pm->quote_id=$quote->id;
                        $pm->print_material_id=$pmi;
                        if(isset($received['print_material_size_id']))
                        {
                            $pm->print_material_size_id = $received['print_material_size_id'][$pmi];
                            $pm->price=PrintMaterialSize::findOrFail($received['print_material_size_id'][$pmi])->price;
                        }
                        if(isset($received['is_distributed']))
                        {
                            if(isset($received['is_distributed'][$pmi]))
                            {
                                $pm->is_distributed = 1;
                            }else{
                                $pm->is_distributed = 0;
                            }
                        }
                        $pm->save();
                    }
                }
                $data['print_material_id'] = 1;
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
                    foreach ($received['digital_media_id'] as $dmi) {
                        $dm= new QuoteDigitalMedia;
                        $dm->quote_id= $quote->id;
                        $dm->digital_media_id=$dmi;
                        $dm->save();
                    }
                }
                $data['digital_media_id'] = 1;
                $data['digital_media_note'] = $received['digital_media_note'];
            }
            /*
             * getting local media info
             * */
            if (isset($received['localMediaChooseBtn']) && !empty($received['localMediaChooseBtn']) && $received['localMediaChooseBtn'] == 1) {
                if(isset($received['local_media_id']))
                {
//                    dd($received);
                    foreach ($received['local_media_id'] as $lmi) {
                        $lm= new QuoteLocalMedia;
                        $lm->quote_id=$quote->id;
                        $lm->local_media_id=$lmi;
                        if(isset($received['local_media_option_id']))
                        {
                            $lm->local_media_option_id = $received['local_media_option_id'][$lmi];
                            $lm->price= LocalMediaOptions::findOrFail($received['local_media_option_id'][$lmi])->price;
                        }
                        $lm->save();
                    }
                }
                $data['local_media_id'] = 1;
                $data['local_media_note'] = $received['local_media_note'];
            }
//            dd($received);
            $quote->update($data);
            \DB::commit();
            Session::flash('message','Data has been successfully stored');
            if(isset($received['quote']))
            {
                return Redirect::to('main/quote-details/'.$quote->id.'/'.$quote->quote_number);
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
        $data['quote']= Quote::where('id',$id)->with('relPropertyDetail','relPrintMaterialDistribution','relQuotePhotography','relQuoteSignboard','relQuotePrintMaterial','relQuoteDigitalMedia','relQuoteLocalMedia')->first();
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
        $received=$request->except('_token','_method');
        $quote= Quote::find($id);
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

                    //QuotePhotography::where('quote_id',$quote->id)->delete();
                    $quote_photography = QuotePhotography::where('quote_id',$quote->id)->get();
                    if(count($quote_photography)>0)
                    {
                        QuotePhotography::where('quote_id',$quote->id)->delete();
                    }
                    foreach ($received['photography_package_id'] as $ppi) {
                        $qp=new QuotePhotography;
                        $qp->quote_id=$quote->id;
                        $qp->price= PhotographyPackage::findOrFail($ppi)->price;
                        $qp->photography_package_id=$ppi;
                        $qp->save();
                    }
                }
                $data['photography_package_id'] = 1;
                $data['photography_package_comments'] = $received['photography_package_comments'];
            }else{
                //QuotePhotography::where('quote_id',$quote->id)->delete();
                $quote_photography = QuotePhotography::where('quote_id',$quote->id)->get();
                if(count($quote_photography)>0)
                {
                    QuotePhotography::where('quote_id',$quote->id)->delete();
                }
                $data['photography_package_id'] = null;
                $data['photography_package_comments'] = '';
            }

            /*
             * getting signboard info
             * */
            if (isset($received['signboardChooseBtn']) && !empty($received['signboardChooseBtn']) && $received['signboardChooseBtn'] == 1) {
                if(isset($received['signboard_package_id'])){
                    //QuoteSignboard::where('quote_id',$quote->id)->delete();
                    $quote_signboard = QuoteSignboard::where('quote_id',$quote->id)->get();
                    if(count($quote_signboard)>0)
                    {
                        QuoteSignboard::where('quote_id',$quote->id)->delete();
                    }
                    foreach ($received['signboard_package_id'] as $spi) {
                        $sp=new QuoteSignboard;
                        $sp->quote_id=$quote->id;
                        $sp->signboard_package_id=$spi;
                        if(isset($received['signboard_package_size_id'])){
                            $sp->signboard_size_id=$received['signboard_package_size_id'][$spi];
                            $sp->price=SignboardPackageSize::findOrFail($received['signboard_package_size_id'][$spi])->price;
                        }
                        $sp->save();
                    }
                }
                $data['signboard_package_id'] = 1;
                $data['signboard_package_comments'] = $received['signboard_package_comments'];
            }else{
                //QuoteSignboard::where('quote_id',$quote->id)->delete();
                $quote_signboard = QuoteSignboard::where('quote_id',$quote->id)->get();
                if(count($quote_signboard)>0)
                {
                    QuoteSignboard::where('quote_id',$quote->id)->delete();
                }
                $data['signboard_package_id'] = null;
                $data['signboard_package_comments'] = '';
            }

            /*
             * getting print material info
             * */
            if (isset($received['printMaterialChooseBtn']) && !empty($received['printMaterialChooseBtn']) && $received['printMaterialChooseBtn'] == 1) {
                if(isset($received['print_material_id'])){
                    //QuotePrintMaterial::where('quote_id',$quote->id)->delete();
                    $quote_print_material = QuotePrintMaterial::where('quote_id',$quote->id)->get();
                    if(count($quote_print_material)>0)
                    {
                        QuotePrintMaterial::where('quote_id',$quote->id)->delete();
                    }
                    foreach ($received['print_material_id'] as $pmi) {
                        $pm=new QuotePrintMaterial;
                        $pm->quote_id=$quote->id;
                        $pm->print_material_id=$pmi;
                        if(isset($received['print_material_size_id']))
                        {
                            $pm->print_material_size_id = $received['print_material_size_id'][$pmi];
                            $pm->price=PrintMaterialSize::findOrFail($received['print_material_size_id'][$pmi])->price;
                        }

                        if(isset($received['is_distributed']))
                        {
                            if(isset($received['is_distributed'][$pmi]))
                            {
                                $pm->is_distributed = 1;
                            }else{
                                $pm->is_distributed = 0;
                            }
                        }
                        $pm->save();
                    }
                }
                $data['print_material_id'] = 1;
                $data['print_material_comments'] = $received['print_material_comments'];
            }else{
                //QuotePrintMaterial::where('quote_id',$quote->id)->delete();
                $quote_print_material = QuotePrintMaterial::where('quote_id',$quote->id)->get();
                if(count($quote_print_material)>0)
                {
                    QuotePrintMaterial::where('quote_id',$quote->id)->delete();
                }
                $data['print_material_id'] = null;
                $data['print_material_comments'] = '';
            }

            /*
             * getting distributed print material info
             * */
            if (isset($received['distributedPrintMaterialChooseBtn']) && !empty($received['distributedPrintMaterialChooseBtn']) && $received['distributedPrintMaterialChooseBtn'] == 1) {
                $distribution['quantity'] = $received['quantity'];
                $distribution['note'] = $received['note'];
                if(!empty($quote->print_material_distribution_id)) {
                    $distribution_id = PrintMaterialDistribution::find($quote->print_material_distribution_id);
                    $distribution_id->update($distribution);
                }
                //exit('kjkdjfk');
            }else{
                $distribution_id=PrintMaterialDistribution::find($quote->print_material_distribution_id);

                if(count($distribution_id)>0)
                {
                    $distribution_id->delete();
                }
                $data['print_material_distribution_id']=null;
            }

            /*
             * getting distributed print material info
             * */
            if (isset($received['digitalMediaChooseBtn']) && !empty($received['digitalMediaChooseBtn']) && $received['digitalMediaChooseBtn'] == 1) {
                if(isset($received['digital_media_id']))
                {
                    $quote_dgital_media = QuoteDigitalMedia::where('quote_id',$quote->id)->get();
                    if(count($quote_dgital_media)>0){
                        QuoteDigitalMedia::where('quote_id',$quote->id)->delete();
                    }
                    foreach ($received['digital_media_id'] as $dmi) {
                        $dm= new QuoteDigitalMedia;
                        $dm->quote_id= $quote->id;
                        $dm->digital_media_id=$dmi;
                        $dm->save();
                    }
                }
                $data['digital_media_id'] = 1;
                $data['digital_media_note'] = $received['digital_media_note'];
            }else{
                //QuoteDigitalMedia::where('quote_id',$quote->id)->delete();
                $quote_digital_media = QuoteDigitalMedia::where('quote_id',$quote->id)->get();
                if(count($quote_digital_media)>0){
                    QuoteDigitalMedia::where('quote_id',$quote->id)->delete();
                }
                $data['digital_media_id'] = null;
                $data['digital_media_note'] = '';
            }

            /*
             * getting local media info
             * */
            if (isset($received['localMediaChooseBtn']) && !empty($received['localMediaChooseBtn']) && $received['localMediaChooseBtn'] == 1) {
                if(isset($received['local_media_id']))
                {
//                    dd($received);

                    $quote_local_media = QuoteLocalMedia::where('quote_id',$quote->id)->get();
                    //dd($quote_local_media);
                    if(count($quote_local_media)>0)
                    {
                        QuoteLocalMedia::where('quote_id',$quote->id)->delete();
                    }

                    foreach ($received['local_media_id'] as $lmi) {
                        $lm= new QuoteLocalMedia;
                        $lm->quote_id=$quote->id;
                        $lm->local_media_id=$lmi;
                        if(isset($received['local_media_option_id']))
                        {
                            $lm->local_media_option_id = $received['local_media_option_id'][$lmi];
                            $lm->price= LocalMediaOptions::findOrFail($received['local_media_option_id'][$lmi])->price;
                        }
                        $lm->save();
                    }
                }
                $data['local_media_id'] = 1;
                $data['local_media_note'] = $received['local_media_note'];
            }else{
                //QuoteLocalMedia::where('quote_id',$quote->id)->delete();

                $quote_local_media = QuoteLocalMedia::where('quote_id',$quote->id)->get();

                if(count($quote_local_media)>0)
                {
                    QuoteLocalMedia::where('quote_id',$quote->id)->delete();
                }
                $data['local_media_id'] = null;
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