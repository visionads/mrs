<?php
namespace Modules\Main\Controllers;

/**
 * Created by PhpStorm.
 * User: sr
 * Date: 5/8/16
 * Time: 1:55 PM
 */

use App\Transaction;
use App\User;
use App\UserImage;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use App\Payment;
use DB;


class PaymentController extends Controller
{
    public function index()
    {
        $pageTitle = 'Transactions List';
        $role_name = User::getRole(Auth::user()->id) ;
        if($role_name == 'admin' || $role_name == 'super-admin')
        {
           //$data = Transaction::getAllTransactionWithPayment();
            $data=Transaction::with('relPayment')->orderBy('id','DESC')->paginate(10);
            //print_r($data); exit();
        }
        else
        {
            //$data = Transaction::getAllTransactionWithPaymentForAgent();
            $data=Transaction::with('relPayment')->where('business_id', Auth::user()->business_id)->orderBy('id','DESC')->paginate(10);
        }

//        dd($data);
        return view("main::payment.index",['pageTitle'=>$pageTitle, 'transactions'=>$data]);
    } // -- Ram
    public function index_payment()
    {
        $pageTitle = 'Payment';
        $data = '';
        return view("main::payment.index_payment",['pageTitle'=>$pageTitle, 'data'=>$data]);
    }
    public function store($id,$total_amount)
    {
        $data['transaction_id']=$id;
        $data['type']='eway';
        $data['amount']=$total_amount;
        $data['status']='success';
        $payment['payment']=Payment::create($data);
        $payment['transaction']=Transaction::findOrFail($id);
        $user['admin'] = \DB::table('user')->where('username', '=', 'super-admin')->first();
        $user['agent'] = User::findOrFail(\Auth::id());
//        dd($user['admin']->email);
//        return view('main::payment.mail',$payment);
//        dd($payment);
        try{
            \Mail::send('main::payment.mail', array('payment_details'=>$payment),
                function($message) use ($user,$payment)
                {
                    $message->from('bd.shawon1991@gmail.com', 'MRS');
                    $message->to($user['admin']->email)->cc($user['agent']->email);
                    $message->subject('Payment for the Order '.$payment['transaction']->invoice_no);
                });

            Session::flash('message','Payment placed successfully.');
        }catch (\Exception $e){
            dd($e->getMessage());
            Session::flash('error', $e->getMessage());
        }
        return redirect('main/invoice/'.$payment['payment']->id);
    }
    public function show($id)
    {
        $pageTitle_bill_amount = 'Transaction Bill ';
        $pageTitle_paid_amount = 'Paid Amount ';
        $transaction = Transaction::getTransactionDetails($id); //-- Old
        $stts_transaction = $transaction->status;
        //exit($stts_transaction);
//        dd($transaction);
        //$transaction = Transaction::where('id',$id)->first(); // -- Ram -- To show the bill amount in transaction table
        //print_r($transaction->id); exit();
        $payments = Payment::where('transaction_id',$id)->get();

        //===== To Find the total paid Amount ***//
        $paid = 0;
        foreach($payments as $payment){
            $paid += $payment->amount;
            $stts_payment = $payment->status;
        }
        //print_r($paid); exit();

        //===== Total Amount from Transaction ***//
        $total_amount = $transaction->total_amount;
        //print_r($total_amount); exit();

        //===== Total Due ***//
        $due = $total_amount - $paid;
        //print_r($due); exit();

        //===== Change Status of Payment table ***//
        //print_r($stts); exit();
        $status = [ 'status'=>'paid' ];

        if($due=='0' && $stts_transaction !== 'paid')
        {
            /*DB::beginTransaction();
            try{

                Payment::where('transaction_id', $id)->update($status);
                DB::commit();
                Session::flash('message', 'No Due !');

            }catch(\Exception $e){
                DB::rollback();
                //dd($e->getMessage());
                Session::flash('danger', $e->getMessage());
            }*/
            DB::beginTransaction();
            try{
                //exit($id);
                Transaction::where('id', $id)->update($status);
                DB::commit();
                Session::flash('message', 'No Due !');

            }catch(\Exception $e){
                DB::rollback();
                //dd($e->getMessage());
                Session::flash('danger', $e->getMessage());
            }
        }
        //else{ exit('Pass');}

        return view("main::payment.payment_details",['pageTitle_bill_amount'=>$pageTitle_bill_amount,'pageTitle_paid_amount'=>$pageTitle_paid_amount, 'payment_details'=>$payments,'transaction'=>$transaction]);

    }



}