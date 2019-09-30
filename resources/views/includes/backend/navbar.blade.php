<header class="main-header">
    <!-- Logo -->
    <a href="{{url('/home')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>M</b>B</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>MY</b>BLOG</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <!-- <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a> -->

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{asset('/backend/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{Auth::user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{asset('/backend/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                            <p>
                                {{Auth::user()->name}} - {{Auth::user()->roles->first()->display_name}}
                                <small>Member since {{Auth::user()->created_at->format('F. Y')}}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{route('edit.account')}}" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href=""
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();"
                                   class="btn btn-default btn-flat">Sign out</a>
                                <form id="logout-form" action="{{route('logout')}}" method="POST"
                                      style="display: none">
                                    {{csrf_field()}}
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
