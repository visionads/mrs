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

                        <p class="size-13">
                            @if(isset($quote))
                                    + Quote No. : {{ $quote->quote_number }}<br>
                                    + Photography Package Comments : {{ $quote->photography_package_comments }}<br>
                                    + Signboard Package Comments : {{ $quote->signboard_package_comments }}<br>
                                    + Print Material Comments : {{ $quote->print_material_comments }}<br>
                                    + Print Material Distribution : {{ $quote->print_material_distribution_id }}<br>
                                    + Digital Media Note : {{ $quote->digital_media_note }}<br>
                                    + Local Media Note : {{ $quote->local_media_note }}<br>
                                    <?php
                                    $quote_id = $quote->id;
                                    $quote_no = $quote->quote_number;
                                    ?>

                            @endif
                        </p>
                    </div>

            </div>


            <div class="col-sm-6 text-right">
                <h2 style="color:#f36f21">Total : $ {{ $total }}</h2>
                <h2 style="color:#f36f21">GST : $ {{ $gst }} </h2>
                <h2 style="color:#f36f21">Total COST Inc GST : $ {{ $total_with_gts }} </h2>

                <a href="{{ route('quote-list') }}" class="btn new_button ">Back To Quote</a>&nbsp;
                {{--<a href="{{ route('quote-confirm', ['quote_id'=>$quote_id, 'quote_no'=>$quote_no ]) }}" class="btn new_button ">Proceed to Confirm</a>--}}
                <button class="proceed-to-confirm btn new_button" data-placement="top" data-content="Click here to Proceed Confirm "> Proceed to Confirm </button>
            </div>
        </div>
        </div>
    </div>

     {{--Agreement page--}}
    <div class="container agreement" style="display:none">

    {!! Form::open(['route' => 'place-order', 'method' => 'post','id' => 'jq-validation-form']) !!}

    {!! Form::hidden('quote_id', $quote_id) !!}
    {!! Form::hidden('quote_no', $quote_no) !!}
    <div class="row">
        <div class="col-sm-12" id="new_order_title">
            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t-">
                <div class="col-sm-12">
                    <hr>
                    <span class="label size-25">Agreement</span><br><br>
                </div>
            </div>
        </div>
        <div class="col-sm-12" id="submit_button_div">
            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t-">
                <div class="col-sm-12">
                    <p style="color:#f36f21;">Vendor Acknowledgment  : I Hereby agree to the outlined marketing campaign above</p>
                </div>
            </div>

            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div class="col-sm-12 new_order">
                    {!! Form::label('vendor_name', 'Vendor Name :', []) !!}
                    <small class="required size-13">(Required)</small>
                    {!! Form::text('vendor_name', Input::old('vendor_name'), ['id'=>'vendor_name', 'class' => 'form-control radius-10','maxlength'=>'64','placeholder'=>'Vendor Name','title'=>'Enter Vendor Name','required']) !!}
                </div>
            </div>
            {{--<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div class="col-sm-12">
                    {!! Form::label('vendor_email', 'Vendor Email :', []) !!}
                    {!! Form::email('vendor_email', Input::old('vendor_email'), ['id'=>'vendor_email', 'class' => 'form-control radius-10','maxlength'=>'64','placeholder'=>'Vendor Name','title'=>'Enter Vendor Name']) !!}
                </div>
            </div>--}}
            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div class="col-sm-12 new_order">
                    {!! Form::label('vendor_phone', 'Vendor Phone :', []) !!}
                    <small class="required size-13">(Required)</small>
                    {!! Form::text('vendor_phone', Input::old('vendor_phone'), ['id'=>'vendor_phone', 'class' => 'form-control radius-10','maxlength'=>'64','placeholder'=>'Vendor Name','title'=>'Enter Vendor Name','required']) !!}
                </div>
            </div>

            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div class="col-sm-12 new_order">
                    {!! Form::label('vendor_signature', 'Vendor Signature :', ['class' => 'control-label']) !!}
                    {!! Form::textarea('vendor_signature', Input::old('vendor_signature'),['size' => '6x3','title'=>'Vendor Signature','id'=>'description','placeholder'=>'Vendor Signature here..','spellcheck'=>'true','class' => 'form-control radius-10']) !!}
                </div>
            </div>

            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div class="col-sm-12 new_order">
                    {!! Form::label('date', 'Date :', []) !!}
                    <small class="required size-13">(Required)</small>
                    <div class="input-group date">
                        {!! Form::text('signature_date', @$generate_voucher_number? date('Y/m/d') : @$data[0]['signature_date'], ['id'=>'date_id','class' => 'bs-datepicker-component form-control','title'=>'select date','required']) !!}
                        {{--<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>--}}
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
            </div>

            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div class="col-sm-12 new_order">
                    {!! Form::label('agent_signature_path', 'Agent Signature :', ['class' => 'control-label']) !!}
                    {!! Form::textarea('agent_signature', Input::old('agent_signature'),['size' => '6x2','title'=>'Agent Signature','id'=>'agent_signature','placeholder'=>'Agent Signature here..','spellcheck'=>'true','class' => 'form-control radius-10']) !!}
                </div>
            </div>

            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div class="col-sm-12 text-right">
                    {!! Form::submit('Confirmed Quote', ['class' => 'btn btn new_button','data-placement'=>'top','data-content'=>'click to confirm Agreement','onclick'=>'return confirm("Are you sure!")']) !!}&nbsp;
                </div>
                {{--<div class="col-sm-12" id="submit_button">
                    <a href="{{ route('payment') }}" class="btn new_button" onclick="return confirm('Are You Sure ! ')"> Confirm </a>
                </div>--}}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    </div>

    @include('main::order._script')

@stop