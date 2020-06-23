<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-light navbar-warning">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        @guest
        <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
        <li class="nav-item">
            <a class="nav-link" href="{{ action('FrontendController@index') }}"><i class="fa fa-arrow-left custom"></i> Back to Site</a>
        </li>
        @else
        <li class="nav-item">
            <a class="nav-link" href="{{ action('FrontendController@index') }}" target="_blank"><i class="fa fa-globe" aria-hidden="true"></i> Visit Site</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user-circle" aria-hidden="true"></i> {{ Auth::user()->name }} <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('roles.index') }}">Roles</a>
                <a class="dropdown-item" href="{{ route('permissions.index') }}">Permissions</a>
                <a class="dropdown-item" href="{{ route('setting.index') }}">Settings</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </li>
        @endguest
    </ul>
</nav>
<!-- /.navbar -->
@auth
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
	<!-- Brand Logo -->
	<a href="{{route('home')}}" class="brand-link navbar-warning">
		<img src="{{asset('manager/images/donut.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8;" />
		<span class="brand-text text-dark">{{ setting('site_name') }}</span>
	</a>
	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <li class="nav-item">
                    <a href="{{route('home')}}" class="nav-link"><i class="nav-icon fas fa-home"></i><p>Home</p></a>
                </li>
                
                @can('page.index')
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link"><i class="nav-icon far fa-file-alt"></i><p>Page<i class="fas fa-angle-left right"></i></p></a>
					<ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link" href="{{ route('page.index') }}"><i class="far fa-circle nav-icon"></i> All Pages</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('page.create') }}"><i class="far fa-circle nav-icon"></i> Add New</a></li>
                    </ul>                    
                </li>
                @endcan

                @can('blog.index')
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link"><i class="nav-icon fas fa-file-alt"></i> <p> Blog <i class="fas fa-angle-left right"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link" href="{{ route('blog.index') }}"><i class="far fa-circle nav-icon"></i> All Blogs</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('blog.create') }}"><i class="far fa-circle nav-icon"></i> Add New</a></li>
                    </ul>
                </li>
                @endcan

                @can('category.index')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('category.index') }}"><i class="nav-icon fa fa-tag" aria-hidden="true"></i> <p>Categories</p></a>
                </li>
                @endcan
                
                @can('media.index')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('media.index') }}"><i class="nav-icon far fa-image"></i> <p>Media</p></a>
                </li>
                @endcan

                @can('theme.index')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('themes.index') }}"><i class="nav-icon fas fa-paint-brush"></i> <p>Themes</p></a>
                </li>
                @endcan

                @can('addons.index')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('addons.index') }}"><i class="nav-icon fas fa-box-open"></i> <p>Modules</p></a>
                </li>
                @endcan

                @can('menu.index')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('menu.index') }}"><i class="nav-icon fa fa-bars" aria-hidden="true"></i> <p>Menu</p></a>
                </li>
                @endcan

                @can('users.index')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('users.index') }}"><i class="nav-icon fa fa-users" aria-hidden="true"></i> <p>Users</p></a>
                </li>
                @endcan

                @can('setting.index')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('setting.index') }}"><i class="nav-icon fa fa-cogs" aria-hidden="true"></i> <p>Settings</p></a>
                </li>	
                @endcan
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
@endauth