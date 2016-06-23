<?php

namespace Modules\Main\Controllers;

use App\GenerateNumber;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use App\Order;
use App\PropertyDetail;
use App\PrintMaterialDistribution;
use App\Quote;
use App\Transaction;
use App\User;
use App\SolutionType;
use App\PhotographyPackage;
use App\SignboardPackage;
use App\PrintMaterial;
use App\LocalMedia;
use App\DigitalMedia;
use Auth;
use DB;
use PhpParser\Node\Stmt\Property;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Helpers\ImageResize;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function quote_confirm($quote_id, $quote_no)
    {
        $pageTitle = 'Agreement';

        //TODO:: Must be calculate price

        return view('main::order.quote_confirm',[
            'pageTitle'=>$pageTitle,
            'quote_id'=>$quote_id,
            'quote_no'=>$quote_no,
            ]);
    }


    public function new_order()
    {

        //exit('new_order');
        $pageTitle = 'MRS - New Order List';
//        $data = DB::table('quote')->orderBy('id','DESC')->paginate(30);
        $role_name = User::getRole(Auth::user()->id) ;
        //print_r(Auth::user()->business_id); exit();
        if($role_name == 'admin' || $role_name == 'super-admin')
        {
            //$data = Quote::with('relSolutionType')->where('business_id', Auth::user()->business_id)->orderBy('id','DESC')->paginate(30);
            $data = Quote::with('relBusiness','relUser')->orderBy('id','DESC')->paginate(10);
        }
        else
        {
            //exit('agent');
            $data = Quote::with('relBusiness','relUser')->where(['business_id'=> Auth::user()->business_id,'status'=>'placed_order'])->orderBy('id','DESC')->paginate(10);
            //print_r($data); exit();
        }

//        dd($data);
        return view('main::order.new_order',['pageTitle'=>$pageTitle, 'data'=>$data]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function place_order(Request $request)
    {
        //exit('000000');
        $input = $request->all();

        if(isset($input['continue'])){
            $route = $input['continue'];
            $quote_status = ['status'=>'quote_confirmed'];
        }
        if(isset($input['later'])){
            $route = $input['later'];
            $quote_status = ['status'=>'placed_order'];
        }

        //exit($route);

        $quote_id = $input['quote_id'];
        $quote_no = $input['quote_no'];
        $total = $input['total'];
        $gst = $input['gst'];
        $total_with_gst = $input['total_with_gst'];

        $vendor_signature = Input::file('vendor_signature');
        $agent_signature = Input::file('agent_signature');

        $vendor_img_path = null;
        $agent_img_path = null;

        if(count($vendor_signature)>0 || count($agent_signature)>0)
        {
            $file_type_required = 'png,jpeg,jpg';
            $destinationPath = 'uploads/signature_image/';
            $uploadfolder = 'uploads/';
            if ( !file_exists($uploadfolder) ) {
                $oldmask = umask(0);  // helpful when used in linux server
                mkdir ($uploadfolder, 0777);
            }
            if ( !file_exists($destinationPath) ) {
                $oldmask = umask(0);  // helpful when used in linux server
                mkdir ($destinationPath, 0777);
            }

            //vendor signature
            if($vendor_signature){
                $vendor_file_name = $this->image_upload($vendor_signature,$file_type_required,$destinationPath);

                if($vendor_file_name != '') {
                    $vendor_img_path = $vendor_file_name[0];
                    //$input['thumbnail'] = $file_name_1[1];
                }else{
                    Session::flash('error', 'Some thing error in image file type! Please Try again');
                    return redirect()->back();
                }
            }

            //agent signature
            if($agent_signature){
                $agent_file_name = $this->image_upload($agent_signature,$file_type_required,$destinationPath);

                if($agent_file_name != '') {
                    $agent_img_path = $agent_file_name[0];
                    //$input['thumbnail'] = $file_name_2[1];
                }else{
                    Session::flash('error', 'Some thing error in image file type! Please Try again');
                    return redirect()->back();
                }
            }
        }

        /*Input array from retrive_quote_details.blade.php page form*/
        if(!empty($vendor_img_path))
        {
            $input_confirm = [
                'vendor_name' => $input['vendor_name'],
                'vendor_phone' => $input['vendor_phone'],
                'vendor_signature_path' => $vendor_img_path,
                'signature_date' => $input['signature_date']
            ];
        }
        elseif(!empty($agent_img_path))
        {
            $input_confirm = [
                'vendor_name' => $input['vendor_name'],
                'vendor_phone' => $input['vendor_phone'],
                'signature_date' => $input['signature_date'],
                'agent_signature_path' => $agent_img_path
            ];
        }
        else
        {
            $input_confirm = [
                'vendor_name' => $input['vendor_name'],
                'vendor_phone' => $input['vendor_phone'],
                'signature_date' => $input['signature_date']
            ];
        }

        //print_r($input_confirm); exit;

        $quote_data = Quote::findOrFail($quote_id);
        $property_detail_id =$quote_data->property_detail_id;

        DB::beginTransaction();
        try{
            //$model_property_details = new PropertyDetail();
            $model_property_details = PropertyDetail::findOrFail($property_detail_id);
            $model_property_details->update($input_confirm);

            Quote::where('id',$quote_id)->update($quote_status);
            //$quote_data->update($quote_status);

            DB::commit();
            Session::flash('message', 'Successfully you confirmed your Quote! and Your Quote Number is : '.$quote_no);
        }catch(\Exception $e){
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }

        if($route == 'Continue to Order') {
            //exit('From Continue');
            return redirect()->route('page-place-order', [
                'quote_id' => $quote_id,
                'quote_no' => $quote_no,
                'total' => $total,
                'gst' => $gst,
                'total_with_gst' => $total_with_gst
            ]);
        }
        if($route == 'Later'){
            //exit('From Later');
            return redirect('main/new-order');
        }

    }



    public function page_place_order($quote_id, $quote_no)
    {
        //exit('0000000');
        $pageTitle = 'Place Order';
        //,$total,$gst,$total_with_gst

        $quote_data = Quote::findOrFail($quote_id);

        $property_detail_id = $quote_data->property_detail_id;
        $print_material_id = $quote_data->print_material_distribution_id;


        $data['solution_types']= SolutionType::get();
        $photography_packages_qr= PhotographyPackage::with('relPhotographyPackage')->get();
        $signboard_packages_qr= SignboardPackage::with('relSignboardPackage')->get();
        $print_materials_qr= PrintMaterial::with('relPrintMaterial')->get();
        $local_medias_qr= LocalMedia::with('relLocalMedia')->get();
        $data['digital_medias']= DigitalMedia::get();


        $quote = Quote::with(
            'relPropertyDetail',
            'relPrintMaterialDistribution',
            'relQuoteLocalMedia',
            'relQuotePhotography',
            'relQuoteSignboard',
            'relQuotePrintMaterial'
            )->where('id', $quote_id)->first();


        /**
         * --------------Starts
         */

        // ---------- For photography Package===============================
        $photography_package_str = '';
        $photography_price = 0;
        if(isset($quote->photography_package_id) && $quote->photography_package_id==1){
            foreach($photography_packages_qr as $photography_package){
                if(isset($quote->relQuotePhotography)){
                    foreach($quote->relQuotePhotography as $ppi){
                        if($ppi->photography_package_id==$photography_package->id){
                            $photography_package_str .= $photography_package->title.',';
                            $photography_price+=$photography_package->price;
                        }
                    }
                }
            }
        }
        //print_r($photography_price); exit();

        // ---------------- For Signboard Package==========================
        $signboard_package_str = '';
        $signboard_price = 0;
        if(isset($quote->signboard_package_id) && $quote->signboard_package_id==1){
            foreach($signboard_packages_qr as $signboard_package){
                if(isset($quote->relQuoteSignboard)){
                    foreach($quote->relQuoteSignboard as $ppi){
                        if($ppi->signboard_package_id==$signboard_package->id){
                            $signboard_package_str .=$signboard_package->title.',';
                            foreach($signboard_package->relSignboardPackage as $relSignboardPackage){
                                if(isset($quote->relQuoteSignboard)){
                                    foreach($quote->relQuoteSignboard as $ppi){
                                        if($ppi->signboard_size_id==$relSignboardPackage->id){
                                            $signboard_price+=$relSignboardPackage->price;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        //print_r($signboard_price); exit();

        // ----------------- For Print Material====================================
        $print_material_str = '';
        $print_material_price = 0;
        if(isset($quote->print_material_id) && $quote->print_material_id==1){
            foreach($print_materials_qr as $print_material){
                if(isset($quote->relQuotePrintMaterial)){
                    foreach($quote->relQuotePrintMaterial as $ppi){
                        if($ppi->print_material_id==$print_material->id){
                            $print_material_str .= $print_material->title.',';
                            if(isset($quote->relQuotePrintMaterial)) {
                                foreach ($quote->relQuotePrintMaterial as $ppi) {
                                    if ($ppi->print_material_id == $print_material->id && $ppi->is_distributed == 1) {
                                    }
                                }
                            }
                            foreach($print_material->relPrintMaterial as $relPrintMaterial){
                                if(isset($quote->relQuotePrintMaterial)){
                                    foreach($quote->relQuotePrintMaterial as $ppi){
                                        if($ppi->print_material_id==$print_material->id && $ppi->print_material_size_id==$relPrintMaterial->id){

                                            $print_material_price+=$relPrintMaterial->price;
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        //print_r($print_material_price); exit();

        //--------------- For Local Media===========================
        $local_media_str = '';
        $local_media_price= 0;
        if(isset($quote->digital_media_id) && $quote->digital_media_id==1){
            foreach($local_medias_qr as $local_media){
                if(isset($quote->relQuoteLocalMedia)){
                    foreach($quote->relQuoteLocalMedia as $ppi){
                        if($ppi->local_media_id==$local_media->id){
                            $local_media_str .= $local_media->title.',';
                        }
                    }
                }
                foreach($local_media->relLocalMedia as $relLocalMedia){
                    if(isset($quote->relQuoteLocalMedia)){
                        foreach($quote->relQuoteLocalMedia as $ppi){
                            if($ppi->local_media_id==$local_media->id && $ppi->local_media_option_id==$relLocalMedia->id){
                                $local_media_price+=$relLocalMedia->price;
                            }
                        }
                    }
                }
            }
        }
        //print_r($local_media_price); exit();

        // To get the selling_price from property_details table
        $vendor_name = $quote->relPropertyDetail ? $quote->relPropertyDetail->vendor_name: null;
        $vendor_phone = $quote->relPropertyDetail ? $quote->relPropertyDetail->vendor_phone: null;
        $vendor_signature_path = $quote->relPropertyDetail ? $quote->relPropertyDetail->vendor_signature_path: null;
        $agent_signature_path = $quote->relPropertyDetail ? $quote->relPropertyDetail->agent_signature_path: null;
        $agent_signature_date = $quote->relPropertyDetail ? $quote->relPropertyDetail->signature_date: null;

        // For Local Media Price ------------------------------------------
        /*$local_media_price = 0;
        foreach($quote->relQuoteLocalMedia as $local_media_p)
        {
            $local_media_price += $local_media_p->price;
        }*/

        // For Total Selling Price --------------------------------------
        $total = $local_media_price + $photography_price + $signboard_price + $print_material_price;

        // For Goods Service Tax ----------------------------------------
        $gst = $total * 0.1;
        $total_with_gst = $total + $gst;

        //exit($selling_price.'/'.$gst.'/'.$total_with_gst);

        /**
         * ---------Ends
         */

        $main_selling_line = $quote->relPropertyDetail ? $quote->relPropertyDetail->main_selling_line: null;
        $property_description = $quote->relPropertyDetail ? $quote->relPropertyDetail->property_description: null;
        $inspection_date = $quote->relPropertyDetail ? $quote->relPropertyDetail->inspection_date: null;
        $inspection_features = $quote->relPropertyDetail ? $quote->relPropertyDetail->inspection_features: null;
        $other_features = $quote->relPropertyDetail ? $quote->relPropertyDetail->other_features: null;
        $selling_price = $quote->relPropertyDetail ? $quote->relPropertyDetail->selling_price: null;
        $auction_time = $quote->relPropertyDetail ? $quote->relPropertyDetail->auction_time: null;
        $offer = $quote->relPropertyDetail ? $quote->relPropertyDetail->offer: null;
        $note = $quote->relPropertyDetail ? $quote->relPropertyDetail->note: null;

        /*---For Print Materials--------*/
        $quantity = $quote->relPrintMaterialDistribution ? $quote->relPrintMaterialDistribution->quantity: null;
        $is_surrounded = $quote->relPrintMaterialDistribution ? $quote->relPrintMaterialDistribution->is_surrounded: null;

        $other_address = $quote->relPrintMaterialDistribution ? $quote->relPrintMaterialDistribution->other_address: null;
        $date_of_distribution = $quote->relPrintMaterialDistribution ? $quote->relPrintMaterialDistribution->date_of_distribution: null;
        $print_metal_dist_note = $quote->relPrintMaterialDistribution ? $quote->relPrintMaterialDistribution->note: null;
        //print_r($quantity); exit();

        return view('main::order.place_order',[
            'pageTitle'=>$pageTitle,
            'quote_id'=>$quote_id,
            'quote_no'=>$quote_no,
            'property_detail_id'=>$property_detail_id,
            'print_material_id'=>$print_material_id,
            'main_selling_line'=>$main_selling_line,
            'property_description'=>$property_description,
            'inspection_date'=>$inspection_date,
            'inspection_features'=>$inspection_features,
            'other_features'=>$other_features,
            'selling_price'=>$selling_price,
            'auction_time'=>$auction_time,
            'offer'=>$offer,
            'note'=>$note,
            'quantity'=>$quantity,
            'is_surrounded'=>$is_surrounded,
            'other_address'=>$other_address,
            'date_of_distribution'=>$date_of_distribution,
            'print_metal_dist_note'=>$print_metal_dist_note,
            'total' => $total,
            'gst' => $gst,
            'total_with_gst' => $total_with_gst
        ]);
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $property_details_id = $input['property_detail_id'];
        $print_material_id = $input['print_material_id'];
        //print_r($print_material_id); exit();
        $quote_id = $input['quote_id'];
        $quote_no = $input['quote_no'];
        $total = $input['total'];
        $gst = $input['gst'];
        $total_with_gst = $input['total_with_gst'];

        //print_r($total);exit();

        // Input data for "property_detail" table
        $input_property_details = [
            'main_selling_line'     => $input['main_selling_line'],
            'property_description'  => $input['property_description'],
            'inspection_date'       => $input['inspection_date'],
            'inspection_features'   => $input['inspection_features'],
            'other_features'        => $input['other_features'],
            'selling_price'         => $input['selling_price'],
            'auction_time'          => $input['auction_time'],
            'offer'                 => $input['offer'],
            'note'                  => $input['note']
        ];

        // Input data for "print_material_distribution" table
        $input_print_material_distribution = [
            'quantity'              => $input['quantity'],
            'is_surrounded'         => $input['is_surrounded'],
            'other_address'         => $input['other_address'],
            'date_of_distribution'  => $input['date_of_distribution'],
            'note'                  => $input['note'],
        ];
        //dd($print_material_id);
        DB::beginTransaction();
        try{

            // update property detail
            $model_property_details = PropertyDetail::findOrFail($property_details_id);
            $property_details_update = $model_property_details->update($input_property_details);
            //$property_details = PropertyDetail::findOrFail($property_details_id);

            // Update Print Material Distribution if exist
            $print_material_distribution_exist =PrintMaterialDistribution::where('id',$print_material_id)->exists();
            //print_r($print_material_distribution_exist); exit();
            if($print_material_distribution_exist)
            {
                //print_r($print_material_distribution_exist); exit();
                $model_print_material_distribution = PrintMaterialDistribution::where('id',$print_material_id)->first();
                $print_material_distribution = $model_print_material_distribution->update($input_print_material_distribution);
                //print_r($model_print_material_distribution->id); exit();
                $pmdid = $model_print_material_distribution->id;
                //print_r($pmdid); exit();
            }
            else
            {
                //exit('slkjdf');
                $model_print_material_distribution = new PrintMaterialDistribution();
                $print_material_distribution = $model_print_material_distribution->create($input_print_material_distribution);
                $pmdid = $print_material_distribution->id;
            }
            //print_r($model_print_material_distribution->id);exit();
            //check if stored above model(s)
            if($property_details_update && $print_material_distribution)
            {
                //update quote table
                //dd($model_print_material_distribution);
                $model_quote = Quote::findOrFail($quote_id);
                $model_quote->print_material_distribution_id = $pmdid;
                $model_quote->status = 'invoiced';

                //Quote::where('id',$quote_id)->update($quote_status);

                //exit('dfj');
                if($model_quote->save()){
                    // check if transaction exists for the quote and invoice number
                    $trn_exists = Transaction::where('quote_id',$quote_id )->exists();
                    if($trn_exists)
                    {
                        $transaction_model = Transaction::where('quote_id',$quote_id )->first();
                        $transaction_model->amount = $total;  //TODO::check price
                        //$transaction_model->gst = (10/100 * $transaction_model->amount) ;
                        $transaction_model->gst = $gst ;
                        //$transaction_model->total_amount = $transaction_model->amount + $transaction_model->gst;
                        $transaction_model->total_amount = $total_with_gst;
                        $transaction_model->status = "active";
                        $transaction_model->save();
                    }
                    else
                    {
                        //generate invoice number
                        $invoice_number=GenerateNumber::generate_number('invoice-number');

                        //New Entry for Transaction Table
                        $transaction_model = new Transaction();
                        $transaction_model->quote_id = $model_quote->id;
                        $transaction_model->invoice_no = $invoice_number['generated_number'];
                        $transaction_model->currency = "AUD";
                        $transaction_model->amount = $total; //TODO::check price
                        $transaction_model->gst = $gst ;
                        $transaction_model->total_amount = $total_with_gst;
                        $transaction_model->status = "active";
                        if($transaction_model->save())
                        {
                            GenerateNumber::update_row($invoice_number['setting_id'],$invoice_number['number']);
                        }
                    }
                }
            }
            // commit the changes
            DB::commit();
            Session::flash('message', 'Successfully added!');
        }catch(\Exception $e){
            // If fails rollback the database
            DB::rollback();
            dd($e->getMessage());
            Session::flash('danger', $e->getMessage());
        }

        return redirect()->route('payment-procedure', [
            'quote_id'=>$quote_id,
            'quote_no'=>$quote_no,
        ]);


    }


    public function payment_procedure($quote_id, $quote_no){
        // Title of the payment page
        $pageTitle = 'Payment';
        $data = Transaction::where('quote_id', $quote_id)->first();
        $user_data= User::findOrFail(Auth::id());
//        dd($data);
        // View page
        return view('main::payment.index_payment',[
            'pageTitle'=>$pageTitle,
            'quote_number'=>$quote_no,
            'data'=>$data,
            'user_data'=>$user_data
        ]);
    }



    protected function image_upload($image,$file_type_required,$destinationPath)
    {

        if ($image != '') {
            $img_name = $image; //($_FILES['image']['name']);
            $random_number = rand(111, 999);
            $thumb_name = 'thumb_50x50_' . $random_number . '_' . $img_name;
            $newWidth = 200;
            $targetFile = $destinationPath . $thumb_name;
            $originalFile = $image;


            $rules = array('image' => 'required|mimes:' . $file_type_required);
            $validator = Validator::make(array('image' => $image), $rules);
            if ($validator->passes()) {

                // Create folders if they don't exist
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }
                $image_original_name = $image->getClientOriginalName();
                $image_name = rand(11111, 99999) . $image_original_name;
                $upload_success = $image->move($destinationPath, $image_name);
                $file = array($destinationPath . $image_name);
                if ($upload_success) {
                    return $file_name = $file;
                } else {
                    return $file_name = '';
                }
            }else{
                return $file_name = '';
            }
        }
    }
}
