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

    <div class="container-fluid">
        <div class="no-border">
            <table cellspacing="0" cellpadding="0" border="0" class="table size-13 quote-list">
                <thead class="head-top">
                <tr>
                    <td colspan="6">
                        <h1>
                            <span class="glyphicon glyphicon-list">&nbsp;</span>{{ $pageTitle }}
                        </h1>
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
                    @if(isset($transactions))
                        @foreach($transactions as $transaction)
                            <tr>
                                <td class="text-center">{{ $transaction->invoice_no }}</td>
                                <td class="text-center">{{ '$ '.number_format($transaction->total_amount,2) }}</td>
                                <td class="text-center">
                                    <?php $amount=0 ?>
                                    @if(count($transaction->relPayment)>0)
                                        @foreach($transaction->relPayment as $payment)
                                            <?php $amount+=$payment['amount'] ?>
                                        @endforeach
                                    @endif
                                    {{ '$ '.number_format($amount,2) }}
                                </td>
                                <td>
                                    <?php
                                    if($transaction->total_amount == $amount && $amount > 0){
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
                                    }
                                    ?>
                                </td>
                                <td class="text-center">{{ date('d M Y',strtotime($transaction->created_at)) }}</td>
                                <td><a href="{{ URL::to('main/view-payment-detail/'.$transaction->id) }}" class="btn btn-primary" data-placement="left" data-content="Details"><span class="glyphicon glyphicon-stats"> Details</span></a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <span class="pull-left size-13 paginate-right-top-40" style="text-align: right">{!! str_replace('/?', '?', $transactions->render()) !!} </span>

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