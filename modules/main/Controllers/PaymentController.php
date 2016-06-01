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
        $pageTitle_bill_amount = 'Transaction Details (Bill Amount)';
        $pageTitle_paid_amount = 'Payment Details (Paid Amount)';
        $transaction = Transaction::getTransactionDetails($id); //-- Old
//        dd($transaction);
        //$transaction = Transaction::where('id',$id)->first(); // -- Ram -- To show the bill amount in transaction table
        //print_r($transaction->id); exit();
        $payments = Payment::where('transaction_id',$id)->get();
//        dd($payments);
        return view("main::payment.payment_details",['pageTitle_bill_amount'=>$pageTitle_bill_amount,'pageTitle_paid_amount'=>$pageTitle_paid_amount, 'payment_details'=>$payments,'transaction'=>$transaction]);

    }



}