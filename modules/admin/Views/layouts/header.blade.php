<style>

</style>

<header class="header-fluid">
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

                {{--<ul class="nav nav-pills">
                    <li role="presentation" class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            Drop down <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>Thank you</li>
                        </ul>
                    </li>
                </ul>--}}
            </div>

        </div>
    </nav>
</header>


<style>

    /*#order_image {
        margin-top: 80px;
    }

    .page-profile #order_img_resize {
        border-radius: 50%;
        width: 150px;
        height: 150px;
        display: inline-block;
        border: 5px solid #f36f21;
    }

    .page-profile #order_img_resize img {

        margin: 10px 0px;
    }

    #order_image #order_img_resize{
        margin-right: -219px;
    }

    #order_user_name{
        float:right;
        font-family: 'Droid Serif', serif;
        color: #f36f21;
        font-size:18px;
        font-weight: 200;
        text-height: font-size;
        line-height: 1em;
    }*/
</style>
