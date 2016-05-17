@extends('admin::layouts.master')

<div style="background-image:url('{{ URL::asset("assets/user/img/chain.jpg")}}') ;height: 100%; width: 100%; ">

@section('content')

<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>

<div class="form-group col-sm-6">
    sdasd
</div>

    <style>

        /*#order_image {
            margin-top: 80px;
        }

        .page-profile #order_img_resize {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            display: inline-block;
            border: 5px solid #f36f21;
        }

        .page-profile #order_img_resize img {

            margin: 10px 0px;
        }

        #order_image #order_img_resize{
            margin-right: -219px;
        }
        
        #order_user_name{
            float:right;
            font-family: 'Droid Serif', serif;
            color: #f36f21;
            font-size:18px;
            font-weight: 200;
            text-height: font-size;
            line-height: 1em;
        }*/
    </style>


<div class="form-group col-sm-6 page-profile" id="order_image">
    <div class="profile-block" id="order_block">
        <div class="panel profile-photo" id="order_img_resize">
            {{--<img src="{{ URL::to('/assets/img/avatar1.jpg') }}" alt="">--}}
            @if(isset($user_image))
                <img src="{{ URL::to($user_image->thumbnail) }}">
            @else
                <img src="{{ URL::to('/assets/img/default.jpg') }}" width="100px" height="100px">
            @endif
        </div>
    </div>
    <div id="order_user_name"><span>John Smith</span></div>
</div>



</div>
@stop