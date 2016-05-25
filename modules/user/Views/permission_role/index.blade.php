@extends('admin::layouts.master')
{{--@section('sidebar')
@include('admin::layouts.sidebar')
@stop--}}

@section('content')
        <!-- form open for batch delete -->
{{--{!!  Form::open(['route' => ['delete-permission-role']]) !!}--}}

{{--{{isset($role_value)?$role_value:''}}--}}

<!-- page start-->
<div class="row" style="font-size: 13px">
    <div class="col-sm-12">
        <div class="panel">
            <div class="panel-heading">
                <span class="panel-title">{{ isset($pageTitle)?$pageTitle:'' }}</span>&nbsp;&nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-content="<em>we can show all permission in this page<br> and add new permission, update from this page</em>">(?)</span>
                <a class="btn btn-primary btn-xs pull-right pop" data-toggle="modal" href="#addData" data-placement="top" data-content="click add permission role button for new permission of a role">
                    <strong>Add New Permission Role</strong>
                </a>
                <input type="button" id="deleteBatch" class="btn btn-primary btn-xs" value="Delete Selected Permission Role" style="display: none;"  onclick="submitForm()" {{--"return confirm('Are you sure to Delete?')"--}}>
                <a class="btn btn-success btn-xs pull-right pop" href="{{route('index-permission')}}" data-placement="left" data-content="Click to redirect in permission page" style="margin-right: 10px;">
                    <strong>Go to permission page</strong>
                </a>
            </div>


            <div class="panel-body">
                {{-------------- Filter :Starts -------------------------------------------}}
                {!! Form::open(['method' =>'GET','route'=>'search-permission-role']) !!}
                <div id="index-search">
                    <div class="col-sm-3">
                        {!! Form::Select('role_id',($role_id), @Input::get('role_id')? Input::get('role_id') : null,['class' => 'form-control', 'title'=>'select your require "role", example :: admin, then click "search" button']) !!}
                    </div>
                    <div class="col-sm-3">
                        {!! Form::text('permission_name',@Input::get('permission_name')? Input::get('permission_name') : null,['class' => 'form-control','placeholder'=>'Type permission name', 'title'=>'Type your require "permission name", then click "search" button']) !!}
                    </div>
                    <div class="col-sm-2 filter-btn">
                        {!! Form::submit('Search', array('class'=>'btn btn-primary btn-xs pull-left','id'=>'button', 'data-placement'=>'right', 'data-content'=>'Type role name and permission name in specific field then click search button for required information')) !!}
                    </div>
                </div>
                {!! Form::close() !!}
                <p> &nbsp;</p>
                <p> &nbsp;</p>

                {{-------------- Filter :Ends -------------------------------------------}}
                        <!-- form open for batch delete -->
                {!!  Form::open(['route' => ['delete-permission-role'], 'id' => 'formCheckbox']) !!}
                <div class="table-primary">
                    <table id="jq-datatables-example" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" >
                        <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll">&nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-placement="top" data-content="check for select permission roles delete">(?)</span></th>
                            <th> Role </th>
                            <th> Permission </th>
                            <th> Action &nbsp;&nbsp;<span style="color: #A54A7B" class="user-guideline" data-placement="top" data-content="view : click for details information<br>update : click for update information">(?)</span></th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(isset($data))
                            @foreach($data as $values)
                                <tr class="gradeX">
                                    <td><input type="checkbox" name="pr_ids[]" value="{{ $values->id }}"></td>
                                    <td>{{isset($values->r_title)?ucfirst($values->r_title):ucfirst($values->relRole->title)}}</td>
                                    <td>{{isset($values->p_title)?ucfirst($values->p_title):ucfirst($values->relPermission->title)}}</td>
                                    <td>
                                        <a href="{{ route('view-permission-role', $values->id) }}" class="btn btn-info btn-xs" data-toggle="modal" data-target="#etsbModal" data-placement="top" data-content="view"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('delete-permission-role', $values->id) }}" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure to Delete?')" data-placement="top" data-content="delete"><i class="fa fa-trash-o"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif

                        </tbody>
                    </table>
                </div>
                <!-- form close for bathc delete -->
                {!! Form::close() !!}

                <span class="pull-right">{!! str_replace('/?', '?',$data->appends(Input::except('page'))->render() ) !!} </span>
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
                <h4 class="modal-title" id="myModalLabel">Add Role To Assign Permission <span style="color: #A54A7B" class="user-guideline" data-content="<em>Must Fill <b>Required</b> Field.    <b>*</b> Put cursor on input field for more informations</em>"><font size="2">(?)</font> </span></h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route' => 'index-permission-role','id' => 'jq-validation-form']) !!}
                    @include('user::permission_role._form')
                {!! Form::close() !!}
            </div> <!-- / .modal-body -->
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div>
<!-- modal -->


<!-- Modal  -->

<div class="modal fade" id="etsbModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

        </div>
    </div>
</div>

{{--Second modal--}}

<div class="modal fade" id="Modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="click x button for close this entry form">×</button>
                <h4 class="modal-title" id="myModalLabel">Assign Permission To : {{isset($role_name)?ucfirst($role_name):''}}<span style="color: #A54A7B" class="user-guideline" data-content="<em>Must Fill <b>Required</b> Field. <b>*</b> Put cursor on input field for more informations</em>"><font size="2"></font> </span></h4>
            </div>
            <div class="modal-body">
                {!! Form::open(['route'=> ['store-permission-role']]) !!}
                @include('user::permission_role._duallistbox_form')
                {!! Form::close() !!}
            </div> <!-- / .modal-body -->
        </div> <!-- / .modal-content -->
    </div> <!-- / .modal-dialog -->
</div>



<!-- modal -->
<script>

    $("#checkAll").change(function () {
        $("input:checkbox").prop('checked', $(this).prop("checked"));
        if($(this).prop("checked") == true){
            $("#deleteBatch").show();
        }
        else{
            $("#deleteBatch").hide();
        }
    });
    $("table input:checkbox").on('change',function(){
        if($(this).prop("checked") == true){
            $("#deleteBatch").show();
        }
    });
    function submitForm(){
        var form = document.getElementById('formCheckbox');
        var r = confirm("Press a button!");
        if (r == true) {
            form.submit();
        } else {
            return false;
        }
    }
</script>

@if(isset($exists_permission) || isset($not_exists_permission))
    @if(count($exists_permission)>0 || count($not_exists_permission)>0)
        <script type="text/javascript">
               $("#Modal2").modal('show');
        </script>
    @endif
@endif


@stop




