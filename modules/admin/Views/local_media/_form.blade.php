    {{--<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>--}}


    <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
        <div class="form-group">
        {!! Form::label('title', 'Title :', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::text('title', Input::old('title'),['id'=>'title','class' => 'form-control text-left','placeholder'=>'Title','title'=>'Media Title','required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('description', 'description:', []) !!}
            <small class="required">(Required)</small>
            {!! Form::textarea('description', Input::old('description'), ['id'=>'description', 'class' => 'form-control','maxlength'=>'128','title'=>'Enter Description', 'placeholder'=>'Enter Description','required']) !!}
        </div>
    </div>


    <div>
        <h4 class="text-center-header options-header">Options</h4>
    </div>

    <table width="100%" id="table" class="table size-13 options-table" cellpadding="0" cellspacing="0">
        <thead  style="background-color: whitesmoke;">
        <tr>
            <th>Option Name:</th>
            <th>Option Price:</th>
        </tr>
        </thead>
        <tbody>

        <tr>
            <td>
                <div>
                    {!! Form::text('title_option[]', Input::old('title_option'), ['title'=>'Enter Title','placeholder'=>'Name', 'class' => 'form-control']) !!}
                </div>
            </td>
            <td>
                <div>
                    {!! Form::text('price[]', Input::old('price'), ['title'=>'Enter Price', 'placeholder'=>'Price', 'class' => 'form-control']) !!}
                </div>
            </td>
        </tr>
        </tbody>
    </table>


    <div class="modal-footer">
        {!! Form::submit('Save changes', ['class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save Local Media information']) !!}&nbsp;
        <a href="{{route('local-media')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
    </div>


    @include('admin::local_media._script')

