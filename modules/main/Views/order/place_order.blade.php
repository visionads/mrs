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
    </style>
    {!! Form::open(['method'=>'POST','route'=>'place-order-store', 'files'=>true]) !!}
    {{--1st Step of the form--}}
    <div id="step-one" class="container pages new_order font-droid step-one">
        <div class="col-md-12">
            <div class="col-sm-12" id="new_order_title"><span class="label size-25">{{ $pageTitle?$pageTitle:"Place Order" }}</span><br><br></div>
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

                {!! Form::hidden('quote_id',$quote_id?$quote_id:null) !!}
                {!! Form::hidden('quote_no', $quote_no?$quote_no:null ) !!}
                {!! Form::hidden('property_detail_id',$property_detail_id?$property_detail_id:null) !!}
                {!! Form::hidden('print_material_id', $print_material_id?$print_material_id:null) !!}
                {!! Form::hidden('total',$total?$total:'0.00') !!}
                {!! Form::hidden('gst',$gst?$gst:'0.00') !!}
                {!! Form::hidden('total_with_gst',$total_with_gst?$total_with_gst:'0.00') !!}
                {!! Form::hidden('material_distribution_id',$print_material_distribution_id,['id'=>'material_distribution_id']) !!}




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
                        {!! Form::textarea('property_description', isset($property_description)?$property_description:null,['size' => '6x9','title'=>'Type property description','id'=>'property_description','placeholder'=>'property description here..','spellcheck'=>'true','class' => 'form-control text-left']) !!}
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
                        {!! Form::label('selling_price', 'selling Price:', ['class' => 'control-label']) !!}
                        <small class="required size-13">(Required)</small>
                        {!! Form::input('number','selling_price', isset($selling_price)?$selling_price:null, ['id'=>'selling_price', 'class' => 'form-control','placeholder'=>'Numeric Value only e.g.- 1100','title'=>'enter selling price','required']) !!}
                    </div>
                </div>

                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('auction_time', 'Auction Times :', ['class' => 'control-label']) !!}
                        <small class="required size-13">(Required)</small>
                        <div class="input-group date" style="position:relative;">
                            {!! Form::text('auction_time',isset($auction_time)?$auction_time:null /*@$generate_voucher_number? date('Y/m/d') : @$data[0]['auction_time']*/, ['id'=>'date_id','placeholder'=>'Click here to choose Auction Date','class' => 'bs-datepicker-component form-control','required','title'=>'select date']) !!}
                            {{--<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>--}}
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>

                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('offer', 'Offer:', ['class' => 'control-label']) !!}
                        {!! Form::text('offer', $offer, ['id'=>'offer', 'class' => 'form-control', 'placeholder'=>'Offer','maxlength'=>'64','title'=>'enter offer']) !!}
                    </div>
                </div>

                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('note', 'Note :', ['class' => 'control-label']) !!}
                        {!! Form::textarea('note', $note,['size' => '6x13','title'=>'Type note','id'=>'note','placeholder'=>'Note here..','spellcheck'=>'true','class' => 'form-control text-left']) !!}
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
                <div class="col-sm-12" id="new_order_title"><span class="label size-25">DISTRIBUTION OF PRINT MATERIAL</span><br><br></div>
            </div>
            <div class="col-sm-12">
                <h4 style="color:#f31f21">Will you require distribution of print material </h4>

                <?php
                if($print_material_distribution_id == '' || $print_material_distribution_id == null){
                    $value1 = 1; $value2 = 0; }
                else{ $value1 = 0;  $value2 = 1; }
                ?>

                <label>
                    <input type="radio" name="print-distribution-material" value="{{$value1}}" class="" id="step-no" {{$value1==1?"checked":""}}> &nbsp; No
                </label>
                <label>
                    <input type="radio" name="print-distribution-material" value="{{$value2}}" class="btn-next" id="last_step" {{$value2==1?"checked":""}}> &nbsp; Yes
                </label>
            </div>
        </div>
    </div>

    {{--3rd Step of the form--}}
    <div class="container pages new_order font-droid step-three" style="display: none">

        <div class="col-sm-12">
            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div class="col-sm-12">
                    <p>Please select below from the total print material above what quantity will be used for distribution to your specified location (Remainder will be sent to you the agency)</p>
                </div>
            </div>

            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div class="col-sm-12">
                    {!! Form::label('quantity', 'Select Quantity :', []) !!}
                    {{--<small class="required">(Required)</small>--}}
                    {!! Form::select('quantity', array(''=>'Select Quantity','1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5'), isset($quantity)?$quantity:null, ['class' => 'form-control','title'=>'select Quantity']) !!}
                </div>
            </div>
            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div class="col-sm-12">
                    {!! Form::label('is_surrounded', 'location of distribution in the surrounding the property :', ['class' => 'control-label']) !!}<br>
                    <label>
                        <input type="radio" name="is_surrounded" value="1" {{$is_surrounded==1?"checked":"checked"}} > &nbsp; No
                    </label>
                    <label>
                        <input type="radio" name="is_surrounded" value="2" {{$is_surrounded==2?"checked":""}}  > &nbsp; Yes
                    </label>

                </div>
            </div>

            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div class="col-sm-12">
                    {!! Form::label('other_address', 'Other (address point, distributed in the radius) : ', []) !!}
                    {!! Form::text('other_address', isset($other_address)?$other_address:null, ['id'=>'other_address', 'class' => 'form-control','title'=>'Write Other Address']) !!}
                </div>
            </div>

            <div class="col-sm-12">
                {!! Form::label('date', 'Preferred date of distribution (please not distribution date is subject to Australia post approval, please ensure to allow sometime for booking dates) :', []) !!}
                <div class="input-group date">
                    {!! Form::text('date_of_distribution', isset($date_of_distribution)?$date_of_distribution:null, ['id'=>'date_id','class' => 'bs-datepicker-component form-control','title'=>'select date']) !!}
                    {{--<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>--}}
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div class="col-sm-12">
                    {!! Form::label('note', 'Note :', ['class' => 'control-label']) !!}
                    {!! Form::textarea('note', isset($print_metal_dist_note)?$print_metal_dist_note:null,['size' => '6x10','title'=>'Type Note','id'=>'note','placeholder'=>'Write Note here..','spellcheck'=>'true','class' => 'form-control text-left']) !!}
                </div>
            </div>
        </div>
    </div>


    {{--4th Step of the form--}}

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
                    {!! Form::textarea('property_note', null,['size' => '6x10','title'=>'Type Note','id'=>'note','placeholder'=>'Write Note here..','spellcheck'=>'true','class' => 'form-control text-left']) !!}
                </div>
            </div>
        </div>
    </div>

    {{--If choose No--}}
    <div class="container pages new_order font-droid step-no-submit">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="col-sm-12 center" id="submit_button">
                    <br>
                    {!! Form::submit('Order now', ['class' => 'btn btn new_button','data-placement'=>'top','data-content'=>'click place order button']) !!}&nbsp;
                </div>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
    @if($errors->any())
        <script type="text/javascript">
            $(function(){
                alert('sdkjf');
                $("#addData").modal('show');
            });
        </script>
    @endif
    @include('main::order._script')

    {{--material_distribution_id--}}
    <script type="text/javascript">
        $(function(){
            var mat_id = document.getElementById('material_distribution_id').value;
            if(mat_id != ''){
                $(".step-three").fadeIn();
                $(".step-no-submit").fadeIn();
            }else{
                $(".step-three").fadeOut();
                $(".step-no-submit").fadeIn();
            }
        });
    </script>

@stop