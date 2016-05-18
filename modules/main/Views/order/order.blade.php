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


    <div id="container" class="container pages new_order font-droid">
        <div class="col-md-12">
            <div class="col-sm-12" id="new_order_title"><span class="label size-25">{{ $pageTitle }}</span><br><br></div>
        </div>
        <div class="col-md-12">
            <div class="col-sm-6">
                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        <h1 class="size-20">Details of the order summary</h1>
                        <style>
                            .commtable tr td { background:#303030; color:#d0d0d0; border-bottom: 1px solid #404040 !important;}
                        </style>
                        <table class="table table-striped size-13 commtable">
                            {{--@if(isset($data_pd))
                                @foreach($data_pd as $row_pd)
                                    <tr><td>Main Selling Line</td><td>:</td><td>{{ $row_pd->main_selling_line }}</td></tr>
                                    <tr><td>Property Description</td><td>:</td><td>{{ $row_pd->property_description }}</td></tr>
                                    <tr><td>Inspection Date</td><td>:</td><td>{{ $row_pd->inspection_date }}</td></tr>
                                    <tr><td>Inspection Features</td><td>:</td><td>{{ $row_pd->inspection_features }}</td></tr>
                                    <tr><td>Other Features</td><td>:</td><td>{{ $row_pd->other_features }}</td></tr>
                                    <tr><td>Selling Price</td><td>:</td><td>{{ $row_pd->selling_price }}</td></tr>
                                    <tr><td>Auction Time</td><td>:</td><td>{{ $row_pd->auction_time }}</td></tr>
                                    <tr><td>Offer</td><td>:</td><td>{{ $row_pd->offer }}</td></tr>
                                    <tr><td>Note</td><td>:</td><td>{{ $row_pd->note }}</td></tr>
                                @endforeach
                            @endif
                                <tr><td colspan="3" class="center">Print Material Distribution </td></tr>
                            @if(isset($data_pmd))
                                @foreach($data_pmd as $row_pmd)
                                    <tr><td>Quantity</td><td>:</td><td>{{ $row_pmd->quantity }}</td></tr>
                                    <tr><td>Is Surrounded</td><td>:</td><td>{{ $row_pmd->is_surrounded }}</td></tr>
                                    <tr><td>Other Address</td><td>:</td><td>{{ $row_pmd->other_address }}</td></tr>
                                    <tr><td>Date of Distribution</td><td>:</td><td>{{ $row_pmd->date_of_distribution }}</td></tr>
                                    <tr><td>Note</td><td>:</td><td>{{ $row_pmd->note }}</td></tr>
                                @endforeach
                            @endif--}}

                        </table>

                        <h2 style="color:#f36f21">Total: $1234</h2>
                        <h2 style="color:#f36f21">GST:$</h2>
                        <h2 style="color:#f36f21">Total COST Inc GST: $</h2>
                        <a href="{{ route('property-details') }}" class="btn new_button"> <span class="glyphicon glyphicon-edit"></span> &nbsp; Edit</a>
                    </div>
                </div>
            </div>

            {!! Form::open(['route' => 'agreement', 'method' => 'post','id' => 'jq-validation-form']) !!}
            <div class="col-sm-6" id="submit_button_div">
                <p style="color:#f36f21;">Vendor Acknowledgment  : I Hereby agree to the outlined marketing campaign above</p>
                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('vendor_name', 'Vendor Name :', []) !!}
                        {!! Form::text('vendor_name', Input::old('vendor_name'), ['id'=>'vendor_name', 'class' => 'form-control radius-10','maxlength'=>'64','placeholder'=>'Vendor Name','title'=>'Enter Vendor Name']) !!}
                    </div>
                </div>
                {{--<div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('vendor_email', 'Vendor Email :', []) !!}
                        {!! Form::email('vendor_email', Input::old('vendor_email'), ['id'=>'vendor_email', 'class' => 'form-control radius-10','maxlength'=>'64','placeholder'=>'Vendor Name','title'=>'Enter Vendor Name']) !!}
                    </div>
                </div>--}}
                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('vendor_phone', 'Vendor Phone :', []) !!}
                        {!! Form::text('vendor_phone', Input::old('vendor_phone'), ['id'=>'vendor_phone', 'class' => 'form-control radius-10','maxlength'=>'64','placeholder'=>'Vendor Name','title'=>'Enter Vendor Name']) !!}
                    </div>
                </div>

                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('vendor_signature', 'Vendor Signature :', ['class' => 'control-label']) !!}
                        {!! Form::textarea('vendor_signature', Input::old('vendor_signature'),['size' => '6x3','title'=>'Vendor Signature','id'=>'description','placeholder'=>'Vendor Signature here..','spellcheck'=>'true','class' => 'form-control radius-10']) !!}
                    </div>
                </div>

                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('date', 'Date :', []) !!}
                        <div class="input-group date">
                            {!! Form::text('signature_date', @$generate_voucher_number? date('Y/m/d') : @$data[0]['signature_date'], ['id'=>'date_id','class' => 'bs-datepicker-component form-control','title'=>'select date']) !!}
                            {{--<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>--}}
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        </div>
                    </div>
                </div>

                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        {!! Form::label('agent_signature_path', 'Agent Signature :', ['class' => 'control-label']) !!}
                        {!! Form::textarea('agent_signature', Input::old('agent_signature'),['size' => '6x2','title'=>'Agent Signature','id'=>'agent_signature','placeholder'=>'Agent Signature here..','spellcheck'=>'true','class' => 'form-control radius-10']) !!}
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-12" id="submit_button">
                        {!! Form::submit('Confirm Quote', ['class' => 'btn btn new_button','data-placement'=>'top','data-content'=>'click to confirm Agreement','onclick'=>'return confirm("Are you sure!")']) !!}&nbsp;
                    </div>
                    {{--<div class="col-sm-12" id="submit_button">
                        <a href="{{ route('payment') }}" class="btn new_button" onclick="return confirm('Are You Sure ! ')"> Confirm </a>
                    </div>--}}
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