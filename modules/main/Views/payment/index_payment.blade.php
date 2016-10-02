@extends('admin::layouts.master')

@section('content')
    <style>
        .new_order label{
            color: white;
            font-size: 14px;
        }

        #new_order{
            text-align: right;
            background-color: #f36f21;
        }


    </style>

    <div id="container" class="container pages new_order font-droid">

        <div class="row center"><h1>{{ (isset($pageTitle))?$pageTitle:'Payment' }}</h1></div>
        <hr class="common-hr">
        <div class="row">
            <div class="col-sm-6 no-padding">
                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        <h1 class="size-25">Payment Summary</h1>

                        <p>
                            vendors can make invoice payment using invoice number.<br><br>

                            + Quote Number : {{ (isset($quote_number))?$quote_number:null }} <br>
                            + Invoice Number : {{ (isset($data))?$data->invoice_no:null }} <br>
                        </p>

                        <h2 style="color:#f36f21" class="size-20">Total : $ {{ (isset($data))?number_format($data->amount,2):'0.00' }}</h2>
                        <h2 style="color:#f36f21" class="size-20">GST : $ {{ (isset($data))?number_format($data->gst,2):'0.00' }} </h2>
                        <h2 style="color:#f36f21" class="size-20">Total COST Inc GST : $ {{ (isset($data))?number_format($data->total_amount,2):'0.00' }} </h2>
                    </div>
                </div>
            </div>
            <style>
                .amount-bg { background:#fff; padding:5px; border-radius:3px;}
            </style>

            <div class="col-sm-6 no-padding" id="submit_button_div">
                {{--<h2 style="color:#f12f01" class="size-25">Payment</h2>--}}

                <div class="form-group" style="margin: 20%">
                    <style>
                        .eway-button span{
                            padding: 10%;
                            width: 200px;
                            text-align: center;
                            height: 70px;
                            color: lightyellow;
                        }
                    </style>
                    <?php $total_amount= $data->total_amount * 100; ?>

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
                            data-invoiceref={{ $data->invoice_no }}
                                    data-invoicedescription='Payment'
                            data-email= {{ $user_data->email }}
                                    data-phone=''
                            data-allowedit="true"
                            data-resulturl={{url('main/payment-success', ['transaction_id'=>$data->id,'paid_amount'=>$data->total_amount])}}
                            >
                    </script>
                </div>

                 {{--<div class="form-group">
                     <div class="col-sm-12" id="submit_button">
                         {!! Form::submit('Pay Now', ['class' => 'btn new_button','data-placement'=>'top','data-content'=>'click to Pay now','onclick'=>'return confirm("Are you sure!")']) !!}&nbsp;
                     </div>
                 </div>--}}

            </div>
        </div>

    </div>



    @if($errors->any())
        <script type="text/javascript">
            $(function(){
                alert('sdkjf');
                $("#addData").modal('show');

            });
        </script>
    @endif

    @include('main::payment._script')

@stop