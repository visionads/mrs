@extends('admin::layouts.master')

@section('content')



    <div class="container-fluid">
        <div class="theme-default main-menu-animated page-invoice gray-bg">
            <div id="main-wrapper">
                <div id="content-wrapper">
                    <div class="page-header" style="border:0px;">
                        <h1 style="background:#dedede;padding: 10px 10px 0 10px; margin:0;" class="size-20"><span class="glyphicon glyphicon-file"></span>Invoice Page
                            <div class="pull-right">
                                <a href="{{ route('invoice-list') }}" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;&nbsp;Back to Invoice List</a>
                                @if(isset($payment))
                                    <a href="{{ URL::to('main/invoice-print/'.$payment->id) }}" class="btn btn-primary"  target="_blank"><span class="glyphicon glyphicon-print"></span>&nbsp;&nbsp;Print version</a>
                                @endif
                            </div>

                        </h1>
                    </div>

                    <div class="panel invoice">
                        <div class="invoice-header">
                            <h3>
                                <div>
                                    <small><strong>MRS</strong>App</small><br>
                                    {{ (isset($transaction))?$transaction->invoice_no:'' }}
                                </div>
                            </h3>
                            <address>
                                {{--{{ Auth::user()->username }}--}}
                                {{ $vendor_name }}<br>
                                {{ $vendor_address }}
                            </address>
                            <div class="invoice-date">
                                <small><strong>Date</strong></small><br>
                                {{ (isset($transaction))?date('M d Y',strtotime($transaction->created_at)):'' }}
                            </div>
                        </div> <!-- / .invoice-header -->
                        <div class="invoice-info">
                            <div class="invoice-recipient">
                                @if(isset($quote))
                                    <strong>{{ $quote->relPropertyDetail['owner_name'] }}</strong><br>
                                    {{ $quote->relPropertyDetail['address'] }}
                                @endif
                            </div> <!-- / .invoice-recipient -->
                            <div class="invoice-total">
                                TOTAL:
                                <span>${{ (isset($transaction))?$transaction->total_amount:'0.00' }}</span>
                            </div> <!-- / .invoice-total -->
                        </div> <!-- / .invoice-info -->
                        <hr>
                        <div class="invoice-table">
                            <table>
                                <thead>
                                <tr>
                                    <th>
                                        Task description
                                    </th>
                                    <th>
                                        Amount
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>
                                        Photography
                                    </td>
                                    <td>
                                        $ {{ number_format($photography_price,2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Signboard Package
                                    </td>
                                    <td>
                                        $ {{ number_format($signboard_price,2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Print Material
                                    </td>
                                    <td>
                                        $ {{ number_format($print_material_price,2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Distribution of Print Material
                                    </td>
                                    <td>
                                        $ 0.00
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Digital Media
                                    </td>
                                    <td>
                                        $ {{ number_format($digital_media_price,2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Local Media
                                    </td>
                                    <td>
                                        $ {{ number_format($local_media_price,2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Total
                                    </th>
                                    <td>
                                        $ {{ number_format($total,2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Paid
                                    </th>
                                    <td>
                                        $ {{ number_format($payment->amount,2) }}
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div> <!-- / .invoice-table -->
                    </div> <!-- / .invoice -->
                    <!-- /5. $INVOICE_PAGE -->

                </div> <!-- / #content-wrapper -->
                <div id="main-menu-bg"></div>
            </div> <!-- / #main-wrapper -->

            <!-- Get jQuery from Google CDN -->
            <!--[if !IE]> -->
            <script type="text/javascript"> window.jQuery || document.write('<script src="assets/javascripts/jquery.min.js">'+"<"+"/script>"); </script>
            <!-- <![endif]-->
            <!--[if lte IE 9]>
            <script type="text/javascript"> window.jQuery || document.write('<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js">'+"<"+"/script>"); </script>
            <![endif]-->


        </div>
    </div>


@stop