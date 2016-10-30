
    <div class="form-group form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
        <div class="row">
            @if(Session::get('user-role') == 'agent')
                <div class="col-sm-6">
                    {!! Form::label('full_name', 'Agent Name:', ['class' => 'control-label']) !!}
                    <small class="required">(Required)</small>
                    {!! Form::text('full_name',Input::old('full_name'),['class' => 'form-control','placeholder'=>'Enter Full Name','required','autofocus', 'title'=>'Enter Full Name']) !!}
                </div>
            @else
                <div class="col-sm-6">
                    {!! Form::label('username', 'UserName:', ['class' => 'control-label']) !!}
                    <small class="required">(Required)</small>
                    {!! Form::text('username',Input::old('username'),['class' => 'form-control','placeholder'=>'User Name','required','autofocus', 'title'=>'Enter User Name']) !!}
                </div>
            @endif
            <div class="col-sm-6">
                {!! Form::label('email', 'Email Address:', ['class' => 'control-label']) !!}
                <small class="required">(Required)</small>
                {!! Form::email('email',Input::old('email'),['class' => 'form-control','placeholder'=>'Email Address','required', 'title'=>'Enter User Email Address']) !!}
            </div>
        </div>
    </div>
    @if(Session::get('user-role') !== 'agent')
    <div class="form-group form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
        <div class="row">
            <div class="col-sm-6">
                {!! Form::label('password', 'Password:', ['class' => 'control-label']) !!}
                <small class="required">(Required)</small>
                {!! Form::password('password',['id'=>'user-password','class' => 'form-control','required','placeholder'=>'Password','title'=>'Enter User Password']) !!}
            </div>
            <div class="col-sm-6">
                {!! Form::label('confirm_password', 'Confirm Password') !!}
                <small class="required">(Required)</small>
                {!! Form::password('re_password', ['class' => 'form-control','placeholder'=>'Re-Enter New Password','required','id'=>'re-password','name'=>'re_password','onkeyup'=>"validation()",'title'=>'Enter Confirm Password That Must Be Match With New Passowrd.']) !!}
                <span id='show-message'></span>

            </div>
        </div>
    </div>
    @endif
    <div class="form-group form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
        <div class="row">
            @if(Session::get('user-role') == 'agent')
                <div class="col-sm-6">
                    {!! Form::label('phone', 'Phone') !!}
                    <small class="required">(Required)</small>
                    {!! Form::text('phone',Input::old('phone'),['class' => 'form-control','placeholder'=>'Enter Phone','required','title'=>'Enter Phone']) !!}
                </div>
                <input type="hidden" name="role_id" value="{{ Auth::user()->id }}">
            @else
                <div class="col-sm-6">
                    {!! Form::label('role_id', 'User Role:', ['class' => 'control-label']) !!}
                    <small class="required">(Required)</small>
                    {!! Form::Select('role_id',$role, Input::old('role_id'),['style'=>'text-transform:capitalize','class' => 'form-control','required','title'=>'select role name']) !!}
                </div>
            @endif

            <div class="col-sm-6">
                {!! Form::label('business_title', 'Company Name / Agency :', ['class' => 'control-label']) !!}
                <small class="required">(Required)</small>
                {!! Form::text('business_title', null ,['class' => 'form-control','required','title'=>'select branch name']) !!}
            </div>
        </div>
    </div>
    @if(Session::get('user-role') == 'agent')
        <div class="form-group form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
            <div class="row">
                <div class="col-sm-12">
                    {!! Form::label('address', 'Address:', ['class' => 'control-label']) !!}
                    <small class="required">(Required)</small>
                    {!! Form::text('address',Input::old('address'),['class' => 'form-control','placeholder'=>'Enter Address','required','title'=>'Write Address']) !!}
                </div>
            </div>
        </div>
    @else
        <div class="form-group form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
            <div class="row">
                <div class="col-sm-6">
                    {!! Form::label('expire_date', 'Expire Date:', ['class' => 'control-label']) !!}
                    <div class="input-group date">
                        @if(isset($data->expire_date))
                            {!! Form::text('expire_date',  '2020-12-12 12:12:12', ['class' => 'form-control bs-datepicker-component','title'=>'select expire date', 'disabled']) !!}
                        @else
                            {!! Form::text('expire_date', '2020-12-12 12:12:12', ['class' => 'form-control bs-datepicker-component','title'=>'select expire date', 'disabled']) !!}
                        @endif

                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    {!! Form::label('status', 'Status:', ['class' => 'control-label']) !!}
                    <small class="narration">(Inactive status Selected)</small>
                    {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive','cancel'=>'Cancel'),Input::old('status'),['class'=>'form-control ','required']) !!}
                </div>
            </div>
        </div>
    @endif
    <div class="form-margin-btn">
        {!! Form::submit('Save changes', ['id'=>'btn-disabled','class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}
        <a href="{{route('user-list')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
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
