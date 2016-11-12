@extends('admin::layouts.master')
@section('content')

    <style>
        input {
            padding: 5px;
        }
        label{
            font-size: 14px;
            color: white;
        }
    </style>

    <div class="row">
        <div class="col-sm-2">
            &nbsp;
        </div>
        <div class="col-sm-8">
                <h4>Create a new account for an agent </h4>
        </div>
        <div class="col-sm-2">
            &nbsp;
        </div>

    </div>
    <div class="row">
    {!! Form::open(['route' => 'add-new-agent','id' => 'jq-validation-form']) !!}


        <div class="col-sm-2">
            &nbsp;
        </div>
        <div class="col-sm-8">
            <div class="form-group form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div class="row">
                    <div class="col-sm-6">
                        {!! Form::label('full_name', 'Agent Name:', ['class' => 'control-label']) !!}
                        <small class="required">(Required)</small>
                        {!! Form::text('full_name',Input::old('full_name'),['class' => 'form-control','placeholder'=>'Enter Full Name','required','autofocus', 'title'=>'Enter Full Name']) !!}
                    </div>
                    <div class="col-sm-6">
                        {!! Form::label('email', 'Agent Email Address:', ['class' => 'control-label']) !!}
                        <small class="required">(Required)</small>
                        {!! Form::email('email',Input::old('email'),['class' => 'form-control','placeholder'=>'Email Address','required', 'title'=>'Enter User Email Address']) !!}
                    </div>
                </div>
            </div>



            <div class="form-group form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div class="row">

                    <div class="col-sm-6">
                        {!! Form::label('phone', 'Agent Phone') !!}
                        <small class="required">(Required)</small>
                        {!! Form::text('phone',Input::old('phone'),['class' => 'form-control','placeholder'=>'Enter Phone','required','title'=>'Enter Phone']) !!}
                    </div>



                    <div class="col-sm-6">
                        {!! Form::label('business_title', 'Agent Company Name  :', ['class' => 'control-label']) !!}
                        <small class="required">(Required)</small>
                        {!! Form::text('business_title', null ,['class' => 'form-control','required','title'=>'select branch name']) !!}
                    </div>
                </div>
            </div>

            <div class="form-group form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div class="row">
                    <div class="col-sm-12">
                        {!! Form::label('address', 'Contact Address:', ['class' => 'control-label']) !!}
                        <small class="required">(Required)</small>
                        {!! Form::textarea('address',Input::old('address'),['class' => 'form-control','placeholder'=>'Enter Address','required','title'=>'Write Address', 'rows'=>5]) !!}
                    </div>
                </div>


            </div>

            <div class="col-sm-12">
                <div class="pull-right" >
                    {!! Form::submit('Save changes', ['id'=>'btn-disabled','class' => 'btn btn-primary','data-content'=>'click save changes button for save role information']) !!}
                    <a href="{{route('get-user-login')}}" class=" btn btn-default "  data-content="click close button for close this entry form">Close</a>
                </div>
            </div>


        </div>
        <div class="col-sm-2">
            &nbsp;
        </div>
    {!! Form::close() !!}
    </div>





<script type="text/javascript" src="{{ URL::asset('assets/admin/js/datepicker.js') }}"></script>
<script>

    function validation() {
        $('#re-password').on('keyup', function () {
            if ($(this).val() == $('#user-password').val())
            {
                $('#show-message').html('');
                document.getElementById("btn-disabled").disabled = false;
                return false;
            }
            else
            {
                $('#show-message').html('confirm password do not match with new password,please check.').css('color', 'red');
                document.getElementById("btn-disabled").disabled = true;
            }
        });
    }

</script>


@stop
