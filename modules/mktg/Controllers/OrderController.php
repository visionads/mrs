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
                $orderDetails= new MktgOrderDetail();
                $orderDetails->type='art';
                $orderDetails->mktg_order_id= $order->id;
                $orderDetails->parent_id= $artWork->id;
                $orderDetails->amount= $artWork->price;
                $orderDetails->comment= $request['description'];
                $orderDetails->save();
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


            DB::commit();
            Session::flash('message','Successfully added to cart');
        }catch (Exception $e)
        {
            DB::rollback();
            Session::flash('error',$e->getMessage());
            return redirect()->back();
        }
        return redirect()->to('marketing/marketing-material-printing');
    }
}