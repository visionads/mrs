@extends('admin::layouts.master')

@section('content')


    <div id="container" class="container pages new_order font-droid">

        <div class="col-sm-12">

            <table class="table table-striped table-responsive size-13 mktg_quote-list" cellspacing="0" cellpadding="0" border="0">
                <thead class="head-top">
                <tr>
                    <td colspan="7">
                        <h3>
                            <span class="glyphicon glyphicon-list">&nbsp;</span> {{ $pageTitle }}
                            <a href="{{ route('mktg-invoice-list') }}" class="btn green-yellow-bg black pull-right"><i class="fa fa-arrow-circle-left">&nbsp;</i> Back To Invoice List</a>
                        </h3>
                    </td>
                </tr>
                </thead>
                <thead>
                    <tr>
                        <th>Order No.</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($data))
                        @foreach($data as $row)
                        <tr>
                            <td>{{ $row->order_no }}</td>
                            <td>{{ $row->date }}</td>
                            <td>{{ number_format($row->amount,2) }}</td>
                            <td>{{ isset($row->total_amount)?$row->total_amount:'0.00' }}</td>
                            <td>{{ $row->status }}</td>
                            <td style="width: 220px;">
                                <a href="{{ route('order-details',$row->id) }}" class="btn btn-primary btn-xs" style="display:inline !important;">Details</a>
                                @if($row->status != 'invoiced')
                                    <a href="{{ route('make-invoice',$row->id) }}" class="btn btn-warning btn-xs" style="display:inline !important;" onclick="return confirm('Are your sure ?')">Confirm Order</a>
                                    <a href="{{ route('delete-order',$row->id) }}" class="btn btn-danger btn-xs" style="display:inline !important;" onclick="return confirm('Are you confirm to delete ?')">Delete</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            <span class="pull-left size-13 paginate-right-top-40" style="text-align: right">{!! str_replace('/?', '?', $data->render()) !!} </span>

        </div>

    </div>

    @include('mktg::marketing_material.agency_stationary_materials._scripts')

@stop