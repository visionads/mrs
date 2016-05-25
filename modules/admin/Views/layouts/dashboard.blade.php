@extends('admin::layouts.master')

{{--<div style="background-image:url('{{ URL::asset("assets/user/img/chain.jpg")}}') ;height: 100%; width: 100%; ">--}}


        @section('content')

                {{--<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>--}}

                <div class="container" style="padding-top:0 !important; margin-top:0 !important;">


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
                    <div id="jhon">
                        <span class="label">
                        </span>
                        <span class="label-agent-details">
                            {{--Gender : {{ (isset($user_profile))?$user_profile->gender:'Update your City' }}<br>--}}
                            City : {{ (isset($user_profile))?$user_profile->city:'Update your City' }}<br>
                            State : {{ (isset($user_profile))?$user_profile->state:'Update your State' }}
                        </span>
                    </div>
                    {{--<div id="agent"><span class="label">****Agent details</span></div>--}}

                    <div class="clearfix"></div>
                    <div class="form-group" id="job_status">
                        <button class="title-button">Job Status</button>
                    </div>
                    {{--<div id="job_progress"><span class="label5">Jobs in progress</span><span class="label6"> (numrecial value)</span></div>--}}
                    <div id="job_progress">
                        <span class="label5">Jobs in progress</span>
                        <span class="label6">
                            ( {{ (isset($last_quote))?$last_quote->quote_number:'not available' }} )
                        </span>
                    </div>

                </div>

                <div class="form-group col-sm-5">
                        <div class="form-group" id="new_quote">
                                <a href="{{ url('main/new-quote') }}" class="quote">New Quote</a>
                        </div>
                        <div class="form-group" id="new_quote">
                                <a href="{{route('quote-list')}}" class="quote">Retrieve Quote</a>
                        </div>
                        {{--<div class="form-group" id="new_quote">
                                <a href="{{route('new-order')}}" class="quote">NEW ORDER</a>
                        </div>
                        <div class="form-group" id="new_quote">
                                <a href="#" class="quote">History</a>
                        </div>--}}
                        <div class="form-group" id="new_quote">
                                <a href="{{ route('quote-list') }}" class="quote">Pay invoice</a>
                        </div>
                </div>
                @if(Session::get('user-role')=='super-admin' || Session::get('user-role')=='admin')
                    <div class="form-group col-sm-5">
                        <div class="form-group" id="new_quote">
                            <a href="{{ url('main/quotes') }}" class="quote">Quote List</a>
                        </div>
                        <div class="form-group" id="new_quote">
                            <a href="{{route('payment-list')}}" class="quote">Payment History</a>
                        </div>
                    </div>
                @endif


</div>

@stop