@extends('admin::layouts.master')


@section('content')
    <div class="row theme-default main-menu-animated page-profile" style="font-size: 13px">

        <div class="profile-full-name">
            <span class="text-semibold">{{isset($profile_data->first_name)?$profile_data->first_name:''}} {{isset($profile_data->middle_name)?$profile_data->middle_name:''}} {{isset($profile_data->last_name)?$profile_data->last_name:''}}</span>
        </div>
        <div class="profile-row">
            <div class="left-col">
                <div class="profile-block">
                    <div class="panel profile-photo">
                        {{--<img src="{{ URL::to('/assets/img/avatar1.jpg') }}" alt="">--}}
                        @if(isset($user_image))
                            <img src="{{ URL::to($user_image->thumbnail) }}">
                        @else
                            <img src="{{ URL::to('/assets/img/default.jpg') }}" width="100px" height="100px">
                        @endif
                    </div>
                    <br>
                    @if(isset($user_image))
                    <a href="{{route('edit-profile-image',$user_image->id)}}" class="btn btn-primary btn-xs" data-placement="top" data-toggle="modal" data-target="#editImageModal">Edit Picture</a>
                    @else
                        <a data-toggle="modal" href="#addImageModal" class="btn btn-primary btn-xs" data-placement="top" data-toggle="modal" >Add Picture</a>
                    @endif
                   <p>&nbsp;</p>
                </div>

                <div class="panel panel-transparent">
                    <div class="panel-heading">
                        <span class="panel-title">Information</span>
                    </div>
                    <div class="list-group">
                        <a href="#" class="list-group-item"><i class="profile-list-icon fa fa-ticket" style="color: #4ab6d5"></i> {{$user->username}}</a>
                        <a href="#" class="list-group-item"><i class="profile-list-icon fa fa-i-cursor" style="color: #1a7ab9"></i> {{$user->ip_address}}</a>
                        <a href="#" class="list-group-item"><i class="profile-list-icon fa fa-envelope" style="color: #888"></i> {{isset($user->email)?$user->email:''}}</a>
                    </div>
                </div>

            </div>
            <div class="right-col">

                <hr class="profile-content-hr no-grid-gutter-h">

                <div class="profile-content">

                    <ul id="profile-tabs" class="profile-nav">
                        <li class="active"><a href="{{route('user-profile')}}" data-target="#profile" class="media_node" id="new_tab" data-toggle="ajax-tab" rel="tooltip">Profile</a></li>
                        {{--<li><a href="{{route('account-user')}}" data-target="#acc-settings" class="media_node" id="replied_tab" data-toggle="ajax-tab" rel="tooltip">Account Settings</a></li>--}}
                        <li>
                            <a class="media_node" data-toggle="modal" href="#passwordModal" data-placement="left" data-content="Account Settings" >
                                <strong>Account Settings</strong>
                            </a>
                        </li>
                    </ul>

                    <div class="clearfix">&nbsp;</div>
                    <div class="tab-content tab-content-bordered panel-padding no-bg">

                        <div class="tab-pane active" id="profile">
                        </div>

                        <div class="tab-pane" id="meta">
                            <a class="btn btn-primary btn-xs pull-right pop" data-toggle="modal" href="#addMeta" data-placement="left" data-content="click add profile button to add">
                                <strong>Add Meta Information</strong>
                            </a>
meta
                        </div>
                        <div class="tab-pane" id="acc-settings">
account
                        </div>
                    </div> <!-- / .tab-content -->
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(window).load(function() {
                $.ajax({
                    url : 'user-info/profile',
                    dataType: 'json'
                }).done(function (data) {
                    $('#profile').html(data);
                }).fail(function () {
//                    alert('Posts could not be loaded.');
                    return false;
                });
            });

        });
</script>

    <div id="addProfile" class="modal fade" tabindex="" role="dialog" style="display: none;">
        <div class="modal-dialog modal-lg" style="z-index: 1050">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="click x button for close this entry form">×</button>
                    <h4 class="modal-title" id="myModalLabel">Add Profile Informations <span style="color: #A54A7B" class="user-guideline" data-content="<em>Must Fill <b>Required</b> Field.    <b>*</b> Put cursor on input field for more informations</em>"><font size="2">(?)</font> </span></h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'store-user-profile','id' => 'jq-validation-form','files'=>'true']) !!}
                    @include('user::user_info.profile._form')
                    {!! Form::close() !!}
                </div> <!-- / .modal-body -->
            </div> <!-- / .modal-content -->
        </div> <!-- / .modal-dialog -->
    </div>
    <!-- modal -->

    <div id="addMeta" class="modal fade" tabindex="" role="dialog" style="display: none;">
        <div class="modal-dialog modal-lg" style="z-index: 1050">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="click x button for close this entry form">×</button>
                    <h4 class="modal-title" id="myModalLabel">Add Meta Information<span style="color: #A54A7B" class="user-guideline" data-content="<em>Must Fill <b>Required</b> Field.    <b>*</b> Put cursor on input field for more informations</em>"><font size="2">(?)</font> </span></h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'store-meta-data','id' => 'meta-data-validation','files'=>'true']) !!}
                    @include('user::user_info.meta_data._form')
                    {!! Form::close() !!}
                </div> <!-- / .modal-body -->
            </div> <!-- / .modal-content -->
        </div> <!-- / .modal-dialog -->
    </div>
    <!-- modal -->




    <div id="passwordModal" class="modal fade" tabindex="" role="dialog" style="display: none;">
        <div class="modal-dialog" style="z-index: 1050">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="click x button for close this entry form">×</button>
                    <h4 class="modal-title" id="myModalLabel">Change Password<span style="color: #A54A7B" class="user-guideline" data-content="<em>Must Fill <b>Required</b> Field.    <b>*</b> Put cursor on input field for more informations</em>"><font size="2">(?)</font> </span></h4>
                </div>
                <div class="modal-body" style="padding: 50px;">
                    {!! Form::open(['route' => 'update-password','id' => 'jq-validation-form']) !!}
                              @include('user::change_password._password_form')
                    {!! Form::close() !!}
                </div> <!-- / .modal-body -->
            </div> <!-- / .modal-content -->
        </div> <!-- / .modal-dialog -->
    </div>

    <!-- Modal  -->

    <div id="addImageModal" class="modal fade" tabindex="" role="dialog" style="display: none;">
        <div class="modal-dialog" style="z-index: 1050">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" title="click x button for close this entry form">×</button>
                    <h4 class="modal-title" id="myModalLabel">Add/Edit Image<span style="color: #A54A7B" class="user-guideline" data-content="<em>Must Fill <b>Required</b> Field.    <b>*</b> Put cursor on input field for more informations</em>"><font size="2">(?)</font> </span></h4>
                </div>
                <div class="modal-body">
                    {!! Form::open(['route' => 'store-profile-image','id' => 'jq-validation-form','files'=>'true']) !!}
                         {!! Form::hidden('user_id',isset($user_id)?$user_id:'') !!}
                         @include('user::user_info.profile_image.add_image')
                    {!! Form::close() !!}
                </div> <!-- / .modal-body -->
            </div> <!-- / .modal-content -->
        </div> <!-- / .modal-dialog -->
    </div>


    <div class="modal fade" id="editImageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="z-index: 1050">
            <div class="modal-content">

            </div>
        </div>
    </div>
    <!-- modal -->
@stop