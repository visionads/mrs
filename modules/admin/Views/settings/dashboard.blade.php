@extends('admin::layouts.master')

<div style="background-image:url('{{ URL::asset("assets/user/img/chain.jpg")}}') ;height: 100%; width: 100%; ">

    @section('content')

        {{--<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>--}}

        <div class="row" id="button_heading">

            <div class="col-sm-12" id="setting_bottons"><span class="label">Settings</span></div>

            <div class="col-sm-6">
                <div class="panel1" id="button_align">
                    <div id="report-button">

                        <div class="panel-body no-padding-t text-center" id="settings_button">
                            <div class="form-group">
                                <a class="btn" href="{{route('solution-type')}}">
                                    <strong>Solution Type</strong>
                                </a>
                            </div>

                            <br>

                            <div class="form-group">
                                <a class="btn" href="{{route('photography-package')}}">
                                    <strong>Photography Package and Options</strong>
                                </a>
                            </div>

                            <br>

                            <div class="form-group">
                                <a class="btn" href="{{route('print-material')}}">
                                    <strong>Print Material and Sizes</strong>
                                </a>
                            </div>


                            <br>

                            <div class="form-group">
                                <a class="btn" href="{{route('signboard-package')}}">
                                    <strong>Signboard Package and Sizes</strong>
                                </a>
                            </div>

                            <br>

                            <div class="form-group">
                                <a class="btn" href="{{route('digital-media')}}">
                                    <strong>Digital Media</strong>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="panel1" id="button_align">
                    <div id="report-button">

                        <div class="panel-body no-padding-t text-center" id="settings_button">

                            <div class="form-group">
                                <a class="btn" href="{{route('local-media')}}">
                                    <strong>Local Media and Options</strong>
                                </a>
                            </div>

                            <br>

                            <div class="form-group">
                                <a class="btn" href="{{ route('quote-invoice-settings') }}">
                                    <strong>Quote Number / Order Number</strong>
                                </a>
                            </div>

                            <br>

                            <div class="form-group">
                                <a class="btn" href="{{ route('quote-invoice-settings') }}">
                                    <strong>Invoice Number</strong>
                                </a>
                            </div>

                            <br>

                            <div class="form-group">
                                <a class="btn" href="{{ route('quote-invoice-settings') }}">
                                    <strong>Transaction Number</strong>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <hr>


        {{--Settings Part-2 Start Here--}}
        <div class="row" id="button_heading">

        <div class="col-sm-12" id="setting_bottons"><span class="label green-yellow">Settings(Part-2)</span></div>

        <div class="col-sm-6">
            <div class="panel1" id="button_align">
                <div id="report-button">

                    <div class="panel-body no-padding-t text-center" id="settings_button_one">
                        <div class="form-group">
                            <a class="btn" href="{{route('mktg-menu-item')}}">
                                <strong>Marketing Material Menu Item</strong>
                            </a>
                        </div>

                        {{--<div class="form-group">
                            <a class="btn" href="{{route('photography-package')}}">
                                <strong>Menu Name</strong>
                            </a>
                        </div>--}}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="panel1" id="button_align">
                <div id="report-button">

                    <div class="panel-body no-padding-t text-center" id="settings_button_two">

                        {{--<div class="form-group">
                            <a class="btn" href="{{route('local-media')}}">
                                <strong>Local Media and Options</strong>
                            </a>
                        </div>--}}
                        {{--<div class="form-group">
                            <a class="btn" href="{{ route('quote-invoice-settings') }}">
                                <strong>Navigation button</strong>
                            </a>
                        </div>--}}

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@stop