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
use Auth;
use DB;
use PhpParser\Node\Stmt\Property;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Helpers\ImageResize;

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


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function place_order(Request $request)
    {
        $input = $request->all();
        $quote_id = $input['quote_id'];
        $quote_no = $input['quote_no'];

        $vendor_signature = $input['vendor_signature'];
        $agent_signature = $input['agent_signature'];

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

            if($vendor_signature){
                $vendor_file_name = ImageResize::image_upload($vendor_signature,$file_type_required,$destinationPath);

                if($vendor_file_name != '') {
                    $vendor_img_path = $vendor_file_name[0];
                    //$input['thumbnail'] = $file_name_1[1];
                }else{
                    Session::flash('error', 'Some thing error in image file type! Please Try again');
                    return redirect()->back();
                }
            }else if($agent_signature){
                $agent_file_name = ImageResize::image_upload($agent_signature,$file_type_required,$destinationPath);

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
        $input_confirm = [
            'vendor_name'              => $input['vendor_name'],
            'vendor_phone'             => $input['vendor_phone'],
            'vendor_signature_path'    => $vendor_img_path,
            'signature_date'           => $input['signature_date'],
            'agent_signature_path'     => $agent_img_path
        ];

        print_r($input_confirm); exit;

        $quote_data = Quote::findOrFail($quote_id);
        $property_detail_id =$quote_data->property_detail_id;

        DB::beginTransaction();
        try{
            //$model_property_details = new PropertyDetail();
            $model_property_details = PropertyDetail::findOrFail($property_detail_id);
            $model_property_details->update($input_confirm);

            DB::commit();
            Session::flash('message', 'Successfully you confirmed your Quote! and Your Quote Number is : '.$quote_no);
        }catch(\Exception $e){
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }

        $pageTitle = 'Property Detail For Marketing Material';

        return redirect()->route('page-place-order', [
            'quote_id'=>$quote_id,
            'quote_no'=>$quote_no
        ]);

    }



    public function page_place_order($quote_id, $quote_no)
    {
        $pageTitle = 'Place Order';

        $quote_data = Quote::findOrFail($quote_id);

        $property_detail_id = $quote_data->property_detail_id;

        //TODO:: Must be calculate price

        return view('main::order.place_order',[
            'pageTitle'=>$pageTitle,
            'quote_id'=>$quote_id,
            'quote_no'=>$quote_no,
            'property_detail_id'=>$property_detail_id,
        ]);
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $property_details_id = $input['property_detail_id'];
        $quote_id = $input['quote_id'];
        $quote_no = $input['quote_no'];

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

        DB::beginTransaction();
        try{

            // update property detail
            $model_property_details = PropertyDetail::findOrFail($property_details_id);
            $property_details_update = $model_property_details->update($input_property_details);
            $property_details = PropertyDetail::findOrFail($property_details_id);

            $model_print_material_distribution = new PrintMaterialDistribution();
            $print_material_distribution = $model_print_material_distribution->create($input_print_material_distribution);

            //check if stored above model(s)
            if($property_details_update && $print_material_distribution)
            {
                //update quote table
                $model_quote = Quote::findOrFail($quote_id);
                $model_quote->print_material_distribution_id = $print_material_distribution->id;
                $invoice_number=GenerateNumber::generate_number('invoice-number');

                if($model_quote->save()){
                    $transaction_model = new Transaction();
                    $transaction_model->quote_id=$model_quote->id;
                    $transaction_model->invoice_no = $invoice_number['generated_number'];
                    $transaction_model->currency = "AUD";
                    $transaction_model->amount = $property_details->selling_price;
                    $transaction_model->gst = (10/100 * $transaction_model->amount) ;
                    $transaction_model->total_amount = $transaction_model->amount + $transaction_model->gst;
                    $transaction_model->status = "active";
                    $transaction_model->save();
                }
            }
            // commit the changes
            GenerateNumber::update_row($invoice_number['setting_id'],$invoice_number['number']);
            DB::commit();
            Session::flash('message', 'Successfully added!');
        }catch(\Exception $e){
            // If fails rollback the database
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }

        return redirect()->route('payment-procedure', [
            'quote_id'=>$quote_id,
            'quote_no'=>$quote_no
        ]);


    }


    public function payment_procedure($quote_id, $quote_no){
        // Title of the payment page
        $pageTitle = 'Payment';
        $data = Transaction::where('quote_id', $quote_id)->first();
        $user_data= User::findOrFail(Auth::id());
        // View page
        return view('main::payment.index',[
            'pageTitle'=>$pageTitle,
            'quote_number'=>$quote_no,
            'data'=>$data,
            'user_data'=>$user_data
        ]);
    }

}
