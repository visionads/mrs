@extends('admin::layouts.master')

@section('content')
    <link href="{{ URL::asset('assets/css/simplegallery.demo1.min.css') }}" rel="stylesheet" type="text/css" >
    <script type="text/javascript" src="{{ URL::asset('assets/js/simplegallery.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){

            $('#gallery').simplegallery({
                galltime : 400,
                gallcontent: '.content',
                gallthumbnail: '.thumbnail',
                gallthumb: '.thumb'
            });

        });
    </script>

    <div id="container" class="container pages new_order font-droid">

        <div class="col-md-12">
            @if(isset($data))

                {!! Form::open(['route'=>['add-to-cart',$data['id']],'id'=>'genForm','files'=>true]) !!}

                <input type="text" name="mktg_menu_item_id" value="{{ $menu_item_id }}">

                {{--=========For Congratulatory Pack ===============--}}
                @if($data['slug']=='congratulatory-pack')
                    <script>
                        $(document).ready(function(){
                            $('.rmv').remove();
                            $('.eml').show();
                        });
                    </script>
                    <input type="hidden" name="congratulatory_pack" value="{{ $data['slug'] }}">
                @endif

                <div class="row">
                    {{--Left pan:: For Image gallery--}}
                    <div class="col-md-4">
                        <div class="image-box">
                            <section id="gallery" class="simplegallery">
                                <div class="content">
                                    @if($data['rel_mktg_menu_item_image'])
                                    @for($i=0; $i<sizeof($data['rel_mktg_menu_item_image']); $i++)
                                        <img src="{{ url($data['rel_mktg_menu_item_image'][$i]['image']) }}" class="image_{{$i}}" alt="" />
                                    @endfor
                                    @endif
                                </div>
                                
                                <div class="thumbnail">
                                    @if($data['rel_mktg_menu_item_image'])
                                    @for($i=0; $i<sizeof($data['rel_mktg_menu_item_image']); $i++)
                                    <div class="thumb">
                                        <a href="#" rel="1">
                                            <img src="{{ url($data['rel_mktg_menu_item_image'][$i]['image_thumb']) }}" id="thumb_{{$i}}" alt="" />
                                        </a>
                                    </div>
                                    @endfor
                                    @endif
                                    <div class="clearfix"></div>
                                </div>
                            </section>
                        </div>
                    </div>

                    {{--Right pan::for form and other items--}}
                    <div class="col-md-8 green-yellow">
                        <h3 class="green-yellow">{{ $pageTitle }}{{---{{ $menu_item_id }}--}}</h3>
                        {{--{!! Form::open(['method'=>'GET','route'=>'solution-type-search','class'=>'form-inline']) !!}
                        {!! Form::open(['method'=>'GET','class'=>'form-horizontal']) !!}
                        @include('mktg::marketing_material.agency_stationary_materials.letterhead_form')
                        {!! Form::close() !!}--}}
                        <?php
                            $option = 0;
                            $value = 0;
                        ?>

                        <div class="row">
                            <div class="col-md-12">
                                {{--option--}}
                                @if(isset($data['rel_mktg_item_option']))
                                    <?php $i=1; ?>
                                    @foreach($data['rel_mktg_item_option'] as $item_opt)
                                        @if($item_opt['type']=='option')
                                            {{--IF Image is available in menu option(**)--}}
                                            @if(empty($item_opt['image']) && empty($item_opt['icon']))

                                                <div class="col-md-4">
                                                    {{--<div class="image-wrapper">
                                                        <img src="{{url($item_opt['image'])}}" class="img-responsive image-center">
                                                    </div>--}}
                                                    <a role="tab" class="btn btn-green" style="width:100%;">
                                                        <label class="radio-inline black size-13 text-left" style="width: 100%;" >
                                                            <input type="radio" name="img_option" value="{!! $item_opt['rel_mktg_item_value'][0]['id'] !!}" <?php if($i++ =='1'){echo 'checked="checked"'; } ?> >
                                                            {{$item_opt['title']}}
                                                        </label>
                                                    </a>
                                                </div>

                                            @elseif(!empty($item_opt['image']) && empty($item_opt['icon']))

                                                <div class="col-md-4">
                                                    <div class="image-wrapper">
                                                        <img src="{{url($item_opt['image'])}}" class="img-responsive image-center">
                                                    </div>
                                                    <a role="tab" class="btn btn-green" style="width:100%;">
                                                        <label class="radio-inline black size-13 text-left" style="width: 100%;" >
                                                            <input type="radio" name="img_option" value="{!! $item_opt['rel_mktg_item_value'][0]['id'] !!}" <?php if($i++ =='1'){echo 'checked="checked"'; } ?> >
                                                            {{$item_opt['title']}}
                                                        </label>
                                                    </a>
                                                </div>

                                            @else

                                                <div class="col-md-6">
                                                    <div class="checkbox">
                                                        @if(isset($item_opt['rel_mktg_item_value'][0]['id']))
                                                        <label class="green-yellow">
                                                            <input name="option[{!! $item_opt['rel_mktg_item_value'][0]['id'] !!}]" value="{!! $item_opt['rel_mktg_item_value'][0]['price'] !!}" type="hidden">
                                                            <i class="{{ $item_opt['icon'] }}"></i> {{$item_opt['title']}}
                                                            <?php $option += $item_opt['rel_mktg_item_value'][0]['price'] ?>
                                                        </label><br>
                                                        @endif
                                                    </div>

                                                </div>
                                            @endif
                                        @endif

                                    @endforeach
                                @endif

                                {{--value--}}
                                @if(isset($data['rel_mktg_item_option']))
                                    @foreach($data['rel_mktg_item_option'] as $item_opt)
                                        @if($item_opt['type']=='value')
                                            <?php
                                                //===== For Vynle Stickers
                                                $hide = '';
                                                $prdct_id = '';
                                                if($item_opt['title']=='SOLD/LEASE')
                                                {
                                                    $hide = 'id="generic"';
                                                }
                                                if($item_opt['title']=='Custom shape')
                                                {
                                                    $hide = 'id="custom"';
                                                }
                                                if($item_opt['title']=='Product' && $pageTitle == 'Vynle stickers outdoor (SOLD)')
                                                {
                                                    $prdct_id = 'id="product"';
                                                }
                                            ?>

                                            <div class="col-sm-12" style="height:10px;"></div>

                                            <div class="col-sm-6 rmv" <?php echo $hide; ?> >
                                                <div style="border-left: 3px dashed #404040;">
                                                    <div class="form-group">
                                                        {!! Form::label('qty', $item_opt['title'], ['class'=>'control-label col-sm-4 green-yellow']) !!}
                                                        <div class="col-sm-8">
                                                            <?php $i=0; ?>
                                                            @if(isset($item_opt['rel_mktg_item_value'][$i]['id']))
                                                                @if($prdct_id !== '')
                                                                    {{--============For Vynle Stickers outdoor===========--}}
                                                                    <select name="option[{{ $item_opt['rel_mktg_item_value'][$i]['id'] }}]" class='form-control deeppink size-15' onchange="myFunction(this.value)" <?php echo $prdct_id; ?> >
                                                                        @if(isset($item_opt['rel_mktg_item_value']))
                                                                            @foreach($item_opt['rel_mktg_item_value'] as $item_val)
                                                                                <option value="{{ $item_val['title'] }}">{{ $item_val['title'] }}</option>
                                                                                <?php $i++;?>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                @else
                                                                    {{--============For General Forms===========--}}
                                                                    <select name="option[{{ $item_opt['rel_mktg_item_value'][$i]['id'] }}]" class='form-control deeppink size-15' onchange="myFunction(this.value)" <?php echo $prdct_id; ?> >
                                                                        @if(isset($item_opt['rel_mktg_item_value']))
                                                                            @foreach($item_opt['rel_mktg_item_value'] as $item_val)
                                                                                <option value="{{ $item_val['price'] }}">{{ $item_val['title'] }}</option>
                                                                                <?php $i++;?>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                @endif
                                                            @endif
                                                            <?php ?>
                                                            {{--{!! Form::select('qty'.$i, [$value[$item_val['id']]],Input::old('qty'),['class' => 'form-control deeppink size-15','id'=>'', 'onchange'=>'myFunction()','required']) !!}--}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endif
                                    @endforeach
                                @endif
                                <script>
                                    //===== Script for Vynle Stickers outdoor
                                    $(document).ready(function(){
                                        $("#generic").hide();
                                        $("#custom").hide();

                                        $("#product").change(function(){
                                            var selectData = ($("#product").val());
                                            if(selectData=='Generic'){
                                            //if(selectData=='1'){
                                                $("#generic").slideDown();
                                                $("#custom").hide();
                                            }
                                            if(selectData=='Custom'){
                                            //if(selectData=='2'){
                                                $("#custom").slideDown();
                                                $("#generic").hide();
                                            }
                                            if(selectData!=='Generic' && selectData!=='Custom')
                                            //if(selectData!=='2' && selectData!=='1')
                                            {
                                                $("#generic").hide();
                                                $("#custom").hide();
                                            }
                                        })
                                    });
                                </script>

                                <div class="col-sm-12" style="height: 30px;"></div>


                                {{--=============For Congratulatory Pack Email form==============--}}
                                <div class="col-md-12 eml" style="display: none;">
                                    <div style="border: 1px dashed #909000; padding: 15px;">
                                        <div class="form-group">
                                            {!! Form::label('send_to', 'SEND TO :', ['class'=>'control-label green-yellow']) !!}
                                            <div class="">
                                                {{--{!! Form::select('send_to', array('0'=>'Select Size','vendor'=>'Vendor','purchaser'=>'Purchaser'),Input::old('send_to'),['class' => 'form-control deeppink size-15','id'=>'','required']) !!}--}}
                                                <select class="form-control deeppink size-15" name="send_to">
                                                    @if(isset($vendor_data))
                                                        @foreach($vendor_data as $v_data)
                                                            <option>{{ $v_data->vendor_email }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        {{--<div class="col-md-12"></div>--}}
                                        <div class="form-group">
                                            {!! Form::label('delivery_to', 'DELIVERY TO :', ['class'=>'control-label green-yellow']) !!}
                                            <div class="">
                                                {!! Form::textarea('delivery_to',Input::old('delivery_to'),['class' => 'form-control deeppink size-15','id'=>'']) !!}
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>{{--End of Emil Form --}}

                                <div class="col-sm-12" style="height: 30px;"></div>


                                <div class="col-md-12">
                                    Do you need Artwork ?
                                    {{--<a href=" #place" class="btn btn-green " id="proceed">Yes <span class="glyphicon glyphicon-chevron-down"></span></a> &nbsp; &nbsp;--}}
                                    <label class="radio-inline green-yellow" >
                                        {!! Form::radio('art','no','true',['id'=>'no']) !!}
                                        No
                                    </label>
                                    <label class="radio-inline green-yellow" >
                                        {!! Form::radio('art','yes','',['id'=>'yes']) !!}
                                        Yes
                                    </label>

                                </div>

                                <div class="col-sm-12" style="height: 30px;"></div>

                                {{--Artwork Form Start--}}
                                <a name="place">&nbsp;</a>
                                <div class="col-md-12" id="place_order">
                                    <div class="row">
                                        <div class="green-yellow">
                                            <hr>
                                            <h2>Artwork</h2>
                                            Please select one of the options:
                                        </div>
                                        <div>
                                            @if(isset($artwork))
                                                @foreach($artwork as $artitem)
                                                    <div class="col-md-6">
                                                        <?php
                                                        $type_id = '';
                                                        if($artitem->field_type == 'description'){ $type_id = "btn_req";}
                                                        if($artitem->field_type == 'file'){ $type_id = "btn_upload";}
                                                        ?>
                                                        <label class="radio-inline green-yellow size-13" id="{{ $type_id }}" >
                                                            {!! Form::radio('art_work_id',$artitem->id,'',['id'=>$artitem->slug]) !!}
                                                            {{ $artitem->title }}
                                                            @if($artitem->field_type == 'description')
                                                                <div id="txt_req">
                                                                    {!! Form::textarea('description', Input::old('note'),['class' => 'form-control text-left','rows'=>'10','placeholder'=>'CHANGES REQ UIRED DETAILS ONLY']) !!}
                                                                </div>
                                                            @elseif($artitem->field_type == 'file')
                                                                <div id="file_upload">
                                                                    {!! Form::file('file','',['class'=>'form-control']) !!}
                                                                </div>
                                                            @endif
                                                        </label><br><br>
                                                    </div>
                                                @endforeach
                                            @endif

                                            {{--<div class="col-md-12">
                                                {!! Form::submit('Order',['class'=>'btn btn-green pull-right']) !!}
                                                <button class="btn btn-green pull-right" type="button" id="order">Order <span class="glyphicon glyphicon-chevron-right"></span></button>
                                            </div>--}}
                                        </div>
                                    </div>
                                </div>
                                {{--Artwork Form End--}}

                                <div class="col-sm-12" style="height: 30px;"></div>

                                <div class="col-md-12">
                                    {{--{!! Form::submit('GET PRICE',['id'=>'','class'=>'btn btn-primary btn-green']) !!}--}}
                                    <button type="button" class="btn btn-green" name="getprice" value="getprice" id="getprice">GET PRICE</button>
                                    <h3 class="green-yellow" id="total"></h3>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <h3 class="green-yellow">Description</h3>
                        <p class="green-yellow size-14">
                            {{ $data['description'] }}
                        </p>
                        <div class="pull-left">
                            <a href="{{ route('marketing-material-printing') }}" class="btn btn-green " id="">Continue Shopping </a>
                            <a href="#" class="btn btn-green " id="">Checkout <span class="glyphicon glyphicon-check"></span></a>
                        </div>
                        <div class="pull-right">
                            {{--<a href=" #place" class="btn btn-green " id="proceed">Proceed <span class="glyphicon glyphicon-chevron-down"></span></a> &nbsp; &nbsp;--}}
                            <button type="submit" class="btn btn-green " name="addtocart" value="addtocart" id="">Add To Cart <span class="glyphicon glyphicon-shopping-cart"></span></button>

                        </div>

                    </div>

                </div>
                {!! Form::close() !!}
            @endif
            
        </div>
    </div>
    <script>
        $('#getprice').click(function () {
            $.ajax({
                url: "{{ route('get-price') }}",
                data: $('#genForm').serialize(),
                method : 'post'
            }).success(function(data){
                $('.totalAmount').remove();
                $('#total').append('<span class="totalAmount">Total : $ '+data.total+'</span>');
                console.log(data.total);
            }).error(function(data){
                alert('Error Occurred');
            });
        });

    </script>


    @include('mktg::marketing_material.agency_stationary_materials._scripts')

@stop