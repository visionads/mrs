<!DOCTYPE html>
<!--[if IE 8]>         <html class="ie8"> <![endif]-->
<!--[if IE 9]>         <html class="ie9 gt-ie8"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="gt-ie8 gt-ie9 not-ie"> <!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Invoice (Print version) - Pages - MRS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <!-- Open Sans font from Google CDN -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&amp;subset=latin" rel="stylesheet" type="text/css">
    {{--//Bootstrap CSS--}}
    <link href="{{ URL::asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/css/bootstrap-theme.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/css/pages.min.css') }}" rel="stylesheet" type="text/css" >
    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/npm.js') }}"></script>


    {{--//Custom CSS for this theme--}}
    <link href="{{ URL::asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" >


    {{-- Data Tables --}}
    <link href="{{ URL::asset('assets/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" >
    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery-1.12.0.min.js') }}"></script>


    {{-- Date Picker --}}
    <link href="{{ URL::asset('assets/css/bootstrap-datepicker3.css') }}" rel="stylesheet" type="text/css" >
    <script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
    <script>
        window.onload = function () {
            var restorepage = document.body.innerHTML;
            var printcontent = document.getElementById('invoice').innerHTML;
            document.body.innerHTML = printcontent;
            window.print();
            //window.print();
        };
    </script>
</head>


<body class="page-invoice page-invoice-print" id="invoice" style="background:#ffffff;">

<div class="invoice">

    <div class="container-fluid">
        <div class="theme-default main-menu-animated page-invoice gray-bg">
            <div id="main-wrapper">
                <div id="content-wrapper">
                    <div class="page-header" style="border:0px;">
                        {{--<h1 style="background:#dedede;padding: 10px 10px 0 10px; margin:0;" class="size-20"><span class="glyphicon glyphicon-file"></span>Invoice Page
                            <div class="pull-right">
                                <a href="{{ route('invoice-list') }}" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left"></span>&nbsp;&nbsp;Back to Invoice List</a>
                                @if(isset($payment))
                                    <a href="{{ URL::to('main/invoice-print/'.$payment->id) }}" class="btn btn-primary"  target="_blank"><span class="glyphicon glyphicon-print"></span>&nbsp;&nbsp;Print version</a>
                                @endif
                            </div>

                        </h1>--}}
                    </div>

                    <div class="panel invoice">
                        <div class="invoice-header">

                            <address>
                                {{--{{ Auth::user()->username }}--}}
                                Prepared By : <br><br>
                                <strong class="black">{{ $vendor_name }}</strong><br>
                                <strong class="lightblack">{{ $vendor_address }}</strong>
                            </address>
                            <address>
                                Prepared For : <br><br>
                                @if(isset($quote))
                                    <strong class="black">{{ $quote->relPropertyDetail['owner_name'] }}</strong><br>
                                    <strong class="lightblack">{{ $quote->relPropertyDetail['address'] }}</strong>
                                @endif
                            </address>

                            <div class="invoice-date">
                                <small><strong>Date</strong></small><br>
                                {{ (isset($transaction))?date('M d Y',strtotime($transaction->created_at)):'' }}
                            </div>
                        </div> <!-- / .invoice-header -->
                        <div class="invoice-info row">
                            {{--<div class="invoice-recipient" style="width:28%; border:1px solid #fff;">
                                @if(isset($quote))
                                    <strong>{{ $quote->relPropertyDetail['owner_name'] }}</strong><br>
                                    {{ $quote->relPropertyDetail['address'] }}
                                @endif
                            </div>--}} <!-- / .invoice-recipient -->
                            <div class="size-15 col-sm-4" style=" width:40%; float:left; border: 1px solid #fff;">
                                <table class="invoice-tbl-box">
                                    <tr><td><small>MR No.</small> </td><td>:</td><td>MR-00001</td></tr>
                                    <tr><td><small>Invoice No.</small> </td><td>:</td><td>{{ (isset($transaction))?$transaction->invoice_no:'' }}</td></tr>
                                </table>
                            </div>
                            <div class="size-15 col-sm-8" style=" width:60%; float:left; border: 1px solid #fff;">
                                {{--<div class=" size-13 col-sm-4 gray-bg-light" style=" width:33%; float: left; border: 1px solid #fff;">
                                    TOTAL:
                                    <span class="size-13"><br>$ {{ (isset($transaction))?number_format($transaction->total_amount,2):'0.00' }}</span>
                                </div>--}}
                                <div class=" size-20 col-sm-4 col-sm-offset-8 gray-bg-light" style=" width: 90%; text-align: right; float: right; border: 1px solid #fff; ">
                                    PAID :
                                    <span class="size-20 green">$ {{ (isset($payment)?number_format($payment->amount,2):'0.00') }}</span>
                                </div>
                                {{--<div class=" size-13 col-sm-4 gray-bg-light" style=" width:33%; float:left; border: 1px solid #fff; ">
                                    DUE :
                                    <span class="size-13 red"><br>$ {{ (isset($transaction) && isset($payment))?number_format($transaction->total_amount - $payment->amount,2):'0.00' }}</span>
                                </div>--}}

                                <!-- / .invoice-total -->
                            </div>
                        </div> <!-- / .invoice-info -->
                        <hr>
                        <div class="invoice-table">
                            <table class="invoice-tbl-box">
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
                                        <span style="border-bottom: 3px double #000;">$ {{ number_format($total_with_gst,2) }}</span>
                                    </td>
                                </tr>
                                {{--<tr>
                                    <th>
                                        Paid
                                    </th>
                                    <td class="darkgreen">
                                        $ {{ number_format($payment->amount,2) }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Due
                                    </th>
                                    <td class="darkred">
                                        $ {{ number_format(($total_with_gst - $payment->amount),2) }}
                                    </td>
                                </tr>--}}
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

</div>
</body>

</html>