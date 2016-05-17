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


    </style>

    <div id="container" class="container pages new_order font-droid">
        <div class="col-md-12">
            <div class="col-sm-12" id="new_order_title"><span class="label size-25">{{ $pageTitle }}</span><br><br></div>
        </div>
        <div class="col-md-12">
            <div class="col-sm-6">
                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        <h1>Detatils of the order</h1>
                        <p>
                            Also included in your marketing campaign
                            + Your property displayed in our SHOP WINDOWS <br>
                            + Your property included in our WEEKLY SALES BOOKKLET <br>
                            + Professional copy writer prepares written advertisment <br>
                            + Design & Installation of professionally printed Photosign Board <br>
                            *****this section can also be customised for the agency depending on what they are offering
                        </p>
                    </div>
                </div>
            </div>
            <style>
                .amount-bg { background:#fff; padding:5px; border-radius:3px;}
            </style>

            <div class="col-sm-6" id="submit_button_div">
                <h2 style="color:#f12f01">Calculator</h2>
                <h2 style="color:#f36f21" class="size-20">Total cost of marketing (GST INC) : $ <span class="amount-bg size-25" > 1234 </span></h2>
                <h2 style="color:#f36f21" class="size-20">Seliing price of the property : $  <span class="amount-bg size-25"> 1234 </span> </h2>
                <h2 style="color:#f36f21" class="size-20">Agent % commission : <span class="amount-bg size-25"> 0.02 </span> &nbsp;%</h2><br>
                <p style="color:#f12f01" class="size-14">Total cost of selling the property, Marketing + Agent Com (GST INC): $ <span class="amount-bg" style="font-size:25px !important"> 1234 </span></p>

                <div class="text-right">
                    <a href="{{ route('retrieve-quote') }}" class="btn new_button">Save Quote</a>
                    <a href="{{ route('place-order') }}" class="btn new_button">Continue</a>

                    {{--<a href="{{ route('property-details') }}" class="btn new_button">Continue</a>--}}
                </div>
               {{-- <div class="form-group">
                    <div class="col-sm-12" id="submit_button">
                        {!! Form::submit('Confirm', ['class' => 'btn btn new_button','data-placement'=>'top','data-content'=>'click to confirm Agreement','onclick'=>'return confirm("Are you sure!")']) !!}&nbsp;
                    </div>
                </div>--}}
            </div>
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