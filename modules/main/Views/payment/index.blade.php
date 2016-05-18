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
        {{--<div class="col-md-12">
            <div class="col-sm-12" id="new_order_title"><span class="label size-25">{{ $pageTitle }}</span><br><br></div>
        </div>
        <div class="col-md-12">
            <div class="col-sm-12" id="new_order_title"><h1>PAYMENT SYSTEM</h1><p>vendors can make invoice payment using invoice number.</p></div>
        </div>
        <div class="col-md-12">
            <div class="col-sm-12" id="new_order_title">
                <a href="{{ route('invoice') }}" class="btn new_button">Submit</a>
            </div>
        </div>--}}
        <div class="row center"><h1>{{ $pageTitle }}</h1></div>
        <hr class="common-hr">
        <div class="row">
            <div class="col-sm-6 no-padding">
                <div class="form-group no-margin-hr panel-padding-h no-padding-t no-border-t">
                    <div class="col-sm-12">
                        <h1 class="size-25">Payment System</h1>

                        <p>
                            vendors can make invoice payment using invoice number.<br><br>

                            + Quote Number : 2348 <br>
                            + Invoice Number : 0008 <br>
                        </p>

                        <h2 style="color:#f36f21" class="size-20">Total: $1234</h2>
                        <h2 style="color:#f36f21" class="size-20">GST:$</h2>
                        <h2 style="color:#f36f21" class="size-20">Total COST Inc GST: $</h2>
                    </div>
                </div>
            </div>
            <style>
                .amount-bg { background:#fff; padding:5px; border-radius:3px;}
            </style>

            <div class="col-sm-6 no-padding" id="submit_button_div">
                <h2 style="color:#f12f01" class="size-25">Payment</h2>
                <p style="color:#d0d0d0; border:1px solid #202020; height:100px;" class="size-14">
                    Space for Payment
                </p>

                 {{--<div class="form-group">
                     <div class="col-sm-12" id="submit_button">
                         {!! Form::submit('Pay Now', ['class' => 'btn new_button','data-placement'=>'top','data-content'=>'click to Pay now','onclick'=>'return confirm("Are you sure!")']) !!}&nbsp;
                     </div>
                 </div>--}}
                <div class="form-group">
                    <div class="col-sm-12" id="submit_button">
                        <a href="{{ route('invoice') }}" class="btn new_button" data-placement="top" data-content="click to Pay now">Pay Now</a>
                    </div>
                </div>
            </div>
        </div>

    </div>



    @if($errors->any())
        <script type="text/javascript">
            $(function(){
                alert('sdkjf');
                $("#addData").modal('show');

            });
        </script>
    @endif

    @include('main::payment._script')

@stop