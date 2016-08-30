{{--<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery-ui.min.js') }}"></script>--}}


{!! Form::model($data, ['method' => 'PATCH', 'route'=> ['update-photography-package', $data[0]['id']]]) !!}

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="click x button for close this entry form">×</button>
    <h4 class="modal-title" id="myModalLabel">{{ $pageTitle }} &nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-content="<em>system fill account type and voucher number <br> Must Fill <b>Required</b> Field.    <b>*</b> Put cursor on input field for more informations</em>"><font size="2"></font> </span></h4>
</div>

<div class="modal-body">

    <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
        <div class="col-sm-12">
            {!! Form::label('title', 'Title:', []) !!}
            <small class="required">(Required)</small>
            {!! Form::text('title', @$data[0]['title'], ['id'=>'title', 'class' => 'form-control','maxlength'=>'64','title'=>'enter title']) !!}
        </div>
    </div>
    <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
        <div class="col-sm-12">
            {!! Form::label('price', 'Price:', []) !!}
            <small class="required">(Required)</small>
            {!! Form::text('price', @$data[0]['price'], ['id'=>'price', 'class' => 'form-control','maxlength'=>'64','title'=>'enter title']) !!}
        </div>
    </div>
    <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
        <div class="col-sm-12">
            {!! Form::label('type', 'Type:', ['class' => 'control-label']) !!}
            <small class="required">(Required)</small>
            {!! Form::Select('type',array('0'=>'--select--','houses'=>'Houses','apartment'=>'Apartment'),@$data[0]['type'],['class'=>'form-control ','required']) !!}
        </div>
    </div>



    {{--------------Details------------------------}}

    <div>
        <h4 class="text-center-header">Options</h4>
    </div>

    <table width="100%" id="update-table" class="table" cellpadding="0" cellspacing="0">
        <thead  style="background-color: whitesmoke;">
        <tr>
            <th>Items:</th>
            <th>Description:</th>
        </tr>
        </thead>
        <tbody>

        @if(@$data[0]['relPhotographyPackage'])
            @foreach($data[0]['relPhotographyPackage'] as $value_dt )
                <tr>
                    <td>
                        <div>
                            {!! Form::text('items[]', @$value_dt['items'], ['class' => 'form-control', 'title'=>'enter items']) !!}
                            {!! Form::hidden('dt_id[]',@$value_dt['id'], ['class'=>'update-coa-id-val']) !!}
                        </div>
                    </td>
                    <td>
                        <div>
                            {!! Form::text('description[]', @$value_dt['description'], ['title'=>'enter description', 'class' => 'form-control']) !!}
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif

        <tr>
            <td>
                <div>
                    {!! Form::text('items[]', Input::old('items'), ['title'=>'enter items', 'class' => 'form-control']) !!}
                </div>
            </td>

            <td>
                <div>
                    {!! Form::text('description[]', Input::old('description'), ['title'=>'enter description', 'class' => 'form-control']) !!}
                </div>
            </td>
        </tr>
        </tbody>
    </table>

</div>



<div class="modal-footer">
    {!! Form::submit('Save changes', ['class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save journal voucher information']) !!}&nbsp;
    <a href="{{route('photography-package')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form" onclick="close_modal();">Close</a>
</div>

{!! Form::close() !!}

@include('admin::photography_package.update_script')
