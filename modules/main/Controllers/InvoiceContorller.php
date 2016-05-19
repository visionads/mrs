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
        $data['transaction']=Transaction::findOrFail($id);
        $data['quote']=Quote::with('relPropertyDetail')->where('id',$data['transaction']->quote_id)->first();
        $data['user']=User::findOrFail(Auth::id());
//        dd($data);
        return view("main::main_pages.invoice",$data);
    }
    public function invoice_print()
    {
        return view("main::main_pages.invoice_print");
    }
    public function invoice_list()
    {
        return view("main::main_pages.invoice_list");
    }


}