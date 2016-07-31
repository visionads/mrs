@extends('admin::layouts.master')

@section('content')


    <div id="container" class="container pages new_order font-droid">

        <div class="col-sm-12">
            <a href="{{ route('make-invoice',$order->id) }}" class="btn btn-primary pull-right">Make Invoice</a>
            <a href="{{ route('marketing-material-printing') }}" class="btn btn-warning pull-right">Continue Shopping</a>
            <a href="{{ route('mktg-order') }}" class="btn btn-danger pull-right">Back</a>

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
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($order_details))
                    @foreach($order_details as $od)
                        <tr>
                            <td>@if($od->io_title==null){{ $od->title }} @else {{ $od->io_title }} @endif</td>
                            <td>{{ $od->type }}</td>
                            <td>{{ $od->price }}</td>
                            <td>
                                <a href="{{ route('delete-order-details',$od->id) }}" class="btn btn-danger" onclick="return confirm('Are you confirm to delete it ?')"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                @endif
                <tr>
                    <th colspan="2" class="text-right">Total</th>
                    <th>{{ $order->total_amount }}</th>
                    <th></th>
                </tr>
                </tbody>
            </table>
            <a href="{{ route('make-invoice',$order->id) }}" class="btn btn-primary pull-right">Make Invoice</a>

        </div>

    </div>

    @include('mktg::marketing_material.agency_stationary_materials._scripts')

@stop