@extends('admin::layouts.master')

@section('content')


    <div id="container" class="container pages new_order font-droid">

        <div class="col-md-12">

            @if(isset($data))
                @foreach($data as $row)

            <div class="row">
                <div class="col-md-4">
                    <div class="image-box">
                        <img src="{{ url($row->relMktgMenuItemImage[0]['image']) }}" class="img-responsive image-center">
                    </div>
                </div>
                <div class="col-md-8 green-yellow">
                    <h3 class="green-yellow">{{ $pageTitle }}</h3>
                    {{--{!! Form::open(['method'=>'GET','route'=>'solution-type-search','class'=>'form-inline']) !!}--}}
                    {{--{!! Form::open(['method'=>'GET','class'=>'form-horizontal']) !!}
                    @include('mktg::marketing_material.agency_stationary_materials.letterhead_form')
                    {!! Form::close() !!}--}}


                    <div class="row">

                        <div class="col-md-12">

                            {{--option--}}
                            @if(isset($row->relMktgItemOption))
                                @foreach($row->relMktgItemOption as $row_data)

                                    @if($row_data->type=='option')
                                    <div class="col-md-6">
                                        <div class="checkbox">
                                            <label class="green-yellow"><input name="a4size" type="checkbox" checked onclick="return false" > {{$row_data->title}}</label><br>
                                        </div>
                                    </div>
                                    @endif

                                @endforeach
                            @endif

                            {{--value--}}
                            @if(isset($row->relMktgItemOption))
                                @foreach($row->relMktgItemOption as $row_data)

                                    @if($row_data->type=='value')


                                    <div class="col-sm-12" style="height: 30px;"></div>
                                    <div class="col-sm-6">
                                        <div style="border-left: 3px dashed #404040;">
                                            <div class="form-group">
                                                {!! Form::label('qty', $row_data->title, ['class'=>'control-label col-sm-4 green-yellow']) !!}
                                                <div class="col-sm-8">
                                                    {!! Form::select('qty', $value,Input::old('qty'),['class' => 'form-control deeppink size-15','id'=>'', 'onchange'=>'myFunction()','required']) !!}
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
                                                        {!! Form::radio('check',$artitem->price,'',['id'=>$artitem->slug]) !!}
                                                        {{ $artitem->title }}
                                                        @if($artitem->field_type == 'description')
                                                            <div id="txt_req">
                                                                {!! Form::textarea('note', Input::old('note'),['class' => 'form-control text-left','rows'=>'10','placeholder'=>'CHANGES REQ UIRED DETAILS ONLY']) !!}
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

                                        <div class="col-md-12">
                                            {{--{!! Form::submit('Order',['class'=>'btn btn-green pull-right']) !!}--}}
                                            {{--<button class="btn btn-green pull-right" type="button" id="order">Order <span class="glyphicon glyphicon-chevron-right"></span></button>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--Artwork Form End--}}

                            <div class="col-sm-12" style="height: 30px;"></div>

                            <div class="col-md-12">
                                {!! Form::submit('GET PRICE',['id'=>'','class'=>'btn btn-primary btn-green']) !!}
                                <h3 class="green-yellow" id="total">Total : $00</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <h3 class="green-yellow">Description</h3>
                    <p class="green-yellow size-14">
                        {{ $row->description }}
                    </p>
                    <div class="pull-left">
                        <a href="{{ route('marketing-material-printing') }}" class="btn btn-green " id="">Continue Shopping </a>
                        <a href="#" class="btn btn-green " id="">Checkout </a>
                    </div>
                    <div class="pull-right">
                        {{--<a href=" #place" class="btn btn-green " id="proceed">Proceed <span class="glyphicon glyphicon-chevron-down"></span></a> &nbsp; &nbsp;--}}
                        <a href="#" class="btn btn-green " id="">Add To Cart <span class="glyphicon glyphicon-shopping-cart"></span></a>
                    </div>

                </div>
            </div>

                @endforeach
            @endif

        </div>

    </div>

    @include('mktg::marketing_material.agency_stationary_materials._scripts')

@stop