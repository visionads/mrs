@extends('admin::layouts.master')

{{--<div style="background-image:url('{{ URL::asset("assets/user/img/chain.jpg")}}') ;height: 100%; width: 100%; ">--}}

@section('content')
    {{--        <link href="{{ URL::asset('assets/quote/css/style.css') }}">--}}



    {{--<div class="form-group col-sm-12 page-profile" id="order_image">--}}
    {{--<div class="profile-block" id="order_block">--}}
    {{--<div class="panel profile-photo" id="order_img_resize">--}}
    {{--<img src="{{ URL::to('/assets/img/avatar1.jpg') }}" alt="">--}}
    {{--@if(isset($user_image))--}}
    {{--<img src="{{ URL::to($user_image->thumbnail) }}">--}}
    {{--@else--}}
    {{--<img src="{{ URL::to('/assets/img/default.jpg') }}" width="100px" height="100px">--}}
    {{--@endif--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div id="order_user_name"><span>John Smith</span></div>--}}
    {{--</div>--}}
    @include('main::quote._style')


    <?php
    $photography_price=0;
    $signboard_price=0;
    $print_material_price=0;
    $local_media_price=0;
    ?>
    {{--For Photography Package--}}
    <?php $photography_package_str = ''; ?>
    @if(isset($data['quote']->photography_package_id) && $data['quote']->photography_package_id==1)
        @foreach($data['photography_packages'] as $photography_package)
            @if(isset($data['quote']->relQuotePhotography))
                @foreach($data['quote']->relQuotePhotography as $ppi)
                    @if($ppi->photography_package_id==$photography_package->id)
                        <?php
                        $photography_package_str .= $photography_package->title.',';
                        $photography_price+=$photography_package->price;
                        ?>
                    @endif
                @endforeach
            @endif
        @endforeach
    @endif
    {{--For Signboard Package--}}
    <?php $signboard_package_str = ''; ?>
    @if(isset($data['quote']->signboard_package_id) && $data['quote']->signboard_package_id==1)
        @foreach($data['signboard_packages'] as $signboard_package)
            @if(isset($data['quote']->relQuoteSignboard))
                 @foreach($data['quote']->relQuoteSignboard as $ppi)
                      @if($ppi->signboard_package_id==$signboard_package->id)
                           <?php $signboard_package_str .=$signboard_package->title.','  ?>
                            @foreach($signboard_package->relSignboardPackage as $relSignboardPackage)
                                 @if(isset($data['quote']->relQuoteSignboard))
                                      @foreach($data['quote']->relQuoteSignboard as $ppi)
                                           @if($ppi->signboard_size_id==$relSignboardPackage->id)
                                               <?php $signboard_price+=$relSignboardPackage->price; ?>
                                           @endif
                                      @endforeach
                                 @endif
                            @endforeach
                      @endif
                 @endforeach
            @endif
        @endforeach
    @endif
    {{--For Print Material--}}
    <?php $print_material_str = ''; ?>
    @if(isset($data['quote']->print_material_id) && $data['quote']->print_material_id==1)
        @foreach($data['print_materials'] as $print_material)
            @if(isset($data['quote']->relQuotePrintMaterial))
                @foreach($data['quote']->relQuotePrintMaterial as $ppi)
                    @if($ppi->print_material_id==$print_material->id)
                        <?php $print_material_str .= $print_material->title.',' ?>
                        @if(isset($data['quote']->relQuotePrintMaterial))
                            @foreach($data['quote']->relQuotePrintMaterial as $ppi)
                                @if($ppi->print_material_id==$print_material->id && $ppi->is_distributed==1)
                                @endif
                            @endforeach
                        @endif
                        @foreach($print_material->relPrintMaterial as $relPrintMaterial)@if(isset($data['quote']->relQuotePrintMaterial))
                            @foreach($data['quote']->relQuotePrintMaterial as $ppi)
                                @if($ppi->print_material_id==$print_material->id && $ppi->print_material_size_id==$relPrintMaterial->id)
                                     {{--{!! $relPrintMaterial->title.'<b style="color: orange"> $'.$relPrintMaterial->price.'</b>' !!}--}}
                                    <?php $print_material_price+=$relPrintMaterial->price; ?>
                                @endif
                            @endforeach
                    @endif
                @endforeach
            @endif
        @endforeach
    @endif
    @endforeach
    @endif
    {{--For Local Media--}}
    <?php $local_media_str = ''; ?>
    @if(isset($data['quote']->digital_media_id) && $data['quote']->digital_media_id==1)
        @foreach($data['local_medias'] as $local_media)
             @if(isset($data['quote']->relQuoteLocalMedia))
                  @foreach($data['quote']->relQuoteLocalMedia as $ppi)
                       @if($ppi->local_media_id==$local_media->id)
                           <?php $local_media_str .= $local_media->title.','; ?>
                       @endif
                  @endforeach
             @endif
             @foreach($local_media->relLocalMedia as $relLocalMedia)
                  @if(isset($data['quote']->relQuoteLocalMedia))
                       @foreach($data['quote']->relQuoteLocalMedia as $ppi)
                            @if($ppi->local_media_id==$local_media->id && $ppi->local_media_option_id==$relLocalMedia->id)
                                <?php $local_media_price+=$relLocalMedia->price; ?>
                            @endif
                       @endforeach
                  @endif
             @endforeach
        @endforeach
    @endif
    {{--For Total Price--}}













    <div class="col-sm-12 font-droid" id="quote-div">

        {{-- <div class="row">--}}
        <div class="col-sm-12">
            {{--<form role="form" method="post" class="">--}}
            <h2 style="color: #fff;text-align: center;">{{ $pageTitle }}</h2>
            <div class="row">
                <hr>
                <h3 class="instruction">Total Amount</h3>
                <style>
                    td{
                        padding-right: 50px;
                        text-align: right;
                    }
                    td,th { border:0px !important; border-bottom:1px solid #000 !important; }
                    th { font-weight: normal !important;}
                </style>
                <table class="table table-responsive white size-15" style="background:#303030 !important;">
                    <tr>
                        <th>Photography {{ ($photography_package_str!=='')? '( '.rtrim($photography_package_str,',').' )':'' }}</th>
                        <td>{{ ($photography_price!=0)?'$ '.number_format($photography_price,2):'$ 0.00' }}</td>
                    </tr>
                    <tr>

                        <th>Signboard {{ ($signboard_package_str!=='')? '( '.rtrim($signboard_package_str,',').' )':'' }}</th>
                        <td>{{ ($signboard_price!=0)?'$ '.number_format($signboard_price,2):'$ 0.00' }}</td>
                    </tr>
                    <tr>

                        <th>Print Material {{ ($print_material_str!=='')? '( '.rtrim($print_material_str,',').' )':'' }}</th>
                        <td>{{ ($print_material_price!=0)?'$ '.number_format($print_material_price,2):'$ 0.00' }}</td>
                    </tr>
                    <tr>
                        <th>Distribution of print material</th>
                        <td>$ 0.00</td>
                    </tr>
                    <tr>
                        <th>Local newsprint media advertising {{ ($local_media_str!=='')? '( '.rtrim($local_media_str,',').' )':'' }}</th>
                        <td>{{ ($local_media_price!=0)?'$ '.number_format($local_media_price,2):'$ 0.00' }}</td>
                    </tr>
                    <tr style="color: orange">
                        <th>Total</th>
                        <td><b>${{ number_format($local_media_price+$print_material_price+$signboard_price+$photography_price,2) }}</b></td>
                    </tr>
                </table>
            </div>
            <div class="quote-form">
                <fieldset><hr>
                    <div class="form-bottom">
                        <div class="validationError"></div>
                        <h3 class="instruction">Selected Solution Type</h3>
                        <div class="form-group solutions_type_id size-15" style="text-align:center !important;">
                            @foreach($data['solution_types'] as $solution_type)
                                <label>
                                    @if($data['quote']->solution_type_id==$solution_type->id)
                                        {{ $solution_type->title }}
                                    @endif
                                </label>
                            @endforeach
                        </div>
                        {{--<div class="center">
                            <button id="solutionTypeNextBtn" href="#quote-div" type="button" class="btn new_button">Next <span class="glyphicon glyphicon-chevron-right"></span></button>
                        </div>--}}
                    </div>
                </fieldset>
                <fieldset><hr>
                    <div class="form-bottom">
                        <h3 class="instruction">Property Details</h3>
                        <br>
                        <div class="row">

                            <div class="col-sm-offset-3 col-sm-6 size-13">
                                <b>Property Owner Name : </b>{{ $data['quote']->relPropertyDetail['owner_name'] }} <br>
                                <b>Property Address : </b>{{ $data['quote']->relPropertyDetail['address'] }} <br>
                                <b>Vendor Name : </b>{{ $data['quote']->relPropertyDetail['vendor_name'] }} <br>
                                <b>Vendor Email : </b>{{ $data['quote']->relPropertyDetail['vendor_email'] }} <br>
                                <b>Vendor Phone : </b>{{ $data['quote']->relPropertyDetail['vendor_phone'] }} <br>
                            </div>
                        </div>
                        {{--<button type="button" class="btn btn-previous pull-left new_button"><span class="glyphicon glyphicon-chevron-left"></span> Previous</button>
                        <button id="propertyDetailsNextBtn" type="button" class="btn pull-right new_button">Next <span class="glyphicon glyphicon-chevron-right"></span></button>--}}
                    </div>
                </fieldset>
                <fieldset><hr>
                    <div class="form-bottom">
                        <h3 class="instruction">Photography</h3>
                        <br>
                        <div class="validationError"></div>
                        @if(isset($data['quote']->photography_package_id) && $data['quote']->photography_package_id==1)
                            <div class="row size-15">
                                <?php $photography_package_str = ''; ?>
                                @foreach($data['photography_packages'] as $photography_package)
                                    @if(isset($data['quote']->relQuotePhotography))

                                        @foreach($data['quote']->relQuotePhotography as $ppi)

                                            @if($ppi->photography_package_id==$photography_package->id)
                                                <div class="col-sm-4">
                                                    <label class="text-center-label">
                                                        {!! $photography_package->title.' <b style="color: orange">$'.$photography_package->price.'</b>' !!}

                                                        <?php
                                                            $photography_package_str .= $photography_package->title.',';
                                                            $photography_price+=$photography_package->price;
                                                        ?>

                                                    </label>

                                                    <ul>
                                                        @foreach($photography_package->relPhotographyPackage as $relPhotographyPackage)
                                                            <li>{{ $relPhotographyPackage->items }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>

                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                                <input type="hidden" value="{{ rtrim($photography_package_str,',') }}" id="photography_package" >
                                <input type="hidden" value="{{ $photography_price }}" id="photography_price" >
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>NOTE</label>
                                        <p>{{ $data['quote']->photography_package_comments }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="text-center">Sorry, No photography package selected.</p>
                                </div>
                            </div>
                        @endif

                        {{--<button type="button" class="btn btn-previous pull-left new_button"><span class="glyphicon glyphicon-chevron-left"></span> Previous</button>
                        <button id="photographyNextBtn" type="button" class="btn pull-right new_button">Next <span class="glyphicon glyphicon-chevron-right"></span></button>--}}


                    </div>
                </fieldset>
                <fieldset><hr>
                    <div class="form-bottom">
                        <h3 class="instruction">Signboard</h3>
                        @if(isset($data['quote']->signboard_package_id) && $data['quote']->signboard_package_id==1)
                            <div class="row">
                                <h3 class="center size-16">FOR SPECS & FEATURES PLEASE CLICK ON THE LINK BELOW</h3>
                                <?php $signboard_package_str = ''; ?>
                                @foreach($data['signboard_packages'] as $signboard_package)

                                    @if(isset($data['quote']->relQuoteSignboard))
                                        @foreach($data['quote']->relQuoteSignboard as $ppi)
                                            @if($ppi->signboard_package_id==$signboard_package->id)
                                                <div class="col-sm-4">
                                                    <label class="">
                                                    <span class="text-center-label">
                                                        {{ $signboard_package->title }}</span>
                                                        <?php $signboard_package_str .=$signboard_package->title.','  ?>
                                                        <img width="100%" height="100" src="{{ asset($signboard_package->image_path) }}">
                                                    </label>
                                                    <div class="panel-body">
                                                        <div class="form-group">
                                                            @foreach($signboard_package->relSignboardPackage as $relSignboardPackage)
                                                                @if(isset($data['quote']->relQuoteSignboard))
                                                                    @foreach($data['quote']->relQuoteSignboard as $ppi)
                                                                        @if($ppi->signboard_size_id==$relSignboardPackage->id)
                                                                            {!! $relSignboardPackage->title.' <b style="color: orange"> $'.$relSignboardPackage->price.'</b>' !!}
                                                                            <?php $signboard_price+=$relSignboardPackage->price; ?>
                                                                        @endif
                                                                    @endforeach
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>

                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                                <input type="hidden" value="{{ rtrim($signboard_package_str,',') }}" id="signboard_package" >
                                <input type="hidden" value="{{ $signboard_price }}" id="signboard_price" >
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>NOTE</label>
                                        <p>{{ $data['quote']->signboard_package_comments }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="text-center">Sorry, No signboard package selected.</p>
                                </div>
                            </div>
                        @endif
                        {{--<button type="button" class="btn btn-previous pull-left new_button"> <span class="glyphicon glyphicon-chevron-left"></span> Previous</button>
                        <button id="signboardNextBtn" type="button" class="btn pull-right new_button">Next <span class="glyphicon glyphicon-chevron-right"></span></button>--}}


                    </div>
                </fieldset>
                <fieldset><hr>
                    <div class="form-bottom">
                        <h3 class="instruction">Print material</h3>                                            <div class="validationError"></div>

                        @if(isset($data['quote']->print_material_id) && $data['quote']->print_material_id==1)
                            <div class="row">
                                <p class="white size-13">All printed material will be 2side print and the orientation (landscape or portriat) of the material will depend on the artowk set up for your agency, please
                                    ensure that check it is the required orientation, For specific requirement for orientation, stock or other requirements please state in the “note” section.
                                </p>
                                <p class="white size-13">Also if you wish to have more then 1 printed material and wish to have dit distributed, please sepcify which print material will be used for distribution by
                                    selecting the distribution.</p>
                                <?php $print_material_str = ''; ?>
                                @foreach($data['print_materials'] as $print_material)
                                    @if(isset($data['quote']->relQuotePrintMaterial))
                                        @foreach($data['quote']->relQuotePrintMaterial as $ppi)
                                            @if($ppi->print_material_id==$print_material->id)
                                                <div class="col-sm-4">
                                                    <label>
                                                        <?php $print_material_str .= $print_material->title.',' ?>
                                                        {{ $print_material->title }}
                                                        <label style="margin-left: 10%;display: block;height: 30px">
                                                            @if(isset($data['quote']->relQuotePrintMaterial))
                                                                @foreach($data['quote']->relQuotePrintMaterial as $ppi)
                                                                    @if($ppi->print_material_id==$print_material->id && $ppi->is_distributed==1)
                                                                        USE FOR DISTRIBUTION
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </label>
                                                        <img width="100%" height="150" src="{{ asset($print_material->image_path) }}">
                                                        <div class="panel-body">
                                                            @foreach($print_material->relPrintMaterial as $relPrintMaterial)@if(isset($data['quote']->relQuotePrintMaterial))
                                                                @foreach($data['quote']->relQuotePrintMaterial as $ppi)
                                                                    @if($ppi->print_material_id==$print_material->id && $ppi->print_material_size_id==$relPrintMaterial->id)
                                                                        {!! $relPrintMaterial->title.'<b style="color: orange"> $'.$relPrintMaterial->price.'</b>' !!}
                                                                        <?php $print_material_price+=$relPrintMaterial->price; ?>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                            @endforeach
                                                        </div>
                                                    </label>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                                <input type="hidden" value="{{ rtrim($print_material_str,',') }}" id="print_material_str" >
                                <input type="hidden" value="{{ $print_material_price }}" id="print_material_price" >
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>NOTE</label>
                                        <p>{{ $data['quote']->print_material_comments }}</p>
                                    </div>
                                </div>
                            </div>

                        @else
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="text-center">Sorry, No print material selected.</p>
                                </div>
                            </div>
                        @endif
                        {{--<button type="button" class="btn btn-previous pull-left new_button"><span class="glyphicon glyphicon-chevron-left"></span> Previous</button>
                        <button id="printMaterialNextBtn" type="button" class="btn pull-right new_button">Next <span class="glyphicon glyphicon-chevron-right"></span></button>--}}

                    </div>
                </fieldset>
                <fieldset><hr>
                    <div class="form-bottom">
                        <h3 class="instruction">Distribution of print material</h3>
                        <div class="validationError"></div>
                        @if(isset($data['quote']->print_material_distribution_id) && $data['quote']->print_material_distribution_id==1)

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('quantity','Total print material (Quantity)') !!}
                                        <h2>{{ $data['quote']->relPrintMaterialDistribution['quantity'] }}</h2>
                                    </div>
                                    <div class="form-group">
                                        <label>NOTE</label>
                                        <p>{{ $data['quote']->relPrintMaterialDistribution['note'] }}</p>
                                    </div>
                                </div>
                            </div>

                        @else
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="text-center white">Sorry, No print material distribution selected.</p>
                                </div>
                            </div>
                        @endif
                        {{--<button type="button" class="btn btn-previous pull-left new_button"><span class="glyphicon glyphicon-chevron-left"></span> Previous</button>
                        <button id="distributedPrintMaterialNextBtn" type="button" class="btn pull-right new_button">Next <span class="glyphicon glyphicon-chevron-right"></span></button>--}}


                    </div>
                </fieldset>
                <fieldset><hr>
                    <div class="form-bottom">
                        <h3 class="instruction">Digital media</h3>
                        <div class="validationError"></div>
                        @if(isset($data['quote']->digital_media_id) && $data['quote']->digital_media_id==1)

                            <div class="row">
                                <div class="optionalContentDiv  @if($data['quote']->digital_media_id == null) optional-content-div @endif">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            @foreach($data['digital_medias'] as $digital_media)
                                                @if(isset($data['quote']->relQuoteDigitalMedia))
                                                    @foreach($data['quote']->relQuoteDigitalMedia as $ppi)
                                                        @if($ppi->digital_media_id==$digital_media->id)
                                                            {{ $digital_media->title }} <br>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach

                                        </div>
                                        <div class="form-group">
                                            <label>NOTE</label>
                                            <p>{{ $data['quote']->digital_media_note }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        @else
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="text-center">Sorry, No digital Media selected.</p>
                                </div>
                            </div>
                        @endif
                        {{--<button type="button" class="btn btn-previous pull-left new_button"><span class="glyphicon glyphicon-chevron-left"></span> Previous</button>
                        <button id="digitalMediaNextBtn" type="button" class="btn pull-right new_button">Next <span class="glyphicon glyphicon-chevron-right"></span></button>--}}


                    </div>
                </fieldset>
                <fieldset><hr>
                    <div class="form-bottom">
                        <h3 class="instruction">Local newsprint media advertising</h3>
                        @if(isset($data['quote']->digital_media_id) && $data['quote']->digital_media_id==1)
                            <div class="row">
                                <div class="optionalContentDiv  @if($data['quote']->local_media_id == null) optional-content-div @endif">
                                    <?php $local_media_str = ''; ?>
                                    @foreach($data['local_medias'] as $local_media)
                                        <div class="col-sm-4">
                                            <div class="form-group size-17">
                                                @if(isset($data['quote']->relQuoteLocalMedia))
                                                    @foreach($data['quote']->relQuoteLocalMedia as $ppi)
                                                        @if($ppi->local_media_id==$local_media->id)
                                                            <?php $local_media_str .= $local_media->title.','; ?>
                                                            {{ $local_media->title }}
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 size-15">
                                                    @foreach($local_media->relLocalMedia as $relLocalMedia)
                                                        @if(isset($data['quote']->relQuoteLocalMedia))
                                                            @foreach($data['quote']->relQuoteLocalMedia as $ppi)
                                                                @if($ppi->local_media_id==$local_media->id && $ppi->local_media_option_id==$relLocalMedia->id)
                                                                    {!! $relLocalMedia->title.' <b style="color: orange">$'.$relLocalMedia->price.'</b>' !!}<br>
                                                                    <?php $local_media_price+=$relLocalMedia->price; ?>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <input type="hidden" value="{{ rtrim($local_media_str,',') }}" id="local_media_str" >
                                    <input type="hidden" value="{{ $local_media_price }}" id="local_media_price" >
                                    <div class="col-sm-12">
                                        <div>
                                            <h4>NOTE</h4>
                                            <p>{{ $data['quote']->local_media_note }}</p>
                                            {{--<label>NOTE</label>
                                            <textarea type="text" readonly name="local_media_note" placeholder="Local Media Note" class="form-control" id="local_media_note">{{ $data['quote']->local_media_note }}</textarea>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>


                        @else
                            <div class="row">
                                <div class="col-sm-12">
                                    <p class="text-center white">Sorry, No local Media selected.</p>
                                </div>
                            </div>
                        @endif
                        {{--<div class="row">
                            <button type="button" class="btn btn-previous pull-left new_button"><span class="glyphicon glyphicon-chevron-left"></span> Previous</button>
                        </div>--}}
                        {{--<div class="row">
                            <div class="col-sm-5 col-sm-offset-7">

                                {!! Form::input('button','save','Save',['class'=>'btn btn-primary btn-bg']) !!}
                                {!! Form::input('button','quote','Quote',['class'=>'btn btn-bg btn-info ']) !!}
                            </div>
                        </div>--}}

                        <div class="row">
                            <div class="col-sm-5 col-sm-offset-7">
                                <a href="{{ URL::previous() }}" class="btn new_button proceedBtn">Back</a>
                            </div>
                        </div>

                    </div>
                </fieldset>
            </div>

        </div>
        {{--</div>--}}
    </div>
    <div>
    </div>
    {{--<script type="text/javascript" src="{{ URL::asset('assets/quote/js/jquery.backstretch.min.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ URL::asset('assets/quote/js/scripts.js') }}"></script>--}}
    @include('main::quote._script')
    {{--<script>
        $(function(){


           var print_material_price = $('#print_material_price').val();
            $('#printmaterialPrice').append('$' +print_material_price);
           var print_material_str = $('#print_material_str').val();
            $('#printMaterialStr').append(print_material_str);

           var local_media_price = $('#local_media_price').val();
            $('#localmediaPrice').append('$' +local_media_price);
           var local_media_str = $('#local_media_str').val();
            $('#localMediaStr').append(local_media_str);

           var total_price =  parseInt(photography_price) + parseInt(signboard_price) + parseInt(print_material_price) + parseInt(local_media_price);
            $('#totalPrice').append('$' +total_price);
            //alert(parseInt(photography_price)+parseInt(signboard_price));
        });
    </script>--}}
@stop
