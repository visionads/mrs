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
        th { border-color: #808080 !important;}

    </style>

    <?php
        $paid = 0;
        if(isset($payment_details)){
            foreach($payment_details as $payment){
                $paid += $payment->amount;
            }
        }

    ?>

    <div class="container-fluid">
        <div class="no-border">
            <div class="col-sm-12 col-md-6">
                <table cellspacing="0" cellpadding="0" border="0" class="table size-13 quote-list">
                    <thead class="head-top">
                    <tr>
                        <td colspan="4">
                            <h1>
                                <span class="glyphicon glyphicon-tags">&nbsp;</span>
                                {{ $pageTitle_bill_amount }}
                                <span class="btn btn-danger pull-right">Due : $ {{ number_format(($transaction->total_amount - $paid),2) }}</span>
                            </h1>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>Quote Number</th>
                        <td>{{ $transaction->quote_number }}</td>
                    </tr>
                    <tr>
                        <th>Transaction ID</th>
                        <td>{{ $transaction->invoice_no }}</td>
                    </tr>
                    <tr>
                        <th>Currency</th>
                        <td>{{ $transaction->currency }}</td>
                    </tr>
                    <tr>
                        <th>Amount</th>
                        <td>{{ '$ '.number_format($transaction->amount,2) }}</td>
                    </tr>
                    <tr>
                        <th>GST</th>
                        <td>{{ '$ '.number_format($transaction->gst,2) }}</td>
                    </tr>
                    <tr>
                        <th style="color:orange">Total Amount</th>
                        <td style="color:orange">{{ '$ '.number_format($transaction->total_amount,2) }}</td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-12 col-md-6">
                <table cellspacing="0" cellpadding="0" border="0" class="table size-13 quote-list">
                    <thead class="head-top">
                    <tr>
                        <td colspan="5">
                            <h1>
                                <span class="glyphicon glyphicon-briefcase">&nbsp;</span>
                                {{ $pageTitle_paid_amount }}
                                <span class="btn btn-success pull-right"> Paid : $ {{ number_format($paid,2) }}</span>
                            </h1>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>Payment Type</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th>Payment Date</th>
                        <th>Action</th>
                    </tr>
                    @foreach($payment_details as $payment)
                        <tr>
                            <td>{{ $payment->type }}</td>
                            <td>{{ $payment->status }}</td>
                            <td>$ {{ number_format($payment->amount,2) }}</td>
                            <td>{{ date('d M Y h:s',strtotime($payment->created_at)) }}</td>
                            <td>
                                <a href="{{ URL::to('main/invoice/'.$payment->id) }}" class="btn btn-primary" data-placement="left" data-content="Create Invoice"><span class="glyphicon glyphicon-file"></span> Invoice</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <a href="{{ URL::previous() }}" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-chevron-left"></span> Back</a>
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