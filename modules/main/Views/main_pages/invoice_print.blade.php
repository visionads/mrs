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
    <div class="invoice-header">
        <h3>
            <div>
                <small><strong>Lander</strong>App</small><br>
                INVOICE #244
            </div>
        </h3>
        <address>
            LanderApp Ltd.<br>
            Los Angeles, Lander Street, 32<br>
            90080 CA, USA
        </address>
        <div class="invoice-date">
            <small><strong>Date</strong></small><br>
            February 21, 2014
        </div>
    </div> <!-- / .invoice-header -->
    <div class="invoice-info">
        <div class="invoice-recipient">
            <strong>Mr. John Smith</strong><br>
            New York, Pass Avenue, 109<br>
            10012 NY, USA
        </div> <!-- / .invoice-recipient -->
        <div class="invoice-total">
            TOTAL:
            <span>$4,657.75</span>
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
                    Rate
                </th>
                <th>
                    Hours
                </th>
                <th>
                    Line total
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>
                    Website design and development
                    <div class="invoice-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</div>
                </td>
                <td>
                    $50.00
                </td>
                <td>
                    50
                </td>
                <td>
                    $2,500.00
                </td>
            </tr>
            <tr>
                <td>
                    Branding
                    <div class="invoice-description">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore.</div>
                </td>
                <td>
                    $47.95
                </td>
                <td>
                    45
                </td>
                <td>
                    $2,157.75
                </td>
            </tr>
            </tbody>
        </table>
    </div> <!-- / .invoice-table -->
</div> <!-- / .invoice -->
</body>

</html>