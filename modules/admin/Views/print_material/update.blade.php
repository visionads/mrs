{{--<<<<<<< HEAD

=======--}}
{{--<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery-ui.min.js') }}"></script>--}}
{{-->>>>>>> bad91047f4ab92384bfe91967d4d1b26ea294d20--}}


{!! Form::model($data, ['method' => 'PATCH', 'route'=> ['update-print-material', $data[0]['id']], 'files'=>true]) !!}

<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="click x button for close this entry form">×</button>
    <h4 class="modal-title" id="myModalLabel">{{ $pageTitle }} &nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-content="<em>system fill account type and voucher number <br> Must Fill <b>Required</b> Field.    <b>*</b> Put cursor on input field for more informations</em>"><font size="2"></font> </span></h4>
</div>

<div class="modal-body">

    <div class="col-sm-12">

    <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t col-sm-7">
        <div>
            {!! Form::label('title', 'Title:', []) !!}
            <small class="required">(Required)</small>
            {!! Form::text('title', @$data[0]['title'], ['id'=>'title', 'class' => 'form-control','maxlength'=>'64','title'=>'enter title']) !!}
        </div>
        <div>
            {!! Form::label('is_distribution', 'Is Distribution:', []) !!}
            <small class="required">(Required)</small>
            {!! Form::select('is_distribution', array('1'=>'Yes','0'=>'No'),@$data[0]['is_distribution'],['class' => 'form-control','required','title'=>'select is_distribution']) !!}
        </div>

        <div>
            {!! Form::label('price', 'Price:', []) !!}
            <small class="required">(Required)</small>
            {!! Form::input('number','price_hd', @$data[0]['price'], ['title'=>'enter price', 'class' => 'form-control','required']) !!}
        </div>
        <div>
            {!! Form::label('description', 'Description:', []) !!}
            <small class="required">(Required)</small>
            {!! Form::textarea('description_hd', @$data[0]['description'], ['title'=>'enter description','rows'=>'2', 'class' => 'form-control','required']) !!}
        </div>
        <div>
            {!! Form::label('quantity_limit', 'Quantity Limit:', []) !!}
            <small class="required">(Required)</small>
            {!! Form::input('number','quantity_limit', @$data[0]['quantity_limit'], ['title'=>'enter quantity', 'class' => 'form-control','required']) !!}
        </div>
    </div>

    <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t col-sm-5">

        {!! Form::label('image_upload', 'Image Upload:', []) !!}
        <small class="required">(Required)</small>

        <div class="col-md-9 image-center">
            <div class="fileupload fileupload-new" data-provides="fileupload">
                <div class="fileupload-new thumbnail" style="width: 120px; height: 120px;">
                    {{--<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />--}}
                    @if($data[0]['image_path'] != '')
                        {{--<img src="{{URL::to($data['image'])}}" alt="" />--}}
                        <a href="{{ route('print-image-show', $data[0]['id']) }}" class="btn btn-info btn-xs" data-toggle="modal" data-target="#imageView"><img src="{{ URL::to($data[0]['image_path']) }}" height="70px" width="50px" alt="{{$data[0]['image_path']}}" />
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



    {{--------------Details------------------------}}

    <div>
        <h4 class="text-center-header">Sizes</h4>
    </div>

    <table width="100%" id="update-table" class="table" cellpadding="0" cellspacing="0">
        <thead  style="background-color: whitesmoke;">
        <tr>
            <th>Title:</th>
            <th>Price:</th>
            <th>Description:</th>
        </tr>
        </thead>
        <tbody>

        @if(@$data[0]['relPrintMaterial'])
            @foreach($data[0]['relPrintMaterial'] as $value_dt )
                <tr>
                    <td>
                        <div>
                            {!! Form::text('title_size[]', @$value_dt['title'], ['class' => 'form-control', 'title'=>'enter Title']) !!}
                            {!! Form::hidden('dt_id[]',@$value_dt['id'], ['class'=>'update-coa-id-val']) !!}
                        </div>
                    </td>
                    <td>
                        <div>
                            {!! Form::input('number','price[]', @$value_dt['price'], ['title'=>'enter price', 'class' => 'form-control','readonly']) !!}
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
                    {!! Form::text('title_size[]', null, ['title'=>'enter title', 'class' => 'form-control']) !!}
                </div>
            </td>
            <td>
                <div>
                    {!! Form::input('number','price[]', null, ['title'=>'enter price', 'class' => 'form-control','readonly']) !!}
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
    <a href="{{route('print-material')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form" onclick="close_modal();">Close</a>
</div>

{!! Form::close() !!}

@include('admin::print_material.update_script')