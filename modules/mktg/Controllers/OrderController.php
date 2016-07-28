<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 7/28/16
 * Time: 10:48 AM
 */

namespace Modules\Mktg\Controllers;


use App\GenerateNumber;
use App\Http\Controllers\Controller;
use App\MktgArtwork;
use App\MktgItemOption;
use App\MktgOrder;
use App\MktgOrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\GenerateOrderNumber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Mockery\CountValidator\Exception;

class OrderController extends Controller
{
    public function add_to_cart(Request $reques, $product_id)
    {
        $request=$reques->all();
        DB::beginTransaction();
        try{
            $order= MktgOrder::where('date',date('Y-m-d'))->where('user_id',Auth::id())->first();
            if(!$order)
            {
                $order_no = GenerateNumber::generate_number('order-number');
                $order = new MktgOrder();
                $order->order_no = $order_no['generated_number'];
                $order->date = date('Y-m-d');
                $order->user_id = Auth::id();
                $order->status = 'open';
                $order->save();
            }
            if(isset($request['option']))
            {
                foreach($request['option'] as $option_id=>$option_price){
                    $orderDetails= new MktgOrderDetail();
                    $orderDetails->type='item';
                    $orderDetails->mktg_order_id= $order->id;
                    $orderDetails->parent_id= $option_id;
                    $orderDetails->amount= $option_price;
//                    $orderDetails->save();
                }
            }
            if($request['art']=='yes' && isset($request['art_work_id']))
            {
                $artWork=MktgArtwork::findOrFail($request['art_work_id']);
                if($artWork->field_type=='file' && !empty($request['file'])){
//                    if ($reques->file('file')->isValid()) {
//                        exit('yes');
//                    }
                    dd($reques->file('f'));
                }else{
                    Session::flash('error','Sorry, You did not select any file to upload.');
                    return redirect()->back();
                }
                dd($artWork);
            }


            dd($request);


            DB::commit();
            Session::flash('message','Successfully added to cart');
        }catch (Exception $e)
        {
            DB::rollback();
            Session::flash('error',$e->getMessage());
            return redirect()->back();
        }
        $order_no= GenerateNumber::generate_number('order-number');
    }
}