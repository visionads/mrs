@extends('admin::layouts.master')

@section('content')

        <!-- page start-->

@if($errors->any())
    <ul class="alert alert-danger">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

{{--set some message after action--}}
{{--@if (Session::has('message'))
    <div class="alert alert-success">{{Session::get("message")}}</div>

@elseif(Session::has('error'))
    <div class="alert alert-warning">{{Session::get("error")}}</div>

@elseif(Session::has('info'))
    <div class="alert alert-info">{{Session::get("info")}}</div>

@elseif(Session::has('danger'))
    <div class="alert alert-danger">{{Session::get("danger")}}</div>

@endif--}}

{{-- Token Mis mathched exception  --}}
@if ($errors->has('token_error'))
    {{$errors}}
    <div class="alert alert-warning"> {{ $errors->first('token_error') }} </div>
@endif

{!! Form::open(['route' => 'post-user-login','id'=>'login-data-validation']) !!}
{!! csrf_field() !!}

<div class="col-sm-4 col-sm-offset-4 login_div" id="login_signin2" >
    <div class="form-group" id="sign1">
        {!! Form::text('email', Input::old('email'), ['class' => 'form-control','required','placeholder'=>'USERNAME OR EMAIL', 'autocomplete'=>'off','autofocus']) !!}
    </div>
    <div class="form-group" id="sign1">
        {!! Form::password('password', ['class'=>'form-control',''=>'', 'placeholder'=>'PASSWORD', 'required'=>'required']) !!}
    </div>
    <br>
    <div class="form-group" id="sign">
        <input type="submit" value="LOG IN" class="sign_button">
    </div>
    <div class="form-group" id="sign">
        <a href="{{--{{ route('forget') }}--}}" class="white size-15">need help signing in?</a>
    </div>
</div>

{!! Form::close() !!}

@stop