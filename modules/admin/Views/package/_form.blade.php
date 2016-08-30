{{--<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ URL::asset('assets/js/jquery-ui.min.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>--}}



<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t col-sm-7">
    <div>
        {!! Form::label('title', 'Title:', ['class'=>'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::text('title', Input::old('title'), ['id'=>'title', 'class' => 'form-control','maxlength'=>'128','title'=>'enter title','required']) !!}
    </div>
    <div>
        {!! Form::label('price', 'Price:', ['class'=>'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::input('number','price', Input::old('price'), ['id'=>'price', 'class' => 'form-control','title'=>'enter price','required']) !!}
    </div>
    <div class="">
        {!! Form::label('status', 'Status:', ['class'=>'control-label']) !!}
        <div class="form-group">
            <label class="radio radio-inline"><input type="radio" name="status" value="open" checked ><span style="left:15px!important; top:3px; position:inherit;">Open</span></label>
            <label class="radio radio-inline"><input type="radio" name="status" value="close" class="corm-control" ><span style="left:15px!important; top:3px; position:inherit;">Close</span></label>
        </div>
    </div>
    <div>
        {!! Form::label('type', 'Type:', ['class' => 'control-label']) !!}
        <small class="required">(Required)</small>
        {!! Form::Select('type',array('0'=>'--select--','medium-packages'=>'Medium Packages','large-range-packages'=>'Large Range Packages','super-exposure-pack'=>'Super Exposure Pack'),Input::old('type'),['class'=>'form-control ','required']) !!}
    </div>
</div>

<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t col-sm-5">

    {!! Form::label('Image Upload', 'Image Upload:', ['class'=>'control-label','style="margin-left:15px;"']) !!}
    <small class="required">(Required)</small>

    <div class="col-md-12 image-center">
        <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new thumbnail" style="width: 120px; height: 120px; float:left;">
                {{--<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />--}}
                @if($data['image'] != '')
                    {{--<img src="{{URL::to($data['image'])}}" alt="" />--}}
                    <a href="{{ route('gal_image.image.show', $data['id']) }}" class="btn btn-info btn-xs" data-toggle="modal" data-target="#imageView"><img src="{{ URL::to($data['image']) }}" height="50px" width="50px" alt="{{$data['image']}}" >
                    </a>
                @else
                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                @endif
            </div>
            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
            <div class="image-center">
                <input type="file" name="image" id="image" class="default" >
            </div>
        </div>
    </div>
    <div class="clearfix" style="margin-left: 18px">
    <span class="label label-danger">NOTE!</span>
    <span>System will allow these types of image(png,jpeg,jpg Format)</span>
    </div>
</div>




<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t col-sm-12">
    <h4 class="text-left-header">Package Options</h4>
</div>


<table width="100%" id="table" class="table" cellpadding="0" cellspacing="0">
    <thead  style="background-color: whitesmoke;">
    <tr>
        <th>Title:</th>
        <th>Price:</th>
        {{--<th>Description:</th>--}}
    </tr>
    </thead>
    <tbody>

    <tr>
        <td>
            <div>
                {!! Form::text('title_option[]', Input::old('title_option'), ['title'=>'enter title','placeholder'=>'Package option title', 'class' => 'form-control']) !!}
            </div>
        </td>

        <td>
            <div>
                {!! Form::input('number','price_option[]', Input::old('price_option'), ['title'=>'enter price','placeholder'=>'Price', 'class' => 'form-control']) !!}
            </div>
        </td>
       {{-- <td>
            <div>
                {!! Form::text('description[]', Input::old('description'), ['title'=>'enter description', 'class' => 'form-control']) !!}
            </div>
        </td>--}}
    </tr>
    </tbody>
</table>


<div class="modal-footer">
    {!! Form::submit('Save changes', ['class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save journal voucher information']) !!}&nbsp;
    <a href="{{route('package')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
</div>


@include('admin::package._script')