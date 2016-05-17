{{--<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery-ui.min.js') }}"></script>--}}


<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
    <div class="col-sm-12">
        {!! Form::label('title', 'Title:', []) !!}
        <small class="required">(Required)</small>
        {!! Form::text('title', Input::old('title'), ['id'=>'title', 'class' => 'form-control','maxlength'=>'64','title'=>'enter title']) !!}
    </div>
</div>
<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
    <div class="col-sm-12">
        {!! Form::label('price', 'Price:', []) !!}
        <small class="required">(Required)</small>
        {!! Form::text('price', Input::old('price'), ['id'=>'price', 'class' => 'form-control','maxlength'=>'64','title'=>'enter title']) !!}
    </div>
</div>


<div>
    <h4 class="text-center-header">Options</h4>
</div>



{{--<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
    <div class="col-sm-12">
        {!! Form::label('items', 'Items:', []) !!}
        <small class="required">(Required)</small>
        {!! Form::text('items', @$data->relPhotographyPackage->items, ['id'=>'items', 'class' => 'form-control','maxlength'=>'64','title'=>'enter title']) !!}
    </div>
</div>

<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
    <div class="col-sm-12">
        {!! Form::label('description', 'Description:', []) !!}
        <small class="required">(Required)</small>
        {!! Form::textarea('description', @$data->relPhotographyPackage->description, ['size' => '6x2', 'class' => 'form-control','title'=>'enter description of occurence']) !!}
    </div>
</div>--}}

<table width="100%" id="table" class="table" cellpadding="0" cellspacing="0">
    <thead  style="background-color: whitesmoke;">
    <tr>
        <th>Items:</th>
        <th>Description:</th>
    </tr>
    </thead>
    <tbody>

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


<div class="modal-footer">
    {!! Form::submit('Save changes', ['class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save journal voucher information']) !!}&nbsp;
    <a href="{{route('photography-package')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
</div>


@include('admin::photography_package._script')
