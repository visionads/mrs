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

    <div class="col-sm-12 font-droid" id="quote-div">

        {{-- <div class="row">--}}
        <div class="col-sm-12">
            {!! Form::open(['route' => ['new_quote_store', $data['quote']->id], 'method' => 'PATCH' ]) !!}
            {{--<form role="form" method="post" class="">--}}
            <h2 style="color: #fff;text-align: center;">Edit Quote</h2>
            <div class="quote-form">
                <fieldset><hr>
                    <div class="form-bottom">
                        <div class="validationError"></div>
                        <h3 class="instruction">Please select one of the following to begin</h3>
                        <div class="form-group solutions_type_id size-15" style="text-align:center !important;">
                            @foreach($data['solution_types'] as $solution_type)
                                <label>
                                    {{ $solution_type->title }}<br>
                                    <input required type="radio" name="solution_type_id" value="{{ $solution_type->id }}" @if($data['quote']->solution_type_id==$solution_type->id) checked @endif>
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
                                    <input type="text" name="owner_name" placeholder="Owner Name" class="form-control" id="owner_name" value="{{ $data['quote']->relPropertyDetail['owner_name'] }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="address">Property Address</label>
                                    <textarea type="text" name="address" placeholder="Address" class="form-control" id="address">{{ $data['quote']->relPropertyDetail['address'] }}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-6 size-13">
                                <div class="form-group">
                                    <label for="vendor_name">Vendor Name</label>
                                    <input type="text" name="vendor_name" placeholder="Vendor Name" class="form-control" id="vendor_name" value="{{ $data['quote']->relPropertyDetail['vendor_name'] }}" >
                                </div>
                                <div class="form-group">
                                    <label for="vendor_email">Vendor Email  <span class="required">(Required)</span></label>
                                    <input type="email" name="vendor_email" placeholder="Vendor Email" class="form-control" id="vendor_email" value="{{ $data['quote']->relPropertyDetail['vendor_email'] }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="vendor_phone">Vendor Contact Number</label>
                                    <input type="text" name="vendor_phone" placeholder="Vendor Number" class="form-control" id="vendor_phone" value="{{ $data['quote']->relPropertyDetail['vendor_phone'] }}" >
                                </div>
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
                        <div class="row">
                            <div class="col-sm-12">
                                <h4>Will the property require pro-photography ?</h4>
                                <label>
                                    <input type="radio" name="pro-photographyChooseBtn" value="0" class="noBtn btn-next" @if($data['quote']->photography_package_id == null) checked="checked" @endif>
                                    No
                                </label>
                                <label>
                                    <input type="radio" name="pro-photographyChooseBtn" value="1" class="yesBtn" @if($data['quote']->photography_package_id != null) checked="checked" @endif>
                                    Yes
                                </label>
                            </div>
                        </div>
                        <div class="row size-15">
                            <div class="optionalContentDiv @if($data['quote']->photography_package_id == null)  optional-content-div @endif">
                                @foreach($data['photography_packages'] as $photography_package)
                                    <div class="col-sm-4">
                                        <label class="text-center-label">
                                            <input type="radio" name="photography_package_id" value="{{ $photography_package->id }}" @if($data['quote']->photography_package_id != null && $photography_package->id==$data['quote']->photography_package_id) checked="checked" @endif>
                                            {{ $photography_package->title }}
                                        </label>

                                        <ul>
                                            @foreach($photography_package->relPhotographyPackage as $relPhotographyPackage)
                                                <li>{{ $relPhotographyPackage->items }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>NOTE</label>
                                        <textarea type="text" name="photography_package_comments" placeholder="Note" class="form-control" id="photography_package_comments">{{ $data['quote']->photography_package_comments }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--<button type="button" class="btn btn-previous pull-left new_button"><span class="glyphicon glyphicon-chevron-left"></span> Previous</button>
                        <button id="photographyNextBtn" type="button" class="btn pull-right new_button">Next <span class="glyphicon glyphicon-chevron-right"></span></button>--}}


                    </div>
                </fieldset>
                <fieldset><hr>
                    <div class="form-bottom">
                        <h3 class="instruction">SIGNBOARD</h3>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="validationError"></div>
                                <h4>Will require signboard ?</h4>
                                <label>
                                    <input name="signboardChooseBtn" type="radio" value="0" class="noBtn btn-next" @if($data['quote']->signboard_package_id == null) checked="checked" @endif>
                                    No
                                </label>
                                <label>
                                    <input name="signboardChooseBtn" type="radio" value="1" class="yesBtn" @if($data['quote']->signboard_package_id != null) checked="checked" @endif>
                                    Yes
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="optionalContentDiv @if($data['quote']->signboard_package_id == null) optional-content-div @endif">
                                <h3 class="center size-16">FOR SPECS & FEATURES PLEASE CLICK ON THE LINK BELOW</h3>
                                @foreach($data['signboard_packages'] as $signboard_package)
                                    <div class="col-sm-4">
                                        <label class="">
                                                    <span class="text-center-label">
                                                    <input type="radio" name="signboard_package_id" value="{{ $signboard_package->id }}" @if($data['quote']->signboard_package_id != null && $data['quote']->signboard_package_id == $signboard_package->id) checked="checked" @endif>
                                                        {{ $signboard_package->title }}</span>
                                            <img width="100%" height="100" src="{{ asset($signboard_package->image_path) }}">
                                        </label>
                                        <div class="panel-body">
                                            <div class="form-group">

                                                <select name="signboard_package_size_id[{{ $signboard_package->id }}]" class="form-control">
                                                    @foreach($signboard_package->relSignboardPackage as $relSignboardPackage)
                                                        <option value="{{ $relSignboardPackage->id }}" @if($data['quote']->signboard_package_id == null) checked="checked" @endif>{{ $relSignboardPackage->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>NOTE</label>
                                        <textarea type="text" name="signboard_package_comments" placeholder="Note" class="form-control" id="signboard_package_comments">{{ $data['quote']->signboard_package_comments }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--<button type="button" class="btn btn-previous pull-left new_button"> <span class="glyphicon glyphicon-chevron-left"></span> Previous</button>
                        <button id="signboardNextBtn" type="button" class="btn pull-right new_button">Next <span class="glyphicon glyphicon-chevron-right"></span></button>--}}


                    </div>
                </fieldset>
                <fieldset><hr>
                    <div class="form-bottom">
                        <h3 class="instruction">PRINT MATERIAL</h3>                                            <div class="validationError"></div>

                        <div class="row">
                            <div class="col-sm-12 size-16">
                                <h4>Will you require print material ?</h4>
                                <label>
                                    <input class="noBtn btn-next" type="radio" name="printMaterialChooseBtn" value="0" @if($data['quote']->print_material_id == null) checked="checked" @endif>
                                    No
                                </label>
                                <label>
                                    <input class="yesBtn" type="radio" name="printMaterialChooseBtn" value="1" @if($data['quote']->print_material_id != null) checked="checked" @endif>
                                    Yes
                                </label>

                            </div>
                        </div>
                        <div class="row">
                            <div class="optionalContentDiv @if($data['quote']->print_material_id == null) optional-content-div @endif">
                                <p class="white size-13">All printed material will be 2side print and the orientation (landscape or portriat) of the material will depend on the artowk set up for your agency, please
                                    ensure that check it is the required orientation, For specific requirement for orientation, stock or other requirements please state in the “note” section.
                                </p>
                                <p class="white size-13">Also if you wish to have more then 1 printed material and wish to have dit distributed, please sepcify which print material will be used for distribution by
                                    selecting the distribution.</p>
                                @foreach($data['print_materials'] as $print_material)
                                    <div class="col-sm-4">
                                        <label>
                                            <input @if($data['quote']->print_material_id == $print_material->id) checked="checked" @endif type="radio" name="print_material_id" value="{{ $print_material->id }}">
                                            {{ $print_material->title }}
                                            <label style="margin-left: 10%">
                                                <input @if($data['quote']->print_material_id == $print_material->id && $data['quote']->is_distributed==1) checked="checked" @endif type="checkbox"  name="is_distributed[]" value="{{ $print_material->id }}">
                                                USE FOR DISTRIBUTION
                                            </label>
                                            <img width="100%" height="150" src="{{ asset($print_material->image_path) }}">
                                            <div class="panel-body">
                                                <select name="print_material_size_id[{{ $print_material->id }}]" class="form-control">
                                                    @foreach($print_material->relPrintMaterial as $relPrintMaterial)
                                                        <option @if($data['quote']->print_material_id != null && $data['quote']->print_material_size_id==$relPrintMaterial->id) selected="selected" @endif value="{{ $relPrintMaterial->id }}">{{ $relPrintMaterial->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </label>
                                    </div>
                                @endforeach
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>NOTE</label>
                                        <textarea type="text" name="print_material_comments" placeholder="Address" class="form-control" id="Note">{{ $data['quote']->print_material_comments }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--<button type="button" class="btn btn-previous pull-left new_button"><span class="glyphicon glyphicon-chevron-left"></span> Previous</button>
                        <button id="printMaterialNextBtn" type="button" class="btn pull-right new_button">Next <span class="glyphicon glyphicon-chevron-right"></span></button>--}}

                    </div>
                </fieldset>
                <fieldset><hr>
                    <div class="form-bottom">
                        <h3 class="instruction">DISTRIBUTION OF PRINT MATERIAL</h3>
                        <div class="validationError"></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4>Will you require distribution of print material ?</h4>
                                <label>
                                    <input class="noBtn btn-next" type="radio" name="distributedPrintMaterialChooseBtn" value="0" @if($data['quote']->print_material_distribution_id == null) checked="checked" @endif>
                                    No
                                </label>
                                <label>
                                    <input class="yesBtn" type="radio" name="distributedPrintMaterialChooseBtn" value="1" @if($data['quote']->print_material_distribution_id != null) checked="checked" @endif>
                                    Yes
                                </label>

                            </div>
                        </div>
                        <div class="row">

                            <div class="optionalContentDiv @if($data['quote']->print_material_distribution_id == null) optional-content-div @endif">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('quantity','Please select below from the total print material above what quantity will be used for distribution to your specified location
(Remainder will be sent to you the agency)') !!}
                                        <select class="quantity" name="quantity" style="color: black">
                                            <option @if($data['quote']->relPrintMaterialDistribution['quantity'] == 0) selected="selected" @endif value="select">Please Select</option>
                                            <option @if($data['quote']->relPrintMaterialDistribution['quantity'] == 1) selected="selected" @endif value="1">1</option>
                                            <option @if($data['quote']->relPrintMaterialDistribution['quantity'] == 2) selected="selected" @endif value="2">2</option>
                                            <option @if($data['quote']->relPrintMaterialDistribution['quantity'] == 3) selected="selected" @endif value="3">3</option>
                                            <option @if($data['quote']->relPrintMaterialDistribution['quantity'] == 4) selected="selected" @endif value="4">4</option>
                                            <option @if($data['quote']->relPrintMaterialDistribution['quantity'] == 5) selected="selected" @endif value="5">5</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>NOTE</label>
                                        <textarea type="text" name="note" placeholder="Note" class="form-control" id="note">{{ $data['quote']->relPrintMaterialDistribution['note'] }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--<button type="button" class="btn btn-previous pull-left new_button"><span class="glyphicon glyphicon-chevron-left"></span> Previous</button>
                        <button id="distributedPrintMaterialNextBtn" type="button" class="btn pull-right new_button">Next <span class="glyphicon glyphicon-chevron-right"></span></button>--}}


                    </div>
                </fieldset>
                <fieldset><hr>
                    <div class="form-bottom">
                        <h3 class="instruction">Digital media</h3>
                        <div class="validationError"></div>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4>Will you require digital media ?</h4>
                                <label>
                                    <input class="noBtn btn-next" type="radio" name="digitalMediaChooseBtn" value="0" @if($data['quote']->digital_media_id == null) checked="checked" @endif>
                                    No
                                </label>
                                <label>
                                    <input class="yesBtn" type="radio" name="digitalMediaChooseBtn" value="1"  @if($data['quote']->digital_media_id != null) checked="checked" @endif>
                                    Yes
                                </label>

                            </div>
                        </div>
                        <div class="row">
                            <div class="optionalContentDiv  @if($data['quote']->digital_media_id == null) optional-content-div @endif">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('digital_media_id','Most popular websites') !!}<br>
                                        @foreach($data['digital_medias'] as $digital_media)
                                            <input type="radio" name="digital_media_id" value="{{ $digital_media->id }}"  @if($data['quote']->digital_media_id == $digital_media->id) checked="checked" @endif> {{ $digital_media->title }} <br>
                                        @endforeach

                                    </div>
                                    <div class="form-group">
                                        <label>NOTE</label>
                                        <textarea type="text" name="digital_media_note" placeholder="Digital Media Note" class="form-control" id="digital_media_note">{{ $data['quote']->digital_media_note }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--<button type="button" class="btn btn-previous pull-left new_button"><span class="glyphicon glyphicon-chevron-left"></span> Previous</button>
                        <button id="digitalMediaNextBtn" type="button" class="btn pull-right new_button">Next <span class="glyphicon glyphicon-chevron-right"></span></button>--}}


                    </div>
                </fieldset>
                <fieldset><hr>
                    <div class="form-bottom">
                        <h3 class="instruction">Local newsprint media advertising</h3>
                        <div class="row">
                            <div class="col-sm-12">
                                <h4>Your choice of local newsprint advertisement ?</h4>
                                <label>
                                    <input class="noBtn btn-next" type="radio" name="localMediaChooseBtn" value="0" @if($data['quote']->local_media_id == null) checked="checked" @endif>
                                    No
                                </label>
                                <label>
                                    <input class="yesBtn" type="radio" name="localMediaChooseBtn" value="1"  @if($data['quote']->local_media_id != null) checked="checked" @endif>
                                    Yes
                                </label>

                            </div>
                        </div>
                        <div class="row">
                            <div class="optionalContentDiv  @if($data['quote']->local_media_id == null) optional-content-div @endif">
                                @foreach($data['local_medias'] as $local_media)
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input  type="radio" value="{{ $local_media->id }}" name="local_media_id"  @if($data['quote']->local_media_id == $local_media->id) checked="checked" @endif>
                                             {{ $local_media->title }}
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                @foreach($local_media->relLocalMedia as $relLocalMedia)
                                                    <input  type="radio" value="{{ $relLocalMedia->id }}" name="local_media_option_id[{{  $local_media->id }}]"  @if($data['quote']->local_media_option_id == $relLocalMedia->id) checked="checked" @endif>
                                                     {{ $relLocalMedia->title }}<br>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>NOTE</label>
                                        <textarea type="text" name="local_media_note" placeholder="Local Media Note" class="form-control" id="local_media_note">{{ $data['quote']->local_media_note }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                <input name="quote" value="Update" type="submit" class="btn new_button proceedBtn">
                            </div>
                        </div>

                    </div>
                </fieldset>
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