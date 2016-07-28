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

    {!! Form::model($data, ['method' => 'PATCH', 'route'=> ['mktg-item-option-add-value-update', $data->id], 'files'=>true]) !!}
    <div class="col-sm-12">
        @if($data)
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

            <div class="col-sm-6">
                <div class="row">
                    <table class="table table-striped">
                        <tr>
                            <th>Title</th>
                            <td width="5">:</td>
                            <td colspan="5">{{ $data->title }}</td>
                        </tr>
                        <tr>
                            <th>Slug</th>
                            <td>:</td>
                            <td colspan="5">{{ $data->slug }}</td>
                        </tr>
                        <tr>
                            <th>Type</th>
                            <td>:</td>
                            <td colspan="5">{{ $data->type }}</td>
                        </tr>
                    </table>

                    <table class="table table-striped" id="table_edit">
                        <tr>
                            <td colspan="6"><h4><span class="glyphicon glyphicon-edit"></span> Edit Value</h4></td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <th>Price</th>
                        </tr>
                        @foreach($options_edit as $val)
                            <tr>
                                <td>
                                    {!! Form::text('title[]', $val->title, ['placeholder'=>'Enter Title', 'class' => 'form-control','autofocus'=>'autofocus']) !!}
                                    {{--{!! Form::text('val_id[]', $val->id,[]) !!}
                                    {{ $data->id }}--}}
                                </td>
                                <td>
                                    {!! Form::text('price[]', $val->price, ['placeholder'=>'Enter Price', 'class' => 'form-control','autofocus'=>'autofocus']) !!}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        @endif
    </div>

    <div class="modal-footer">
        {!! Form::submit('Save changes', ['class' => 'btn btn-primary','data-placement'=>'left','data-content'=>'click save changes button for save the above informatin']) !!}&nbsp;
        {{--<a href="{{route('mktg-menu-item')}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>--}}
        <a href="{{URL::previous()}}" class=" btn btn-default" data-placement="top" data-content="click close button for close this entry form">Close</a>
    </div>
    {!! Form::close() !!}
</div>
@else
<div class="modal-body">
    {{--{!! Form::model($data, ['method' => 'PATCH', 'route'=> ['mktg-item-option-add-value-store', $data->id], 'files'=>true]) !!}--}}
    {!! Form::open(['route'=> ['mktg-item-option-add-value-store', $data->id],'class' => 'form-horizontal','id' => 'jq-validation-form']) !!}
    <div class="col-sm-12">
        @if($data)
            <div class="col-sm-6">
                <div class="row">
                <table class="table table-striped">
                    <tr>
                        <th>Title</th>
                        <td width="5">:</td>
                        <td colspan="5">{{ $data->title }}</td>
                    </tr>
                    <tr>
                        <th>Slug</th>
                        <td>:</td>
                        <td colspan="5">{{ $data->slug }}</td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <td>:</td>
                        <td colspan="5">{{ $data->type }}</td>
                    </tr>
                </table>
                <table class="table table-striped" id="table">
                    <tr>
                        <td colspan="6"><h4><span class="glyphicon glyphicon-plus"></span> Add Value</h4></td>
                    </tr>
                    <tr>
                        <th>Title</th>
                        <th>Price</th>
                    </tr>
                    <tr>
                        <td>
                            {!! Form::text('title[]', null, ['placeholder'=>'Enter Title', 'class' => 'form-control','autofocus'=>'autofocus']) !!}
                            {{--{{ $data->id }}--}}
                        </td>
                        <td>
                            {!! Form::text('price[]', null, ['placeholder'=>'Enter Price', 'class' => 'form-control','autofocus'=>'autofocus']) !!}
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
        {!! Form::submit('Save changes', ['class' => 'btn btn-primary','data-placement'=>'left','data-content'=>'click save changes button for save the above Information']) !!}&nbsp;
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
@include('mktg::marketing_material_crud.menu_item.item_option_value_script')
