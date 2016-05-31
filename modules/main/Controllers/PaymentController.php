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
        $pageTitle = 'Transactions';
        $role_name = User::getRole(Auth::user()->id) ;
        if($role_name == 'admin' || $role_name == 'super-admin')
        {
            //exit('sdkjflksjd');
            //$data = Payment::with('relTransaction')->orderBy('id','DESC')->paginate(10);
            $data = Transaction::orderBy('id','DESC')->paginate(10);

            //$data = Payment::with('relTransaction')->get();
            //$amount = $data->relTransaction;
            /*$i = 0;
            foreach($data as $dd){
                $i++;
            }
            print_r($i); exit();*/
            //print_r($data[0]['amount']); exit();
            /*$data = DB::table('transaction')
                ->leftJoin('payment', 'transaction.id', '=', 'payment.transaction_id')
                ->get();
            print_r($data); exit();*/
        }
        else
        {
            $data = Transaction::where('business_id', Auth::user()->business_id)->orderBy('id','DESC')->paginate(10);
        }

//        dd($data);
        return view("main::payment.index",['pageTitle'=>$pageTitle, 'transactions'=>$data]);
    }
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
        $pageTitle = 'Payment Details';
        $transaction = Transaction::getTransactionDetails($id);
        $payments = Payment::where('transaction_id',$id)->get();
//        dd($payments);
        return view("main::payment.payment_details",['pageTitle'=>$pageTitle, 'payment_details'=>$payments,'transaction'=>$transaction]);

    }



}