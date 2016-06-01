@extends('admin::layouts.master')

@section('content')



    <div class="container-fluid">
        <div class="no-border">
            <table cellspacing="0" cellpadding="0" border="0" class="table size-13 quote-list">
                <thead class="head-top">
                <tr>
                    <td colspan="5">
                        <h1>
                            <span class="glyphicon glyphicon-list">&nbsp;</span> {{ $pageTitle }}
                        </h1>
                    </td>
                </tr>
                </thead>
                <thead>
                <tr>
                    <th>{{--Quote No.--}}Order No.</th>
                    <th>Agent Name</th>
                    <th>Business Name</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                @foreach($data as $quote)
                    <tr>
                        <td class="text-center">{{ $quote->quote_number }}</td>
                        <td style="font-weight:normal;">{{ $quote->relUser['username'] }}</td>
                        <td style="font-weight:normal;">{{ $quote->relBusiness['title'] }}</td>
                        <td class="text-center">{{ date('d M Y',strtotime($quote->created_at)) }}</td>
                        <td><a href="{{ URL::to('main/quote-detail/'.$quote->id) }}" class="btn btn-primary" data-placement="left" data-content="Details"><span class="glyphicon glyphicon-stats"> Details</span></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <span class="pull-left size-13 paginate-right-top-40" style="text-align: right">{!! str_replace('/?', '?', $data->render()) !!} </span>
        </div>
    </div>

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