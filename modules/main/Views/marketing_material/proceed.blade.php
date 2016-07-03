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
                    <h3 class="green-yellow">Letterhead / Followers</h3>
                    <p class="green-yellow size-14">
                        What better way to introduce your business to the world than through professional full-colour
                        brochures. A versatile medium, brochures can be used for a variety of marketing needs, as well as
                        a physical keep sake that customers can keep until they need your product or service.
                        Printed CMYK on both sides on matt or gloss 170GSM stock, these tri-fold brochures are both
                        high quality and durable.
                    </p>
                    <form class="form-horizontal" role="form">
                        @include('main::marketing_material._form')
                    </form>


                </div>
            </div>
        </div>


    </div>

@stop