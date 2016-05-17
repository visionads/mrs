@extends('admin::layouts.master')

@section('content')


    <div id="container" class="container pages new_order font-droid">
        <div class="col-md-12">
            <div class="col-sm-12" id="new_order_title"><span class="label">{{ $pageTitle }}</span></div>
        </div>

        {!! Form::open(['route' => 'store-property-detail', 'method' => 'post','id' => 'jq-validation-form']) !!}

        <div class="col-md-12">
            <div class="col-sm-6">
                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        <p>Details will be used to for all marketing marterial unless specified.
                            If you wish to have details other then stated here please specify in the “note”
                            space provided. (please ensure to check all details are correct)</p>
                    </div>
                </div>

                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('main_selling_line', 'Main selling line:', []) !!}
                        {!! Form::text('main_selling_line', Input::old('main_selling_line'), ['id'=>'main_selling_line', 'class' => 'form-control radius-10','maxlength'=>'64','title'=>'enter main selling line','required']) !!}
                    </div>
                </div>

                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('property_description', 'Property description :', ['class' => 'control-label']) !!}
                        {!! Form::textarea('property_description', Input::old('property_description'),['size' => '6x2','title'=>'Type property description','id'=>'property_description','placeholder'=>'property description here..','spellcheck'=>'true','class' => 'form-control radius-10 text-left']) !!}
                    </div>
                </div>

                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('inspection_date', 'Inspection dates and times:', []) !!}
                        <div class="input-group date">
                            {!! Form::text('date', @$generate_voucher_number? date('Y/m/d') : @$data[0]['inspection_date'], ['class' => 'bs-datepicker-component form-control','required','title'=>'select inspection date']) !!}
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>

                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('inspection_features', 'Genral features, Number Bedrooms, bathrooms, Garage ECT :', ['class' => 'control-label']) !!}
                        {!! Form::textarea('inspection_features', Input::old('inspection_features'),['size' => '6x3','title'=>'Type inspection features','id'=>'inspection_features','placeholder'=>'inspection features here..','spellcheck'=>'true','class' => 'form-control radius-10 text-left']) !!}
                    </div>
                </div>
            </div>

            <div class="col-sm-6" id="submit_button_div">
                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('other_features', 'Other Features:', []) !!}
                        {!! Form::text('other_features', Input::old('other_features'), ['id'=>'other_features', 'class' => 'form-control radius-10','maxlength'=>'64','title'=>'enter other features']) !!}
                    </div>
                </div>

                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('selling_price', 'selling Price:', []) !!}
                        {!! Form::text('selling_price', Input::old('selling_price'), ['id'=>'selling_price', 'class' => 'form-control radius-10','maxlength'=>'64','title'=>'enter selling price']) !!}
                    </div>
                </div>

                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('auction_time', 'Auction times:', []) !!}
                        {!! Form::text('auction_time', Input::old('auction_time'), ['id'=>'auction_time', 'class' => 'form-control radius-10','maxlength'=>'64','title'=>'enter auction time']) !!}
                    </div>
                </div>

                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('offer', 'Offer:', []) !!}
                        {!! Form::text('offer', Input::old('offer'), ['id'=>'offer', 'class' => 'form-control radius-10','maxlength'=>'64','title'=>'enter offer']) !!}
                    </div>
                </div>

                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('note', 'Note :', ['class' => 'control-label']) !!}
                        {!! Form::textarea('note', Input::old('note'),['size' => '6x4','title'=>'Type note','id'=>'note','placeholder'=>'note here..','spellcheck'=>'true','class' => 'form-control radius-10 text-left']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12" id="submit_button">
                        {!! Form::submit('Place Order', ['class' => 'btn btn new_button','data-placement'=>'top','data-content'=>'click place order button']) !!}&nbsp;
                    </div>
                </div>
            </div>
        </div>

        {!! Form::close() !!}

    </div>



    @if($errors->any())
        <script type="text/javascript">
            $(function(){
                alert('sdkjf');
                $("#addData").modal('show');

            });
        </script>
    @endif

    <script>
        // tooltip for buttons
        $(".btn").popover({ trigger: "manual" , html: true, animation:false})
                .on("mouseenter", function () {
                    var _this = this;
                    $(this).popover("show");
                    $(".popover").on("mouseleave", function () {
                        $(_this).popover('hide');
                    });
                }).on("mouseleave", function () {
                    var _this = this;
                    setTimeout(function () {
                        if (!$(".popover:hover").length) {
                            $(_this).popover("hide");
                        }
                    }, 300);
                });
        // tooltip for input field
        $(".form-control").tooltip();
    </script>

@stop