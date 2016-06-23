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

                        <p class="size-13">
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

                        <table class="size-13" style="background:none !important; color:#d0d0d0;">
                            <tr><td width="auto" >+ Photography {!! ($photography_package_str!=='')?'[<span class="items"> '.$photography_package_str.' </span>]':'' !!}</td><td width="20">:</td><td>$ {{ number_format($photography_price,2) }}</td></tr>
                            <tr><td>+ Signboard Package {!! ($signboard_package_str!=='')?'[<span class="items"> '.$signboard_package_str.' </span>]':'' !!}</td><td>:</td><td>$ {{ number_format($signboard_price,2) }}</td></tr>
                            <tr><td>+ Print Material {!! ($print_material_str!=='')?'[<span class="items"> '.$print_material_str.' </span>]':'' !!}</td><td>:</td><td>$ {{ number_format($print_material_price,2) }}</td></tr>
                            <tr><td>+ Distribution of Print Material</td><td>:</td><td>$ 0.00 {{--{{ number_format($print_material_price,2) }}--}}</td></tr>
                            <tr><td>+ Digital Media</td><td>:</td><td>$ 0.00{{--{{ number_format($print_material_price,2) }}--}}</td></tr>
                            <tr style="border-bottom: 3px double #909090;"><td>+ Local Media {!! ($local_media_str!=='')?'[<span class="items"> '.$local_media_str.' </span>]':'' !!}</td><td>:</td><td>$ {{ number_format($local_media_price,2) }}</td></tr>
                            <tr style="font-weight: bold;"><td style="text-align: right">Total&nbsp;</td><td>:</td><td>$ {{ number_format($total,2) }}</td></tr>
                        </table>
                    </div>

            </div>


            <div class="col-sm-6 text-right">
                <h2 style="color:#f36f21">Total : $ {{ (isset($total))?number_format($total,2):'0.00' }}</h2>
                <h2 style="color:#f36f21">GST : $ {{ (isset($gst))?number_format($gst,2):'0.00' }} </h2>
                <h2 style="color:#f36f21">Total COST Inc GST : $ {{ (isset($total_with_gst))?number_format($total_with_gst,2):'0.00' }} </h2>

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
                    {!! Form::text('vendor_name', $vendor_name, ['id'=>'vendor_name', 'class' => 'form-control radius-10','maxlength'=>'64','placeholder'=>'Vendor Name','title'=>'Enter Vendor Name','required']) !!}
                </div>
            </div>
            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div class="col-sm-12 new_order">
                    {!! Form::label('vendor_phone', 'Vendor Phone :', []) !!}
                    <small class="required size-13">(Required)</small>
                    {!! Form::text('vendor_phone', $vendor_phone, ['id'=>'vendor_phone', 'class' => 'form-control radius-10','maxlength'=>'64','placeholder'=>'Vendor Name','title'=>'Enter Vendor Name','required']) !!}
                </div>
            </div>

            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div>
                    @if(isset($vendor_signature_path))
                        <img src="{{ URL::to($vendor_signature_path) }}" height="100" style="margin:10px 0px 0px 15px;" class="radius-10">
                    @else
                        <div style="margin-left:15px; color:#f0ad4e;">Vendor signature is not available</div>
                    @endif
                </div>
                <div class="col-sm-12 new_order file-type">

                    {!! Form::label('vendor_signature', 'Vendor Signature :', ['class' => 'control-label']) !!}
                    <div class="upload-path-css">{!! Form::file('vendor_signature') !!}</div>
                </div>
            </div>

            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div class="col-sm-12 new_order">
                    {!! Form::label('date', 'Date :', []) !!}
                    <small class="required size-13">(Required)</small>
                    <div class="input-group date">
                        {!! Form::text('signature_date',$agent_signature_date /*@$generate_voucher_number? date('Y/m/d') : @$data[0]['signature_date']*/, ['id'=>'date_id','class' => 'bs-datepicker-component form-control','title'=>'select date','required']) !!}
                        {{--<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>--}}
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                </div>
            </div>

            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div>
                    @if(isset($agent_signature_path))
                        <img src="{{ URL::to($agent_signature_path) }}" height="100" style="margin:10px 0px 0px 15px;" class="radius-10">
                    @else
                        <div style="margin-left:15px; color:#f0ad4e;">Agent signature is not available</div>
                    @endif
                </div>
                <div class="col-sm-12 new_order file-type">
                    {!! Form::label('agent_signature', 'Agent Signature :', ['class' => 'control-label']) !!}
                    <div class="upload-path-css">{!! Form::file('agent_signature') !!}</div>
                </div>
            </div>

            <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                <div class="col-sm-12 text-right">
                    {{--{!! Form::submit('Confirmed Quote', ['class' => 'btn btn new_button','data-placement'=>'top','data-content'=>'click to confirm Agreement','onclick'=>'return confirm("Are you sure!")']) !!}&nbsp;--}}
                    {!! Form::button('Confirm',['class' => 'btn btn new_button','data-placement'=>'top','data-content'=>'click to confirm Agreement','data-toggle'=>'modal','data-target'=>'#confirmModal']) !!}

                </div>
                {{--<div class="col-sm-12" id="submit_button">
                    <a href="{{ route('payment') }}" class="btn new_button" onclick="return confirm('Are You Sure ! ')"> Confirm </a>
                </div>--}}
            </div>
        </div>
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