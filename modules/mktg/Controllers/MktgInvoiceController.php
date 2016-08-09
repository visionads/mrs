<?php

namespace Modules\Mktg\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Session;
use Modules\Admin\Helpers\ImageResize;
use App\MktgMaterial;
use App\MktgArtwork;
use App\MktgMenuItem;
use App\MktgItemOption;
use App\MktgMenuItemImage;
use App\MktgItemValue;
use App\MktgOrder;
use App\MktgInvoice;
use App\MktgOrderDetail;
use App\GenerateInvoiceNumber;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Validator;

class MktgInvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //exit('Welcome !');
        $data['pageTitle'] = 'Invoice List';
        $data['invoices']= MktgInvoice::where('invoice_type','INV')->paginate(30);
        return view('mktg::invoice.invoice_list',$data);
    }

    public function make_invoice($order_id)
    {
        //exit('welcome!');
        //=== load Order model
        $order_data = MktgOrder::findOrFail($order_id);
        //print_r($order_data); exit();

        //=== load Invoice model
        $model_invoice = new MktgInvoice();

        //=== Check the existence of an invoice against any specific order
        $check_invoice = $model_invoice->where('mktg_order_id');
        // #800000
        // #035d03

        $invoice_data = $model_invoice->get();

        //=== Generate Invoice Number
        $invoice_no = GenerateInvoiceNumber::generate_invoice_number('invoice-number');
        //print_r($invoice_no['generated_number']);exit();

        $input_arr = array
        (
            'mktg_order_id' =>  $order_data->id,
            'user_id' =>  $order_data->user_id,
            'invoice_type'  =>  'INV',
            'invoice_no'    =>  $invoice_no['generated_number'],
            'amount'        =>  $order_data->total_amount,
            'reference'     =>  'n',
            'status'        =>  'Invoiced'
        );
//        print_r($input_arr);exit();

        DB::beginTransaction();
        try{
            //$model_invoice->save($input_arr);
            MktgInvoice::create($input_arr);
            GenerateInvoiceNumber::update_row($invoice_no['setting_id'],$invoice_no['number']);

            $order_data->status='invoiced';
            $order_data->save();
            DB::commit();
            Session::flash('message', 'Successfully Added!');
        }catch(\Exception $e){
            DB::rollback();
            Session::flash('danger', $e->getMessage());
        }

        return redirect()->route('mktg-invoice-list');
        //return view('mktg::invoice.invoice_list',$data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
