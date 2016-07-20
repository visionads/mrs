{{--<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ URL::asset('assets/js/jquery-ui.min.js') }}"></script>--}}
{{--<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>--}}



<div class="col-sm-12">
    {{--<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t col-sm-7">--}}
    <div class="form-group col-sm-7">
        <div>
            {!! Form::label('title', 'Title :', []) !!}
            <small class="required">(Required)</small>
            {!! Form::text('title', Input::old('title'), ['id'=>'title', 'class' => 'form-control','maxlength'=>'64','title'=>'enter title']) !!}
        </div>
        <div>
            {!! Form::label('slug', 'Slug :', []) !!}
            <small class="required">(Required)</small>
            {!! Form::text('slug', Input::old('slug'), ['id'=>'title', 'class' => 'form-control','maxlength'=>'64','title'=>'enter title']) !!}
        </div>
        <div>
            {!! Form::label('description', 'Description :', []) !!}
            <small class="required">(Required)</small>
            {!! Form::textarea('description', Input::old('description'), ['id'=>'title', 'class' => 'form-control','maxlength'=>'64','title'=>'enter title','rows'=>'4']) !!}
        </div>
        {{--<div>
            {!! Form::label('is_distribution', 'Is Distribution:', []) !!}
            <small class="required">(Required)</small>
            {!! Form::select('is_distribution', array('1'=>'Yes','0'=>'No'),Input::old('is_distribution'),['class' => 'form-control','required','title'=>'select status of branch']) !!}
        </div>--}}
        <div>
            {!! Form::label('mktg_material_id', 'Parent:', []) !!}
            <small class="required">(Required)</small>
            @if(isset($material))
                <select name="mktg_material_id" class="form-control">
                    <?php $default = Input::old('mktg_material_id'); ?>
                    @if(!empty($default))
                        <option value="{{ $default }}">{{ $default }}</option>
                    @else
                        <option value="">Select</option>
                    @endif
                    @foreach($material as $mat)
                       <option value="{{ $mat->id }}">{{ $mat->title }}</option>
                    @endforeach
                </select>
            @endif
        </div>
    </div>

    {{--<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t col-sm-5">--}}
    <div class="form-group col-sm-5 pull-right">

        {!! Form::label('Image Upload', 'Image Upload:', []) !!}
        <small class="required">(Required)</small>

        <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new thumbnail pull-left" style="width: 120px; height: 120px;">
                @if($data['image'] != '')
                    {{--<img src="{{URL::to($data['image'])}}" alt="" />--}}
                    <a href="{{ route('gal_image.image.show', $data['id']) }}" class="btn btn-info btn-xs" data-toggle="modal" data-target="#imageView">
                        <img src="{{ URL::to($data['image']) }}" height="50px" width="50px" alt="{{$data['image']}}" />
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
        <br>
        <span class="label label-danger">NOTE!</span>
        <span>System will allow these types of image(png,jpeg,jpg Format)</span>
    </div>
</div>


{{--===== Options Start =====--}}
<div class="col-sm-12">
    <br><h4 class="text-center-header" style="border-top: 1px solid #d0d0d0;"><br>Menu Options</h4>
</div>

<div class="col-sm-12">
    <table width="auto" id="table" class="table" cellpadding="0" cellspacing="0">
        <thead  style="background-color: whitesmoke;">
        <tr>
            <th>Title:</th>
            <th>Type:</th>
            <th>Slug:</th>
            {{--<th>Price:</th>--}}
            {{--<th>Description:</th>--}}
            <th>Image</th>
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
                    {!! Form::select('type[]',array('option'=>'Option','value'=>'Value'), Input::old('type'), ['title'=>'enter type', 'class' => 'form-control']) !!}
                </div>
            </td>
            <td>
                <div>
                    {!! Form::text('slug[]', Input::old('slug'), ['title'=>'enter slug', 'class' => 'form-control']) !!}
                </div>
            </td>
            <td>
                <div>
                    {!! Form::file('image[]', Input::old('image'), ['title'=>'enter slug', 'class' => 'form-control']) !!}
                </div>
            </td>

            {{--<td>
                <div>
                    {!! Form::input('number','price[]', Input::old('price'), ['title'=>'enter price', 'class' => 'form-control']) !!}
                </div>
            </td>
            <td>
                <div>
                    {!! Form::text('description[]', Input::old('description'), ['title'=>'enter description', 'class' => 'form-control']) !!}
                </div>
            </td>--}}
        </tr>
        </tbody>
    </table>
</div>

<div class="modal-footer">
    {!! Form::submit('Save changes', ['class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save journal voucher information']) !!}&nbsp;
    <a href="{{route('mktg-menu-item')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
</div>


@include('admin::print_material._script')