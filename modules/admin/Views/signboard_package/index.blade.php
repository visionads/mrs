@extends('admin::layouts.master')
@section('content')
{{--<script type="text/javascript" src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>--}}


        <!-- page start-->

<div class="form-group" id="back_button2">
    <a class="btn" href="{{route('settings')}}">
        <strong>Back To Settings</strong>
    </a>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="panel">

            <div class="panel-heading gray-bg">
                <span class="panel-title">{{ $pageTitle }}</span>

                <a class="btn btn-primary btn-sm pull-right pop" data-toggle="modal" href="#addData" data-placement="left" data-content="click to add new Solution">
                    <strong><span class="glyphicon glyphicon-plus"></span>Add Signboard Package</strong>
                </a>
            </div>


            <div class="panel-body">
                {{-------------- Filter :Starts -------------------------------------------}}


                {!! Form::open(['method' =>'GET','route'=>'signboard-package-search']) !!}

                <div id="index-search">
                    <div class="col-sm-3">
                        {!! Form::text('title',@Input::get('title')? Input::get('title') : null,['class' => 'form-control','placeholder'=>'Type title', 'title'=>'Type your required Role title "title", then click "search" button']) !!}
                    </div>
                    <div class="col-sm-3 filter-btn">
                        {!! Form::submit('Search', array('class'=>'btn btn-primary btn-sm pull-left pop','id'=>'button', 'data-placement'=>'right', 'data-content'=>'type code or title or both in specific field then click search button for required information')) !!}
                    </div>
                </div>

                {!! Form::close() !!}

                {{-------------- Filter :Ends -------------------------------------------}}
                <div class="table-primary">
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered size-13" id="example">

                        <thead>
                        <tr class="bg-primary">
                            <th> Title </th>
                            <th> Image Path</th>
                            <th> Action &nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-placement="top" data-content="view : click for details informations<br>update : click for update informations<br>delete : click for delete informations"></span></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($data))
                            @foreach($data as $values)
                                <tr class="gradeX">
                                    <td>{{ucfirst($values->title)}}</td>
                                    <td>
                                        <img src="{{asset($values->image_path)}}" style="width:35px;height:35px;">
                                    </td>
                                    <td>
                                        <a href="{{ route('view-signboard-package', $values->id) }}" class="btn btn-info btn-xs" data-placement="top" data-toggle="modal" data-target="#etsbModal" data-content="view"><i class="glyphicon glyphicon-eye-open"></i></a>
                                        <a href="{{ route('edit-signboard-package', $values->id) }}" class="btn btn-primary btn-xs" data-placement="top" data-toggle="modal" data-target="#etsbModal" data-content="update"><i class="glyphicon glyphicon-edit"></i></a>
                                        <a href="{{ route('delete-signboard-package', $values->id) }}" class="btn btn-danger btn-xs" data-placement="top" onclick="return confirm('Are you sure to Delete?')" data-content="delete"><i class="glyphicon glyphicon-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
                <span class="pull-left size-13 paginate-right-top-40" style="text-align: right">{!! str_replace('/?', '?', $data->render()) !!} </span>
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
                <h4 class="modal-title" id="myModalLabel">Add Signboard Package Information<span style="color: #A54A7B" class="user-guideline" data-content="<em>Must Fill <b>Required</b> Field.    <b>*</b> Put cursor on input field for more informations</em>"><font size="2"></font> </span></h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'store-signboard-package','class' => 'form-horizontal','id' => 'jq-validation-form', 'files'=>true]) !!}
                @include('admin::signboard_package._form')
                {!! Form::close() !!}
            </div> <!-- / .modal-body -->
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div>
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