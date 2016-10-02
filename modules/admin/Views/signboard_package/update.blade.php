{{--<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery-ui.min.js') }}"></script>--}}

{!! Form::model($data, ['method' => 'PATCH', 'route'=> ['update-signboard-package', $data->id], 'files'=>true]) !!}

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="click x button for close this entry form">×</button>
    <h4 class="modal-title" id="myModalLabel">{{ $pageTitle }} &nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-content="<em>system fill account type and voucher number <br> Must Fill <b>Required</b> Field.    <b>*</b> Put cursor on input field for more informations</em>"><font size="2"></font> </span></h4>
</div>

<div class="modal-body">
    @include('admin::signboard_package._form')


</div>



{{--<div class="modal-footer">--}}
    {{--{!! Form::submit('Save changes', ['class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save journal voucher information']) !!}&nbsp;--}}
    {{--<a href="{{route('signboard-package')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form" onclick="close_modal();">Close</a>--}}
{{--</div>--}}

{!! Form::close() !!}

@include('admin::signboard_package.update_script')
