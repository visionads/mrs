
    <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">

            <div class="form-group">
                {!! Form::label('title', 'Title :', ['class' => 'control-label']) !!}
                <small class="required">(Required)</small>
                {!! Form::text('title', Input::old('title'),['title'=>'Type Solution Type','id'=>'title','class' => 'form-control text-left','placeholder'=>'Solution Title','required','autofocus']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('description', 'Description :', ['class' => 'control-label']) !!}
                <small class="required">(Required)</small>
                {!! Form::textarea('description', Input::old('description'),['title'=>'Type Solution Type Description','id'=>'description','placeholder'=>'Solution Description here..','spellcheck'=>'true','class' => 'form-control text-left','required']) !!}
            </div>

    </div>

    <div class="modal-footer">
        {!! Form::submit('Save changes', ['class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save Solution Type information']) !!}&nbsp;
        <a href="{{route('solution-type')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
    </div>
