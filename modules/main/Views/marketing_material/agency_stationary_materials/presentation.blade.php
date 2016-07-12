@extends('admin::layouts.master')

@section('content')


    <div id="container" class="container pages new_order font-droid">
        <div class="col-md-12">
            {{--<div class="col-sm-12" id="new_order_title"><span class="label green-yellow">{{ $pageTitle }}</span></div>--}}
        </div>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="image-box">
                        <img src="{{ URL::to('/assets/img/letter-head-big.jpg') }}" class="img-responsive image-center">
                    </div>
                </div>
                <div class="col-md-8 green-yellow">
                    <h3 class="green-yellow">{{ $pageTitle }}</h3>
                    <form class="form-horizontal" action="" role="form">
                        @include('main::marketing_material.agency_stationary_materials.presentation_form')
                    </form>
                </div>
                <div class="col-md-12">
                    <h3 class="green-yellow">Description</h3>
                    <p class="green-yellow size-14">
                        What better way to introduce your business to the world than through professional full-colour
                        brochures. A versatile medium, brochures can be used for a variety of marketing needs, as well as
                        a physical keep sake that customers can keep until they need your product or service.
                        Printed CMYK on both sides on matt or gloss 170GSM stock, these tri-fold brochures are both
                        high quality and durable.
                    </p>
                    <a href=" #place" class="btn btn-green pull-right" id="proceed">Proceed <span class="glyphicon glyphicon-chevron-down"></span></a>
                </div>
            </div>
        </div>



        {{--Place Order Form--}}
        <a name="place">&nbsp;</a>
        {!! Form::open() !!}
        <div class="col-md-12" id="place_order">
            <div class="row">
                <div class="green-yellow">
                    <hr>
                    <h2 class="center">Artwork</h2>
                    Please select one of the options:
                </div>
                <div>
                    <div class="col-md-6">
                        <label class="radio-inline green-yellow" >
                            {!! Form::radio('check','check1','',['id'=>'check1']) !!}
                            Use existing file (RE ORDER NO CHANGES)
                        </label><br><br>
                        <label class="radio-inline green-yellow" id="btn_req">
                            {!! Form::radio('check','check3','',['id'=>'check3']) !!}
                            Use existing file (CHANGES REQ UIRED DETAILS ONLY) Please write below the changes, eg Name: John Smith, Phone 0234565...
                            <div id="txt_req">
                                {!! Form::textarea('note', Input::old('note'),['class' => 'form-control text-left','rows'=>'10','placeholder'=>'CHANGES REQ UIRED DETAILS ONLY']) !!}
                            </div>
                        </label><br><br>
                        <label class="radio-inline green-yellow">
                            {!! Form::radio('check','check5','',['id'=>'check5']) !!}
                            Artwork and design required (one of our friendly graphics designers will be in touch with you)
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="radio-inline green-yellow" id="btn_upload">
                            {!! Form::radio('check','check2','',['id'=>'check2']) !!}
                            Upload Artwork (file)
                            <div id="file_upload">
                                {!! Form::file('file','',['class'=>'form-control']) !!}
                            </div>
                        </label><br><br>
                        <label class="radio-inline green-yellow">
                            {!! Form::radio('check', 'check4','',['id'=>'check4']) !!}
                            Use existing file (CHANGES REQ UIRED DETAILS ONLY) Please write below the changes, eg Name: John Smith, Phone 0234565...
                        </label>
                    </div>
                    <div class="col-md-12">
                        {{--{!! Form::submit('Order',['class'=>'btn btn-green pull-right']) !!}--}}
                        <button class="btn btn-green pull-right" type="button" id="order">Order <span class="glyphicon glyphicon-chevron-right"></span></button>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}

    </div>

    <script>
        $(document).ready(function(){

            //===== For Main
            $("#place_order").hide();
            $("#proceed").click(function(){
                $("#place_order").fadeIn();
            });

            //===== For Secondary ( Text area)
            $("#txt_req").hide();
            $("#btn_req").click(function() {
                $("#txt_req").slideDown();
                $("#file_upload").slideUp();
            });

            //===== For Secondary ( Upload Artwork)
            $("#file_upload").hide();
            $("#btn_upload").click(function(){
                $("#file_upload").slideDown();
                $("#txt_req").slideUp();
            });

            //===== For Secondary ( General )
            $("#check1,#check4,#check5").click(function(){
                $("#file_upload,#txt_req").slideUp();
            });
        });
    </script>

@stop