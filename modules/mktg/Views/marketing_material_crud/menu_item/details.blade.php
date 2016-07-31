@extends('admin::layouts.master')
@section('content')
{{--<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>--}}


        <!-- page start-->

{{--<div class="form-group" id="back_button2">
    <a class="btn" href="{{route('settings')}}">
        <strong>Back To Settings</strong>
    </a>
</div>--}}

<div class="row">
    <div class="col-sm-12">
        <div class="panel">

            <div class="panel-heading gray-bg">
                <span class="panel-title">{{ $pageTitle }}</span>

                <a class="btn btn-default btn-sm pull-right pop" data-toggle="modal" href="{{ route('mktg-menu-item') }}" data-placement="left" data-content="click to add new Solution">
                    <strong><span class="glyphicon glyphicon-arrow-left"></span> Back to Marketing Menu Item</strong>
                </a>
            </div>


            <div class="panel-body">
                <div style="padding: 10px;">
                    <table id="" class="table table-hover table-striped">
                        <h4 class="text-center">Marketing Menu Item</h4>

                        <tr>
                            <td class="col-lg-7">
                                <table class="table  table-hover table-striped" >
                                    <tr>
                                        <th class="col-lg-2">Title</th>
                                        <td class="col-lg-2 text-center">:</td>
                                        <td class="col-lg-8">{{ isset($data->title) ? $data->title:'' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Slug</th>
                                        <td>:</td>
                                        <td>{{ isset($data->slug) ? $data->slug:'' }}</td>
                                    </tr>

                                    <tr>
                                        <th>Description</th>
                                        <td>:</td>
                                        <td>{{ isset($data->description) ? $data->description:'' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>:</td>
                                        <td>{{ isset($data->status) ? $data->status:'' }}</td>
                                    </tr>
                                </table>
                            </td>

                            <td class="col-lg-5">
                                <table class="table table-bordered table-hover table-striped" >
                                    <tr>
                                        {{--<th class="col-lg-6">Image : </th>--}}
                                        <td class="col-lg-6" colspan="3" style="background: #fff !important;">
                                            <div>
                                                {{--<a href="{{ route('print-image-show', $data[0]['id']) }}" class="btn btn-info btn-xs" data-toggle="modal" data-target="#imageView"><img src="{{ URL::to($data[0]['image_thumb']) }}" alt="{{$data[0]['image_path']}}" /></a>--}}
                                                @if(isset($data->relMktgMenuItemImage[0]['image']))
                                                    <img src="{{ URL::to($data->relMktgMenuItemImage[0]['image']) }}" class="img-rounded" style="width: auto; max-width: 100%">
                                                @else
                                                    <h1>No Image Available</h1>
                                                @endif
                                            </div>

                                            @if(isset($data->relMktgMenuItemImage))
                                                <div class="row" style="margin-top: 10px;">
                                                    @foreach($data->relMktgMenuItemImage as $imgdata)
                                                        <div class="col-sm-4">
                                                            <img src="{{ URL::to($imgdata->image) }}" class="img-rounded" style="width: auto; max-width:100%; margin-bottom: 5px;">
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>




                    </table>

                    @if(count($data->relMktgItemOption)>0)

                        <h4 class="text-left-header">Marketing Menu Options</h4>

                        <div class="table-primary">
                            <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="jq-datatables-example">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Type</th>
                                    <th>Icont</th>
                                    <th width="100">Image</th>
                                    <th width="100">Status</th>
                                    <th width="30">Value</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(@$data->relMktgItemOption)
                                    @foreach($data->relMktgItemOption as $values )
                                        <tr class="gradeX">
                                            <td>{{$values->title }}</td>
                                            <td>{{$values->slug }}</td>
                                            <td>{{$values->type }}</td>
                                            <td><span class="{{ $values->icon }}"></span></td>
                                            <td>
                                                @if(isset($values->image))
                                                    <img src="{{ URL::to($values->image) }}" width="80" height="60">
                                                @else
                                                    <h5>No Image</h5>
                                                @endif
                                            </td>
                                            <td>{{ $values->status }}</td>
                                            <td>
                                                <a href="{{ route('mktg-item-option-add-value', $values->id) }}" class="btn btn-primary btn-xs" data-placement="top" data-toggle="modal" data-target="#etsbModal" data-content="Add Value"><i class="glyphicon glyphicon-plus "></i> Add / <i class="glyphicon glyphicon-edit "></i> Edit</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page end-->

<!-- modal -->


<!-- Modal  -->

<div class="modal fade" id="etsbModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">


        </div>
    </div>
</div>
<!-- modal -->

<div class="modal fade" id="imageView" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="background-color: #1a1a1a; margin: 0 auto; opacity: 0.9">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">


        </div>
    </div>
</div>



<!--script for this page only-->
@if($errors->any())
    <script type="text/javascript">
        $(function(){
            $("#addData").modal('show');
        });

    </script>


@endif


@stop