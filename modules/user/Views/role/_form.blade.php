<div class="row">
    <div class="col-sm-12">
        <div class="form-group " style="margin: 10px">
                {!! Form::label('title', 'Title:', ['class' => 'control-label']) !!}
                {!! Form::text('title',Input::old('title'),['class' => 'form-control','placeholder'=>'Role Name','required','autofocus', 'title'=>'Enter Role Name']) !!}

                {!! Form::label('status', 'Status:', ['class' => 'control-label']) !!}
                <small class="narration">(Active status Selected)</small>
                {!! Form::Select('status',array('active'=>'Active','inactive'=>'Inactive'),Input::old('status'),['class'=>'form-control ','required']) !!}

        </div>

        <div class="">
            {!! Form::submit('Save changes', ['class' => 'btn btn-primary pull-right','data-placement'=>'top','data-content'=>'click save changes button for save role information']) !!}&nbsp;
            <a href="{{route('role')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
        </div>
    </div>
</div>

