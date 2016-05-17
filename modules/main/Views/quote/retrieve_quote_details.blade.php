@extends('admin::layouts.master')

@section('content')

    <style>
        .invoice-list { border:0px; !important; background: black; color: #909090;}
        .table thead tr th { border:1px solid #202020; border-bottom: 0px !important;}
        .table thead tr { border-bottom: 0px !important; border-left: 1px solid #202020; border-bottom: 1px solid #202020;}
        .table tbody tr td {border-top:0px !important; background: linear-gradient(0deg, #f0f0f0,#e0e0e0); color:#404040;}
        .invoice-list thead tr { background:linear-gradient(45deg,#f36f21,#f47f32); color:#ffffff;}
        .invoice-list thead.head-top tr { background:linear-gradient(0deg,#909090,#606060); color:#ffffff;}

        .no-border { border:0px !important; }
        .invoice-list h1, .table thead tr th { text-shadow:1px 1px 3px #404040;}
        .invoice-list h1 {padding: 10px; margin:0; font-size:20px; }

    </style>


    <div id="">
        <div class="no-border">
            <table cellspacing="0" cellpadding="0" border="0" class="table size-13 invoice-list">
                <thead class="head-top">
                <tr>
                    <td colspan="3">
                        <h1>
                            <span class="glyphicon glyphicon-list">&nbsp;</span> {{ $pageTitle }}
                        </h1>
                    </td>
                </tr>
                </thead>
                <thead>
                <tr>
                    <th colspan="3">{{ $pageTitle }}</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td width="20%">Quote No.</td>
                    <td width="3%"> : </td>
                    <td>009898</td>
                </tr>
                <tr>
                    <td>Photography Package Comments</td>
                    <td> : </td>
                    <td>photography_package_comments</td>
                </tr>
                <tr>
                    <td>Signboard Package Comments</td>
                    <td> : </td>
                    <td>signboard_package_comments</td>
                </tr>
                <tr>
                    <td>Print Material Comments</td>
                    <td> : </td>
                    <td>print_material_comments</td>
                </tr>
                <tr>
                    <td>Print Material Distribution</td>
                    <td> : </td>
                    <td>print_material_distribution</td>
                </tr>
                <tr>
                    <td>Digital Media Note</td>
                    <td> : </td>
                    <td>digital_media_note</td>
                </tr>
                <tr>
                    <td>Local Media Note</td>
                    <td> : </td>
                    <td>local_media_note</td>
                </tr>
                </tbody>
            </table>
            <div style="text-align: right">
                <a href="{{ route('retrieve-quote') }}" class="btn new_button ">Back To Quote</a>&nbsp;
                <a href="{{ route('property-details') }}" class="btn new_button ">Proceed Order</a>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery-1.12.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
    @if($errors->any())
        <script type="text/javascript">
            $(function(){
                alert('sdkjf');
                $("#addData").modal('show');

            });
        </script>
    @endif

    <script>
        // tooltip for buttons
        $(".btn").popover({ trigger: "manual" , html: true, animation:false})
                .on("mouseenter", function () {
                    var _this = this;
                    $(this).popover("show");
                    $(".popover").on("mouseleave", function () {
                        $(_this).popover('hide');
                    });
                }).on("mouseleave", function () {
            var _this = this;
            setTimeout(function () {
                if (!$(".popover:hover").length) {
                    $(_this).popover("hide");
                }
            }, 300);
        });
        // tooltip for input field
        $(".form-control").tooltip();
    </script>

@stop