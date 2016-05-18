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
    {!! Form::open(['method'=>'GET','route'=>'place-order-store']) !!}
    {{--1st Step of the form--}}
    <div id="step-one" class="container pages new_order font-droid step-one">
        <div class="col-md-12">
            <div class="col-sm-12" id="new_order_title"><span class="label size-25">{{ $pageTitle }}</span><br><br></div>
        </div>
        <div class="col-md-12">
            {{--Left pan--}}
            <div class="col-sm-6">

                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        <p>Details will be used to for all marketing marterial unless specified.
                            If you wish to have details other then stated here please specify in the “note”
                            space provided. (please ensure to check all details are correct)</p>
                    </div>
                </div>
                {!! Form::hidden('quote_id',$quote_id, ['class'=>'coa-id-val']) !!}
                {!! Form::hidden('property_detail_id',$property_id, ['class'=>'coa-id-val']) !!}
                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('main_selling_line', 'Main selling line:', []) !!}
                        {!! Form::text('main_selling_line', Input::old('main_selling_line'), ['id'=>'main_selling_line', 'placeholder'=>'Main selling line', 'class' => 'form-control','maxlength'=>'64','title'=>'enter main selling line','required']) !!}
                    </div>
                </div>

                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('property_description', 'Property description :', ['class' => 'control-label']) !!}
                        {!! Form::textarea('property_description', Input::old('property_description'),['size' => '6x10','title'=>'Type property description','id'=>'property_description','placeholder'=>'property description here..','spellcheck'=>'true','class' => 'form-control text-left']) !!}
                    </div>
                </div>

                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('date', 'Inspection dates and times :', []) !!}
                        <div class="input-group date">
                            {!! Form::text('inspection_date', @$generate_voucher_number? date('Y/m/d') : @$data[0]['inspection_date'], ['id'=>'date_id','placeholder'=>'Click here to choose Date','class' => 'bs-datepicker-component form-control','required','title'=>'select date']) !!}
                            {{--<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>--}}
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>

                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('inspection_features', 'General features, Number Bedrooms, bathrooms, Garage ECT :', ['class' => 'control-label']) !!}
                        {!! Form::textarea('inspection_features', Input::old('inspection_features'),['size' => '6x5','title'=>'Type inspection features','id'=>'inspection_features','placeholder'=>'inspection features here..','spellcheck'=>'true','class' => 'form-control text-left']) !!}
                    </div>
                </div>

            </div>

            {{--Right Pan--}}
            <div class="col-sm-6" id="submit_button_div">
                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('other_features', 'Other Features:', []) !!}
                        {!! Form::text('other_features', Input::old('other_features'), ['id'=>'other_features', 'class' => 'form-control','placeholder'=>'Other Features','title'=>'enter other features']) !!}
                    </div>
                </div>

                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('selling_price', 'selling Price:', []) !!}
                        {!! Form::input('number','selling_price', Input::old('selling_price'), ['id'=>'selling_price', 'class' => 'form-control','placeholder'=>'Numeric Value only e.g.- 1100','title'=>'enter selling price']) !!}
                    </div>
                </div>

                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('auction_time', 'Auction times:', []) !!}
                        {!! Form::text('auction_time', Input::old('auction_time'), ['id'=>'auction_time', 'class' => 'form-control', 'placeholder'=>'e.g.- 20 days','title'=>'enter auction time']) !!}
                    </div>
                </div>

                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('offer', 'Offer:', []) !!}
                        {!! Form::text('offer', Input::old('offer'), ['id'=>'offer', 'class' => 'form-control', 'placeholder'=>'Offer','maxlength'=>'64','title'=>'enter offer']) !!}
                    </div>
                </div>

                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('note', 'Note :', ['class' => 'control-label']) !!}
                        {!! Form::textarea('note', Input::old('note'),['size' => '6x13','title'=>'Type note','id'=>'note','placeholder'=>'Note here..','spellcheck'=>'true','class' => 'form-control text-left']) !!}
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
        <hr>
        <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
            <div class="col-md-12">
                <div class="col-sm-12" id="new_order_title"><span class="label size-18">DISTRIBUTION OF PRINT MATERIAL</span><br><br></div>
            </div>
            <div class="col-sm-12">
                <h4 style="color:#f31f21">Will you require distribution of print material </h4>
                <label>
                    <input type="radio" name="print-distribution-material" value="1" class="" id="step-no"> &nbsp; No
                </label>
                <label>
                    <input type="radio" name="print-distribution-material" value="0" class="btn-next" id="last_step"> &nbsp; Yes
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
                    {!! Form::select('quantity', array(''=>'Quantity','1'=>'1','2'=>'2'),Input::old('quantity'),['class' => 'form-control','title'=>'select Quantity']) !!}
                </div>
            </div>
            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div class="col-sm-12">
                    {!! Form::label('is_surrounded', 'location of distribution in the surrounding the property :', ['class' => 'control-label']) !!}<br>
                    <label>
                        <input type="radio" name="is_surrounded" value="1" > &nbsp; No
                    </label>
                    <label>
                        <input type="radio" name="is_surrounded" value="2" > &nbsp; Yes
                    </label>
                </div>
            </div>

            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div class="col-sm-12">
                    {!! Form::label('other_address', 'Other (address point, distributed in the radius) : ', []) !!}
                    {!! Form::text('other_address', Input::old('other_address'), ['id'=>'other_address', 'class' => 'form-control','title'=>'Write Other Address']) !!}
                </div>
            </div>

            <div class="col-sm-12">
                {!! Form::label('date', 'Preferred date of distribution (please not distribution date is subject to Australia post approval, please ensure to allow sometime for booking dates) :', []) !!}
                <div class="input-group date">
                    {!! Form::text('date_of_distribution', @$generate_voucher_number? date('Y/m/d') : @$data[0]['date'], ['id'=>'date_id','class' => 'bs-datepicker-component form-control','title'=>'select date']) !!}
                    {{--<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>--}}
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                </div>
            </div>
            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div class="col-sm-12">
                    {!! Form::label('note', 'Note :', ['class' => 'control-label']) !!}
                    {!! Form::textarea('note', Input::old('note'),['size' => '6x10','title'=>'Type Note','id'=>'note','placeholder'=>'Write Note here..','spellcheck'=>'true','class' => 'form-control text-left']) !!}
                </div>
            </div>

            {{--<div class="form-group">
                --}}{{--<div class="col-sm-12" id="submit_button">
                    <a href="{{ route('place-order') }}" class="btn new_button">Place Order</a>
                </div>--}}{{--
                <div class="col-sm-12" id="submit_button">
                    {!! Form::submit('Place Order', ['class' => 'btn btn new_button','data-placement'=>'top','data-content'=>'click place order button']) !!}&nbsp;
                </div>
            </div>--}}

        </div>
    </div>

    {{--If choose No--}}
    <div class="container pages new_order font-droid step-no-submit">
        <div class="col-sm-12">
            <div class="form-group">
                <div class="col-sm-12 center" id="submit_button">
                    {!! Form::submit('Place Order', ['class' => 'btn btn new_button','data-placement'=>'top','data-content'=>'click place order button']) !!}&nbsp;
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

@stop