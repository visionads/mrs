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
            @if(!isset($role))
                <a href="{{ route('mktg-order') }}" class="btn btn-info pull-right">Order List</a>
                @if(!isset($payment))
                <a href="{{ route('payments') }}" class="btn btn-primary pull-right">Payments</a>
                @else
                    <a href="{{ route('invoice-list') }}" class="btn btn-primary pull-right">Invoice List</a>
                @endif
            @endif
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
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @if(isset($invoices))
                    @foreach($invoices as $invoice)
                        <?php
                        if($invoice->status=='paid') $status='approved'; else $status='paid';
                        ?>
                        <tr>
                            <td class="text-center">{{ $invoice->invoice_no }}</td>
                            <td class="text-center">{{ '$ '.number_format($invoice->amount,2) }}</td>
                            <td>
                                {{ $invoice->status }}
                            </td>
                            <td class="text-center">{{ date('Y-m-d',strtotime($invoice->created_at)) }}</td>
                            <td>
                                @if(isset($role))
                                    <a href="{{ URL::route('change_payment_status_for_mtkg_payment',$invoice->id.'/'.$status) }}" class="btn btn-primary" data-placement="left" data-content="Details"><span class="fa fa-star"></span> Change Status</a>
                                @elseif(!isset($payment))
                                    <a href="{{--{{ URL::to('main/invoice/'.$transaction->quote_id) }}--}}" class="btn btn-primary" data-placement="left" data-content="Details"><span class="fa fa-credit-card"></span> Pay Now</a>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
            {{--
            <span class="pull-left size-13 paginate-right-top-40" style="text-align: right">{!! str_replace('/?', '?', $transactions->render()) !!} </span>

            --}}
        </div>
    </div>




@stop