@extends('admin::layouts.master')

@section('content')



    <div class="container-fluid">
        <div class="no-border">
            <table cellspacing="0" cellpadding="0" border="0" class="table size-13 quote-list">
                <thead class="head-top">
                <tr>
                    <td colspan="4">
                        <h1>
                            <span class="glyphicon glyphicon-list">&nbsp;</span> {{ $pageTitle }}
                        </h1>
                    </td>
                </tr>
                </thead>
                <thead>
                <tr>
                    <th>Quote No.</th>
                    <th>Solution Type</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody>
                {{--@if(isset($data))
                    @foreach($data as $row)
                        <tr>
                            <td class="text-center"><a href="{{ route('retrieve-quote-details/'.$row->id) }}" class="underline"> {{ $row->quote_number }} </a></td>
                            <td style="font-weight:normal;">{{ $row->property_detail_id }}</td>
                            <td class="text-center">{{ $row->created_at }}</td>
                        </tr>
                    @endforeach
                @endif--}}
                @foreach($data as $quote)
                    <tr>
                        <td class="text-center"><a href="{{ route('retrieve-quote-details-demo') }}" class="underline"> {{ $quote->id }} </a></td>
                        <td style="font-weight:normal;">{{ $quote->solution_type['title'] }}</td>
                        <td class="text-center">{{ date('d M Y',strtotime($quote->created_at)) }}</td>
                        <td><a href="{{ URL::to('main/edit_quote/'.$quote->id) }}" class="btn btn-primary" data-placement="left" data-content="Edit"><span class="glyphicon glyphicon-edit"></span></a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>

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