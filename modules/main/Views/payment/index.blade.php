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
                    <td colspan="4">
                        <h1>
                            <span class="glyphicon glyphicon-list">&nbsp;</span> {{ $pageTitle }}
                        </h1>
                    </td>
                </tr>
                </thead>
                <thead>
                <tr>
                    <th>Type</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                    @if(isset($payments))
                        @foreach($payments as $payment)
                            <tr>
                                <td class="text-center">{{ $payment->type }}</td>
                                <td class="text-center">{{ '$'.$payment->amount }}</td>
                                <td class="text-center">{{ $payment->status }}</td>
                                <td><a href="{{ URL::to('main/view-payment-detail/'.$payment->id) }}" class="btn btn-primary" data-placement="left" data-content="Details"><span class="glyphicon glyphicon-stats"> Details</span></a></td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

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