@extends('admin::layouts.master')

@section('content')

    <style>
        .invoice-list { border:0px; !important; background: black; color: #909090;}
        .table thead tr th { border:1px solid #202020; border-bottom: 0px !important;}
        .table thead tr { border-bottom: 0px !important; border-left: 1px solid #202020; border-bottom: 1px solid #202020;}
        .table tbody tr td {border-top:0px !important; background: linear-gradient(0deg, #101010,#202020);}
        .invoice-list thead tr { background:linear-gradient(45deg,#f36f21,#f47f32); color:#ffffff;}
        .invoice-list thead.head-top tr { background:linear-gradient(0deg,#909090,#606060); color:#ffffff;}

        .no-border { border:0px !important; }
        .invoice-list h1, .table thead tr th { text-shadow:1px 1px 3px #404040;}
        .invoice-list h1 {padding: 10px; margin:0; font-size:20px; }

    </style>


    <div class="container-fluid">
        <div class="no-border">
            <table cellspacing="0" cellpadding="0" border="0" class="table size-13 invoice-list">
                <thead class="head-top">
                <tr>
                    <td colspan="7">
                        <h1>
                            <span class="glyphicon glyphicon-list">&nbsp;</span>{{ $pageTitle }}
                        </h1>
                    </td>
                </tr>
                </thead>
                <thead>
                <tr>
                    <th>SL/No.</th>
                    <th>Type</th>
                    <th>Code</th>
                    <th>Last Number</th>
                    <th>Increment</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php $j = 1; ?>
                    @foreach($data as $row)
                        <tr>
                            <td class="text-center">{{ $j++ }}</td>
                            <td style="font-weight:normal;">{{ $row->type }}</td>
                            <td style="font-weight:normal;">{{ $row->code }}</td>
                            <td style="font-weight:normal;">{{ $row->last_number }}</td>
                            <td style="font-weight:normal;">{{ $row->increment }}</td>
                            <td style="font-weight:normal;">{{ $row->status }}</td>
                            <td class="text-center">
                                {{--<a href="--}}{{--{{ route('invoice') }}--}}{{--" class="btn btn-primary btn-xs" data-content="View" data-placement="left"><span class="glyphicon glyphicon-eye-open"></span></a>--}}
                                <a href="{{--{{ route('invoice') }}--}}" class="btn btn-warning btn-xs" data-content="View" data-placement="left"><span class="glyphicon glyphicon-edit"></span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal  -->
    <div class="modal fade" id="etsbModal" tabindex="" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

            </div>
        </div>
    </div>
    <!-- modal -->

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