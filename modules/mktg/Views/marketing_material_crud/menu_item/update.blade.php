{{--<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery-ui.min.js') }}"></script>--}}

<div class="modal-header">
    {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="click x button for close this entry form">×</button>--}}
    <a href="{{ URL::previous() }}" class="close" type="button" title="click x button for close this entry form"> × </a>
    <h4 class="modal-title" id="myModalLabel">{{ $pageTitle }}<span style="color: #A54A7B" class="user-guideline" data-content="<em>Must Fill <b>Required</b> Field.    <b>*</b> Put cursor on input field for more informations</em>"><font size="2"></font> </span></h4>
</div>
<div class="modal-body">
{!! Form::model($data, ['method' => 'PATCH', 'route'=> ['mktg-menu-item-update', $data->id], 'files'=>true]) !!}

<div class="col-sm-12">

    <div class="form-group col-sm-7">
        <div>
            {!! Form::label('mktg_material_id', 'Parent:', []) !!}
            <small class="required">(Required)</small>
            @if(isset($material))
                <select name="mktg_material_id" class="form-control">
                    @foreach($material as $mat)
                        @if($mat->id == $data->mktg_material_id)
                            <option value="{{ $mat->id }}" selected >{{ $mat->title }}</option>
                        @else
                            <option value="{{ $mat->id }}">{{ $mat->title }}</option>
                        @endif
                    @endforeach
                </select>
            @endif
        </div>
        <div>
            {!! Form::label('title', 'Title :', []) !!}
            <small class="required">(Required)</small>
            {!! Form::text('title', Input::old('title'), ['id'=>'title', 'class' => 'form-control','maxlength'=>'64','title'=>'enter title']) !!}
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
    </div>

    {{--<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t col-sm-5">--}}
    <div class="form-group col-sm-5 pull-right">
        {!! Form::label('Image Upload', 'Image Upload:', []) !!}
        <small class="required">(Required)</small>
        <div class="row">
        @if($data->relMktgMenuItemImage[0]['image'])
            @foreach($data->relMktgMenuItemImage as $imgdata)
                <div class="col-sm-4">
                    <img src="{{URL::to($imgdata['image'])}}" alt="" width="100%">
                    <div class="checkbox" style="border: 1px solid #d0d0d0;">
                        <label class="checkbox-inline text-right">
                            <input type="checkbox" name="img_delete[]" value="{{ $imgdata->id }}">
                            <span class="pull-right" style="line-height: 20px;">Delete &nbsp;</span>
                        </label>
                    </div>
                </div>
            @endforeach
        @else
            <h2>No Image Available</h2>
        @endif
        </div>
        {{--{!! Form::file('image[]', '', ['id'=>'title', 'class' => 'form-control','multiple']) !!}--}}
        <input type="file" name="image[]" id="image" class="default" multiple >
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
    <table width="auto" id="update-table" class="table" cellpadding="0" cellspacing="0">
        <thead  style="background-color: whitesmoke;">
        <tr>
            <th>Title:</th>
            <th>Type:</th>
            <th>Icon:</th>
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
                            {!! Form::hidden('opt_id',$options->id,[]) !!}
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
                            {!! Form::text('icon_option[]', $options->icon, ['title'=>'enter Icon', 'class' => 'form-control']) !!}
                        </div>
                    </td>
                    <td>
                        <div>
                            @if(isset($options->image_thumb))
                                <img src="{{ URL::to($options->image_thumb) }}">
                                {!! Form::hidden('del_option_img',$options->image_thumb,[]) !!}
                            @endif
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
                    {!! Form::select('type_option[]',array(''=>'Select','option'=>'Option','value'=>'Value'), '', ['title'=>'enter type', 'class' => 'form-control']) !!}
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