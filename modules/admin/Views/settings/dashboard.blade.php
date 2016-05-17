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
                            <a class="btn" href="#">
                                <strong>Quote Number / Order Number</strong>
                            </a>
                        </div>

                        <br>

                        <div class="form-group">
                            <a class="btn" href="#">
                                <strong>Invoice Number</strong>
                            </a>
                        </div>

                        <br>

                        <div class="form-group">
                            <a class="btn" href="#">
                                <strong>Transaction Number</strong>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
@stop