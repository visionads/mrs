@extends('admin::layouts.master')

@section('content')


    <div id="container" class="container pages new_order font-droid">

        <div class="col-md-12">
            @if(isset($data))
                {!! Form::open(['route'=>['add-to-cart',$data['id']],'id'=>'genForm','files'=>true]) !!}

                <div class="row">
                    <div class="col-md-4">
                        <div class="image-box">
                            <img src="{{ url($data['rel_mktg_menu_item_image'][0]['image']) }}" class="img-responsive image-center" width="100%" style="height:130px;">
                        </div>
                    </div>
                    <div class="col-md-8 green-yellow">
                        <h3 class="green-yellow">{{ $pageTitle }}</h3>
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
                                            <div class="col-md-6">
                                                <div class="checkbox">
                                                    <label class="green-yellow">
                                                        <input name="option[{!! $item_opt['rel_mktg_item_value'][0]['id'] !!}]" value="{!! $item_opt['rel_mktg_item_value'][0]['price'] !!}" type="hidden">
                                                        <i class="{{ $item_opt['icon'] }}"></i> {{$item_opt['title']}}
                                                        <?php $option += $item_opt['rel_mktg_item_value'][0]['price'] ?>
                                                    </label><br>
                                                </div>
                                            </div>
                                        @endif

                                    @endforeach
                                @endif

                                {{--value--}}
                                @if(isset($data['rel_mktg_item_option']))
                                    @foreach($data['rel_mktg_item_option'] as $item_opt)
                                        @if($item_opt['type']=='value')
                                            <div class="col-sm-12" style="height: 30px;"></div>
                                            <div class="col-sm-6">
                                                <div style="border-left: 3px dashed #404040;">
                                                    <div class="form-group">
                                                        {!! Form::label('qty', $item_opt['title'], ['class'=>'control-label col-sm-4 green-yellow']) !!}
                                                        <div class="col-sm-8">
                                                            <?php $i=0; ?>
                                                            <select name="option[{{ $item_opt['rel_mktg_item_value'][$i]['id'] }}]" class='form-control deeppink size-15' onchange="myFunction(this.value)">
                                                                @if(isset($item_opt['rel_mktg_item_value']))
                                                                    @foreach($item_opt['rel_mktg_item_value'] as $item_val)
                                                                        <option value="{{ $item_val['price'] }}" >{{ $item_val['title'] }}</option>
                                                                        <?php $i++;?>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            <?php ?>
                                                            {{--{!! Form::select('qty'.$i, [$value[$item_val['id']]],Input::old('qty'),['class' => 'form-control deeppink size-15','id'=>'', 'onchange'=>'myFunction()','required']) !!}--}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        @endif
                                    @endforeach
                                @endif

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
                                    <button type="submit" class="btn btn-green" name="getprice" value="getprice" id="getprice">GET PRICE </button>
                                    <button type="button" id="get" onclick="getData()">Get</button>
                                    <h3 class="green-yellow" id="total">Total : $00</h3>
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
                            {{--<a href="#" class="btn btn-green " id="">Checkout </a>--}}
                        </div>
                        <div class="pull-right">
                            <a href=" #place" class="btn btn-green " id="proceed">Proceed <span class="glyphicon glyphicon-chevron-down"></span></a> &nbsp; &nbsp;
                            <button type="submit" class="btn btn-green " name="addtocart" value="addtocart" id="">Add To Cart <span class="glyphicon glyphicon-shopping-cart"></span></button>

                        </div>

                    </div>

                </div>
                {!! Form::close() !!}
            @endif
            
        </div>
    </div>
    <div class="white">
        <h1>Totla calculation:</h1>
        <input type="hidden" value="<?php echo $option; ?>" id="option">
        Option = <?php echo $option; ?><br>
        Value = <?php echo $value; ?>
    </div>
    <script>
        function getData(){

            alert($('#genForm').serialize());
            //var object = formService.getObjectFormFields("#genForm");
            alert(object);
            //var data = {};
            //alert($("#genForm").serializeArray().map(function(x){data[x.name] = x.value;}));
            //$params = array();
           // parse_str($_GET, $params);


        }
        function myFunction(value) {
            var option = document.getElementById("option").value;
            //var x = document.getElementById("qty").value;
            //var y = document.getElementById("stock").value;
            //var a = document.getElementById("stock").value;
            //var b = document.getElementById("stock").value;
            //alert(value);
            var x = 0;
            x += value;
            var ttl = 0;
            alert(x+option);
            ttl = parseInt(x) + parseInt(y);
            document.getElementById("total").innerHTML = "Total : $" + ttl;
        }
    </script>


    @include('mktg::marketing_material.agency_stationary_materials._scripts')

@stop