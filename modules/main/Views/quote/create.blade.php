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

<div class="col-sm-12 font-droid" id="quote-div" xmlns="http://www.w3.org/1999/html">

           {{-- <div class="row">--}}
                <div class="col-sm-12">
                    {!! Form::open(['route'=>'new-quote-store']) !!}
                    {{--<form role="form" method="post" class="">--}}
                        <h2 style="color: #fff;text-align: center;">Add New Quote</h2>
                        <div class="quote-form">
                            <fieldset><hr>
                                <div class="form-bottom">
                                    <div class="validationError"></div>
                                    <h3 class="instruction">Please select one of the following to begin <span style="color: white;">(Required)</span></h3>
                                    <div class="form-group solutions_type_id size-15" style="text-align:center !important;">
                                        @foreach($data['solution_types'] as $solution_type)
                                        <label>
                                            {{ $solution_type->title }}<br>
                                            <input required type="radio" name="solution_type_id" value="{{ $solution_type->id }}">
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
                                        <div class="col-sm-6 size-13">
                                            <div class="form-group">
                                                <label for="owner_name">Property Owners Name <span class="required">(Required)</span></label>
                                                <input type="text" name="owner_name" placeholder="Owner Name" class="form-control" id="owner_name" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Property Address</label>
                                                <textarea type="text" name="address" placeholder="Address" class="form-control" id="address"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 size-13">
                                            <div class="form-group">
                                                <label for="vendor_name">Vendor Name</label>
                                                <input type="text" name="vendor_name" placeholder="Vendor Name" class="form-control" id="vendor_name">
                                            </div>
                                            <div class="form-group">
                                                <label for="vendor_email">Vendor Email  <span class="required">(Required)</span></label>
                                                <input type="email" name="vendor_email" placeholder="Vendor Email" class="form-control" id="vendor_email" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="vendor_phone">Vendor Contact Number</label>
                                                <input type="text" name="vendor_phone" placeholder="Vendor Number" class="form-control" id="vendor_phone">
                                            </div>
                                        </div>
                                    </div>
                                    {{--<button type="button" class="btn btn-previous pull-left new_button"><span class="glyphicon glyphicon-chevron-left"></span> Previous</button>
                                    <button id="propertyDetailsNextBtn" type="button" class="btn pull-right new_button">Next <span class="glyphicon glyphicon-chevron-right"></span></button>--}}
                                </div>
                            </fieldset>

                            {{--===== Package Start =====================================================================--}}
                            <fieldset><hr>
                                <div class="form-bottom">
                                    <h3 class="instruction">Packages</h3>
                                    <br>
                                    <div class="row text-center">
                                        Would you like to choose a Complete Package ?<br>
                                        <label><input type="radio" name="package" class="choose0" value="0" checked>No</label>
                                        <label><input type="radio" name="package" class="choose1" value="1">Yes</label>
                                    </div>


                                    <div class="row pack-choise">
                                        @if(isset($data['packages']))
                                            <?php $i=0; ?>
                                            @foreach($data['packages'] as $package)
                                                <div class="col-sm-12 package1">
                                                <table class="" border="0" style="width: 100%; height: auto; color: #fff; text-align: center; background:#000;">
                                                    <tr>
                                                        <td align="left" width="30%">
                                                            <div class="">
                                                                @if(isset($package->image_path))
                                                                    <img src="{{ url($package->image_path) }}" class="img-responsive img-rounded" style="max-width:100%;" alt="No image found in the image directory">
                                                                @endif

                                                                <?php $i += 1; if($i=='1') {$checked='checked';}else{$checked='';} ?>
                                                                <div class="right-dashed">
                                                                    <label class="text-color">
                                                                        <input type="radio" name="package_head_id" <?php echo $checked ?> value="{{ $package->id }}">
                                                                        {{ $package->title }}
                                                                    </label>

                                                                    @if(isset($package['relPackageOption']))
                                                                        <ul class="size-14 ">
                                                                            @foreach($package['relPackageOption'] as $package_option)
                                                                                <li>{{ $package_option->title }}</li>
                                                                                {{--<li align="right">{{ number_format($package_option->price,2) }}</li>--}}
                                                                            @endforeach
                                                                        </ul>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                        @if(isset($package['relPackageOption']))
                                                            @foreach($package['relPackageOption'] as $package_option)
                                                                <td>{{ $package_option->title }}<br> {{  $package_option->desctiption }}</td>
                                                                <td> + </td>
                                                                {{--<td align="right">{{ number_format($package_option->price,2) }}</td>--}}
                                                            @endforeach
                                                        @endif

                                                        <td> = </td>

                                                        <td>
                                                            <strong style="border-bottom: 3px double #f59e00; color: #f59e00">{{number_format($package->price,2)}}</strong>
                                                        </td>
                                                    </tr>
                                                </table>
                                                    </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </fieldset>
                            {{--========================================= Package End =============================================--}}

                            <fieldset class="dflt_packs"><hr>
                                <div class="form-bottom">
                                    <h3 class="instruction">Photography</h3>
                                    <br>
                                    <div class="validationErrorPhotographyPackage"></div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4>Will the property require pro-photography ?</h4>
                                            <label>
                                                <input type="radio" name="pro-photographyChooseBtn" value="0" class="noBtn btn-next" checked="checked">
                                                No
                                            </label>
                                            <label>
                                                <input type="radio" name="pro-photographyChooseBtn" value="1" class="yesBtn">
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row size-15">
                                        <div class="optionalContentDiv optional-content-div">
                                            @foreach($data['photography_packages'] as $photography_package)
                                                <div class="col-sm-2">
                                                    <div  class="common-box1">
                                                    <label class="text-left-label">
                                                        <input class="photography_package_id" type="checkbox" name="photography_package_id[]" value="{{ $photography_package->id }}">
                                                        <span class="text-color size-18">{{  $photography_package->title }}</span><br>
                                                        <span class="text-color size-18">$ {{ $photography_package->price }}</span>
                                                    </label>

                                                    <ul class="options">
                                                        @foreach($photography_package->relPhotographyPackage as $relPhotographyPackage)
                                                            <li>{{ $relPhotographyPackage->items }}</li>
                                                        @endforeach
                                                    </ul>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>NOTE</label>
                                                    <textarea type="text" name="photography_package_comments" placeholder="Note" class="form-control" id="photography_package_comments"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{--<button type="button" class="btn btn-previous pull-left new_button"><span class="glyphicon glyphicon-chevron-left"></span> Previous</button>
                                    <button id="photographyNextBtn" type="button" class="btn pull-right new_button">Next <span class="glyphicon glyphicon-chevron-right"></span></button>--}}


                                </div>
                            </fieldset>
                            {{--===== For Sign Board Package ========================================================================--}}
                            <fieldset class="dflt_packs"><hr>
                                <div class="form-bottom">
                                    <h3 class="instruction">SIGNBOARD</h3>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="validationErrorSignboardPackage"></div>
                                            <h4>Will require signboard ?</h4>
                                            <label>
                                                <input name="signboardChooseBtn" type="radio" value="0" class="noBtn btn-next" checked="checked">
                                                No
                                            </label>
                                            <label>
                                                <input name="signboardChooseBtn" type="radio" value="1" class="yesBtn">
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="optionalContentDiv optional-content-div">
                                            {{--<h3 class="left size-16 orange">FOR SPECS & FEATURES PLEASE CLICK ON THE LINK BELOW</h3>--}}
                                            <div><h3 class="left size-32" style="color: #f36f21">Price Include Installation and Removal</h3></div>
                                            @foreach($data['signboard_packages'] as $signboard_package)
                                            <div class="col-sm-3 ">
                                                <div class="sign-box" style="height: 800px;">
                                                    <label class="">
                                                        <span class="text-left-label text-color">
                                                            <input type="checkbox" class="signboard_package_id" name="signboard_package_id[]" value="{{ $signboard_package->id }}">
                                                            {{--<input type="radio" class="signboard_package_id" name="signboard_package_id[]" value="{{ $signboard_package->id }}">--}}
                                                            {{ $signboard_package->title }}
                                                        </span>
                                                    </label>
                                                    <div>
                                                        @foreach($signboard_package->relSignboardPackage as $relSignboardPackage)
                                                            {{ $relSignboardPackage->title }}
                                                            <p>{{ $relSignboardPackage->description }}</p>
                                                            <h2 class="size-40 text-color text-normal">$ {{ $relSignboardPackage->price }}</h2>
                                                        @endforeach
                                                    </div>
                                                    <div class="pkg-img">
                                                        <img width="100%" src="{{ asset($signboard_package->image_path) }}">
                                                    </div>

                                                    {{--<div class="panel-body">
                                                        <div class="form-group">

                                                            <select name="signboard_package_size_id[{{ $signboard_package->id }}]" class="form-control">
                                                                @foreach($signboard_package->relSignboardPackage as $relSignboardPackage)
                                                                    <option value="{{ $relSignboardPackage->id }}">{{ $relSignboardPackage->title.' ( $'.$relSignboardPackage->price.')' }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>--}}
                                                </div>
                                            </div>
                                            @endforeach
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>NOTE</label>
                                                    <textarea type="text" name="signboard_package_comments" placeholder="Note" class="form-control" id="signboard_package_comments"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--<button type="button" class="btn btn-previous pull-left new_button"> <span class="glyphicon glyphicon-chevron-left"></span> Previous</button>
                                    <button id="signboardNextBtn" type="button" class="btn pull-right new_button">Next <span class="glyphicon glyphicon-chevron-right"></span></button>--}}


                                </div>
                            </fieldset>
                            {{--===== End Sign Board Package || Print Material Starts =========================================================================================--}}
                            <fieldset class="dflt_packs"><hr>
                                <div class="form-bottom">
                                    <h3 class="instruction">PRINT MATERIAL</h3>
                                    <div class="validationErrorPrintMaterial"></div>

                                    <div class="row">
                                        <div class="col-sm-12 size-16">
                                            <h4>Will you require print material ?</h4>
                                            <label>
                                                <input class="noBtn btn-next" type="radio" name="printMaterialChooseBtn" value="0" checked="checked">
                                                No
                                            </label>
                                            <label>
                                                <input class="yesBtn" type="radio" name="printMaterialChooseBtn" value="1">
                                                Yes
                                            </label>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="optionalContentDiv optional-content-div">
                                            <div class="col-md-12" style="padding-top:10px; padding-bottom: 10px;">
                                                <p class="white size-13">All printed material will be 2side print and the orientation (landscape or portriat) of the material will depend on the artowk set up for your agency, please
                                                    ensure that check it is the required orientation, For specific requirement for orientation, stock or other requirements please state in the “note” section.
                                                </p>
                                                <p class="white size-13">Also if you wish to have more then 1 printed material and wish to have dit distributed, please sepcify which print material will be used for distribution by
                                                    selecting the distribution.
                                                </p>
                                            </div>
                                            @foreach($data['print_materials'] as $print_material)
                                            <div class="col-sm-2">
                                                <div class="sign-box" style="height: 550px;">
                                                    <label class="size-15 text-color">
                                                        <input type="checkbox" class="print_material_id" name="print_material_id[]" value="{{ $print_material->id }}">
                                                        {{ $print_material->title }}
                                                    </label>
                                                    <p class="white size-13">
                                                        @foreach($print_material->relPrintMaterial as $relPrintMaterial)
                                                            {{ $relPrintMaterial->description }}
                                                        @endforeach
                                                    </p>
                                                    <label class="green size-15">
                                                        <input type="checkbox" name="is_distributed[{{ $print_material->id }}]" value="{{ $print_material->id }}">
                                                        USE FOR DISTRIBUTION
                                                    </label>
                                                    <div class="pkg-img"><img width="100%" src="{{ asset($print_material->image_path) }}"></div>
                                                    <div class="panel-body select">
                                                        <select name="print_material_size_id[{{ $print_material->id }}]" class="form-control">
                                                            @foreach($print_material->relPrintMaterial as $relPrintMaterial)
                                                            <option value="{{ $relPrintMaterial->id }}">{{ $relPrintMaterial->title.'( $'.$relPrintMaterial->price.')' }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="text-color size-32">
                                                        @foreach($print_material->relPrintMaterial as $relPrintMaterial)
                                                           $ {{ $relPrintMaterial->price }}
                                                        @endforeach
                                                    </div>



                                                </div>
                                            </div>
                                            @endforeach
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label>NOTE</label>
                                                    <textarea type="text" name="print_material_comments" placeholder="Note" class="form-control" id="address"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--<button type="button" class="btn btn-previous pull-left new_button"><span class="glyphicon glyphicon-chevron-left"></span> Previous</button>
                                    <button id="printMaterialNextBtn" type="button" class="btn pull-right new_button">Next <span class="glyphicon glyphicon-chevron-right"></span></button>--}}

                                </div>
                            </fieldset>
                            {{--===== Distribution of print material starts from here =============================================================================--}}
                            <fieldset class="dflt_packs"><hr>
                                <div class="form-bottom">
                                    <h3 class="instruction">DISTRIBUTION OF PRINT MATERIAL</h3>
                                    <div class="validationErrorDistributionPrintMaterial"></div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4>Will you require distribution of print material ?</h4>
                                            <label>
                                                <input class="noBtn btn-next" type="radio" name="distributedPrintMaterialChooseBtn" value="0" checked="checked">
                                                No
                                            </label>
                                            <label>
                                                <input class="yesBtn" type="radio" name="distributedPrintMaterialChooseBtn" value="1">
                                                Yes
                                            </label>

                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="optionalContentDiv optional-content-div">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    {!! Form::label('quantity','Please select below from the total print material above what quantity will be used for distribution to your specified location (Remainder will be sent to you the agency)','class="controll-label size-13"') !!}

                                                    <select class="quantity form-control" name="quantity"  style="color: black">
                                                        <option value="select">Please Select</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label size-13">Location of Distribution in the surrounding properties<span class="required">New Field</span></label><br>

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <label>
                                                                <input class="" type="radio" name="locationDistributionProperties" value="0" checked="checked">
                                                                No
                                                            </label>
                                                            <label>
                                                                <input class="" type="radio" name="locationDistributionProperties" value="1">
                                                                Yes
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>NOTE</label>
                                                    <textarea type="text" name="note" placeholder="Note" class="form-control" id="note"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div style="width: 100%; height: 15px"></div>
                                                    <label class="control-label size-13">Quantity<small class="required"> [New field]</small></label>
                                                    <input type="number" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label size-13">Distribution Area [Post Code ]<small class="required"> [New field]</small></label>
                                                    <input type="number" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label size-13">Choose a Date of Distribution <small class="required"> [New field]</small></label>
                                                    <input type="number" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--<button type="button" class="btn btn-previous pull-left new_button"><span class="glyphicon glyphicon-chevron-left"></span> Previous</button>
                                    <button id="distributedPrintMaterialNextBtn" type="button" class="btn pull-right new_button">Next <span class="glyphicon glyphicon-chevron-right"></span></button>--}}


                                </div>
                            </fieldset>
                            {{--===== Distribution of Print material end || Digital Media starts=======================================================--}}

                            {{--<fieldset class="dflt_packs"><hr>
                                <div class="form-bottom">
                                    <h3 class="instruction">Digital media</h3>
                                    <div class="validationErrorDigitalMedia"></div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4>Will you require digital media ?</h4>
                                            <label>
                                                <input class="noBtn btn-next" type="radio" name="digitalMediaChooseBtn" value="0" checked="checked">
                                                No
                                            </label>
                                            <label>
                                                <input class="yesBtn" type="radio" name="digitalMediaChooseBtn" value="1">
                                                Yes
                                            </label>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="optionalContentDiv optional-content-div">
                                            <div class="col-sm-6">
                                            <div class="form-group">
                                                {!! Form::label('digital_media_id','Most popular websites','class=" size-13"') !!}<br>
                                                @foreach($data['digital_medias'] as $digital_media)
                                                    <label class="size-13">
                                                        <input class="digital_media_id" type="checkbox" name="digital_media_id[]" value="{{ $digital_media->id }}"> {{ $digital_media->title }}
                                                    </label> <br>

                                                @endforeach

                                            </div>
                                            <div class="form-group">
                                                <label>NOTE</label>
                                                <textarea type="text" name="digital_media_note" placeholder="Digital Media Note" class="form-control" id="digital_media_note"></textarea>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    --}}{{--<button type="button" class="btn btn-previous pull-left new_button"><span class="glyphicon glyphicon-chevron-left"></span> Previous</button>
                                    <button id="digitalMediaNextBtn" type="button" class="btn pull-right new_button">Next <span class="glyphicon glyphicon-chevron-right"></span></button>--}}{{--


                                </div>
                            </fieldset>--}}
                            {{--<fieldset class="dflt_packs"><hr>
                                <div class="form-bottom">
                                    <h3 class="instruction">Local newsprint media advertising</h3>
                                    <div class="validationErrorLocalMedia"></div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4>Your choice of local newsprint advertisement ?</h4>
                                            <label>
                                                <input class="noBtn btn-next" type="radio" name="localMediaChooseBtn" value="0" checked="checked">
                                                No
                                            </label>
                                            <label>
                                                <input class="yesBtn" type="radio" name="localMediaChooseBtn" value="1">
                                                Yes
                                            </label>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="optionalContentDiv optional-content-div">
                                            @foreach($data['local_medias'] as $local_media)
                                            <div class="col-sm-4 localMediaDiv">
                                                <div class="form-group">
                                                    <label class="size-15">
                                                        <input class="local_media_id" type="checkbox" name="local_media_id[]" value="{{ $local_media->id }}">
                                                        {{ $local_media->title }}
                                                    </label>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        @foreach($local_media->relLocalMedia as $relLocalMedia)
                                                            --}}{{--<input type="radio">--}}{{--
                                                            <label class="size-13">
                                                                <input class="local_media_option_id" type="radio" value="{{ $relLocalMedia->id }}" name="local_media_option_id[{{  $local_media->id }}]">
                                                                {!! $relLocalMedia->title.' <b style="color: orange">$'.$relLocalMedia->price.'</b>' !!}
                                                            </label><br>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                            <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>NOTE</label>
                                                <textarea type="text" name="local_media_note" placeholder="Local Media Note" class="form-control" id="local_media_note"></textarea>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    --}}{{--<div class="row">
                                        <button type="button" class="btn btn-previous pull-left new_button"><span class="glyphicon glyphicon-chevron-left"></span> Previous</button>
                                    </div>--}}{{--
                                    --}}{{--<div class="row">
                                        <div class="col-sm-5 col-sm-offset-7">

                                            {!! Form::input('button','save','Save',['class'=>'btn btn-primary btn-bg']) !!}
                                            {!! Form::input('button','quote','Quote',['class'=>'btn btn-bg btn-info ']) !!}
                                        </div>
                                    </div>--}}{{--


                                </div>
                            </fieldset>--}}
                            <div class="row">
                                <div class="col-sm-12 center">
                                    <input value="Save" name="save" type="submit" class="btn new_button proceedBtn">
                                    <input name="quote" value="Continue" type="submit" class="btn new_button proceedBtn">
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            {{--</div>--}}
        </div>
<div>
</div>
        {{--<script type="text/javascript" src="{{ URL::asset('assets/quote/js/jquery.backstretch.min.js') }}"></script>--}}
        {{--<script type="text/javascript" src="{{ URL::asset('assets/quote/js/scripts.js') }}"></script>--}}
        @include('main::quote._script')
@stop
