
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
            {!! Form::open(['route' => ['new_quote_store', $data['quote']->id], 'method' => 'PATCH','files'=> 'true' ]) !!}
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
                                {{--<div class="form-group">--}}
                                {{--<label for="vendor_name">Vendor Name</label>--}}
                                {{--<input type="text" name="vendor_name" placeholder="Vendor Name" class="form-control" id="vendor_name" value="{{ $data['quote']->relPropertyDetail['vendor_name'] }}" >--}}
                                {{--</div>--}}
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



                {{--===== Package(New) Start =====================================================================--}}
                <fieldset><hr>
                    <div class="form-bottom">
                        <h3 class="instruction">Packages</h3>
                        <br>
                        {{--===== For Yes/No top labaling ***--}}
                        <div class="row text-center">
                            {{--Would you like to choose a Complete Package ?<br>--}}
                            <div class="col-sm-6">
                                {{--<label><input type="radio" name="package" class="choose0" value="1" checked> Complete Package</label>--}}
                                <label><input type="radio" name="package" class="choose0" value="1" @if($data['quote']->package_head_id != null) checked="checked" @endif> Complete Package</label>
                            </div>
                            <div class="col-sm-6">
                                <label><input type="radio" name="package" class="choose1" value="0" @if($data['quote']->package_head_id == null) checked="checked" @endif>Customize your quote </label>
                            </div>
                        </div>

                        <div class="row pack-choise" @if($data['quote']->package_head_id == null) style="display: block !important" @endif >
                            @if(isset($data['packages']))
                                <?php
                                $i=0;
                                $j = 0;
                                $pack_type_unique = array();
                                ?>
                                {{--=== 1st Loop ===--}}
                                @foreach($data['packages'] as $package)

                                    <?php
                                    $pack_type_unique[$j] = $package->type;
                                    if($j > 0){
                                        if ($pack_type_unique[$j] != $pack_type_unique[$j-1]){
                                            echo '<div class="col-md-12 text-color center size-25 uppercase"><span class="glyphicon glyphicon-minus"></span>'.str_replace('-',' ',$pack_type_unique[$j]).'</div>';
                                        }
                                    } else {
                                        echo '<div class="col-md-12 text-color center size-25 uppercase"><span class="glyphicon glyphicon-minus"></span>'.str_replace('-',' ',$pack_type_unique[$j]).'</div>';
                                    }
                                    $j++;
                                    ?>

                                    {{--<div class="col-md-12 text-color center size-25">{{ $package->type }}</div>--}}
                                    <div class="col-sm-12 package1">
                                        <label style="width: 100%;">
                                            <table class="" border="0" style="width: 100%; height: auto; color: #fff; text-align: center; background:#000;">
                                                <tr>
                                                    <td align="left">
                                                        <?php
                                                        //if($data['quote']->relQuotePackage['price'] == $package->price){$checked='checked';}else{$checked='';}
                                                        if($data['quote']->package_head_id == $package->id){$checked='checked';}else{$checked='';}
                                                        if($data['quote']->is_distributed_pakcage == "Yes"){$checked1='checked'; }else{$checked1='';}
                                                        if($is_dist == "Yes"){$hide = 'display:none';}else{ $hide='';}
                                                        ?>
                                                        <input type="radio" name="package_head_id" <?php echo $checked ?> value="{{ $package->id }}">
                                                        <span class="text-color">{{ $package->title }}</span>
                                                    </td>
                                                </tr>
                                                @if($package->type == "super-exposure-pack")
                                                <tr>
                                                    <td align="left">
                                                        <div class="checkbox">
                                                            <label class="size-14"><input type="checkbox" name="is_distributed_package"  <?php echo $checked ?> value="yes" class="is_dist">Is Distributed Package</label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endif
                                                <tr>
                                                    {{--=== First part from left ===--}}
                                                    <td align="left" width="30%">
                                                        <div class="">
                                                            @if(isset($package->image_path))
                                                                <img src="{{ asset($package->image_path) }}" class="img-responsive img-rounded" style="max-width:100%;" alt="No image found in the image directory">
                                                            @endif

                                                            <div class="">
                                                                @if(isset($package['relPackageOption']))
                                                                    <ul class="size-14 right-dashed" style=" margin-bottom: 30px;">
                                                                        @foreach($package['relPackageOption'] as $package_option)
                                                                            <li>{{ $package_option->title }}</li>
                                                                            {{--<li align="right">{{ number_format($package_option->price,2) }}</li>--}}
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </td>

                                                    {{--=== 2nd Loop ===--}}
                                                    @if(isset($package['relPackageOption']))
                                                        <?php
                                                            $totalItem=count($package['relPackageOption']);
                                                            $x=1;
                                                        ?>
                                                        @foreach($package['relPackageOption'] as $package_option)
                                                            <td>
                                                                <span class="size-17 text-color">{{ $package_option->title }}</span><br>
                                                                <span class="size-15 italic">{{ isset($package_option->description)?$package_option->description:''  }}</span><br>
                                                                @if(isset($package_option->image))
                                                                    <img src="{{ asset($package_option->image) }}" width="100">
                                                                @else
                                                                    <span class="glyphicon glyphicon-picture" style="font-size: 64px;" title="No Image Available"></span>
                                                                @endif
                                                            </td>
                                                            @if($x < $totalItem)
                                                            <td> <span class="glyphicon glyphicon-plus text-color size-18"></span> </td>
                                                                @endif
                                                            {{--<td align="right">{{ number_format($package_option->price,2) }}</td>--}}
                                                            <?php $x++; ?>
                                                            @endforeach
                                                    @endif

                                                    {{--=== end loop ===--}}
                                                    <td class="size-25 text-color"> = </td>
                                                    <td align="right" width="13%">
                                                        <strong style="color: #f59e00; font-size: 30px;">$ {{number_format($package->price,2)}}</strong>
                                                    </td>
                                                </tr>
                                            </table>
                                        </label>
                                    </div>
                                @endforeach
                                {{--<div class="center"><a role="tab" class="btn btn-warning" id="addphotography"> + ADD Photography Package</a></div>--}}
                            @endif

                        </div>
                    </div>
                </fieldset>
                {{--========================================= Package(New) End =============================================--}}


                <fieldset class=""><hr>

                    <div class="form-bottom">
                        <h3 class="instruction">Photography</h3>
                        <br>
                        <div class="validationErrorPhotographyPackage"></div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>
                                    <input type="radio" name="pro-photographyChooseBtn" value="0" class="noBtnP btn-next" @if($data['quote']->photography_package_id == null) checked="checked" @endif>
                                    Upload your own
                                </label>
                            </div>
                            <div class="col-sm-6">
                                <label>
                                    <input type="radio" name="pro-photographyChooseBtn" value="1" class="yesBtnP" @if($data['quote']->photography_package_id != null) checked="checked" @endif>
                                    Select photography package
                                </label>
                            </div>
                        </div>

                        <div class="row size-15">
                            {{--<div class="optionalContentDiv @if(count($data['quote']->relQuotePropertyImage) == 0) optional-content-div @endif" id="pImage">

                                <div class="col-sm-12">

                                    {!! Form::label('Special Request for photography', 'Special Request for photography (Multiple) :', []) !!}

                                    <div class="row">
                                        <div class="col-md-6 image-center">
                                            <div class="image-center">
                                                <input type="file" name="custom_photography_images[]" id="image" class="default" multiple />
                                            </div>
                                        </div>
                                        <div class="col-md-6 image-center">
                                            @if(count($data['quote']->relQuotePropertyImage) >= 0)
                                                @foreach($data['quote']->relQuotePropertyImage as $image)
                                                    <img src="{{ asset($image->image) }}" style="padding: 2px;" width="200px" height="100px">
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <span class="label label-danger"><font size="1">NOTE!</font></span>
                                    <span style="color: white"><font size="1">System will allow these types of image(png,jpeg,jpg Format)</font></span>
                                </div>
                            </div>--}}
                            <div class="optionalContentDiv @if($data['quote']->photography_package_id == null)  optional-content-div @endif">
                                <?php $k = 0; $photo_type_unique = array();  ?>
                                @foreach($data['photography_packages'] as $photography_package)
                                    <?php
                                    $photo_type_unique[$k] = $photography_package->type;
                                    if($k > 0){
                                        if ($photo_type_unique[$k] != $photo_type_unique[$k-1]){
                                            echo '<div class="col-md-12 text-color left size-25 uppercase"><span class="glyphicon glyphicon-minus"></span> '.$photo_type_unique[$k].'</div>';
                                        }
                                    } else {
                                        echo '<div class="col-md-12 text-color left size-25 uppercase"><span class="glyphicon glyphicon-minus"></span> '.$photo_type_unique[$k].'</div>';
                                    }
                                    $k++;
                                    ?>

                                    <div class="col-sm-2">
                                        <label style="width: 100%">
                                            <div  class="common-box1">
                                                <input class="photography_package_id" type="radio" name="photography_package_id[]" value="{{ $photography_package->id }}"
                                                       @if(isset($data['quote']->relQuotePhotography))
                                                       @foreach($data['quote']->relQuotePhotography as $ppi)
                                                       @if($ppi->photography_package_id==$photography_package->id)
                                                       checked="checked"
                                                        @endif
                                                        @endforeach
                                                        @endif >
                                                {{--{!! $photography_package->title.' <b style="color: orange">$'.$photography_package->price.'</b>' !!}--}}
                                                <span class="text-color size-18">{{  $photography_package->title }}</span><br>
                                                <span class="text-color size-18">$ {{ $photography_package->price }}</span>
                                                {{--</label>--}}

                                                <ul class="options" style="list-style: inside">
                                                    @foreach($photography_package->relPhotographyPackage as $relPhotographyPackage)
                                                        <li>{{ $relPhotographyPackage->items }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </label>
                                    </div>

                                @endforeach
                                <div class="col-md-12">&nbsp;</div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label>NOTE</label>
                                        <textarea type="text" name="photography_package_comments" placeholder="Note" class="form-control" id="photography_package_comments">{{ $data['quote']->photography_package_comments }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>

                {{--========================================== Sign Board Package ***============================================--}}
                <fieldset class="dflt_packs" @if($data['quote']->package_head_id != null) style="display: none" @endif><hr>
                    <div class="form-bottom">
                        <h3 class="instruction">SIGNBOARD</h3>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="validationErrorSignboardPackage"></div>
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
                                <h3 class="center size-25 text-color">Price Include Installation and Removal</h3>
                                @foreach($data['signboard_packages'] as $signboard_package)

                                    <div class="col-sm-3 ">
                                        <label style="padding: 0; margin: 0; width: 100%;">
                                            <div class="sign-box" style="height: 800px;">

                                                <span class="text-left-label text-color">
                                                    <input type="checkbox" class="signboard_package_id" name="signboard_package_id[]" value="{{ $signboard_package->id }}"
                                                           @if(isset($data['quote']->relQuoteSignboard))
                                                           @foreach($data['quote']->relQuoteSignboard as $ppi)
                                                           @if($ppi->signboard_package_id==$signboard_package->id)
                                                           checked="checked"
                                                            @endif
                                                            @endforeach
                                                            @endif>

                                                    {{ $signboard_package->title }}
                                                </span>

                                                <div>

                                                    <p>{{ $signboard_package->description }}</p>
                                                    <h2 class="size-40 text-color text-normal">$ {{ $signboard_package->price }}</h2>
                                                </div>
                                                @foreach($signboard_package->relSignboardPackage as $relSignboardPackage)
                                                    <input type="hidden" value="{{ $relSignboardPackage->id }}"
                                                           @if(isset($data['quote']->relQuoteSignboard))
                                                           @foreach($data['quote']->relQuoteSignboard as $ppi)
                                                           @if($ppi->signboard_size_id==$relSignboardPackage->id)
                                                           selected="selected"
                                                            @endif
                                                            @endforeach
                                                            @endif >
                                                @endforeach
                                                <div class="pkg-img">
                                                    <img width="100%" src="{{ asset($signboard_package->image_path) }}">
                                                </div>

                                            </div>
                                        </label>
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
                    </div>
                </fieldset>



                <fieldset class="dflt_packs" @if($data['quote']->package_head_id != null) style="display: none" @endif><hr>
                    <div class="form-bottom">
                        <h3 class="instruction">PRINT MATERIAL</h3>
                        <div class="validationErrorPrintMaterial"></div>

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

                                    <div class="col-sm-2">
                                        <div class="sign-box" style="height: 550px;">
                                            <label class="size-15 text-color">
                                                <input class="print_material_id" @if(isset($data['quote']->relQuotePrintMaterial))
                                                @foreach($data['quote']->relQuotePrintMaterial as $ppi)
                                                @if($ppi->print_material_id==$print_material->id)
                                                checked="checked"
                                                       @endif
                                                       @endforeach
                                                       @endif type="checkbox" name="print_material_id[]" value="{{ $print_material->id }}">
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
                                                        <option @if(isset($data['quote']->relQuotePrintMaterial))
                                                                @foreach($data['quote']->relQuotePrintMaterial as $ppi)
                                                                @if($ppi->print_material_id==$print_material->id && $ppi->print_material_size_id==$relPrintMaterial->id)
                                                                selected="selected"
                                                                @endif
                                                                @endforeach
                                                                @endif value="{{ $relPrintMaterial->id }}">{{ $relPrintMaterial->title.'( $'.$relPrintMaterial->price.')' }}</option>
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
                                        <textarea type="text" name="print_material_comments" placeholder="Address" class="form-control" id="Note">{{ $data['quote']->print_material_comments }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--<button type="button" class="btn btn-previous pull-left new_button"><span class="glyphicon glyphicon-chevron-left"></span> Previous</button>
                        <button id="printMaterialNextBtn" type="button" class="btn pull-right new_button">Next <span class="glyphicon glyphicon-chevron-right"></span></button>--}}

                    </div>
                </fieldset>

                <div class="row">
                    <div class="col-sm-12 center">
                        <input name="quote" value="Update" type="submit" class="btn new_button proceedBtn">
                    </div>
                </div>
            </div>

            </form>

        </div>
        {{--</div>--}}
    </div>
    <div>
    </div>

    @include('main::quote._script')
    <script>
        $(document).ready(function () {
            var ckbox = $('.is_dist');
            $('input').on('click',function () {
                if (ckbox.is(':checked')) {
                    $(".dist_print_optional").hide();
                } else {
                    $(".dist_print_optional").show();
                }
            });
        });
    </script>
    @if($data['quote']->package_head_id == null)
        <script>
            $(".pack-choise").hide();
            $(".dflt_packs").show();
        </script>
    @elseif($data['quote']->package_head_id != null)
        <script>
            $(".pack-choise").show();
            $(".dflt_packs").hide();
        </script>
    @endif
@stop
