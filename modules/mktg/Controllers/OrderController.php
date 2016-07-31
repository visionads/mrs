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
use App\MktgArtworkImage;
use App\MktgItemOption;
use App\MktgOrder;
use App\MktgOrderDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\GenerateOrderNumber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Mockery\CountValidator\Exception;

class OrderController extends Controller
{
    public function add_to_cart(Request $reques, $product_id)
    {
        $request=$reques->all();
        DB::beginTransaction();
        try{
            $total_amount=0;
            $order= MktgOrder::where('date',date('Y-m-d'))->where('user_id',Auth::id())->where('status','open')->first();
            if(!$order)
            {
                $order_no = GenerateNumber::generate_number('order-number');
                $order = new MktgOrder();
                $order->order_no = $order_no['generated_number'];
                $order->date = date('Y-m-d');
                $order->user_id = Auth::id();
                $order->status = 'open';
                $order->save();
                GenerateNumber::update_row($order_no['setting_id'],$order_no['number']);
            }
            if(isset($request['option']))
            {
                foreach($request['option'] as $option_id=>$option_price){
                    $orderDetails= new MktgOrderDetail();
                    $orderDetails->type='item';
                    $orderDetails->mktg_order_id= $order->id;
                    $orderDetails->parent_id= $option_id;
                    $orderDetails->amount= $option_price;
                    $orderDetails->save();
                    $total_amount +=$option_price;
                }
            }
            if($request['art']=='yes' && isset($request['art_work_id']))
            {
                $artWork=MktgArtwork::findOrFail($request['art_work_id']);
                $orderDetails= new MktgOrderDetail();
                $orderDetails->type='art';
                $orderDetails->mktg_order_id= $order->id;
                $orderDetails->parent_id= $artWork->id;
                $orderDetails->amount= $artWork->price;
                $orderDetails->comment= $request['description'];
                $orderDetails->save();
                $total_amount +=$artWork->price;
                $path=public_path('assets/artImg');
                if($artWork->field_type=='file') {
                    if (!empty($request['file'])) {
                        if ($reques->file('file')->isValid()) {
                            $fileName = rand(10, 99) . $reques->file('file')->getClientOriginalName();
                            $reques->file('file')->move($path, $fileName);

                            $artImg = new MktgArtworkImage();
                            $artImg->mktg_order_detail_id = $orderDetails->id;
                            $artImg->image = 'assets/artImg/' . $fileName;
                            $artImg->save();
                        }
                    } else {
                        Session::flash('error', 'Sorry, You did not select any file to upload.');
                        return redirect()->back();
                    }
                }
            }
            $gst= ($total_amount*10)/100;
            $order->amount=$total_amount;
            $order->gst= $gst;
            $order->total_amount=$gst+$total_amount;
            $order->save();

            DB::commit();
            Session::flash('message','Successfully added to cart');
        }catch (Exception $e)
        {
            DB::rollback();
            Session::flash('error',$e->getMessage());
            return redirect()->back();
        }
        return redirect()->to('marketing/order-details/'.$order->id);
    }
    public function order_details($order_id)
    {
        $data['pageTitle']= 'Order Details';
        $data['order_details']= DB::select(DB::raw("SELECT
od.id,od.type,od.parent_id,od.amount,
IF(od.type='item',iv.title,aw.title) title,
IF(od.type='item',iv.price,aw.price) price,
IF(io.id = NULL, '', io.title) io_title

FROM mktg_order_detail AS od
LEFT JOIN mktg_item_value as iv ON (od.parent_id=iv.id)
 left join mktg_item_option as io on io.id = iv.mktg_item_option_id
LEFT JOIN mktg_artwork as aw ON (od.parent_id=aw.id)
WHERE `mktg_order_id`=$order_id"));
//        dd($data['order_details']);
        $data['order']=MktgOrder::findOrFail($order_id);
        return view('mktg::order.details',$data);
    }
    public function delete_order($order_id)
    {
        DB::beginTransaction();
        try{
            $order_details=MktgOrderDetail::where('mktg_order_id',$order_id)->get();
            foreach ($order_details as $od) {
                MktgArtworkImage::where('mktg_order_detail_id',$od->id)->delete();
            }
            MktgOrderDetail::where('mktg_order_id',$order_id)->delete();
            MktgOrder::findOrFail($order_id)->delete();
            Session::flash('message','Order has been successfully deleted.');
            DB::commit();
        }catch (Exception $e){
            DB::rollback();
            Session::flash('error',$e->getMessage());
        }
        return redirect()->back();
    }
    public function delete_order_details($order_id)
    {
        DB::beginTransaction();
        try {
            $order_details = MktgOrderDetail::findOrFail($order_id);
            $order = MktgOrder::findOrFail($order_details->mktg_order_id);
            $amount = $order->amount - $order_details->amount;
            $gst = ($amount * 10) / 100;
            $order->amount = $amount;
            $order->gst = $gst;
            $order->total_amount = $gst + $amount;
            $order->save();
            $order_details->delete();
            DB::commit();
            Session::flash('message','Successfully delete');
        }catch (Exception $e){
            DB::rollback();
            Session::flash('error',$e->getMessage());
        }
        return redirect()->back();
    }
}