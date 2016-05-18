@extends('admin::layouts.master')

@section('content')

    <style>
        .new_order label{
            color: white;
            font-size: 14px;
        }

        #new_order{
            text-align: right;
            background-color: #f36f21;
        }
        .commtable tr td { background:#303030; color:#d0d0d0; border-bottom: 1px solid #404040 !important;}
    </style>

    <div id="container" class="container pages new_order font-droid">
        <div class="col-md-12">
            <div class="col-sm-12" id="new_order_title"><span class="label size-25">{{ $pageTitle }}</span><br><br></div>
        </div>
        <div class="col-md-12">
            <div class="col-sm-6">

                    <div class="col-sm-12">
                        <table class="table table-striped size-13 commtable">
                            {{--@if(isset($data_pd))
                                @foreach($data_pd as $row_pd)
                                    <tr><td>Main Selling Line</td><td>:</td><td>{{ $row_pd->main_selling_line }}</td></tr>
                                    <tr><td>Property Description</td><td>:</td><td>{{ $row_pd->property_description }}</td></tr>
                                    <tr><td>Inspection Date</td><td>:</td><td>{{ $row_pd->inspection_date }}</td></tr>
                                    <tr><td>Inspection Features</td><td>:</td><td>{{ $row_pd->inspection_features }}</td></tr>
                                    <tr><td>Other Features</td><td>:</td><td>{{ $row_pd->other_features }}</td></tr>
                                    <tr><td>Selling Price</td><td>:</td><td>{{ $row_pd->selling_price }}</td></tr>
                                    <tr><td>Auction Time</td><td>:</td><td>{{ $row_pd->auction_time }}</td></tr>
                                    <tr><td>Offer</td><td>:</td><td>{{ $row_pd->offer }}</td></tr>
                                    <tr><td>Note</td><td>:</td><td>{{ $row_pd->note }}</td></tr>
                                @endforeach
                            @endif
                                <tr><td colspan="3" class="center">Print Material Distribution </td></tr>
                            @if(isset($data_pmd))
                                @foreach($data_pmd as $row_pmd)
                                    <tr><td>Quantity</td><td>:</td><td>{{ $row_pmd->quantity }}</td></tr>
                                    <tr><td>Is Surrounded</td><td>:</td><td>{{ $row_pmd->is_surrounded }}</td></tr>
                                    <tr><td>Other Address</td><td>:</td><td>{{ $row_pmd->other_address }}</td></tr>
                                    <tr><td>Date of Distribution</td><td>:</td><td>{{ $row_pmd->date_of_distribution }}</td></tr>
                                    <tr><td>Note</td><td>:</td><td>{{ $row_pmd->note }}</td></tr>
                                @endforeach
                            @endif--}}

                        </table>
                        <table class="table table-striped size-13 commtable">
                            {{--<tr><td colspan="3"><h1 class="size-16"><span class="glyphicon glyphicon-list">&nbsp;</span> {{ $pageTitle }}</h1></td></tr>--}}
                            <tr><td colspan="3"><h1 class="size-16"><span class="glyphicon glyphicon-list">&nbsp;</span> Details of the order summary</h1></td></tr>

                            <tr><th colspan="3">{{ $pageTitle }}</th></tr>

                            <tr><td>Quote No.</td><td> : </td><td>009898</td></tr>
                            <tr><td>Photography Package Comments</td><td> : </td><td>photography_package_comments</td></tr>
                            <tr><td>Signboard Package Comments</td><td> : </td><td>signboard_package_comments</td></tr>
                            <tr><td>Print Material Comments</td><td> : </td><td>print_material_comments</td></tr>
                            <tr><td>Print Material Distribution</td><td> : </td><td>print_material_distribution</td></tr>
                            <tr><td>Digital Media Note</td><td> : </td><td>digital_media_note</td></tr>
                            <tr><td>Local Media Note</td><td> : </td><td>local_media_note</td></tr>
                        </table>
                    </div>

            </div>


            <div class="col-sm-6">
                <h2 style="color:#f36f21">Total: $1234</h2>
                <h2 style="color:#f36f21">GST:$</h2>
                <h2 style="color:#f36f21">Total COST Inc GST: $</h2>

                <a href="{{ route('retrieve-quote') }}" class="btn new_button ">Back To Quote</a>&nbsp;
                <a href="{{ route('place-order') }}" class="btn new_button ">Proceed Order</a>
            </div>
        </div>
    </div>


    {{--<script type="text/javascript" src="{{ URL::asset('assets/js/jquery-1.12.0.min.js') }}"></script>
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
    </script>--}}

@stop