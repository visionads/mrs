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
                        background:linear-gradient(0deg,#000000,#202020) !important;
                    }
                    td,th { border:0px !important; border-bottom:1px solid #000 !important; }
                    th { font-weight: normal !important; background:linear-gradient(0deg,#000000,#202000) !important;}


                </style>
                {{--Checking for Complete Package--}}
                @if(isset($data['quote']->relQuotePackage))
                    <table class="table table-responsive white size-18">
                        <tr>
                            <th>Package name : <span style="color: gold;">{{ $data['quote']->relQuotePackage['title'] }}</span> </th>
                            <td>{{ '$ '.number_format($data['quote']->relQuotePackage['price'],2) }}</td>
                        </tr>
                        <tr style="color: orange">
                            <th>Total</th>
                            <td><b>${{ number_format($data['quote']->relQuotePackage['price'],2) }}</b></td>
                        </tr>
                    </table>
                @else
                {{--If complete package is not choosen by the agent--}}
                    <table class="table table-responsive white size-13">
                        <tr>
                            <th>Photography {{ ($photography_package_str!=='')? '[ '.rtrim($photography_package_str,',').' ]':'' }}</th>
                            <td>{{ ($photography_price!=0)?'$ '.number_format($photography_price,2):'$ 0.00' }}</td>
                        </tr>
                        <tr>

                            <th>Signboard {{ ($signboard_package_str!=='')? '[ '.rtrim($signboard_package_str,',').' ]':'' }}</th>
                            <td>{{ ($signboard_price!=0)?'$ '.number_format($signboard_price,2):'$ 0.00' }}</td>
                        </tr>
                        <tr>

                            <th>Print Material {{ ($print_material_str!=='')? '[ '.rtrim($print_material_str,',').' ]':'' }}</th>
                            <td>{{ ($print_material_price!=0)?'$ '.number_format($print_material_price,2):'$ 0.00' }}</td>
                        </tr>
                        <tr>
                            <th>Distribution of print material</th>
                            <td>$ 0.00</td>
                        </tr>
                        <tr>
                            <th>Digital Media</th>
                            <td>$ 0.00</td>
                        </tr>
                        <tr>
                            <th>Local newsprint media advertising {{ ($local_media_str!=='')? '[ '.rtrim($local_media_str,',').' ]':'' }}</th>
                            <td>{{ ($local_media_price!=0)?'$ '.number_format($local_media_price,2):'$ 0.00' }}</td>
                        </tr>
                        <tr style="color: orange">
                            <th>Total</th>
                            <td><b>${{ number_format($local_media_price+$print_material_price+$signboard_price+$photography_price,2) }}</b></td>
                        </tr>
                    </table>
                @endif
            </div>
            <div class="quote-form">
                <fieldset><hr>
                    <div class="form-bottom">
                        <div class="validationError"></div>
                        <h3 class="instruction">Selected Solution Type</h3>
                        <div class="form-group solutions_type_id" style="text-align:center !important;">
                            @foreach($data['solution_types'] as $solution_type)
                                <p class="center white size-13">
                                    @if($data['quote']->solution_type_id==$solution_type->id)
                                        <span class="glyphicon glyphicon-check"></span> {{ $solution_type->title }}
                                    @endif
                                </p>
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

                            <style>
                                .tbl { background:none; color:#fff;}
                                .tbl th { text-align:right; width: 48%; background:none !important;}
                                .tbl td.tdata { text-align: left; width: 48%; background:none !important;}
                                .tbl td { text-align: center; background: none !important;}
                                ul.genul { list-style:inside; padding:0px;}
                                ul.genul li { font-size:13px;}
                                .note { background:none; }
                                .note p { color:#fff; font-size:13px; font-style: italic;}
                                .note label { font-size:15px; font-weight: normal !important; }
                                .h-space { display: block; height: 30px;}
                                .h-space-10 { display: block; height: 10px;}
                                .text-normal { font-weight: normal !important;}
                                .circle { width: 50px; height: 50px; display: inline-block; border-radius:30px; font-size: 28px; background:#202020; }
                            </style>
                            {{--<div class="col-sm-offset-3 col-sm-6 size-13">--}}
                            <div class=" col-sm-12 size-13 center">
                                <table class="table tbl">
                                    <tr><th>Property Owner Name</th><td> : </td><td class="tdata">{{ $data['quote']->relPropertyDetail['owner_name'] }}</td></tr>
                                    <tr><th>Property Address</th><td> : </td><td class="tdata">{{ $data['quote']->relPropertyDetail['address'] }} </td></tr>
                                    <tr><th>Vendor Name</th><td> : </td><td class="tdata">{{ $data['quote']->relPropertyDetail['vendor_name'] }} </td></tr>
                                    <tr><th>Vendor Email</th><td> : </td><td class="tdata">{{ $data['quote']->relPropertyDetail['vendor_email'] }} </td></tr>
                                    <tr><th>Vendor Phone</th><td> : </td><td class="tdata">{{ $data['quote']->relPropertyDetail['vendor_phone'] }}</td></tr>
                                </table>
                            </div>
                        </div>

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
                                                    <label class="text-left-label size-15 text-normal">
                                                        {!! $photography_package->title.' <b style="color: orange">$'.$photography_package->price.'</b>' !!}

                                                        <?php
                                                            $photography_package_str .= $photography_package->title.',';
                                                            $photography_price+=$photography_package->price;
                                                        ?>

                                                    </label>

                                                    <ul class="genul">
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
                                <div class="col-sm-12 note">
                                    @if($data['quote']->photography_package_comments !=='')
                                        <label>NOTE</label>
                                        <p>{{ $data['quote']->photography_package_comments }}</p>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-sm-12 note">
                                    <p class="center">Sorry, No photography package selected.</p>
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
                                                    <label class="text-left-label size-13">
                                                        <span class="size-17 text-normal">{{ $signboard_package->title }}</span><div class="h-space-10"></div>
                                                        <?php $signboard_package_str .=$signboard_package->title.','  ?>
                                                        <img width="100%" height="100" src="{{ asset($signboard_package->image_path) }}">
                                                    </label>
                                                    <div class="">
                                                        <div class="white size-15" style="border:0px solid #909090;">
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
                            </div>
                            <div class="row">
                                <div class="col-sm-12 note">
                                    @if($data['quote']->signboard_package_comments !== '')
                                        <label>NOTE</label>
                                        <p>{{ $data['quote']->signboard_package_comments }}</p>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-sm-12 note">
                                    <p class="center">Sorry, No signboard package selected.</p>
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
                                <div class="col-md-12">
                                <p class="white size-13">All printed material will be 2side print and the orientation (landscape or portriat) of the material will depend on the artowk set up for your agency, please
                                    ensure that check it is the required orientation, For specific requirement for orientation, stock or other requirements please state in the “note” section.
                                </p>
                                <p class="white size-13">Also if you wish to have more then 1 printed material and wish to have dit distributed, please sepcify which print material will be used for distribution by
                                    selecting the distribution.</p>
                                </div>
                                <?php $print_material_str = ''; ?>
                                @foreach($data['print_materials'] as $print_material)
                                    @if(isset($data['quote']->relQuotePrintMaterial))
                                        @foreach($data['quote']->relQuotePrintMaterial as $ppi)
                                            @if($ppi->print_material_id==$print_material->id)
                                                <div class="col-sm-4">
                                                    <label>
                                                        <?php $print_material_str .= $print_material->title.',' ?>
                                                        <span class="size-17 text-normal">{{ $print_material->title }}</span>
                                                        <label style="margin-left: 5%;display: block; height: 30px;" class="size-14">
                                                            @if(isset($data['quote']->relQuotePrintMaterial))
                                                                @foreach($data['quote']->relQuotePrintMaterial as $ppi)
                                                                    @if($ppi->print_material_id==$print_material->id && $ppi->is_distributed==1)
                                                                        <span class="glyphicon glyphicon-check"></span> USE FOR DISTRIBUTION
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </label>
                                                        <img width="100%" height="150" src="{{ asset($print_material->image_path) }}">
                                                        <div class="size-15 text-normal">
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

                            </div>
                            <div class="row">
                                <div class="col-sm-12 note">
                                    @if($data['quote']->print_material_comments !== '')
                                        <label>NOTE</label>
                                        <p>{{ $data['quote']->print_material_comments }}</p>
                                    @endif
                                </div>
                            </div>

                        @else
                            <div class="row">
                                <div class="col-sm-12 note">
                                    <p class="center">Sorry, No print material selected.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </fieldset>
                <fieldset><hr>
                    <div class="form-bottom">
                        <h3 class="instruction">Distribution of print material</h3>
                        <div class="validationError"></div>
                        @if(isset($data['quote']->print_material_distribution_id) /*&& $data['quote']->print_material_distribution_id==1*/)

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class=" center">
                                        <div class="size-17" style="padding-bottom:20px;">Total distribution of print material (Quantity)</div>
                                        <span class="circle" style="color:orange">
                                            {{ $data['quote']->relPrintMaterialDistribution['quantity'] }}
                                        </span>
                                    </div >
                                    <div class=" note">
                                        @if($data['quote']->relPrintMaterialDistribution['note'] !=='')
                                            <label>NOTE</label>
                                            <p>{{ $data['quote']->relPrintMaterialDistribution['note'] }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        @else
                            <div class="row">
                                <div class="col-sm-12 note">
                                    <p class="center white">Sorry, No print material distribution selected.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </fieldset>
                <fieldset><hr>
                    <div class="form-bottom">
                        <h3 class="instruction">Digital media</h3>
                        <div class="validationError"></div>
                        @if(isset($data['quote']->digital_media_id) && $data['quote']->digital_media_id==1)

                            <div class="size-17">Most popular websites</div>
                            <div class="row">
                                <div class="optionalContentDiv  @if($data['quote']->digital_media_id == null) optional-content-div @endif">
                                    <div class="col-sm-12">
                                        <div class="form-group size-13">
                                            @foreach($data['digital_medias'] as $digital_media)
                                                @if(isset($data['quote']->relQuoteDigitalMedia))
                                                    @foreach($data['quote']->relQuoteDigitalMedia as $ppi)
                                                        @if($ppi->digital_media_id==$digital_media->id)
                                                            <div class="col-md-4"><span class="glyphicon glyphicon-check"></span> {{ $digital_media->title }}</div>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="h-space-10"></div>
                            <div class="note">
                                @if($data['quote']->digital_media_note!=='')
                                    <label>NOTE</label>
                                    <p>{{ $data['quote']->digital_media_note }}</p>
                                @endif
                            </div>


                        @else
                            <div class="row">
                                <div class="col-sm-12 note">
                                    <p class="center">Sorry, No digital Media selected.</p>
                                </div>
                            </div>
                        @endif
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
                                                <div class="col-sm-12 size-14">
                                                    @foreach($local_media->relLocalMedia as $relLocalMedia)
                                                        @if(isset($data['quote']->relQuoteLocalMedia))
                                                            @foreach($data['quote']->relQuoteLocalMedia as $ppi)
                                                                @if($ppi->local_media_id==$local_media->id && $ppi->local_media_option_id==$relLocalMedia->id)
                                                                    <span class="glyphicon glyphicon-check"></span> {!! $relLocalMedia->title.' <b style="color: orange">$'.$relLocalMedia->price.'</b>' !!}<br>
                                                                    <?php $local_media_price+=$relLocalMedia->price; ?>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="col-sm-12">
                                        <div class="h-space clearfix"></div>
                                        <div class="note">
                                            @if($data['quote']->local_media_note !== '')
                                                <label>NOTE</label>
                                                <p>{{ $data['quote']->local_media_note }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>


                        @else
                            <div class="row">
                                <div class="col-sm-12 note">
                                    <p class="center white">Sorry, No local Media selected.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </fieldset>



                <fieldset><hr>
                    <div class="form-bottom">
                        <h3 class="instruction">Quote Property Access Information</h3>
                        <br>
                        @if(count($data['quote_property'])>0)
                        <div class="row">

                            <style>
                                .tbl { background:none; color:#fff;}
                                .tbl th { text-align:right; width: 48%; background:none !important;}
                                .tbl td.tdata { text-align: left; width: 48%; background:none !important;}
                                .tbl td { text-align: center; background: none !important;}
                                ul.genul { list-style:inside; padding:0px;}
                                ul.genul li { font-size:13px;}
                                .note { background:none; }
                                .note p { color:#fff; font-size:13px; font-style: italic;}
                                .note label { font-size:15px; font-weight: normal !important; }
                                .h-space { display: block; height: 30px;}
                                .h-space-10 { display: block; height: 10px;}
                                .text-normal { font-weight: normal !important;}
                                .circle { width: 50px; height: 50px; display: inline-block; border-radius:30px; font-size: 28px; background:#202020; }
                            </style>
                            {{--<div class="col-sm-offset-3 col-sm-6 size-13">--}}
                            <div class=" col-sm-12 size-13 center">
                                <table class="table tbl">
                                    <tr><th>Prefered Date</th><td> : </td><td class="tdata">{{ isset($data['quote_property'][0]->prefered_date)?$data['quote_property'][0]->prefered_date : '' }}</td></tr>
                                    <tr><th>Property Access Option :</th><td> : </td>
                                        <td class="tdata">
                                            <label>
                                                <input type="radio" name="property_access_options" value="tennant" @if($data['quote_property'][0]->property_access_options=='tennant'){{'checked'}}@endif> &nbsp; Tennant
                                            </label>
                                            <label>
                                                <input type="radio" name="property_access_options" value="vendor" @if($data['quote_property'][0]->property_access_options=='vendor'){{'checked'}}@endif> &nbsp; Vendor
                                            </label>
                                            <label>
                                                <input type="radio" name="property_access_options" value="agent" @if($data['quote_property'][0]->property_access_options=='agent'){{'checked'}}@endif> &nbsp; Agent/ Agency
                                            </label>
                                            <label>
                                                <input type="radio" name="property_access_options" value="other" @if($data['quote_property'][0]->property_access_options=='other'){{'checked'}}@endif> &nbsp; Other, pick up keys from
                                            </label>
                                        </td></tr>
                                    <tr><th>Contact Name</th><td> : </td><td class="tdata">{{ isset($data['quote_property'][0]->contact_name)?$data['quote_property'][0]->contact_name:'' }} </td></tr>
                                    <tr><th>Contact Number</th><td> : </td><td class="tdata">{{ isset($data['quote_property'][0]->contact_number)?$data['quote_property'][0]->contact_number:'' }} </td></tr>
                                    <tr><th>Contact Alternate Number</th><td> : </td><td class="tdata">{{ isset($data['quote_property'][0]->contact_alternate_number)?$data['quote_property'][0]->contact_alternate_number:'' }}</td></tr>
                                    <tr><th>Contact Email</th><td> : </td><td class="tdata">{{ isset($data['quote_property'][0]->contact_email)?$data['quote_property'][0]->contact_email:'' }}</td></tr>
                                    <tr><th>Property Note</th><td> : </td><td class="tdata">{{ isset($data['quote_property'][0]->property_note)?$data['quote_property'][0]->property_note:'' }}</td></tr>
                                </table>
                            </div>

                            <div class="col-sm-12 center">
                                @if(count($data['quote_image'])>0)
                                    @foreach($data['quote_image'] as $quote_images)
                                    <label>
                                        <img width="100%" height="150" src="{{ asset($quote_images->image) }}">
                                    </label>
                                    @endforeach
                                @endif
                            </div>

                        </div>
                        @else
                            <div class="row">
                                <div class="col-sm-12 note">
                                    <p class="center">Sorry, No print material selected.</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-sm-12 center">
                            <div class="h-space"></div>
                            <a href="{{ URL::previous() }}" class="btn new_button proceedBtn"><span class="glyphicon glyphicon-chevron-left"></span> Back</a>
                        </div>
                    </div>
                </fieldset>

            </div>

        </div>
    </div>
    <div>
    </div>
    @include('main::quote._script')

@stop
