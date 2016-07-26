{{--<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery-ui.min.js') }}"></script>--}}

<div class="modal-header">
    {{--<button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="click x button for close this entry form">×</button>--}}
    <a href="{{ URL::previous() }}" class="close" type="button" title="click x button for close this entry form"> × </a>
    <h4 class="modal-title" id="myModalLabel">{{ $pageTitle }}<span style="color: #A54A7B" class="user-guideline" data-content="<em>Must Fill <b>Required</b> Field.    <b>*</b> Put cursor on input field for more informations</em>"><font size="2"></font> </span></h4>
</div>
@if(isset($options))
<div class="modal-body">

    {!! Form::model($data, ['method' => 'PATCH', 'route'=> ['mktg-item-option-add-value-update', $options->id], 'files'=>true]) !!}

    {{--===== Options Start =====--}}
    {{--<div class="col-sm-12">
        <br><h4 class="text-left-header" style="border-top: 1px solid #d0d0d0;"><br>Menu Options</h4>
    </div>--}}

    <div class="col-sm-12">
        @if($data)
            <div class="col-sm-6">
                <div class="row">
                <table class="table table-striped">
                    <tr>
                        <th>Title</th>
                        <td width="5">:</td>
                        <td>{{ $data->title }}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>:</td>
                        <td>{{ $data->slug }}</td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td>:</td>
                        <td>{{ $data->type }}</td>
                    </tr>

                    <tr>
                        <td colspan="3"><h4><span class="glyphicon glyphicon-edit"></span> Edit Value</h4></td>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <td>:</td>
                        <td>
                            @if(isset($options))
                                {!! Form::text('title', $options->title, ['placeholder'=>'Enter Title', 'class' => 'form-control','autofocus'=>'autofocus']) !!}
                            @else
                                {!! Form::text('title', '', ['placeholder'=>'Enter Title', 'class' => 'form-control','autofocus'=>'autofocus']) !!}
                            @endif
                            {!! Form::hidden('mktg_item_option_id', $data->id, [ 'class' => 'form-control']) !!}
                        </td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>:</td>
                        <td>
                            @if(isset($options))
                                {!! Form::text('price', $options->price, ['placeholder'=>'Enter Price', 'class' => 'form-control','autofocus'=>'autofocus']) !!}
                            @else
                                {!! Form::text('price', '', ['placeholder'=>'Enter Price', 'class' => 'form-control','autofocus'=>'autofocus']) !!}
                            @endif
                        </td>
                    </tr>

                </table>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="row">
                <table class="table">
                    <tr>
                        <th valign="top">Image</th>
                        <td width="5">:</td>
                        <td>
                            @if(isset($data->image))
                                <img src="{{ URL::to(isset($data->image)?$data->image:'') }}" width="100%">
                            @else
                                <h5>No Image Available</h5>
                            @endif
                        </td>
                    </tr>
                </table>
                </div>
            </div>
        @endif
    </div>

    <div class="modal-footer">
        {!! Form::submit('Save changes', ['class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save journal voucher information']) !!}&nbsp;
        {{--<a href="{{route('mktg-menu-item')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>--}}
        <a href="{{URL::previous()}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
    </div>


    {!! Form::close() !!}
</div>
@else
<div class="modal-body">

    {!! Form::model($data, ['method' => 'PATCH', 'route'=> ['mktg-item-option-add-value-store', $data->id], 'files'=>true]) !!}

    {{--===== Options Start =====--}}
    {{--<div class="col-sm-12">
        <br><h4 class="text-left-header" style="border-top: 1px solid #d0d0d0;"><br>Menu Options</h4>
    </div>--}}

    <div class="col-sm-12">
        @if($data)
            <div class="col-sm-6">
                <div class="row">
                <table class="table table-striped">
                    <tr>
                        <th>Title</th>
                        <td width="5">:</td>
                        <td>{{ $data->title }}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>:</td>
                        <td>{{ $data->slug }}</td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td>:</td>
                        <td>{{ $data->type }}</td>
                    </tr>

                    <tr>
                        <td colspan="3"><h4><span class="glyphicon glyphicon-plus"></span> Add Value</h4></td>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <td>:</td>
                        <td>
                            @if(isset($options))
                                {!! Form::text('title', $options->title, ['placeholder'=>'Enter Title', 'class' => 'form-control','autofocus'=>'autofocus']) !!}
                            @else
                                {!! Form::text('title', '', ['placeholder'=>'Enter Title', 'class' => 'form-control','autofocus'=>'autofocus']) !!}
                            @endif
                            {!! Form::hidden('mktg_item_option_id', $data->id, [ 'class' => 'form-control']) !!}
                        </td>
                    </tr>
                    <tr>
                        <th>Price</th>
                        <td>:</td>
                        <td>
                            @if(isset($options))
                                {!! Form::text('price', $options->price, ['placeholder'=>'Enter Price', 'class' => 'form-control','autofocus'=>'autofocus']) !!}
                            @else
                                {!! Form::text('price', '', ['placeholder'=>'Enter Price', 'class' => 'form-control','autofocus'=>'autofocus']) !!}
                            @endif
                        </td>
                    </tr>

                </table>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="row">
                <table class="table">
                    <tr>
                        <th valign="top">Image</th>
                        <td width="5">:</td>
                        <td>
                            @if(isset($data->image))
                                <img src="{{ URL::to(isset($data->image)?$data->image:'') }}" width="100%">
                            @else
                                <h5>No Image Available</h5>
                            @endif
                        </td>
                    </tr>
                </table>
                </div>
            </div>
        @endif
    </div>

    <div class="modal-footer">
        {!! Form::submit('Save changes', ['class' => 'btn btn-primary','data-placement'=>'top','data-content'=>'click save changes button for save journal voucher information']) !!}&nbsp;
        {{--<a href="{{route('mktg-menu-item')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>--}}
        <a href="{{URL::previous()}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
    </div>


    {!! Form::close() !!}
</div>
@endif



<script>
    /*$(document).on('shown', "#etsbModal", function() {
        $('input:text:visible:first').focus();
    });*/
    $(document).on('shown.bs#etsbModal', '#etsbModal', function() {
        $(this).find('[autofocus]').focus();
    });
</script>
{{--
@include('mktg::marketing_material_crud.menu_item.update_script')--}}
