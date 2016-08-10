<?php
/**
 * Created by PhpStorm.
 * User: etsb
 * Date: 8/1/16
 * Time: 10:04 AM
 */

namespace Modules\Mktg\Controllers;


use App\GenerateOrderNumber;
use App\Http\Controllers\Controller;
use App\MktgInvoice;
use App\MktgOrder;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MktgPaymentController extends Controller
{
    public function index()
    {
        //exit('Welcome !');
        $data['pageTitle'] = 'Payment List';
        $role_name = User::getRole(Auth::user()->id) ;
        if($role_name == 'admin' || $role_name == 'super-admin')
        {
            $data['invoices']=MktgInvoice::with('relUser')->where('invoice_type', 'MR')->paginate(30);
            $data['role']='admin';
        }else {
            $data['invoices'] = MktgInvoice::where('invoice_type', 'MR')->paginate(30);
            $data['payment'] = 'MR';
        }
        return view('mktg::invoice.invoice_list',$data);
    }

    /**
     * @param $id
     * @param $total_amount
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store($id,$total_amount)
    {

        $invoiceDetail= MktgInvoice::findOrFail($id);
        $data['mktg_order_id']=$invoiceDetail->mktg_order_id;
        $data['user_id']=$invoiceDetail->user_id;
        $data['reference']='eway';
        $data['amount']=$total_amount;
        $data['status']='paid';

        $mr_number=GenerateOrderNumber::generate_number('money-receipt');
        $data['invoice_no']=$mr_number['generated_number'];

        $payment= MktgInvoice::create($data);

        GenerateOrderNumber::update_row($mr_number['setting_id'],$mr_number['number']);

        DB::beginTransaction();
        try{
            $user['admin'] = \DB::table('user')->where('username', '=', 'super-admin')->first();
            $user['agent'] = User::findOrFail(\Auth::id());

            DB::commit();

            \Mail::send('mktg::payment.mail', array('payment_details'=>$payment),
                function($message) use ($user,$payment)
                {
                    $message->from('mrs@gmail.com', 'MRS');
                    $message->to($user['admin']->email)->cc($user['agent']->email);
                    $message->subject('Payment for the Order '.$payment->invoice_no);
                });

            Session::flash('message','Payment placed successfully.');
        }catch (\Exception $e){
            DB::rollback();
            Session::flash('error', $e->getMessage());
            return redirect()->back();
        }
        return redirect('order-details/'.$id);
    }


    /**
     * @param $id
     * @param $status
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
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