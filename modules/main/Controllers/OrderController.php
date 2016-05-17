<?php

namespace Modules\Main\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//use App\Order;
use App\PropertyDetail;
use App\PrintMaterialDistribution;
use Auth;
use DB;
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
    public function store(Request $request)
    {
        $input = $request->all();
        $input_one = [
            //'owner_name',
            //'address',
            //'vendor_name',
            //'vendor_email',
            //'vendor_phone',
            //'vendor_signature_path',
            'signature_date'=>$input['date'],
            //'agent_signature_path',
            'main_selling_line'=>$input['main_selling_line'],
            'property_description'=>$input['property_description'],
            'inspection_features'=>$input['inspection_features'],
            'other_features'=>$input['other_features'],
            'selling_price'=>$input['selling_price'],
            'auction_time'=>$input['auction_time'],
            'offer'=>['offer'],
            'note'=>['note']
        ];

        if(!empty($input['is_surrounded'])){ $surrouded = $input['is_surrounded']; }else{ $surrouded = '1';}
        $input_two = [
            'quantity'=>$input['quantity'],
            'is_surrounded'=>$surrouded,
            'other_address'=>$input['other_address'],
            //'date_of_distribution'=>$input['date'],
            'note'=>$input['note']
        ];
        //$signature_date = [ 'signature_date'=>$input['date'] ];
        //$date_of_distribution = [ 'date_of_distribution'=>$input['date'] ];

        $model_one = new PropertyDetail();
        $model_two = new PrintMaterialDistribution();
        DB::beginTransaction();
        try{
            $model_one->create($input);
            $model_two->create($input);
            DB::commit();
            Session::flash('message', 'Successfully added!');
        }catch(\Exception $e){
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }
        //return redirect('index');
        return redirect('main/place-order');
        //return redirect()->back();
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
