<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 8/1/16
 * Time: 10:04 AM
 */

namespace Modules\Mktg\Controllers;


use App\Http\Controllers\Controller;
use App\MktgInvoice;

class PaymentController extends Controller
{

    public function store($id,$total_amount)
    {
        $invoiceDetail= MktgInvoice::findOrFail($id);
        $data['mktg_order_id']=$invoiceDetail->mktg_order_id;
        $data['reference']='eway';
        $data['amount']=$total_amount;
        $data['status']='paid';

        $mr_number=GenerateNumber::generate_number('money-receipt-number');
        $data['invoice_no']=$mr_number['generated_number'];

        //print_r($data['money_receipt_no']); exit();

        $payment= MktgInvoice::create($data);

        GenerateNumber::update_row($mr_number['setting_id'],$mr_number['number']);

        $user['admin'] = \DB::table('user')->where('username', '=', 'super-admin')->first();
        $user['agent'] = User::findOrFail(\Auth::id());
//        dd($user['admin']->email);
//        return view('main::payment.mail',$payment);
//        dd($payment);
        try{
            \Mail::send('mktg::payment.mail', array('payment_details'=>$payment),
                function($message) use ($user,$payment)
                {
                    $message->from('mrs@gmail.com', 'MRS');
                    $message->to($user['admin']->email)->cc($user['agent']->email);
                    $message->subject('Payment for the Order '.$payment->invoice_no);
                });

            Session::flash('message','Payment placed successfully.');
        }catch (\Exception $e){
            dd($e->getMessage());
            Session::flash('error', $e->getMessage());
        }
        return redirect('order-details/'.$id);
    }
}