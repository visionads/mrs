{{--<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery-ui.min.js') }}"></script>--}}

<div class="modal-header">
    {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="click x button for close this entry form">×</button>--}}
    <a href="{{ URL::previous() }}" class="close" type="button" title="click x button for close this entry form"> × </a>
    <h4 class="modal-title" id="myModalLabel">{{ $pageTitle }}<span style="color: #A54A7B" class="user-guideline" data-content="<em>Must Fill <b>Required</b> Field.    <b>*</b> Put cursor on input field for more informations</em>"><font size="2"></font> </span></h4>
</div>
<div class="modal-body">

{!! Form::model($data, ['method' => 'PATCH', 'route'=> ['mktg-menu-item-update', $data[0]['id']], 'files'=>true]) !!}

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
            {!! Form::textarea('description', Input::old('description'), ['id'=>'title', 'class' => 'form-control','title'=>'enter title','rows'=>'4']) !!}
        </div>
        <div>
            {!! Form::label('status', 'Status:', []) !!}
            <small class="required">(Required)</small>
            {!! Form::select('status', array('open'=>'Open','close'=>'Close'),Input::old('status'),['class' => 'form-control','required','title'=>'select status of Item']) !!}
        </div>
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
        @if($data->relMktgMenuItemImage[0]['image'])
        <img src="{{URL::to($data->relMktgMenuItemImage[0]['image'])}}" alt="" width="100%" />
        @else
            <h2>No Image Available</h2>
        @endif
        {!! Form::file('image', Input::old('image'), ['id'=>'title', 'class' => 'form-control']) !!}


        {{--<div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="fileupload-new thumbnail pull-left" style="width: 120px; height: 120px;">
                @if($data['image'] != '')
                    <img src="{{URL::to($data['image'])}}" alt="" />
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
        </div>--}}
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
        @if($data->relMktgItemOption)
            @foreach($data->relMktgItemOption as $options)
                <tr>
                    <td>
                        <div>
                            {!! Form::text('title_option[]', $options->title, ['title'=>'enter title', 'class' => 'form-control']) !!}
                        </div>
                    </td>
                    <td>
                        @if($options->type == 'option')
                            <div>
                                {!! Form::select('type_option[]',array($options->type=>$options->type,'value'=>'Value'), Input::old('type_option'), ['title'=>'enter type', 'class' => 'form-control']) !!}
                            </div>
                        @else
                            <div>
                                {!! Form::select('type_option[]',array($options->type=>$options->type,'option'=>'Option'), Input::old('type_option'), ['title'=>'enter type', 'class' => 'form-control']) !!}
                            </div>
                        @endif
                    </td>
                    <td>
                        <div>
                            {!! Form::text('slug_option[]', $options->slug, ['title'=>'enter slug', 'class' => 'form-control']) !!}
                        </div>
                    </td>
                    <td>
                        <div>
                            {{ isset($options->image)?$options->image:'' }}
                            {!! Form::file('image_option[]', Input::old('image_option'), ['title'=>'enter Image', 'class' => 'form-control']) !!}
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif
        <tr>
            <td>
                <div>
                    {!! Form::text('title_option[]', Input::old('title_option'), ['title'=>'enter title', 'class' => 'form-control']) !!}
                </div>
            </td>
            <td>
                <div>
                    {!! Form::select('type_option[]',array('option'=>'Option','value'=>'Value'), Input::old('type_option'), ['title'=>'enter type', 'class' => 'form-control']) !!}
                </div>
            </td>
            <td>
                <div>
                    {!! Form::text('slug_option[]', Input::old('slug_option'), ['title'=>'enter slug', 'class' => 'form-control']) !!}
                </div>
            </td>
            <td>
                <div>
                    {!! Form::file('image_option[]', Input::old('image_option'), ['title'=>'enter Image', 'class' => 'form-control']) !!}
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>

<div class="modal-footer">
    {!! Form::submit('Save changes', ['class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save journal voucher information']) !!}&nbsp;
    <a href="{{route('mktg-menu-item')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
</div>


{!! Form::close() !!}
</div>
@include('mktg::marketing_material_crud.menu_item.update_script')