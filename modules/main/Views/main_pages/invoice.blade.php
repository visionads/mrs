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
                            <a href="{{ route('invoice-print') }}" class="btn btn-primary"  target="_blank"><span class="glyphicon glyphicon-print"></span>&nbsp;&nbsp;Print version</a>
                        </div>

                    </h1>
                </div>

                <div class="panel invoice">
                    <div class="invoice-header">
                        <h3>
                            <div>
                                <small><strong>MRS</strong>App</small><br>
                                INVOICE #001
                            </div>
                        </h3>
                        <address>
                            MRS Ltd.<br>
                            Los Angeles, Lander Street, 32<br>
                            90080 CA, USA
                        </address>
                        <div class="invoice-date">
                            <small><strong>Date</strong></small><br>
                            February 21, 2015
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