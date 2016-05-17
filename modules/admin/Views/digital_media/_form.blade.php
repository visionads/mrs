
    <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">

            <div class="form-group">
                {!! Form::label('title', 'Title :', ['class' => 'control-label']) !!}
                <small class="required">(Required)</small>
                {!! Form::text('title', Input::old('title'),['title'=>'Type your media Title','id'=>'title','class' => 'form-control text-left','placeholder'=>'e.g - ETSB Media','required','autofocus']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('url', 'URL :', ['class' => 'control-label']) !!}
                <small class="required">(Required)</small>
                {!! Form::text('url', Input::old('url'),['title'=>'Type your URL','id'=>'url','class' => 'form-control text-left','placeholder'=>'e.g - www.yoursite.com','required']) !!}
            </div>

    </div>

    <div class="modal-footer">
        {!! Form::submit('Save changes', ['class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save all the changes']) !!}&nbsp;
        <a href="{{route('digital-media')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
    </div>
