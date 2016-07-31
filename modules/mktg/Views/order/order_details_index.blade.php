@extends('admin::layouts.master')

@section('content')


    <div id="container" class="container pages new_order font-droid">

        <div class="col-sm-12">
            <table class="table table-striped table-responsive size-13 mktg_quote-list" cellspacing="0" cellpadding="0" border="0">
                <thead class="head-top">
                <tr>
                    <td colspan="5">
                        <h3>
                            <span class="glyphicon glyphicon-list">&nbsp;</span> {{ $pageTitle }}
                        </h3>
                    </td>
                </tr>
                </thead>
                <thead>
                    <tr>
                        <th>Order Type</th>
                        <th>Amount</th>
                        <th>Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($data))
                        @foreach($data as $row)
                        <tr>
                            <td>{{ $row->type }}</td>
                            <td>{{ number_format($row->amount,2) }}</td>
                            <td>{{ isset($row->total_amount)?$row->total_amount:'0.00' }}</td>
                        </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

    </div>

    @include('mktg::marketing_material.agency_stationary_materials._scripts')

@stop