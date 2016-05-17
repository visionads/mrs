@extends('admin::layouts.master');
@section('content')


        <!-- page start-->

<div class="form-group" id="back_button">
    <a class="btn" href="{{route('settings')}}">
        <strong>Back To Settings</strong>
    </a>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading gray-bg">
                <span class="panel-title">{{ $pageTitle }}</span>

                <a class="btn btn-primary btn-sm pull-right pop" data-toggle="modal" href="#addData" data-placement="left" data-content="click to add new Media">
                    <strong><span class="glyphicon glyphicon-plus"></span> Add New Media</strong>
                </a>
            </div>

            <div class="panel-body">
                <!--Search Form-->
                <div class="">
                    {!! Form::open(['method'=>'GET','route'=>'solution-type-search','class'=>'form-inline']) !!}

                    {!! Form::text('title', @Input::get('title')? Input::get('title') : null,['title'=>'Type your required media Title','id'=>'title','class' => 'form-control text-left','placeholder'=>'Title']) !!}
                    {!! Form::text('url', @Input::get('url')? Input::get('url') : null,['title'=>'Type your required description','id'=>'description','class' => 'form-control text-left','placeholder'=>'description']) !!}
                    {!! Form::submit('Search', ['class' => 'btn btn-primary btn-sm','data-placement'=>'top','data-content'=>'click to Search']) !!}

                    {!! Form::close() !!}
                </div>
                <!-- Search Form End -->

                <!-- Table -->
                <div class="table-primary">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered size-13" id="example">
                        <thead>
                        <tr class="bg-primary">
                            <th>Title</th>
                            <th>Description</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(isset($data))
                            @foreach($data as $row)
                                <tr class="gradeX">
                                    <td>{{ $row->title }}</td>
                                    <td>{{ $row->url }}</td>

                                    <td>
                                        <a href="{{ route('digital-media-view', $row->id ) }}" class="btn btn-info btn-sm" data-placement="top" data-toggle="modal" data-target="#etsbModal" data-content="view"><i class="glyphicon glyphicon-eye-open"></i></a>
                                        <a href="{{ route('digital-media-edit', $row->id ) }}" class="btn btn-primary btn-sm" data-placement="top" data-toggle="modal" data-target="#etsbModal" data-content="update"><i class="glyphicon glyphicon-edit"></i></a>
                                        <a href="{{ route('digital-media-delete', $row->id) }}" class="btn btn-danger btn-sm" data-placement="top" onclick="return confirm('Are you sure to Delete?')" data-content="delete"><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>

                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
                <!-- Table End -->
                <span class="pull-left size-13 paginate-right-top-40">{!! str_replace('/?', '?', $data->render()) !!}</span>
            </div>
        </div>
    </div>
</div>
<!-- page end-->

<div id="addData" class="modal fade" tabindex="" role="dialog" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="click x button for close this entry form">×</button>
                <h4 class="modal-title" id="myModalLabel">Add : {{ $pageTitle }} </h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['method'=>'GET', 'route'=>'digital-media-store','class' => '','id' => 'jq-validation-form']) !!}
                @include('admin::digital_media._form')
                {!! Form::close() !!}

            </div> <!-- / .modal-body -->
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div>
<!-- modal -->

<!-- Modal  -->
<div class="modal fade" id="etsbModal" tabindex="" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        </div>
    </div>
</div>
<!-- modal -->
{{--<script type="text/javascript" src="{{ URL::asset('assets/js/jquery-1.12.0.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery-ui.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>--}}
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