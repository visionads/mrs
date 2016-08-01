@extends('admin::layouts.master')

@section('content')


    <div id="container" class="container pages new_order font-droid">

        <div class="col-sm-12">
            @if($order->status!='invoiced')
                <a href="{{ route('make-invoice',$order->id) }}" class="btn btn-primary pull-right" onclick="return confirm('Are your sure ?')">Confirm Order</a>
                <a href="{{ route('marketing-material-printing') }}" class="btn btn-warning pull-right">Continue Shopping</a>
            @endif
            @if(session('user-role')!='admin' && session('user-role')!='super-admin')
                    <a href="{{ route('mktg-order') }}" class="btn btn-danger pull-right">Back</a>
             @else
                <a href="{{ route('payments') }}" class="btn btn-danger pull-right">Back</a>

            @endif

            <table class="table table-striped table-responsive size-13 mktg_quote-list" cellspacing="0" cellpadding="0" border="0">
                <thead class="head-top">
                <tr>
                    <td colspan="7">
                        <h3>
                            <span class="glyphicon glyphicon-list">&nbsp;</span> {{ $pageTitle }} of {{ $order->order_no }}
                        </h3>
                    </td>
                </tr>
                </thead>
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Type</th>
                    <th>Amount</th>
                    @if($order->status != 'invoiced')
                    <th>Action</th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @if(isset($order_details))
                    @foreach($order_details as $od)
                        <tr>
                            <td>@if($od->io_title==null){{ $od->title }} @else {{ $od->io_title }} @endif</td>
                            <td>{{ $od->type }}</td>
                            <td>{{ $od->price }}</td>
                            @if($order->status != 'invoiced')
                            <td>
                                    <a href="{{ route('delete-order-details',$od->id) }}" class="btn btn-danger" onclick="return confirm('Are you confirm to delete it ?')"><i class="fa fa-trash"></i></a>
                            </td>
                            @endif
                        </tr>
                    @endforeach
                @endif
                <tr>
                    <th colspan="2" class="text-right">Total</th>
                    <th>{{ $order->amount }}</th>
                    @if($order->status != 'invoiced')
                    <th></th>
                    @endif
                </tr>
                <tr>
                    <th colspan="2" class="text-right">GST 10%</th>
                    <th>{{ $order->gst }}</th>
                    @if($order->status != 'invoiced')
                    <th></th>
                    @endif
                </tr>
                <tr>
                    <th colspan="2" class="text-right">Total</th>
                    <th>{{ $order->total_amount }}</th>
                    @if($order->status != 'invoiced')
                    <th></th>
                    @endif
                </tr>
                </tbody>
            </table>
                @if(session('user-role')!='admin' && session('user-role')!='super-admin')
                    @if($order->status!='invoiced')
                        <a href="{{ route('make-invoice',$order->id) }}" class="btn btn-primary pull-right" onclick="return confirm('Are your sure ?')">Confirm Order</a>
                    @else
                        <style>
                            .eway-button span{
                                padding: 10%;
                                width: 200px;
                                text-align: center;
                                height: 70px;
                                color: lightyellow;
                            }
                        </style>
                        <?php
                        $total_amount= $order->total_amount * 100;
                        $email= \Illuminate\Support\Facades\Auth::user()->email;

                        ?>

                        <script src="https://secure.ewaypayments.com/scripts/eCrypt.js"
                                class="eway-paynow-button"
                                data-publicapikey="epk-4AABBD0F-8893-4863-8776-ABF469799708"
                                data-amount={{$total_amount}}
                                        data-currency="AUD"
                                data-buttoncolor="#ffc947"
                                data-buttonsize="100"
                                data-buttonerrorcolor="#f2dede"
                                data-buttonprocessedcolor="#dff0d8"
                                data-buttondisabledcolor="#f5f5f5"
                                data-buttontextcolor="#000000"
                                data-invoiceref={{ $order->invoice_no }}
                                        data-invoicedescription='Payment'
                                data-email= {{ $email }}
                                        data-phone=''
                                data-allowedit="true"
                                data-resulturl={{route('payment-success', ['transaction_id'=>$order->id,'paid_amount'=>$order->total_amount])}}
                                >
                        </script>
                    @endif
                @endif


        </div>

    </div>


    {{--<button onClick="eCrypt.showModalPayment(ewayConfig, resultCallback);">Pay with eWAY</button>--}}

    @include('mktg::marketing_material.agency_stationary_materials._scripts')

@stop