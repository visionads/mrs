@extends('admin::layouts.master')

@section('content')
{{--
    <style>
        .invoice-list { border:0px; !important; background: black; color: #909090;}
        .table thead tr th { border:1px solid #202020; border-bottom: 0px !important;}
        .table thead tr { border-bottom: 0px !important; border-left: 1px solid #202020; border-bottom: 1px solid #202020;}
        .table tbody tr td {border-top:0px !important; background: linear-gradient(0deg, #101010,#202020);}
        .invoice-list thead tr { background:linear-gradient(45deg,#f36f21,#f47f32); color:#ffffff;}
        .invoice-list thead.head-top tr { background:linear-gradient(0deg,#909090,#606060); color:#ffffff;}

        .no-border { border:0px !important; }
        .invoice-list h1, .table thead tr th { text-shadow:1px 1px 3px #404040;}
        .invoice-list h1 {padding: 10px; margin:0; font-size:20px; }

        a.btn { display:inline-block!important; width: auto !important;}
    </style>--}}


    <div class="container-fluid">
        <div class="no-border">
            <table cellspacing="0" cellpadding="0" border="0" class="table size-13 mktg_quote-list">
                <thead class="head-top">
                <tr>
                    <td colspan="6">
                        <h3>
                            <span class="glyphicon glyphicon-list">&nbsp;</span>{{ $pageTitle }}
                        </h3>
                    </td>
                </tr>
                </thead>
                <thead>
                <tr>
                    <th>Invoice No.{{--Transaction ID--}}</th>
                    <th>Bill Amount</th>
                    <th>Paid Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                {{--@if(isset($transactions))--}}
                    {{--@foreach($transactions as $transaction)--}}
                        <tr>
                            <td class="text-center">{{--{{ $transaction->invoice_no }}--}}</td>
                            <td class="text-center">{{--{{ '$ '.number_format($transaction->total_amount,2) }}--}}</td>
                            <td class="text-center">
                                <?php /*$amount=0*/ ?>
                                {{--@if(count($transaction->relPayment)>0)--}}
                                    {{--@foreach($transaction->relPayment as $payment)--}}
                                        <?php /*$amount+=$payment['amount']*/ ?>
                                    {{--@endforeach--}}
                               {{-- @endif--}}
                                {{--{{ '$ '.number_format($amount,2) }}--}}
                            </td>
                            <td>
                                <?php
                                /*if($transaction->total_amount == $amount && $amount > 0){
                                    echo '<span class="glyphicon glyphicon-ok green"></span>&nbsp; <span class=""> Paid</span>';
                                }
                                $difference = $transaction->total_amount - $amount;
                                if($difference < $transaction->total_amount && $difference > 0 )
                                {
                                    //echo '<span class="green">'.$transaction->total_amount.'Partially Paid-'.$amount.'-'.$difference.'</span>';
                                    echo '<span class="glyphicon glyphicon-off orange"></span>&nbsp; <span class=""> Partially Paid</span>';
                                }
                                //echo $amount;
                                if($amount <1 )
                                {
                                    echo '<span class="glyphicon glyphicon-remove darkred"></span>&nbsp; <span class=""> Not Paid</span>';
                                }
                                if($amount>$transaction->total_amount)
                                {
                                    echo '<span class="glyphicon glyphicon-flash darkpink"></span>&nbsp; <span class="">Over Paid</span>';
                                }*/
                                ?>
                            </td>
                            <td class="text-center"></td>
                            <td>
                                {{--@if($amount !== 0)--}}
                                    <a href="{{--{{ URL::to('main/invoice/'.$transaction->quote_id) }}--}}" class="btn btn-default" data-placement="left" data-content="Details"><span class="glyphicon glyphicon-stats"></span>Invoice</a>
                                    <a href="{{--{{ URL::to('main/view-payment-detail/'.$transaction->id) }}--}}" class="btn btn-primary" data-placement="left" data-content="Details"><span class="glyphicon glyphicon-stats"></span> Details</a>
                                {{--@else--}}
                                    <a href="{{--{{ URL::to('main/view-payment-detail/'.$transaction->id) }}--}}" class="btn btn-primary" data-placement="left" data-content="Details"><span class="glyphicon glyphicon-stats"></span> Details</a>
                                {{--@endif--}}

                            </td>
                        </tr>
                    {{--@endforeach--}}
                {{--@endif--}}
                </tbody>
            </table>
            {{--
            <span class="pull-left size-13 paginate-right-top-40" style="text-align: right">{!! str_replace('/?', '?', $transactions->render()) !!} </span>

            --}}
        </div>
    </div>




@stop