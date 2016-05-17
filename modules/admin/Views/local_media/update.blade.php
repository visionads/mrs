
{{--<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery-ui.min.js') }}"></script>--}}





{!! Form::model($data, ['method' => 'PATCH', 'route'=> ['local-media-update', $data[0]['id']]]) !!}

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="click x button for close this entry form">×</button>
    <h4 class="modal-title" id="myModalLabel">{{ $pageTitle }} &nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-content="<em>system fill account type and voucher number <br> Must Fill <b>Required</b> Field.    <b>*</b> Put cursor on input field for more informations</em>"><font size="2"></font> </span></h4>
</div>

<div class="modal-body">

    <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
        <div>
            <div class="form-group">
                {!! Form::label('title', 'Title :', ['class'=>'control-label']) !!}
                <small class="required">(Required)</small>
                {!! Form::text('title', @$data[0]['title'], ['id'=>'title', 'class' => 'form-control','maxlength'=>'64','title'=>'enter title']) !!}
            </div>
<br>
            <div class="form-group">
                {!! Form::label('description', 'Description:', [ 'class'=>'control-label']) !!}
                <small class="required">(Required)</small>
                {!! Form::textarea('description', @$data[0]['description'], ['id'=>'description', 'class' => 'form-control','maxlength'=>'128','title'=>'Enter Description','rows'=>'6']) !!}
            </div>
        </div>
    </div>




    {{--------------Details------------------------}}

    <div>
        <h4 class="text-center-header option-header">Options</h4>
    </div>

    <table width="100%" id="update-table" class="table size-13" cellpadding="0" cellspacing="0">
        <thead  style="background-color: whitesmoke;">
        <tr>
            <th>Option Name:</th>
            <th>Option Price:</th>
        </tr>
        </thead>
        <tbody>

        @if(@$data[0]['relLocalMedia'])
            @foreach($data[0]['relLocalMedia'] as $value_dt )
                <tr>
                    <td>
                        <div>
                            {!! Form::text('title_option[]', @$value_dt['title'], ['class' => 'form-control', 'title'=>'Enter Option Title']) !!}
                            {!! Form::hidden('dt_id[]',@$value_dt['id'], ['class'=>'update-coa-id-val']) !!}
                        </div>
                    </td>
                    <td>
                        <div>
                            {!! Form::text('price[]', @$value_dt['price'], ['title'=>'Enter Price', 'class' => 'form-control']) !!}
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif

        <tr>
            <td>
                <div>
                    {!! Form::text('title_option[]', Input::old('title'), ['title'=>'Enter Option Title', 'class' => 'form-control']) !!}
                </div>
            </td>

            <td>
                <div>
                    {!! Form::text('price[]', Input::old('price'), ['title'=>'Enter Price', 'class' => 'form-control']) !!}
                </div>
            </td>
        </tr>
        </tbody>
    </table>

</div>



<div class="modal-footer">
    {!! Form::submit('Save changes', ['class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save journal voucher information']) !!}&nbsp;
    <a href="{{route('local-media')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form" onclick="close_modal();">Close</a>
</div>

{!! Form::close() !!}

@include('admin::local_media.update_script')


