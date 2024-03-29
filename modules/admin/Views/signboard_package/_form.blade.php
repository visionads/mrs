{{--<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>--}}

<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t col-sm-12">

<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t col-sm-7">
    <div>
        {!! Form::label('title', 'Title:', []) !!}
        <small class="required">(Required)</small>
        {!! Form::text('title', null, ['id'=>'title', 'class' => 'form-control','maxlength'=>'64','title'=>'enter title']) !!}
    </div>
    <div>
        {!! Form::label('price', 'Price:', []) !!}
        <small class="required">(Required)</small>
        {!! Form::input('number','price', null , ['title'=>'enter price', 'class' => 'form-control','required']) !!}
    </div>
    <div>
        {!! Form::label('description', 'Description:', []) !!}
        <small class="required">(Required)</small>
        {!! Form::textarea('description', null , ['title'=>'enter description','rows'=>'5', 'class' => 'form-control','required']) !!}
    </div>
</div>

<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t col-sm-5">

    {!! Form::label('Image Upload', 'Image Upload:', []) !!}
    <small class="required">(Required)</small>

    <div class="col-md-12 image-center">
        <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new thumbnail" style="width: 120px; height: 120px;">
                {{--<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />--}}
                @if($data['image'] != '')
                    {{--<img src="{{URL::to($data['image'])}}" alt="" />--}}
                    <a href="{{ route('gal_image.image.show', $data['id']) }}" class="btn btn-info btn-xs" data-toggle="modal" data-target="#imageView"><img src="{{ URL::to($data['image']) }}" height="50px" width="50px" alt="{{$data['image']}}" />
                    </a>
                @else
                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                @endif
            </div>
            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
            <div class="image-center">
                <input type="file" name="image" id="image" class="default" />
            </div>
        </div>
        <span class="label label-danger">NOTE!</span>
                                             <span>
                                             System will allow these types of image(png,jpeg,jpg Format)
                                             </span>
    </div>

</div>

</div>




{{--<table width="100%" id="table" class="table" cellpadding="0" cellspacing="0">
    <thead  style="background-color: whitesmoke;">
    <tr>
        <th>Title:</th>
        <th>Price:</th>
        <th>Image:</th>
        <th>Description:</th>
    </tr>
    </thead>
    <tbody>

    <tr>
        <td>
            <div>
                {!! Form::text('title_size[]', Input::old('title_size'), ['title'=>'enter title', 'class' => 'form-control']) !!}
            </div>
        </td>

        <td>
            <div>
                {!! Form::input('number','price[]', 00, ['title'=>'enter price', 'class' => 'form-control']) !!}
            </div>
        </td>
        <td>
            <div>
                {!! Form::file('image_option[]', null, ['title'=>'enter Image', 'class' => 'form-control']) !!}
            </div>
        </td>
        <td>
            <div>
                {!! Form::text('description[]', Input::old('description'), ['title'=>'enter description', 'class' => 'form-control']) !!}
            </div>
        </td>
    </tr>
    </tbody>
</table>--}}


<div class="modal-footer">
    {!! Form::submit('Save changes', ['class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save journal voucher information']) !!}&nbsp;
    <a href="{{route('signboard-package')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
</div>


@include('admin::signboard_package._script')
