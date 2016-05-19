<?php

namespace Modules\Main\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use App\Order;
use App\PropertyDetail;
use App\PrintMaterialDistribution;
use App\Quote;
use Auth;
use DB;
use PhpParser\Node\Stmt\Property;
use Session;
use Illuminate\Support\Facades\Redirect;

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


        $input_confirm = [
            'vendor_name'              => $input['vendor_name'],
            'vendor_phone'              => $input['vendor_phone'],
            //'vendor_signature_path'    => $input['vendor_signature'], TODO:: image upload
            'signature_date'           => $input['signature_date']
            //'agent_signature_path'     => $input['description'], TODO:: image upload
        ];

        $quote_data = Quote::findOrFail($quote_id);
        $property_detail_id =$quote_data->property_detail_id;


        DB::beginTransaction();
        try{
            //$model_property_details = new PropertyDetail();
            $model_property_details = PropertyDetail::findOrFail($property_detail_id);
            $model_property_details->update($input_confirm);

            DB::commit();
            Session::flash('message', 'Successfully added!');
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

        //return $quote_id; exit;
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
            $property_details = $model_property_details->update($input_property_details);

            // new entry in print_material_distribution
            $model_print_material_distribution = new PrintMaterialDistribution();
            $print_material_distribution = $model_print_material_distribution->create($input_print_material_distribution);

            //check if stored above model(s)
            if($property_details && $print_material_distribution)
            {
                //update quote table
                $model_quote = Quote::findOrFail($quote_id);
                $model_quote->print_material_distribution_id = $print_material_distribution->id;
                $model_quote->save();
            }
            // commit the changes
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


        //TODO:: calculate GST (10%) :


        $pageTitle = 'Payment';
        $quote = Quote::with('relPropertyDetail', 'relPrintMaterialDistribution')->where('id', $quote_id)->get();

        // To get the selling_price from property_details table
        foreach($quote as $quotes){
            $selling_price = $quotes->relPropertyDetail->selling_price;
        }

        // For Goods Service Tax
        $gst = $selling_price * 0.1;

        // For Total with GST
        $total_with_gts = $selling_price + $gst;

        return view('main::payment.index',[
            'pageTitle'=>$pageTitle,
            'quote'=>$quote,
            'quote_number'=>$quote_no,
            'total'=>$selling_price,
            'gst'=>$gst,
            'total_with_gts'=>$total_with_gts
        ]);
    }

}
