<?php
namespace Modules\Main\Controllers;

/**
 * Created by PhpStorm.
 * User: sr
 * Date: 5/8/16
 * Time: 1:55 PM
 */

use App\Quote;
use App\Transaction;
use App\User;
use App\Payment;
use App\UserImage;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;



class InvoiceController extends Controller
{
    public function invoice($id)
    {
        $pageTitle = 'Invoice';
        //print_r($id); exit();
        $payment=Payment::findOrFail($id); // -- Old
        //$payment=Payment::where('id',$id)->first();
        //print_r($payment->transaction_id); exit();
        $transaction=Transaction::findOrFail($payment->transaction_id);
        //print_r($transaction->quote_id); exit();
        $quote = Quote::with(
            'relPropertyDetail',
            'relPrintMaterialDistribution' ,
            'relQuoteLocalMedia',
            'relQuoteDigitalMedia',
            'relQuotePhotography',
            'relQuoteSignboard',
            'relQuotePrintMaterial'
        )->where('id', $transaction->quote_id)->first();

        // To get the selling_price from property_details table
        //$selling_price = $quote->relPropertyDetail ? $quote->relPropertyDetail->selling_price: '0.00';
        $vendor_name = $quote->relPropertyDetail ? $quote->relPropertyDetail->vendor_name: null;
        $vendor_address = $quote->relPropertyDetail ? $quote->relPropertyDetail->address: null;
        $vendor_phone = $quote->relPropertyDetail ? $quote->relPropertyDetail->vendor_phone: null;
        $vendor_signature_path = $quote->relPropertyDetail ? $quote->relPropertyDetail->vendor_signature_path: null;
        $agent_signature_path = $quote->relPropertyDetail ? $quote->relPropertyDetail->agent_signature_path: null;
        $agent_signature_date = $quote->relPropertyDetail ? $quote->relPropertyDetail->signature_date: null;

        // For Local Media Price ------------------------------------------
        $local_media_price = 0;
        foreach($quote->relQuoteLocalMedia as $local_media_p)
        {
            $local_media_price += $local_media_p->price;
        }


        // For Digital Media Price ------------------------------------------
        $digital_media_price = 0;
        foreach($quote->relQuoteDigitalMedia as $digital_media_p)
        {
            $digital_media_price += $digital_media_p->price;
        }

        // For Photography Price ----------------------------------------
        $photography_price = 0;
        foreach($quote->relQuotePhotography as $photography_p)
        {
            $photography_price += $photography_p->price;
        }

        // For Signboard Price ------------------------------------------
        $signboard_price = 0;
        foreach($quote->relQuoteSignboard as $signboard_p)
        {
            $signboard_price +=  $signboard_p->price;
        }

        // For Print Material Price -------------------------------------
        $print_material_price = 0;
        foreach($quote->relQuotePrintMaterial as $print_material_p)
        {
            $print_material_price += $print_material_p->price;
        }

        // For Total Selling Price --------------------------------------
        $selling_price = $local_media_price + $photography_price + $signboard_price + $print_material_price;

        // For Goods Service Tax ----------------------------------------
        $gst = $selling_price * 0.1;
        $total_with_gst = $selling_price + $gst;

        // Return to view Page-------------------------------------------
        return view('main::main_pages.invoice',[
            'pageTitle'=>$pageTitle,
            'transaction'=>$transaction,
            'payment'=>$payment,
            'quote'=>$quote,
            'total'=>$selling_price,
            'gst'=>$gst,
            'total_with_gst'=>$total_with_gst,
            'vendor_name' => $vendor_name,
            'vendor_address' => $vendor_address,
            'vendor_phone' => $vendor_phone,
            'vendor_signature_path'=>$vendor_signature_path,
            'agent_signature_path'=>$agent_signature_path,
            'agent_signature_date'=>$agent_signature_date,
            'local_media_price' => $local_media_price,
            'digital_media_price' => $digital_media_price,
            'photography_price'=>$photography_price,
            'signboard_price'=>$signboard_price,
            'print_material_price'=>$print_material_price
        ]);


//
//
//        $data['quote']=Quote::with('relPropertyDetail')->where('id',$data['transaction']->quote_id)->first();
//        $data['user']=User::findOrFail(Auth::id());
////        dd($data);
//        return view("main::main_pages.invoice",$data);
    }
    public function invoice_print($id)
    {
        $pageTitle = 'Invoice';
        $payment=Payment::findOrFail($id);
        $transaction=Transaction::findOrFail($payment->transaction_id);
        $quote = Quote::with(
            'relPropertyDetail',
            'relPrintMaterialDistribution' ,
            'relQuoteLocalMedia',
            'relQuoteDigitalMedia',
            'relQuotePhotography',
            'relQuoteSignboard',
            'relQuotePrintMaterial'
        )->where('id', $transaction->quote_id)->first();

        // To get the selling_price from property_details table
        //$selling_price = $quote->relPropertyDetail ? $quote->relPropertyDetail->selling_price: '0.00';
        $vendor_name = $quote->relPropertyDetail ? $quote->relPropertyDetail->vendor_name: null;
        $vendor_address = $quote->relPropertyDetail ? $quote->relPropertyDetail->address: null;
        $vendor_phone = $quote->relPropertyDetail ? $quote->relPropertyDetail->vendor_phone: null;
        $vendor_signature_path = $quote->relPropertyDetail ? $quote->relPropertyDetail->vendor_signature_path: null;
        $agent_signature_path = $quote->relPropertyDetail ? $quote->relPropertyDetail->agent_signature_path: null;
        $agent_signature_date = $quote->relPropertyDetail ? $quote->relPropertyDetail->signature_date: null;

        // For Local Media Price ------------------------------------------
        $local_media_price = 0;
        foreach($quote->relQuoteLocalMedia as $local_media_p)
        {
            $local_media_price += $local_media_p->price;
        }


        // For Digital Media Price ------------------------------------------
        $digital_media_price = 0;
        foreach($quote->relQuoteDigitalMedia as $digital_media_p)
        {
            $digital_media_price += $digital_media_p->price;
        }

        // For Photography Price ----------------------------------------
        $photography_price = 0;
        foreach($quote->relQuotePhotography as $photography_p)
        {
            $photography_price += $photography_p->price;
        }

        // For Signboard Price ------------------------------------------
        $signboard_price = 0;
        foreach($quote->relQuoteSignboard as $signboard_p)
        {
            $signboard_price +=  $signboard_p->price;
        }

        // For Print Material Price -------------------------------------
        $print_material_price = 0;
        foreach($quote->relQuotePrintMaterial as $print_material_p)
        {
            $print_material_price += $print_material_p->price;
        }

        // For Total Selling Price --------------------------------------
        $selling_price = $local_media_price + $photography_price + $signboard_price + $print_material_price;

        // For Goods Service Tax ----------------------------------------
        $gst = $selling_price * 0.1;
        $total_with_gst = $selling_price + $gst;

        // Return to view Page-------------------------------------------
        return view('main::main_pages.invoice_print',[
            'pageTitle'=>$pageTitle,
            'transaction'=>$transaction,
            'payment'=>$payment,
            'quote'=>$quote,
            'total'=>$selling_price,
            'gst'=>$gst,
            'total_with_gst'=>$total_with_gst,
            'vendor_name' => $vendor_name,
            'vendor_address'=>$vendor_address,
            'vendor_phone' => $vendor_phone,
            'vendor_signature_path'=>$vendor_signature_path,
            'agent_signature_path'=>$agent_signature_path,
            'agent_signature_date'=>$agent_signature_date,
            'local_media_price' => $local_media_price,
            'digital_media_price' => $digital_media_price,
            'photography_price'=>$photography_price,
            'signboard_price'=>$signboard_price,
            'print_material_price'=>$print_material_price
        ]);











//
//
//        $data['quote']=Quote::with('relPropertyDetail')->where('id',$data['transaction']->quote_id)->first();
//        $data['user']=User::findOrFail(Auth::id());
////        dd($data);
//        return view("main::main_pages.invoice",$data);
    }
    /*public function invoice_list()
    {
        $pageTitle = 'Pay Invoice List';
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
        return view("main::main_pages.invoice_list",['pageTitle'=>$pageTitle, 'transactions'=>$data]);
    }*/ // -- Ram

    public function invoice_list()
    {
        $pageTitle = 'Pay Invoice List';
        $role_name = User::getRole(Auth::user()->id) ;
        if($role_name == 'admin' || $role_name == 'super-admin')
        {
            //$data = Transaction::getAllTransactionWithPayment();
            $data = Quote::with('relBusiness','relUser')->orderBy('id','DESC')->paginate(10);
            //print_r($data); exit();
        }
        else
        {
            //$data = Transaction::getAllTransactionWithPaymentForAgent();
            $data = Quote::with('relBusiness','relUser')->where(['business_id'=> Auth::user()->business_id,'status'=>'placed-order'])->orderBy('id','DESC')->paginate(10);
        }
        return view("main::main_pages.new_invoice_list",['pageTitle'=>$pageTitle, 'data'=>$data]);
    } // -- Shajjad





}