
    <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">

            <div class="form-group">
                {!! Form::label('quantity', 'Quantity :', ['class' => 'control-label']) !!}
                <small class="required">(Required)</small>
                {!! Form::input('number', 'quantity', Input::old('quantity'), ['title'=>'Type Quantity of Material(s)', 'class' => 'form-control', 'placeholder'=>'e.g - 00 ( 2 digits only )', 'max'=>'99', 'required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('is_surrounded', 'Surrounded Status :', ['class' => 'control-label']) !!}
                <small class="required">(Required)</small>
                {!! Form::select('is_surrounded', array(''=>'Select Surrounded Status','1'=>'Yes','2'=>'No') ,Input::old('is_surrounded'),['title'=>'Select Surrounded Status','id'=>'is_surrounded','class' => 'form-control text-left','required']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('other_address', 'Other address :', ['class' => 'control-label']) !!}
                <small class="required">(Required)</small>
                {!! Form::text('other_address', Input::old('other_address'),['title'=>'Type Other Address','id'=>'other_address','class' => 'form-control text-left','placeholder'=>'e.g - H# 000, Flat : xxx ...','required']) !!}
            </div>


            <div class="bootstrap-iso">
                <div class="container-fluid">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <!-- Form code begins -->
                        <div class="form-group"> <!-- Date input -->
                            <label class="control-label" for="date">Date</label>
                            <input class="form-control" id="date" name="date" placeholder="YYYY-MM-DD" type="text"/>
                        </div>
                        <!-- Form code ends -->
                    </div>
                </div>
            </div>


            <div class="form-group">
                {!! Form::label('note', 'Note :', ['class' => 'control-label']) !!}
                <small class="required">(Required)</small>
                {!! Form::textarea('note', Input::old('note'),['title'=>'Write a Note','id'=>'note','class' => 'form-control text-left','rows'=>'6','placeholder'=>'Short Note About the Material','required']) !!}
            </div>

    </div>

    <div class="modal-footer">
        {!! Form::submit('Save changes', ['class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save all the changes']) !!}&nbsp;
        <a href="{{ URL::previous() }}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
    </div>

<script>
    $(".form-control").tooltip();
</script>

