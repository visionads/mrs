<!DOCTYPE html>
<html class="gt-ie8 gt-ie9 not-ie pxajs"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> {{isset($pageTitle) ? $pageTitle:'Market Realty Solutions'}} </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,400italic' rel='stylesheet' type='text/css'>
    {{--<link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&amp;subset=latin" rel="stylesheet" type="text/css">--}}

    {{--//Bootstrap CSS--}}
    <link href="{{ URL::asset('assets/css/bootstrap.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/css/bootstrap-theme.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/css/pages.min.css') }}" rel="stylesheet" type="text/css" >
    {{--//Custom CSS for this theme--}}
    <link href="{{ URL::asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" >

    {{-- Data Tables CSS--}}
    <link href="{{ URL::asset('assets/css/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/css/buttons.dataTables.min.css') }}" rel="stylesheet" type="text/css" >

    {{-- Data Tables js--}}
    <script src="https://code.jquery.com/jquery-1.12.3.js"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>


    {{-- Date Picker --}}
    <link href="{{ URL::asset('assets/css/bootstrap-datepicker3.css') }}" rel="stylesheet" type="text/css" >
    {{--<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>--}}

</head>

<body>

    <div id="main-wrapper">


        <!-- Header -->
        @include('admin::layouts.header')


        <!-- Container -->
        {{--<div class="container-fluid text-center content-height-100">
            @include('admin::layouts.messages')
                @yield('content')

        </div>--}}
        <div class="container-fluid text-center content-height-100">

                @yield('content')

        </div>

    </div>

    <script>
        $(document).ready(function(){
            //data Tables
            //$('#example').DataTable();

            //date picker
            var date_input=$('input[id="date_id"]'); //our date input has the name "date"
            var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
            date_input.datepicker({
                format: 'yyyy-mm-dd',
                container: container,  // need more clarification
                todayHighlight: true,
                autoclose: true,
            })

            // For Content Full Screen
            /*$('.content-height-100').height($(window).height());*/
        })

        $(document).ready(function() {
            $('#example').DataTable( {
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        download: 'open',
                        //download: 'download',
                        text: 'PDF open in new tab'
                    },
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            } );
        } );
    </script>

    <script type="text/javascript" src="{{ URL::asset('assets/js/npm.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery-ui.min.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap-datepicker.min.js') }}"></script>
    {{-- Data Tables --}}
    {{--<script type="text/javascript" src="{{ URL::asset('assets/js/dataTables.bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>--}}

</body>
</html>

