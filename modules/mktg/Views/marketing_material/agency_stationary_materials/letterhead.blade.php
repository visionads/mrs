@extends('admin::layouts.master')

@section('content')


    <div id="container" class="container pages new_order font-droid">

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-4">
                    <div class="image-box">
                        <img src="{{ URL::to('/assets/img/letter-head-big.jpg') }}" class="img-responsive image-center">
                    </div>
                </div>
                <div class="col-md-8 green-yellow">
                    <h3 class="green-yellow">{{ $pageTitle }}</h3>
                    {{--{!! Form::open(['method'=>'GET','route'=>'solution-type-search','class'=>'form-inline']) !!}--}}
                    {!! Form::open(['method'=>'GET','class'=>'form-horizontal']) !!}
                        @include('mktg::marketing_material.agency_stationary_materials.letterhead_form')
                    {!! Form::close() !!}
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
                    <div class="pull-left">
                        <a href="{{ route('marketing-material-printing') }}" class="btn btn-green " id="">Continue Shopping </a>
                        <a href="#" class="btn btn-green " id="">Checkout </a>
                    </div>
                    <div class="pull-right">
                        {{--<a href=" #place" class="btn btn-green " id="proceed">Proceed <span class="glyphicon glyphicon-chevron-down"></span></a> &nbsp; &nbsp;--}}
                        <a href="#" class="btn btn-green " id="">Add To Cart <span class="glyphicon glyphicon-shopping-cart"></span></a>
                    </div>

                </div>
            </div>
        </div>

    </div>

    @include('mktg::marketing_material.agency_stationary_materials._scripts')

@stop