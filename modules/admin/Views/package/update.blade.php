
{!! Form::model($data, ['method' => 'PATCH', 'route'=> ['update-package', $data[0]['id']], 'files'=>true]) !!}

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="click x button for close this entry form">×</button>
    <h4 class="modal-title" id="myModalLabel">{{ $pageTitle }} &nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-content="<em>system fill account type and voucher number <br> Must Fill <b>Required</b> Field.    <b>*</b> Put cursor on input field for more informations</em>"><font size="2"></font> </span></h4>
</div>

<div class="modal-body">

    <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t col-sm-7">
        <div>
            {!! Form::label('title', 'Title:', ['class'=>'control-label']) !!}
            <small class="required">(Required)</small>
            {!! Form::text('title', @$data[0]['title'], ['id'=>'title', 'class' => 'form-control','maxlength'=>'64','title'=>'enter title']) !!}
        </div>
        <div>
            {!! Form::label('price', 'Price:', ['class'=>'control-label']) !!}
            <small class="required">(Required)</small>
            {!! Form::input('number','price', @$data[0]['price'], ['id'=>'price', 'class' => 'form-control','title'=>'enter price','required']) !!}
        </div>
        <div class="row">
            <div class="col-md-6">
                {!! Form::label('status', 'Status:', ['class'=>'control-label']) !!}
                <div class="form-group">
                    @if(isset($data[0]['status']))
                        @if($data[0]['status']=='open')
                            <label class="radio radio-inline"><input type="radio" name="status" value="{{ @$data[0]['status'] }}" checked ><span style="left:15px!important; top:3px; position:inherit;">Open</span></label>
                            <label class="radio radio-inline"><input type="radio" name="status" value="close" ><span style="left:15px!important; top:3px; position:inherit;">Close</span></label>
                        @else
                            <label class="radio radio-inline"><input type="radio" name="status" value="open"  ><span style="left:15px!important; top:3px; position:inherit;">Open</span></label>
                            <label class="radio radio-inline"><input type="radio" name="status" value="{{ @$data[0]['status'] }}" checked ><span style="left:15px!important; top:3px; position:inherit;">Close</span></label>
                        @endif
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                {!! Form::label('is_distributed_package', 'Is Distributed Package:', ['class'=>'control-label']) !!}
                <div class="form-group">
                    @if(isset($data[0]['is_distributed_package']))
                        @if($data[0]['is_distributed_package']=='yes')
                            <label class="radio radio-inline"><input type="radio" name="is_distributed_package" value="{{ @$data[0]['is_distributed_package'] }}" checked ><span style="left:15px!important; top:3px; position:inherit;">Yes</span></label>
                            <label class="radio radio-inline"><input type="radio" name="is_distributed_package" value="no" ><span style="left:15px!important; top:3px; position:inherit;">No</span></label>
                        @else
                            <label class="radio radio-inline"><input type="radio" name="is_distributed_package" value="yes"  ><span style="left:15px!important; top:3px; position:inherit;">Yes</span></label>
                            <label class="radio radio-inline"><input type="radio" name="is_distributed_package" value="{{ @$data[0]['status'] }}" checked ><span style="left:15px!important; top:3px; position:inherit;">No</span></label>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div>
            {!! Form::label('type', 'Type:', ['class' => 'control-label']) !!}
            <small class="required">(Required)</small>
            {!! Form::Select('type',array('medium-packages'=>'Medium Packages','large-range-packages'=>'Large Range Packages','super-exposure-pack'=>'Super Exposure Pack'),@$data[0]['type'],['class'=>'form-control ','required']) !!}
        </div>
    </div>

    <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t col-sm-5">

        {!! Form::label('image_upload', 'Image Upload:', []) !!}
        <small class="required">(Required)</small>

        <div class="col-md-9 image-center">
            <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new thumbnail" style="width: 120px; height: 120px; float: left;">
                    {{--<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />--}}
                    @if($data[0]['image_path'] != '')
                        {{--<img src="{{URL::to($data['image'])}}" alt="" />--}}
                        <a href="{{ route('package-image-show', $data[0]['id']) }}" class="btn btn-info btn-xs" data-toggle="modal" data-target="#imageView"><img src="{{ URL::to($data[0]['image_path']) }}" height="70px" width="50px" alt="{{$data[0]['image_path']}}" />
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



    {{--------------Details------------------------}}

    <div>
        <h4 class="text-left-header">Package Options</h4>
    </div>

    <table width="100%" id="update-table" class="table" cellpadding="0" cellspacing="0">
        <thead  style="background-color: whitesmoke;">
        <tr>
            <th>Title:</th>
            <th>Price:</th>
            <th>Image:</th>
            <th>Description:</th>
        </tr>
        </thead>
        <tbody>

        @if(@$data[0]['relPackageOption'])
            @foreach($data[0]['relPackageOption'] as $value_dt )
                <tr>
                    <td>
                        <div>
                            {!! Form::text('title_option[]', @$value_dt['title'], ['class' => 'form-control', 'title'=>'enter Title']) !!}
                            {!! Form::hidden('dt_id[]',@$value_dt['id'], ['class'=>'update-coa-id-val']) !!}
                        </div>
                    </td>
                    <td>
                        <div>
                            {!! Form::input('number','price_option[]', @$value_dt['price'], ['title'=>'enter price', 'class' => 'form-control','readonly']) !!}
                        </div>
                    </td>
                    <td>
                        <div>
                            @if(isset($value_dt->image_thumb))
                                <img src="{{ URL::to($value_dt->image_thumb) }}">
                                {!! Form::hidden('del_option_img_thumb[]',$value_dt->image_thumb,[]) !!}
                                {!! Form::hidden('del_option_img[]',$value_dt->image,[]) !!}
                            @endif
                            {{--{!! Form::file('image_option_edit[]', null, ['title'=>'enter Image', 'class' => 'form-control']) !!}--}}
                            {!! Form::file('image_option[]', null, ['title'=>'enter Image', 'class' => 'form-control']) !!}
                        </div>
                    </td>
                    <td>
                        <div>
                            {!! Form::text('description[]', @$value_dt['description'], ['title'=>'enter description', 'class' => 'form-control']) !!}
                        </div>
                    </td>
                </tr>
            @endforeach
        @endif

        <tr>
            <td>
                <div>
                    {!! Form::text('title_option[]', null, ['title'=>'enter title','placeholder'=>'Package option title', 'class' => 'form-control']) !!}
                </div>
            </td>
            <td>
                <div>
                    {!! Form::input('number','price_option[]', 0, ['title'=>'enter price','placeholder'=>'Price', 'class' => 'form-control','readonly']) !!}
                </div>
            </td>
            <td>
                <div>
                    {!! Form::file('image_option[]', null, ['title'=>'enter Image', 'class' => 'form-control']) !!}
                </div>
            </td>
            <td>
                <div>
                    {!! Form::text('description[]', null, ['title'=>'enter description', 'class' => 'form-control']) !!}
                </div>
            </td>
        </tr>
        </tbody>
    </table>

</div>



<div class="modal-footer">
    {!! Form::submit('Save changes', ['class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save journal voucher information']) !!}&nbsp;
    <a href="{{route('package')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form" onclick="close_modal();">Close</a>
</div>

{!! Form::close() !!}

@include('admin::package.update_script')