@extends('admin::layouts.master')

<div style="background-image:url('{{ URL::asset("assets/user/img/chain.jpg")}}') ;height: 100%; width: 100%; ">

@section('content')

{{--<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>--}}


<div class="form-group col-sm-7 font-droid " id="marketing_image">
        <div class="page-profile">
                <div class="profile-row">
                        <div class="left-col">
                                <div class="profile-block" id="block">
                                        <div class="panel profile-photo" id="image_resize">
                                                {{--<img src="{{ URL::to('/assets/img/avatar1.jpg') }}" alt="">--}}
                                                @if(isset($user_image))
                                                        <img src="{{ URL::to($user_image->thumbnail) }}">
                                                @else
                                                        <img src="{{ URL::to('/assets/img/default.jpg') }}" width="200" height="200" >
                                                @endif
                                        </div>
                                </div>

                        </div>
                </div>
        </div>
        <div id="jhon"><span class="label">John Smith</span></div>
        <div id="agent"><span class="label">****Agent details</span></div>

        <div class="form-group" id="job_status">
                <input type="submit" value="Job Status" class="quote">
        </div>
        <div id="job_progress"><span class="label5">Jobs in progress</span><span class="label6"> (numrecial value)</span></div>

</div>
<div class="form-group col-sm-5">
        <div class="form-group" id="new_quote">
                <a href="{{ url('main/new-quote#quote-div') }}" class="quote">New Quote</a>
        </div>
        <div class="form-group" id="new_quote">
                <a href="{{route('retrieve-quote')}}" class="quote">Retrieve Quote</a>
        </div>
        {{--<div class="form-group" id="new_quote">
                <a href="{{route('new-order')}}" class="quote">NEW ORDER</a>
        </div>
        <div class="form-group" id="new_quote">
                <a href="#" class="quote">History</a>
        </div>--}}
        <div class="form-group" id="new_quote">
                <a href="{{ route('payment') }}" class="quote">Pay invoice</a>
        </div>
    <a></a>


        {{--
        <div class="form-group" id="new_quote">
                <input type="submit" value="Retrieve Quote" class="quote">
        </div>
        <div class="form-group" id="new_quote">
                <input type="submit" value="NEW ORDER" class="quote">
        </div>
        <div class="form-group" id="new_quote">
                <input type="submit" value="History" class="quote">
        </div>
        <div class="form-group" id="new_quote">
                <input type="submit" value="Pay invoice" class="quote">
        </div>--}}
</div>


</div>
@stop