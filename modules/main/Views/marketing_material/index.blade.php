@extends('admin::layouts.master')

@section('content')


    <div id="container" class="container pages new_order font-droid">
        <div class="col-md-12">
            <div class="col-sm-12" id="new_order_title"><span class="label green-yellow">{{ $pageTitle }}</span></div>
        </div>
        {{--<div class="col-md-12" style="border: 1px solid #303030;">
            <img src="{{ URL::to('/assets/img/vid.jpg') }}" class="img-responsive">
        </div>--}}

        {{--First Level--}}
        <div class="col-md-4">
            <div class="green-yellow-bg-btn">
                <a href="#" data-toggle="modal" data-target="#ASM">
                    <span class="glyphicon glyphicon-paperclip size-25"></span><br>
                    Agency Stationary Material
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="green-yellow-bg-btn">
                <a href="#" data-toggle="modal" data-target="#AAM">
                    <span class="glyphicon glyphicon-home size-25"></span><span class="glyphicon glyphicon-user size-25"></span><br>
                    Agency /Agent Marketing
                </a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="green-yellow-bg-btn">
                <a href="#" data-toggle="modal" data-target="#PM">
                    <span class="glyphicon glyphicon-home size-25 relative"><p class="absolute size-15 sticker-red-circled top-0 right-0">For Sale</p></span><br>
                    Property Marketing
                </a>
            </div>
        </div>

        <!-- Modal for Agency Stationary Material ====================================================================== -->
        <div id="ASM" class="modal fade" role="dialog" style="background: black !important;">
            <div class="modal-dialog" style="background: black !important;">

                <!-- Modal content-->
                <div class="modal-content" style="background: black !important; padding: 0px !important; width:100% !important;">
                    {{--Modal Header--}}
                    <div class="modal-header no-border" style="background: none !important; padding: 0px !important;">
                        <div class="size-20 green-yellow-bg center" style="padding: 5px;">
                            <span class="glyphicon glyphicon-paperclip "></span>
                                Agency Stationary Material
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                    </div>

                    {{--Modal Body--}}
                    <div class="modal-body no-padding no-border" style="padding-top: 20px !important; background: black;">
                        {{--Second Level--}}
                        <div class="col-md-12 no-padding">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div>
                                        <img src="{{ URL::to('/assets/img/letter-head.jpg') }}" class="img-responsive image-center">
                                    </div>
                                    <div class="green-yellow-bg-btn">
                                        <a href="{{ route('marketing-material-proceed') }}" class="below">
                                            Letterhead / Followers
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-4 padding-bot-10">
                                    <div>
                                        <img src="{{ URL::to('/assets/img/presentation.jpg') }}" class="img-responsive image-center">
                                    </div>
                                    <div class="green-yellow-bg-btn">
                                        <a href="#" class="below">
                                            Presentation folders
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-4 padding-bot-10">
                                    <div>
                                        <img src="{{ URL::to('/assets/img/withcomp.jpg') }}" class="img-responsive image-center">
                                    </div>
                                    <div class="green-yellow-bg-btn">
                                        <a href="#" class="below">
                                            Withcomp slips
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-4 padding-bot-10">
                                    <div>
                                        <img src="{{ URL::to('/assets/img/envelopes.jpg') }}" class="img-responsive image-center">
                                    </div>
                                    <div class="green-yellow-bg-btn">
                                        <a href="#" class="below">
                                            Envelopes
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-4 padding-bot-10">
                                    <div>
                                        <img src="{{ URL::to('/assets/img/forms.jpg') }}" class="img-responsive image-center">
                                    </div>
                                    <div class="green-yellow-bg-btn">
                                        <a href="#" class="below">
                                            Forms
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-4 padding-bot-10">
                                    <div>
                                        <img src="{{ URL::to('/assets/img/carbon-books.jpg') }}" class="img-responsive image-center">
                                    </div>
                                    <div class="green-yellow-bg-btn">
                                        <a href="#" class="below">
                                            Carbon books (NCR)
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{--Modal Footer--}}
                    <div class="modal-footer no-border">
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-top: 20px !important; ">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Modal for Agency Stationary Material ====================================================================== -->
        <div id="AAM" class="modal fade" role="dialog" style="background: black !important;">
            <div class="modal-dialog" style="background: black !important;">

                <!-- Modal content-->
                <div class="modal-content" style="background: black !important; padding: 0px !important; width:100% !important;">
                    {{--Modal Header--}}
                    <div class="modal-header no-border" style="background: none !important; padding: 0px !important;">
                        <div class="size-20 green-yellow-bg center" style="padding: 5px;">
                            <span class="glyphicon glyphicon-home size-25"></span><span class="glyphicon glyphicon-user size-25"></span></span>
                                Agency /Agent Marketing
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                    </div>

                    {{--Modal Body--}}
                    <div class="modal-body no-padding no-border" style="padding-top: 20px !important; background: black;">
                        {{--Second Level--}}
                        <div class="col-md-12 no-padding">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div>
                                        <img src="{{ URL::to('/assets/img/letter-head.jpg') }}" class="img-responsive image-center">
                                    </div>
                                    <div class="green-yellow-bg-btn">
                                        <a href="#" class="below">
                                            Letterhead / Followers
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-4 padding-bot-10">
                                    <div>
                                        <img src="{{ URL::to('/assets/img/presentation.jpg') }}" class="img-responsive image-center">
                                    </div>
                                    <div class="green-yellow-bg-btn">
                                        <a href="#" class="below">
                                            Presentation folders
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-4 padding-bot-10">
                                    <div>
                                        <img src="{{ URL::to('/assets/img/withcomp.jpg') }}" class="img-responsive image-center">
                                    </div>
                                    <div class="green-yellow-bg-btn">
                                        <a href="#" class="below">
                                            Letterhead / Followers
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-4 padding-bot-10">
                                    <div>
                                        <img src="{{ URL::to('/assets/img/envelopes.jpg') }}" class="img-responsive image-center">
                                    </div>
                                    <div class="green-yellow-bg-btn">
                                        <a href="#" class="below">
                                            Letterhead / Followers
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-4 padding-bot-10">
                                    <div>
                                        <img src="{{ URL::to('/assets/img/forms.jpg') }}" class="img-responsive image-center">
                                    </div>
                                    <div class="green-yellow-bg-btn">
                                        <a href="#" class="below">
                                            Letterhead / Followers
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-4 padding-bot-10">
                                    <div>
                                        <img src="{{ URL::to('/assets/img/carbon-books.jpg') }}" class="img-responsive image-center">
                                    </div>
                                    <div class="green-yellow-bg-btn">
                                        <a href="#" class="below">
                                            Letterhead / Followers
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{--Modal Footer--}}
                    <div class="modal-footer no-border">
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-top: 20px !important; ">Close</button>
                    </div>
                </div>

            </div>
        </div>

        <!-- Modal for Agency Stationary Material ====================================================================== -->
        <div id="PM" class="modal fade" role="dialog" style="background: black !important;">
            <div class="modal-dialog" style="background: black !important;">

                <!-- Modal content-->
                <div class="modal-content" style="background: black !important; padding: 0px !important; width:100% !important;">
                    {{--Modal Header--}}
                    <div class="modal-header no-border" style="background: none !important; padding: 0px !important;">
                        <div class="size-20 green-yellow-bg center" style="padding: 5px;">
                            <span class="glyphicon glyphicon-home size-25 relative"></span>
                            Property Marketing
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                    </div>

                    {{--Modal Body--}}
                    <div class="modal-body no-padding no-border" style="padding-top: 20px !important; background: black;">
                        {{--Second Level--}}
                        <div class="col-md-12 no-padding">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div>
                                        <img src="{{ URL::to('/assets/img/letter-head.jpg') }}" class="img-responsive image-center">
                                    </div>
                                    <div class="green-yellow-bg-btn">
                                        <a href="#" class="below">
                                            Letterhead / Followers
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-4 padding-bot-10">
                                    <div>
                                        <img src="{{ URL::to('/assets/img/presentation.jpg') }}" class="img-responsive image-center">
                                    </div>
                                    <div class="green-yellow-bg-btn">
                                        <a href="#" class="below">
                                            Presentation folders
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-4 padding-bot-10">
                                    <div>
                                        <img src="{{ URL::to('/assets/img/withcomp.jpg') }}" class="img-responsive image-center">
                                    </div>
                                    <div class="green-yellow-bg-btn">
                                        <a href="#" class="below">
                                            Letterhead / Followers
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-4 padding-bot-10">
                                    <div>
                                        <img src="{{ URL::to('/assets/img/envelopes.jpg') }}" class="img-responsive image-center">
                                    </div>
                                    <div class="green-yellow-bg-btn">
                                        <a href="#" class="below">
                                            Letterhead / Followers
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-4 padding-bot-10">
                                    <div>
                                        <img src="{{ URL::to('/assets/img/forms.jpg') }}" class="img-responsive image-center">
                                    </div>
                                    <div class="green-yellow-bg-btn">
                                        <a href="#" class="below">
                                            Letterhead / Followers
                                        </a>
                                    </div>
                                </div>

                                <div class="col-sm-4 padding-bot-10">
                                    <div>
                                        <img src="{{ URL::to('/assets/img/carbon-books.jpg') }}" class="img-responsive image-center">
                                    </div>
                                    <div class="green-yellow-bg-btn">
                                        <a href="#" class="below">
                                            Letterhead / Followers
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{--Modal Footer--}}
                    <div class="modal-footer no-border">
                        <button type="button" class="btn btn-default" data-dismiss="modal" style="margin-top: 20px !important; ">Close</button>
                    </div>
                </div>

            </div>
        </div>


    </div>

   {{-- @if($errors->any())
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