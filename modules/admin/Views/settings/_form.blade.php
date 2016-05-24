

    <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">

            <div class="form-group">
                {!! Form::label('type', 'Type :', ['class' => 'control-label']) !!}

                {!! Form::text('type', $data->type,['title'=>'Type of the Settings','id'=>'type','class' => 'form-control text-left','placeholder'=>'e.g - ETSB Media', 'disabled']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('code', 'Code :', ['class' => 'control-label']) !!}
                <small class="required">(Required)</small>
                {!! Form::text('code', $data->code,['title'=>'Type your Code','id'=>'code','class' => 'form-control text-left','placeholder'=>'e.g - www.yoursite.com','required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('last_number', 'Last Number :', ['class' => 'control-label']) !!}
                <small class="required">(Required)</small>
                {!! Form::input('number','last_number', $data->last_number,['title'=>'Type Last Number','id'=>'last_number','class' => 'form-control text-left','placeholder'=>'e.g - www.yoursite.com','required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('increment', 'Increment :', ['class' => 'control-label']) !!}
                <small class="required">(Required)</small>
                {!! Form::input('number','increment', $data->increment,['title'=>'Type increment','id'=>'increment','class' => 'form-control text-left','placeholder'=>'e.g - www.yoursite.com','required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('status', 'Status :', ['class' => 'control-label']) !!}
                <small class="required">(Required)</small>
                {!! Form::select('status', array(''=>'Select surrounded status','1'=>'Yes','2'=>'No') ,@Input::get('status')?Input::get('status'):null,['title'=>'Status','class' => 'form-control text-left']) !!}
            </div>


    </div>

    <div class="modal-footer">
        {!! Form::submit('Save changes', ['class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save all the changes']) !!}&nbsp;
        <a href="{{route('settings-table')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
    </div>
