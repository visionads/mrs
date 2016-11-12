@extends('admin::layouts.master')

@section('content')

    <style>
        .new_order label{
            color: white;
            font-size: 14px;
        }

        #new_order{
            text-align: right;
            background-color: #f36f21;
        }
        .commtable tr td { background:#303030; color:#d0d0d0; border-bottom: 1px solid #404040 !important;}
        .items { color:orange;}
    </style>
    <div class="container pages font-droid">
        <div class="row">
        <div class="col-md-12">
            <div class="col-sm-12" id="new_order_title"><span class="label size-25">{{ $pageTitle }}</span><br><br></div>
        </div>
            @if($print_material_quantity != 0)
            <script>
                $(document).ready(function(){
                     $('.keep_hide').hide();
                });
            </script>
            @endif

        <div class="col-md-12">
            <div class="col-sm-6 keep_hide">

                    <div class="col-sm-12">
                        <h1 class="size-25">Quote summary</h1>

                        <p class="size-18">
                            @if(isset($quote))
                                    <strong>Quote No. : {{ $quote->quote_number }}</strong><br>
                                    {{--+ Photography Package Comments : {{ $quote->photography_package_comments }}<br>
                                    + Signboard Package Comments : {{ $quote->signboard_package_comments }}<br>
                                    + Print Material Comments : {{ $quote->print_material_comments }}<br>
                                    + Print Material Distribution : {{ $quote->print_material_distribution_id }}<br>
                                    + Digital Media Note : {{ $quote->digital_media_note }}<br>
                                    + Local Media Note : {{ $quote->local_media_note }}<br>--}}
                                    <?php
                                    $quote_id = $quote->id;
                                    $quote_no = $quote->quote_number;
                                    ?>
                            @endif
                        </p>

                        @if(isset($exist_package))
                            <table class="size-18" style="background:none !important; color:#d0d0d0;">
                                <tr>
                                    <td width="auto" >+ Photography {!! ($photography_package_str!=='')?'[<span class="items size-13"> '.$photography_package_str.' </span>]':'' !!}</td>
                                    <td>&nbsp; : &nbsp;</td>
                                    <td>$ {{ number_format($photography_price,2) }}</td>
                                </tr>
                                {{--<tr><td>+ Distribution of Print Material</td><td>:  $</td><td>{{ number_format($distributed_print_material_price,2) }}</td></tr>--}}

                                @if($print_material_quantity!= 0)
                                    @if($print_material_use_for_distribution = 1)
                                        <tr><td>+ Cost of Distribution </td><td>:  $</td><td class="dist_price_in_summary">0.00</td></tr>
                                    @endif
                                @endif
                                <tr style="border-bottom: 3px double #909090;">
                                    <td>+ Package Name : {!! ($package_str!=='')?' <span class="items"> '.$package_str.' </span>' : '' !!}</td>
                                    <td>&nbsp; : &nbsp;</td>
                                    <td>$ {{ number_format($package_price,2) }}</td>
                                </tr>
                                <tr style="font-weight: bold;"><td style="text-align: right">Total&nbsp;</td><td>:</td><td class="totalToScript">$ {{ number_format($total,2) }}</td></tr>

                            </table>
                        @else
                            <table class="size-13" style="background:none !important; color:#d0d0d0;">
                                <tr>
                                    <td width="auto" >+ Photography {!! ($photography_package_str!=='')?'[<span class="items size-13"> '.$photography_package_str.' </span>]':'' !!}</td>
                                    <td>&nbsp; : &nbsp;</td>
                                    <td>$ {{ number_format($photography_price,2) }}</td>
                                </tr>
                                {{--<tr><td width="auto" >+ Photography {!! ($photography_package_str!=='')?'[<span class="items"> '.$photography_package_str.' </span>]':'' !!}</td><td width="20">:</td><td>$ {{ number_format($photography_price,2) }}</td></tr>--}}
                                <tr><td>+ Signboard Package {!! ($signboard_package_str!=='')?'[<span class="items"> '.$signboard_package_str.' </span>]':'' !!}</td><td>&nbsp; : &nbsp;</td><td width="20%">$ {{ number_format($signboard_price,2) }}</td></tr>
                                <tr><td>+ Print Material {!! ($print_material_str!=='')?'[<span class="items"> '.$print_material_str.' </span>]':'' !!}</td><td>&nbsp; : &nbsp;</td><td>$ {{ number_format($print_material_price,2) }}</td></tr>
                                {{--<tr style="border-bottom: 3px double #909090;"><td>+ Distribution
                                </td><td>:  $</td><td>{{ number_format($distributed_print_material_price,2) }}</td></tr>--}}

                                @if($print_material_quantity!= 0)
                                    @if($print_material_use_for_distribution = 1)
                                        <tr style="border-bottom: 3px double #909090;"><td>+ Cost of Distribution </td><td>&nbsp; : &nbsp;</td><td>$ <span class="dist_price_in_summary">0.00</span></td></tr>
                                    @endif
                                @endif
                                {{--<tr><td>+ Digital Media</td><td>:</td><td>$ 0.00--}}{{--{{ number_format($print_material_price,2) }}--}}{{--</td></tr>--}}
                                {{--<tr style="border-bottom: 3px double #909090;"><td>+ Local Media {!! ($local_media_str!=='')?'[<span class="items"> '.$local_media_str.' </span>]':'' !!}</td><td>:</td><td>$ {{ number_format($local_media_price,2) }}</td></tr>--}}
                                <tr style="font-weight: bold;"><td style="text-align: right">Total&nbsp;</td><td>:</td><td class="totalToScript">$ {{ number_format($total,2) }}</td></tr>
                                <input type="hidden" id="ttlprice" value="{{ $total }}" name="ttlprice">
                            </table>
                        @endif
                    </div>

            </div>


            <div class="col-sm-6 text-right keep_hide">
                {{--<h2 style="color:#f36f21">Total : $ {{ (isset($total))?number_format($total,2):'0.00' }}</h2>
                <h2 style="color:#f36f21">GST : $ {{ (isset($gst))?number_format($gst,2):'0.00' }} </h2>
                <h2 style="color:#f36f21">Total COST Inc GST : $ {{ (isset($total_with_gst))?number_format($total_with_gst,2):'0.00' }} </h2>--}}

                <h2 style="color:#f36f21">Total : $ <span class="totalToScript">{{ (isset($total))?number_format($total,2):'0.00' }}</span></h2>
                <h2 style="color:#f36f21">GST : $ <span class="newgst">{{ (isset($gst))?number_format($gst,2):'0.00' }}</span> </h2>
                <h2 style="color:#f36f21">Total COST Inc GST : $ <span class="newtotal">{{ (isset($total_with_gst))?number_format($total_with_gst,2):'0.00' }}</span> </h2>
            </div>
            <div class="col-md-12">
                <p>

                    <label>
                        {!! Form::checkbox('agree','yes',null,['id'=>'agreeCheckbox']) !!} I Hereby agree to the outlined marketing campaign above
                    </label>
                </p>
            </div>
            <div class="col-md-6 col-md-offset-6">
                <a href="{{ route('quote-list') }}" class="btn new_button ">Back To Quote</a>&nbsp;
                {{--<a href="{{ route('quote-confirm', ['quote_id'=>$quote_id, 'quote_no'=>$quote_no ]) }}" class="btn new_button ">Proceed to Confirm</a>--}}
                <button class="proceed-to-confirm btn new_button" data-placement="top" data-content="Click here to Proceed Confirm "> Proceed to Confirm </button>
            </div>
        </div>
        </div>
    </div>

     {{--Agreement page--}}
    <div class="container agreement" style="display:none">

    {!! Form::open( ['route' => 'place-order', 'method' => 'POST','id' => 'jq-validation-form', 'files'=>true]) !!}

    {!! Form::hidden('quote_id', (isset($quote_id))?$quote_id:null) !!}
    {!! Form::hidden('quote_no', (isset($quote_no))?$quote_no:null) !!}
    {!! Form::hidden('total', (isset($total))?$total:'0.00') !!}
    {!! Form::hidden('gst', (isset($gst))?$gst:'0.00') !!}
    {!! Form::hidden('total_with_gst', (isset($total_with_gst))?$total_with_gst:'0.00') !!}

        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
{{--            @include('main::order.place_order')--}}



            <div id="step-one" class="container pages new_order font-droid step-one">
                <div class="col-md-12">
                    <div class="col-sm-12" id="new_order_title"><span class="label size-25">Property Details</span><br><br></div>
                </div>
                <div class="row">
                    {{--Left pan--}}
                    <div class="col-sm-6 no-padding">
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                            <div class="col-sm-12">
                                <p class="size-13">Details will be used to for all marketing marterial unless specified.
                                    If you wish to have details other then stated here please specify in the “note”
                                    space provided. (please ensure to check all details are correct)</p>
                            </div>
                        </div>





                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                            <div class="col-sm-12">
                                {!! Form::label('main_selling_line', 'Main selling line:', ['class' => 'control-label']) !!}
                                <small class="required size-13">(Required)</small>
                                {!! Form::text('main_selling_line', isset($main_selling_line)?$main_selling_line:null, ['id'=>'main_selling_line', 'placeholder'=>'Main selling line', 'class' => 'form-control','maxlength'=>'64','title'=>'enter main selling line','required']) !!}
                            </div>
                        </div>

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                            <div class="col-sm-12">
                                {!! Form::label('property_description', 'Property description :', ['class' => 'control-label']) !!}
                                <small class="required size-13">(Required)</small>
                                {!! Form::textarea('property_description', isset($property_description)?$property_description:null,['size' => '6x9','title'=>'Type property description','id'=>'property_description','placeholder'=>'property description here..','spellcheck'=>'true','class' => 'form-control text-left','required']) !!}
                            </div>
                        </div>

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                            <div class="col-sm-12">
                                {!! Form::label('inspection_date', 'Inspection dates and times :', ['class' => 'control-label']) !!}
                                    {!! Form::text('inspection_date',isset($inspection_date)?$inspection_date:null /*@$generate_voucher_number? date('Y/m/d') : @$data[0]['inspection_date']*/, ['placeholder'=>'Click here to choose Inspection Date','class' => 'form-control','title'=>'select date']) !!}
                                {{--<div class="input-group date">--}}
                                    {{--<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>--}}
                                    {{--<span class="input-group-addon"><i class="fa fa-calendar"></i></span>--}}
                                {{--</div>--}}
                            </div>
                        </div>

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                            <div class="col-sm-12">
                                {!! Form::label('inspection_features', 'General features, Number Bedrooms, bathrooms, Garage ECT :', ['class' => 'control-label']) !!}
                                {!! Form::textarea('inspection_features', isset($inspection_features)?$inspection_features:null,['size' => '6x5','title'=>'Type inspection features','id'=>'inspection_features','placeholder'=>'inspection features here..','spellcheck'=>'true','class' => 'form-control text-left']) !!}
                            </div>
                        </div>

                    </div>

                    {{--Right Pan--}}
                    <div class="col-sm-6 no-padding" id="submit_button_div">
                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                            <div class="col-sm-12">
                                {!! Form::label('other_features', 'Other Features:', ['class' => 'control-label']) !!}
                                {!! Form::text('other_features', isset($other_features)?$other_features:null, ['id'=>'other_features', 'class' => 'form-control','placeholder'=>'Other Features','title'=>'enter other features']) !!}
                            </div>
                        </div>

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                            <div class="col-sm-12">
                                {!! Form::label('selling_price', 'Selling Price:', ['class' => 'control-label']) !!}
                                {{--<small class="required size-13">(Required)</small>--}}
                                {!! Form::input('text','selling_price', isset($selling_price)?$selling_price:null, ['id'=>'selling_price', 'class' => 'form-control','placeholder'=>'Numeric Value only e.g.- 1100','title'=>'enter selling price']) !!}
                            </div>
                        </div>

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                            <div class="col-sm-12">
                                {!! Form::label('auction_time', 'Auction Times :', ['class' => 'control-label']) !!}

                                {{--<div class="input-group date" style="position:relative;">
                                    {!! Form::text('auction_time',isset($auction_time)?$auction_time:null, ['id'=>'date_id','placeholder'=>'Click here to choose Auction Date','class' => 'bs-datepicker-component form-control','title'=>'select date']) !!}
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>--}}
                                {!! Form::text('auction_time',isset($auction_time)?$auction_time:null, ['placeholder'=>'Write Date and time','class' => 'form-control','title'=>'select date']) !!}

                            </div>
                        </div>

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                            <div class="col-sm-12">
                                {!! Form::label('offer', 'Offer:', ['class' => 'control-label']) !!}
                                {!! Form::text('offer', null, ['id'=>'offer', 'class' => 'form-control', 'placeholder'=>'Offer','maxlength'=>'64','title'=>'enter offer']) !!}
                            </div>
                        </div>

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                            <div class="col-sm-12">
                                {!! Form::label('note', 'Note :', ['class' => 'control-label']) !!}
                                {!! Form::textarea('note', null,['size' => '6x13','title'=>'Type note','id'=>'note','placeholder'=>'Note here..','spellcheck'=>'true','class' => 'form-control text-left']) !!}
                            </div>
                        </div>

                        <div class="form-group text-right">
                            {{--<div class="col-sm-12" id="submit_button">
                                {!! Form::submit('Place Order', ['class' => 'btn btn new_button','data-placement'=>'top','data-content'=>'click place order button']) !!}&nbsp;
                            </div>--}}
                            {{--<div class="col-sm-12 text-right">
                                <button class="btn new_button" id="next_step" type="button"> Next <span class="glyphicon glyphicon-chevron-right"></span></button>
                            </div>--}}

                        </div>
                    </div>


                    <!--============================================================================================== ***
                    COMPLETE PACKAGE
                    If package is "is_distributed_package"
                    *** ===============================================================================================-->
                    {{--{{ $package_type }}--}}
                    @if($package_type!=='')
                        {{--@if($package_type == "super-exposure-pack")--}}
                        @if($is_distributed_package == "yes")
                            {{--@if(isset($quote->is_distributed_package))--}}
                                {{--@if($quote->is_distributed_package=='yes')--}}
                                <div class="col-sm-12">
                                    <hr class="common-hr">
                                    <h3 class="instruction">COST OF DISTRIBUTION </h3>
                                    <div class="form-group">
                                        <label class="control-label size-13">Location of Distribution in the surrounding properties<span class="required"></span></label><br>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>
                                                    <input class="" type="radio" name="is_surrounded" value="0" checked="checked">
                                                    No
                                                </label>
                                                <label>
                                                    <input class="" type="radio" name="is_surrounded" value="1">
                                                    Yes
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label size-13">Distribution Area <small class="required"> [ Post Code ]</small></label>
                                        <input type="text" name="distribution_area" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label size-13 text-normal">Choose a Date of Distribution <span class="required">[ Distribution Commenses on Saturday and will be complete within 5 day window ]</span></label>
                                        <select name="date_of_distribution" class="form-control">
                                            @foreach($saturdays as $saturday)
                                                <option value="{{ $saturday }}">{{ date('d M Y D',strtotime($saturday)) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{--@endif--}}
                            {{--@endif--}}
                        {{--@else--}}
                            {{--<div class="col-sm-12">
                                <hr class="common-hr">
                                <h3 class="instruction">DISTRIBUTION OF PRINT MATERIAL</h3>
                                <div class="form-group">
                                    <label class="control-label size-13">Location of Distribution in the surrounding properties<span class="required"></span></label><br>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>
                                                <input class="" type="radio" name="is_surrounded" value="0" checked="checked">
                                                No
                                            </label>
                                            <label>
                                                <input class="" type="radio" name="is_surrounded" value="1">
                                                Yes
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label size-13">Distribution Area <small class="required"> [ Post Code ]</small></label>
                                    <input type="text" name="distribution_area" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label class="control-label size-13 text-normal">Choose a Date of Distribution <span class="required">[ Distribution Commenses on Saturday and will be complete within 5 day window ]</span></label>
                                    <select name="date_of_distribution" class="form-control">
                                        @foreach($saturdays as $saturday)
                                            <option value="{{ $saturday }}">{{ date('d M Y D',strtotime($saturday)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>--}}
                        @endif
                    @endif
                    <!-- ===================================================================================================***
                    End print Materila Distribution form with is_distributed_package
                    ***=====================================================================================================-->


                    <!--=================================================================================================== ***
                    CUSTOM PACKAGE
                    If Print Material is Selected with "Use for Distribution" from New Quote form
                    *** ====================================================================================================-->
                    {{--{{ $print_material_use_for_distribution }}--}}
                    @if($print_material_quantity!= 0)
                        @if($print_material_use_for_distribution = 1)
                            <div class="col-md-12">
                                <hr class="common-hr">
                                <h3 class="instruction">COST OF DISTRIBUTION </h3>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        {!! Form::label('quantity','Please select below from the total print material above what quantity will be used for distribution to your specified location (Remainder will be sent to you the agency)','class="controll-label size-13"') !!}

                                        {{--<select class="quantity form-control" name="quantity" id="distributionQuantity"  style="color: black">
                                            <option value="select">Please Select</option>
                                            @for($i=1000;$i<=20000;$i+=1000)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>--}}
                                        {{--<input class="form-control" type="number" name="quantity" id="distributionQuantity" value="{{ $print_material_quantity }}">--}}
                                        <select class="quantity form-control" name="quantity" id="distributionQuantity" required  style="color: black">
                                            <option value="">Please Select</option>
                                            <option value="{{ $print_material_quantity }}" selected >{{ $print_material_quantity }}</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label size-13">Min Quantity<span class="required"> (Price $65 per 1000)</span></label><br>
                                                <input class="form-control" id="minQuantity" name="distributed_quantity" type="number" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label size-13">Rest Quantity<span class="required"></span></label><br>
                                                <input class="form-control" id="restQuantity" name="rest_quantity" type="number" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <p style="color: red">Total Price : <price></price></p>

                                    <input type="hidden" name="distribution_price" placeholder="Distribution Price" class="form-control" id="distributionPrice" readonly>
                                    <div class="form-group">
                                        <label>NOTE</label>
                                        <textarea type="text" name="note" placeholder="Note" class="form-control" id="note"></textarea>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label size-13">Location of Distribution in the surrounding properties<span class="required"></span></label><br>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>
                                                    <input class="" type="radio" name="is_surrounded" value="0" checked="checked">
                                                    No
                                                </label>
                                                <label>
                                                    <input class="" type="radio" name="is_surrounded" value="1">
                                                    Yes
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label size-13">Distribution Area <small class="required"> [ Post Code ]</small></label>
                                        <input type="text" name="distribution_area" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label size-13 text-normal">Choose a Date of Distribution <span class="required">[ Distribution Commenses on Saturday and will be complete within 5 day window ]</span></label>
                                        <select name="date_of_distribution" class="form-control">
                                            @foreach($saturdays as $saturday)
                                                <option value="{{ $saturday }}">{{ date('d M Y D',strtotime($saturday)) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        @endif
                    @endif
                    <!-- ===================================================================================================***
                    End print material distribution
                    ***=====================================================================================================-->


                    <!-- ===================================================================================================***
                    PHOTOGRAPHY Starts
                    ***=====================================================================================================-->
                    {{--@if($quote->photography_package_id==null)--}}
                        {{--<div class="container pages new_order font-droid">
                            <hr class="common-hr">
                            <div class="row form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                                <div class="col-md-12">
                                    <div class="col-sm-12" id="new_order_title"><span class="label size-25">Photography</span><br><br></div>
                                </div>
                                <div class="col-sm-12">
                                    <h4 style="color:#f31f21">Will you take photography by yourself ?</h4>

                                    <label>
                                        <input type="radio" name="quote_property_access" value="0" class="" id="property_access_close" checked> &nbsp; No
                                    </label>
                                    <label>
                                        <input type="radio" name="quote_property_access" value="1" class="btn-next" id="property_access_open"> &nbsp; Yes
                                    </label>
                                </div>
                            </div>
                        </div>--}}


                        {{--<div class="container pages new_order font-droid step-four" style="display: block">--}}

                        <div class="col-md-12">

                        {{--<div class="col-sm-12">
                            {!! Form::label('date', 'Preferred Date and Time :', []) !!}
                            <div class="input-group date">
                                {!! Form::text('prefered_date', null, ['id'=>'date_id','class' => 'bs-datepicker-component form-control','title'=>'select date']) !!}
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </div>--}}



                        {{--{!! Form::label('Special Request for photography', 'Special Request for photography :', ['class'=>'text-center']) !!}--}}

                        <hr class="common-hr">
                        <h3 class="instruction">PHOTOGRAPHY</h3>
                            @if($quote->photography_package_id==null)

                        {{--<div class="col-md-12">--}}
                            {{--<div class="fileupload fileupload-new" data-provides="fileupload">--}}
                            {{--<div class="fileupload-new thumbnail" style="width: 120px; height: 120px;   ">
                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                            </div>
                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>--}}
                            <div class="form-group" style="text-align: center !important;">
                                <i class="fa fa-image" style="font-size: 72px;"></i><br>
                                <label class="control-label">Upload Photographs</label>
                                <input type="file" name="image[]" id="image" class="form-control" style="width:200px; margin: auto !important;" multiple >
                                <span class="label label-danger"><font size="1">NOTE!</font></span>
                                <span style="color: white"><font size="1">System will allow these types of image(png,jpeg,jpg Format)</font></span>
                            </div>
                            {{--</div>--}}

                        {{--</div>--}}


                        @else
                        {{--<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">--}}

                        <div class="form-group">
                            {!! Form::label('property_access_information', 'Property Access Information :', ['class' => 'control-label orange size-20']) !!}<br>
                            <label>
                                <input type="radio" name="property_access_options" value="tennant" checked> &nbsp; Tennant
                            </label>
                            <label>
                                <input type="radio" name="property_access_options" value="vendor" > &nbsp; Vendor
                            </label>
                            <label>
                                <input type="radio" name="property_access_options" value="agent" > &nbsp; Agent/ Agency
                            </label>
                            <label>
                                <input type="radio" name="property_access_options" value="other" > &nbsp; Other, pick up keys from
                            </label>
                        </div>
                        {{--</div>--}}
                        {{--<div class="col-md-12">--}}
                            <div class="form-group">
                                {!! Form::label('contact_name', 'Contact Name : ', ['class'=>'control-label']) !!}
                                {!! Form::text('contact_name', null, ['id'=>'contact_name', 'class' => 'form-control','title'=>'contact name','required']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('contact_number', 'Contact Number : ', []) !!}
                                {!! Form::text('contact_number', null, ['id'=>'contact_number', 'class' => 'form-control','title'=>'contact number','required']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('contact_alternate_number', 'Contact Alternate Number : ', []) !!}
                                {!! Form::text('contact_alternate_number', null, ['id'=>'contact_alternate_number', 'class' => 'form-control','title'=>'contact alternate number']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('contact_email', 'Contact Email : ', []) !!}
                                {!! Form::text('contact_email', null, ['id'=>'contact_email', 'class' => 'form-control','title'=>'contact email']) !!}
                            </div>

                            <div class="form-group">
                                {!! Form::label('property_note', 'Note :', ['class' => 'control-label']) !!}
                                {!! Form::textarea('property_note', null,['size' => '6x2','title'=>'Type Note','id'=>'note','placeholder'=>'Write Note here..','spellcheck'=>'true','class' => 'form-control text-left']) !!}
                            </div>
                        {{--</div>--}}
                        </div>
                        {{--</div>--}}

                    @endif
                    <!-- ===================================================================================================***
                    PHOTOGRAPHY Ends
                    ***=====================================================================================================-->



                </div>
            </div>

            <div class="col-md-12">
                <div class="col-sm-6 keep_hide">

                    <div class="col-sm-12">
                        <h1 class="size-25">Quote summary</h1>

                        <p class="size-18">
                            @if(isset($quote))
                                <strong>Quote No. : {{ $quote->quote_number }}</strong><br>
                                {{--+ Photography Package Comments : {{ $quote->photography_package_comments }}<br>
                                + Signboard Package Comments : {{ $quote->signboard_package_comments }}<br>
                                + Print Material Comments : {{ $quote->print_material_comments }}<br>
                                + Print Material Distribution : {{ $quote->print_material_distribution_id }}<br>
                                + Digital Media Note : {{ $quote->digital_media_note }}<br>
                                + Local Media Note : {{ $quote->local_media_note }}<br>--}}
                                <?php
                                $quote_id = $quote->id;
                                $quote_no = $quote->quote_number;
                                ?>
                            @endif
                        </p>

                        @if(isset($exist_package))
                            <table class="size-18" style="background:none !important; color:#d0d0d0;">
                                <tr>
                                    <td width="auto" >+ Photography {!! ($photography_package_str!=='')?'[<span class="items size-13"> '.$photography_package_str.' </span>]':'' !!}</td>
                                    <td>&nbsp; : &nbsp;</td>
                                    <td>$ {{ number_format($photography_price,2) }}</td>
                                </tr>
                                {{--<tr><td>+ Distribution of Print Material</td><td>:  $</td><td>{{ number_format($distributed_print_material_price,2) }}</td></tr>--}}

                                @if($print_material_quantity!= 0)
                                    @if($print_material_use_for_distribution = 1)
                                        <tr><td>+ Cost of Distribution </td><td>:  $</td><td class="dist_price_in_summary">0.00</td></tr>
                                    @endif
                                @endif
                                <tr style="border-bottom: 3px double #909090;">
                                    <td>+ Package Name : {!! ($package_str!=='')?' <span class="items"> '.$package_str.' </span>' : '' !!}</td>
                                    <td>&nbsp; : &nbsp;</td>
                                    <td>$ {{ number_format($package_price,2) }}</td>
                                </tr>
                                <tr style="font-weight: bold;"><td style="text-align: right">Total&nbsp;</td><td>:</td><td class="totalToScript">$ {{ number_format($total,2) }}</td></tr>

                            </table>
                        @else
                            <table class="size-13" style="background:none !important; color:#d0d0d0;">
                                <tr>
                                    <td width="auto" >+ Photography {!! ($photography_package_str!=='')?'[<span class="items size-13"> '.$photography_package_str.' </span>]':'' !!}</td>
                                    <td>&nbsp; : &nbsp;</td>
                                    <td>$ {{ number_format($photography_price,2) }}</td>
                                </tr>
                                {{--<tr><td width="auto" >+ Photography {!! ($photography_package_str!=='')?'[<span class="items"> '.$photography_package_str.' </span>]':'' !!}</td><td width="20">:</td><td>$ {{ number_format($photography_price,2) }}</td></tr>--}}
                                <tr><td>+ Signboard Package {!! ($signboard_package_str!=='')?'[<span class="items"> '.$signboard_package_str.' </span>]':'' !!}</td><td>&nbsp; : &nbsp;</td><td width="20%">$ {{ number_format($signboard_price,2) }}</td></tr>
                                <tr><td>+ Print Material {!! ($print_material_str!=='')?'[<span class="items"> '.$print_material_str.' </span>]':'' !!}</td><td>&nbsp; : &nbsp;</td><td>$ {{ number_format($print_material_price,2) }}</td></tr>
                                {{--<tr style="border-bottom: 3px double #909090;"><td>+ Distribution of Print Material</td><td>:  $</td><td>{{ number_format($distributed_print_material_price,2) }}</td></tr>--}}

                                @if($print_material_quantity!= 0)
                                    @if($print_material_use_for_distribution = 1)
                                        <tr style="border-bottom: 3px double #909090;"><td>+ Cost of Distribution </td><td>&nbsp; : &nbsp;</td><td>$ <span class="dist_price_in_summary">0.00</span></td></tr>
                                    @endif
                                @endif
                                {{--<tr><td>+ Digital Media</td><td>:</td><td>$ 0.00--}}{{--{{ number_format($print_material_price,2) }}--}}{{--</td></tr>--}}
                                {{--<tr style="border-bottom: 3px double #909090;"><td>+ Local Media {!! ($local_media_str!=='')?'[<span class="items"> '.$local_media_str.' </span>]':'' !!}</td><td>:</td><td>$ {{ number_format($local_media_price,2) }}</td></tr>--}}
                                <tr style="font-weight: bold;"><td style="text-align: right">Total&nbsp;</td><td>:</td><td class="totalToScript">$ {{ number_format($total,2) }}</td></tr>
                                <input type="hidden" id="ttlprice" value="{{ $total }}" name="ttlprice">
                            </table>
                        @endif
                    </div>

                </div>
                <div class="col-sm-6 text-right keep_hide">
                    {{--<h2 style="color:#f36f21">Total : $ {{ (isset($total))?number_format($total,2):'0.00' }}</h2>
                    <h2 style="color:#f36f21">GST : $ {{ (isset($gst))?number_format($gst,2):'0.00' }} </h2>
                    <h2 style="color:#f36f21">Total COST Inc GST : $ {{ (isset($total_with_gst))?number_format($total_with_gst,2):'0.00' }} </h2>--}}

                    <h2 style="color:#f36f21">Total : $ <span class="totalToScript">{{ (isset($total))?number_format($total,2):'0.00' }}</span></h2>
                    <h2 style="color:#f36f21">GST : $ <span class="newgst">{{ (isset($gst))?number_format($gst,2):'0.00' }}</span> </h2>
                    <h2 style="color:#f36f21">Total COST Inc GST : $ <span class="newtotal">{{ (isset($total_with_gst))?number_format($total_with_gst,2):'0.00' }}</span> </h2>
                </div>
            </div>




            <div class="col-sm-12" style="text-align: center !important;">
                {{--{!! Form::submit('Confirmed Quote', ['class' => 'btn btn new_button','data-placement'=>'top','data-content'=>'click to confirm Agreement','onclick'=>'return confirm("Are you sure!")']) !!}&nbsp;--}}
{{--                {!! Form::submit('Confirm',['class' => 'btn btn new_button','data-placement'=>'top','data-content'=>'click to confirm Agreement','data-toggle'=>'modal','data-target'=>'#confirmModal']) !!}--}}
                {!! Form::submit('Confirm',['class' => 'btn btn new_button','data-placement'=>'top','data-content'=>'click to confirm Agreement']) !!}

            </div>
            {{--<div class="col-sm-12" id="submit_button">
                <a href="{{ route('payment') }}" class="btn new_button" onclick="return confirm('Are You Sure ! ')"> Confirm </a>
            </div>--}}
        </div>
        <!-- Modal -->
        <div id="confirmModal" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content" style="text-align: center !important;">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Confirmed Quote</h4>
                    </div>
                    <div class="modal-body">
                        <p>Are You Sure ?</p>
                    </div>
                    <div class="modal-footer" style="text-align: center !important;">
                        {{--<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>--}}
                        {{--{!! Form::submit('Continue to Order', ['class' => 'btn new_button','data-placement'=>'top','data-content'=>'click to confirm Agreement']) !!}&nbsp;
                        {!! Form::submit('Later', ['class' => 'btn new_button','data-placement'=>'top','data-content'=>'click to confirm Agreement']) !!}&nbsp;--}}

                        <input type="submit" name="continue" value="Continue to Order" class="btn new_button" data-placement="top" data-content="click to confirm Agreement">&nbsp;
                        <input type="submit" name="later" value="Later" class="btn new_button" data-placement="top" data-content="click to confirm Later">
                        {{--<a href="#" class="btn new_button" data-dismiss="modal">Later</a>--}}
                    </div>
                </div>

            </div>
        </div>

    {!! Form::close() !!}
    </div>

    @include('main::order._script')
    @include('main::quote._script')

@stop