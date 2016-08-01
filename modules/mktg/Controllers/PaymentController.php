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
use App\MktgOrder;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{
    public function index()
    {
        //exit('Welcome !');
        $data['pageTitle'] = 'Payment List';
        $role_name = User::getRole(Auth::user()->id) ;
        if($role_name == 'admin' || $role_name == 'super-admin')
        {
            $data['invoices']=MktgInvoice::where('invoice_type', 'MR')->get();
            $data['role']='admin';
        }else {
            $data['invoices'] = MktgInvoice::where('invoice_type', 'MR')->get();
            $data['payment'] = 'MR';
        }
        return view('mktg::invoice.invoice_list',$data);
    }

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
    public function change_status($id,$status)
    {
        $invoice= MktgInvoice::findOrFail($id);
        $invoice->status=$status;
        $invoice->save();
        $order= MktgOrder::findOrFail($invoice->mktg_order_id);
        $user= User::findOrFail($order->user_id);
        try{
            \Mail::send('mktg::payment.confirm_mail',['status'=>$status,'invoice'=>$invoice],
                function($message) use ($user)
                {
                    $message->from('mrs@gmail.com', 'MRS');
                    $message->to($user->email);
                    $message->subject('Payment Status Information');
                });

            Session::flash('message','Payment status Successfully Changed.');
        }catch (\Exception $e){
            dd($e->getMessage());
            Session::flash('error', $e->getMessage());
        }
        return redirect('marketing/payments');
    }
}