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
        //$pageTitle = 'MRS - Place Order Page';
        $pageTitle = 'Agreement';
        //$model = new PrintMaterialDistribution();
        $data = PrintMaterialDistribution::get()->last(); //->with('PropertyDetail')->get()->last();
//        dd($data);
        $data1 = PropertyDetail::get()->last();
//        dd($data1);
        return view('main::order.order',['pageTitle'=>$pageTitle,'data'=>$data,'data1'=>$data1]);
    }
    public function property_details()
    {
        $pageTitle = 'Property Detail For Marketing Material';
        $data = '';
        return view('main::order.property_details',['pageTitle'=>$pageTitle, 'data'=>$data]);
    }
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
    public function agreement(Request $request)
    {
        $input = $request->all();

        $input_confirm = [

            'vendor_name'              => $input['vendor_name'],
            //'vendor_email'              => $input['vendor_email'],
            'vendor_phone'              => $input['vendor_phone'],
            //'vendor_signature_path'    => $input['vendor_signature'],
            'signature_date'           => $input['signature_date']
            //'agent_signature_path'     => $input['description'],
        ];


        DB::beginTransaction();
        try{

            $model_pd = new PropertyDetail();
            //$pd = $model_pd->create($input_pd);
            $confirm = $model_pd->create($input_confirm);

            if($confirm)
            {
                $model_quote = new Quote();
                $model_quote->property_detail_id = $confirm->id;
                $model_quote->save();
            }
            $quote_id = $model_quote->id;
            $property_id = $confirm->id;

            DB::commit();
            Session::flash('message', 'Successfully added!');
        }catch(\Exception $e){
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }

        $pageTitle = 'Property Detail For Marketing Material';
        return view('main::order.property_details',['pageTitle'=>$pageTitle, 'quote_id'=>$quote_id, 'property_id'=>$property_id]);
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $property_id = $input['property_detail_id'];
        $quote_id = $input['quote_id'];

        //print_r($property_id);
        //exit;
        $input_pd = [
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

        $input_pmd = [
            'quantity'              => $input['quantity'],
            'is_surrounded'         => $input['is_surrounded'],
            'other_address'         => $input['other_address'],
            'date_of_distribution'  => $input['date_of_distribution'],
            'note'                  => $input['note'],
        ];



        DB::beginTransaction();
        try{

            $model_pd = new PropertyDetail();
            $pd = $model_pd->where('id',$property_id)->update($input_pd);
            //$pd = $model_pd->create($input_pd);

            $model_pmd = new PrintMaterialDistribution();
            $pmd = $model_pmd->create($input_pmd);

            if($pd && $pmd)
            {
                $model_quote = new Quote();
                $model_quote->where('id',$quote_id);
                $model_quote->property_detail_id = $pd->id;
                $model_quote->print_material_distribution = $pmd->id;
                $model_quote->save();
            }

            DB::commit();
            Session::flash('message', 'Successfully added!');
        }catch(\Exception $e){
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }

        $pageTitle = 'Payment';
        $data_pd = PropertyDetail::where('id',$pd->id)->get();
        $data_pmd = PrintMaterialDistribution::where('id',$pmd->id)->get();
        //return view('main::order.order',['pageTitle'=>$pageTitle,'data_pd'=>$data_pd,'data_pmd'=>$data_pmd]);
        return view('main::payment.payment',['pageTitle'=>$pageTitle]);
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
