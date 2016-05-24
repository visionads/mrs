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

        <div class="row center"><h1>{{ $pageTitle }}</h1></div>
        <hr class="common-hr">
        <div class="row">
            <div class="col-sm-6 no-padding">
                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        <h1 class="size-25">Payment Summary</h1>

                        <p>
                            vendors can make invoice payment using invoice number.<br><br>

                            + Quote Number : {{ $data->relTransaction['quote_id'] }} <br>
                            + Invoice Number : {{ $data->invoice_no }} <br>
                        </p>

                        <h2 style="color:#f36f21" class="size-20">Total : $ {{ $data->amount }}</h2>
                        <h2 style="color:#f36f21" class="size-20">GST : $ {{ $data->gst }} </h2>
                        <h2 style="color:#f36f21" class="size-20">Total COST Inc GST : $ {{ $data->total_amount }} </h2>
                    </div>
                </div>
            </div>
            <style>
                .amount-bg { background:#fff; padding:5px; border-radius:3px;}
            </style>
        </div>

    </div>

@stop