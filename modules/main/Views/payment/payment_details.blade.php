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
            <div class="col-sm-12 col-md-6 col-md-offset-3">
                <table cellspacing="0" cellpadding="0" border="0" class="table size-13 quote-list">
                    <thead class="head-top">
                    <tr>
                        <td colspan="4">
                            <h1>
                                <span class="glyphicon glyphicon-list">&nbsp;</span> {{ $pageTitle }}
                            </h1>
                        </td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th>Quote Number</th>
                        <td>{{ $payment_details->quote_number }}</td>
                    </tr>
                    <tr>
                        <th>Transaction ID</th>
                        <td>{{ $payment_details->invoice_no }}</td>
                    </tr>
                    <tr>
                        <th>Payment Type</th>
                        <td>{{ $payment_details->type }}</td>
                    </tr>
                    <tr>
                        <th>Paid Amount</th>
                        <td>${{ $payment_details->amount }}</td>
                    </tr>
                    <tr>
                        <th>Currency</th>
                        <td>{{ $payment_details->currency }}</td>
                    </tr>
                    <tr>
                        <th>Payment Status</th>
                        <td>{{ $payment_details->status }}</td>
                    </tr>
                    <tr>
                        <th>Total Amount</th>
                        <td>${{ $payment_details->total_amount }}</td>
                    </tr>
                    </tbody>
                </table>
                <a href="{{ URL::previous() }}" class="btn btn-primary pull-right">Back</a>
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