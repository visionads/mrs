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

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*//$pageTitle = 'MRS - Place Order Page';
        $pageTitle = 'Agreement';
        //$model = new PrintMaterialDistribution();
        $data = PrintMaterialDistribution::get()->last(); //->with('PropertyDetail')->get()->last();
//        dd($data);
        $data1 = PropertyDetail::get()->last();
//        dd($data1);
        return view('main::order.order',['pageTitle'=>$pageTitle,'data'=>$data,'data1'=>$data1]);*/
    }
    public function quote_confirm()
    {
        $pageTitle = 'Agreement';
        $data = PrintMaterialDistribution::get()->last(); //->with('PropertyDetail')->get()->last();
        $data1 = PropertyDetail::get()->last();
        return view('main::order.quote_confirm',['pageTitle'=>$pageTitle,'data'=>$data,'data1'=>$data1]);
    }
    /*public function property_details()
    {
        $pageTitle = 'Property Detail For Marketing Material';
        $data = '';
        return view('main::order.property_details',['pageTitle'=>$pageTitle, 'data'=>$data]);
    }*/
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /*$pageTitle = 'MRS - Quote';
        $user_image = UserImage::where('user_id',Auth::user()->id)->first();

        return view('main::quote.create',['pageTitle'=>$pageTitle,'user_image'=>$user_image]);*/
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

        $input_confirm = [

            'vendor_name'              => $input['vendor_name'],
            'vendor_phone'              => $input['vendor_phone'],
            //'vendor_signature_path'    => $input['vendor_signature'],
            'signature_date'           => $input['signature_date']
            //'agent_signature_path'     => $input['description'],
        ];


        DB::beginTransaction();
        try{
            $property_detail_id = '160';
            $quote_id = '101';
            //$model_property_details = new PropertyDetail();
            $model_property_details = PropertyDetail::findOrFail($property_detail_id);
            $model_property_details->update($input_confirm);

            /*if($confirm)
            {
                //$model_quote = new Quote();
                //$model_quote->property_detail_id = $confirm->id;
                //$model_quote->save();
            }
            //$quote_id = $model_quote->id;*/
            $property_id = $property_detail_id;

            DB::commit();
            Session::flash('message', 'Successfully added!');
        }catch(\Exception $e){
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }

        $pageTitle = 'Property Detail For Marketing Material';
        return view('main::order.place_order',['pageTitle'=>$pageTitle, 'quote_id'=>$quote_id, 'property_id'=>$property_detail_id]);
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $property_details_id = $input['property_detail_id'];
        $quote_id = $input['quote_id'];

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

            $model_property_details = PropertyDetail::findOrFail($property_details_id);
            $property_details = $model_property_details->update($input_property_details);

            $model_print_material_distribution = new PrintMaterialDistribution();
            $print_material_distribution = $model_print_material_distribution->create($input_print_material_distribution);

            if($property_details && $print_material_distribution)
            {
                $model_quote = Quote::findOrFail($quote_id);
                //$model_quote = Quote::where('property_detail_id',$property_details_id)->first();
                $quote_input_arr = [
                    'print_material_distribution' => $print_material_distribution->id
                ];
                $model_quote->update($quote_input_arr);
            }

            DB::commit();
            Session::flash('message', 'Successfully added!');
        }catch(\Exception $e){
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }

        $pageTitle = 'Payment';
        return view('main::payment.index',['pageTitle'=>$pageTitle]);
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
