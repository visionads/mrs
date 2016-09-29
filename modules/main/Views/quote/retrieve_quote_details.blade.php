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
        <div class="col-md-12">
            <div class="col-sm-6">

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
                                <tr style="border-bottom: 3px double #909090;">
                                    <td>+ Package Name : {!! ($package_str!=='')?' <span class="items"> '.$package_str.' </span>' : '' !!}</td>
                                    <td>&nbsp; : &nbsp;</td>
                                    <td>$ {{ number_format($package_price,2) }}</td>
                                </tr>
                                <tr style="font-weight: bold;"><td style="text-align: right">Total&nbsp;</td><td>&nbsp; : &nbsp;</td><td>$ {{ number_format($total,2) }}</td></tr>
                            </table>
                        @else
                            <table class="size-13" style="background:none !important; color:#d0d0d0;">
                                {{--<tr><td width="auto" >+ Photography {!! ($photography_package_str!=='')?'[<span class="items"> '.$photography_package_str.' </span>]':'' !!}</td><td width="20">:</td><td>$ {{ number_format($photography_price,2) }}</td></tr>--}}
                                <tr><td>+ Signboard Package {!! ($signboard_package_str!=='')?'[<span class="items"> '.$signboard_package_str.' </span>]':'' !!}</td><td>:</td><td width="20%">$ {{ number_format($signboard_price,2) }}</td></tr>
                                <tr><td>+ Print Material {!! ($print_material_str!=='')?'[<span class="items"> '.$print_material_str.' </span>]':'' !!}</td><td>:</td><td>$ {{ number_format($print_material_price,2) }}</td></tr>
                                <tr style="border-bottom: 3px double #909090;"><td>+ Distribution of Print Material</td><td>:</td><td>{{ number_format($distributed_print_material_price,2) }}</td></tr>
                                {{--<tr><td>+ Digital Media</td><td>:</td><td>$ 0.00--}}{{--{{ number_format($print_material_price,2) }}--}}{{--</td></tr>--}}
                                {{--<tr style="border-bottom: 3px double #909090;"><td>+ Local Media {!! ($local_media_str!=='')?'[<span class="items"> '.$local_media_str.' </span>]':'' !!}</td><td>:</td><td>$ {{ number_format($local_media_price,2) }}</td></tr>--}}
                                <tr style="font-weight: bold;"><td style="text-align: right">Total&nbsp;</td><td>:</td><td>$ {{ number_format($total,2) }}</td></tr>
                            </table>
                        @endif
                    </div>

            </div>


            <div class="col-sm-6 text-right">
                <h2 style="color:#f36f21">Total : $ {{ (isset($total))?number_format($total,2):'0.00' }}</h2>
                <h2 style="color:#f36f21">GST : $ {{ (isset($gst))?number_format($gst,2):'0.00' }} </h2>
                <h2 style="color:#f36f21">Total COST Inc GST : $ {{ (isset($total_with_gst))?number_format($total_with_gst,2):'0.00' }} </h2>
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
                                <div class="input-group date">
                                    {!! Form::text('inspection_date',isset($inspection_date)?$inspection_date:null /*@$generate_voucher_number? date('Y/m/d') : @$data[0]['inspection_date']*/, ['id'=>'date_id','placeholder'=>'Click here to choose Inspection Date','class' => 'bs-datepicker-component form-control','title'=>'select date']) !!}
                                    {{--<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>--}}
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
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
                                <small class="required size-13">(Required)</small>
                                {!! Form::input('number','selling_price', isset($selling_price)?$selling_price:null, ['id'=>'selling_price', 'class' => 'form-control','placeholder'=>'Numeric Value only e.g.- 1100','title'=>'enter selling price','required']) !!}
                            </div>
                        </div>

                        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                            <div class="col-sm-12">
                                {!! Form::label('auction_time', 'Auction Times :', ['class' => 'control-label']) !!}

                                <div class="input-group date" style="position:relative;">
                                    {!! Form::text('auction_time',isset($auction_time)?$auction_time:null /*@$generate_voucher_number? date('Y/m/d') : @$data[0]['auction_time']*/, ['id'=>'date_id','placeholder'=>'Click here to choose Auction Date','class' => 'bs-datepicker-component form-control','title'=>'select date']) !!}
                                    {{--<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>--}}
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>
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
                </div>
            </div>






            <div class="container pages new_order font-droid">
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
            </div>


            <div class="container pages new_order font-droid step-four" style="display: none">

                <div class="col-sm-12">

                    <div class="col-sm-12">
                        {!! Form::label('date', 'Prefered Date and Time :', []) !!}
                        <div class="input-group date">
                            {!! Form::text('prefered_date', null, ['id'=>'date_id','class' => 'bs-datepicker-component form-control','title'=>'select date']) !!}
                            {{--<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>--}}
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>

                    <div class="col-sm-12">

                        {!! Form::label('Special Request for photography', 'Special Request for photography :', []) !!}

                        <div class="col-md-12 image-center">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail" style="width: 120px; height: 120px;   ">
                                    {{--@if($data['image'] != '')
                                        <a href="{{ route('gal_image.image.show', $data['id']) }}" class="btn btn-info btn-xs" data-toggle="modal" data-target="#imageView"><img src="{{ URL::to($data['image']) }}" height="50px" width="50px" alt="{{$data['image']}}" />
                                        </a>
                                    @else--}}
                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                    {{--{!! Form::file('images[]', array('multiple'=>true)) !!}--}}
                                    {{--@endif--}}
                                </div>
                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                <div class="image-center">
                                    <input type="file" name="image[]" id="image" class="default" multiple />
                                </div>
                            </div>
                            <span class="label label-danger"><font size="1">NOTE!</font></span>
                            <span style="color: white"><font size="1">System will allow these types of image(png,jpeg,jpg Format)</font></span>
                        </div>
                    </div>

                    <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                        <div class="col-sm-12">
                            {!! Form::label('property_access_information', 'Property Access Information :', ['class' => 'control-label']) !!}<br>
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
                    </div>

                    <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                        <div class="col-sm-12">
                            {!! Form::label('contact_name', 'Contact Name : ', []) !!}
                            {!! Form::text('contact_name', null, ['id'=>'contact_name', 'class' => 'form-control','title'=>'contact name']) !!}
                        </div>
                    </div>

                    <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                        <div class="col-sm-12">
                            {!! Form::label('contact_number', 'Contact Number : ', []) !!}
                            {!! Form::text('contact_number', null, ['id'=>'contact_number', 'class' => 'form-control','title'=>'contact number']) !!}
                        </div>
                    </div>

                    <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                        <div class="col-sm-12">
                            {!! Form::label('contact_alternate_number', 'Contact Alternate Number : ', []) !!}
                            {!! Form::text('contact_alternate_number', null, ['id'=>'contact_alternate_number', 'class' => 'form-control','title'=>'contact alternate number']) !!}
                        </div>
                    </div>

                    <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                        <div class="col-sm-12">
                            {!! Form::label('contact_email', 'Contact Email : ', []) !!}
                            {!! Form::text('contact_email', null, ['id'=>'contact_email', 'class' => 'form-control','title'=>'contact email']) !!}
                        </div>
                    </div>



                    <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                        <div class="col-sm-12">
                            {!! Form::label('property_note', 'Note :', ['class' => 'control-label']) !!}
                            {!! Form::textarea('property_note', null,['size' => '6x2','title'=>'Type Note','id'=>'note','placeholder'=>'Write Note here..','spellcheck'=>'true','class' => 'form-control text-left']) !!}
                        </div>
                    </div>
                </div>
            </div>




            <div class="col-sm-12 text-right">
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

@stop