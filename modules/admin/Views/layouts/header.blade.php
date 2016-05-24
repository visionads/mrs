
{{--<header class="header-fluid">
    <!-- Navbar -->
    <nav>
        <div class="container" id="main-navbar">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Image</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="{{route('dashboard')}}"><span class="menu_underline">HOME</span></a></li>
                    <li><a href="{{ route('what-we-do') }}"><span class="menu_underline">WHAT WE DO</span></a></li>

                    @if(isset(Auth::user()->username))
                        <li><a href="{{ route('need-help') }}"><span class="menu_underline">NEED HELP</span></a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle user-menu" data-toggle="dropdown">

                                @if(Session::has('user_image'))
                                    {!! HTML::image(Session::get('user_image')) !!}
                                @else
                                    {!! HTML::image('avatar.png', 'User ') !!}
                                @endif

                                    <span class="menu_underline">{!! isset(Auth::user()->username) ? strtoupper(Auth::user()->username) : '' !!}</span>
                            </a>
                            <ul id="setting_dropdown" class="dropdown-menu">
                                <li><a href="{{route('user-profile')}}"><span class="menu_color"><i class="dropdown-icon fa fa-user"></i>&nbsp;&nbsp;Profile</span></a></li>
                                <li class="divider"></li>
                                <li><a href="#"><i class="dropdown-icon fa fa-user"></i>&nbsp;&nbsp;User Settings</a></li>
                                <li class="divider"></li>
                                <li><a href="{{route('settings')}}"><i class="dropdown-icon fa fa-user"></i>&nbsp;&nbsp;Settings</a></li>
                                <li class="divider"></li>
                                <li><a href="{{route('user-logout')}}"><i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a></li>
                            </ul>
                        </li>
                    @else
                        <li><a href="#"><span class="menu_underline">CONTACT US</span></a></li>
                        <li class="active"><a href="{{route('get-user-login')}}" class="button"><span class="menu_underline">SIGN</span></a></li>
                    @endif
                </ul>

                --}}{{--<ul class="nav nav-pills">
                    <li role="presentation" class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            Drop down <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>Thank you</li>
                        </ul>
                    </li>
                </ul>--}}{{--
            </div>

        </div>
    </nav>
</header>--}}


<div class="container-fluid font-droid" style="padding-bottom:0px !important; margin-bottom:0 !important;">
    <!--Navigation Bar-->
    <div class="col-sm-12" >
        <nav class="navbar navbar-default" >
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!--Header Logo-->
                    <img src="{{ URL::to('/assets/img/mrs_logo.jpg') }}" width="230">
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                    <ul class="nav navbar-nav navbar-right no-padding">
                        <li><a href="{{route('dashboard')}}"><span class="link-underline">HOME</span></a></li>
                        <li><a href="{{ route('what-we-do') }}"><span class="link-underline">WHAT WE DO</span></a></li>
                        @if(isset(Auth::user()->username))
                            <li><a href="{{ route('need-help') }}"><span class="link-underline">NEED HELP</span></a></li>

                            <!--Dropdown-->
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle user-img-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                    @if(Session::has('user_image'))
                                        {!! HTML::image(Session::get('user_image')) !!}
                                    @else
                                        {!! HTML::image('avatar.png', 'User ') !!}
                                    @endif

                                    <span class="link-underline">{!! isset(Auth::user()->username) ? strtoupper(Auth::user()->username) : '' !!}</span>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{route('user-profile')}}">Profile</a></li>
                                    {{--<li><a href="#">User Settings</a></li>--}}
                                    @if(Session::get('user-role')=='super-admin' || Session::get('user-role')=='admin')
                                    <li><a href="{{route('settings')}}">Settings</a></li>
                                    <li><a href="{{route('index-permission-role')}}">Permissions of roles</a></li>
                                    <li><a href="{{route('index-role-user')}}">User Roles</a></li>
                                    <li><a href="{{route('user-list')}}">User List</a></li>
                                    @endif
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{route('user-logout')}}">Log Out</a></li>
                                </ul>
                            </li>
                        @else
                            <li><a href="#">CONTACT US</a></li>
                            <li class="active"><a href="{{route('get-user-login')}}" class="button">SIGN</a></li>
                        @endif

                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>
</div>
