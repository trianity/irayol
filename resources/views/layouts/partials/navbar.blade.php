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
            <a class="nav-link" href="{{ route('home') }}"><i class="fa fa-arrow-left custom"></i> Back to Site</a>
        </li>
        @else
        <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}" target="_blank"><i class="fa fa-globe" aria-hidden="true"></i> {{__('global.view_site')}}</a>
        </li>        
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user-circle" aria-hidden="true"></i> <span class="caret"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('profile.index') }}">{{ __('global.profile') }}</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('roles.index') }}">{{ __('global.roles.title') }}</a>
                <a class="dropdown-item" href="{{ route('permissions.index') }}">{{ __('global.permissions.title') }}</a>
                <a class="dropdown-item" href="{{ route('setting.index') }}">{{ __('global.settings') }}</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-language"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                @if (config('locale.status') && count(config('locale.languages')) > 1)
                    @foreach (array_keys(config('locale.languages')) as $lang)
                        @if ($lang != App::getLocale())
                            <a class="dropdown-item" href="{!! route('lang.swap', $lang) !!}">
                               <span class="flag-icon flag-icon-{{ config('locale.languages')[$lang][4] }}"></span> {{ strtoupper($lang) }} - {{ config('locale.languages')[$lang][3] }}
                            </a>
                        @endif
                    @endforeach
                @endif
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
	<a href="{{route('admin.home')}}" class="brand-link navbar-warning">
		<img src="{{asset('manager/images/donut.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: 0.8;" />
		<span class="brand-text text-dark">{{ setting('site_name') }}</span>
	</a>
	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <li class="nav-item">
                    <a href="{{route('admin.home')}}" class="nav-link {{ ! route::is('admin.home') ? : 'active'}}"><i class="nav-icon fas fa-home"></i><p>{{__('global.home')}}</p></a>
                </li>
                
                @can('page.index')
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link {{ ! route::is('page.index', 'page.create')  ? : 'active'}}"><i class="nav-icon far fa-file-alt"></i><p>{{ __('global.pages') }}<i class="fas fa-angle-left right"></i></p></a>
					<ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ ! route::is('page.index') ? : 'active'}}" href="{{ route('page.index') }}"><i class="far fa-circle nav-icon"></i> {{ __('global.list_page') }}</a></li>
                        <li class="nav-item"><a class="nav-link {{ ! route::is('page.create') ? : 'active'}}" href="{{ route('page.create') }}"><i class="far fa-circle nav-icon"></i> {{ __('global.create') }}</a></li>
                    </ul>                    
                </li>
                @endcan

                @can('blog.index')
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link {{ ! route::is('blog.index', 'blog.create') ? : 'active'}}"><i class="nav-icon fas fa-file-alt"></i> <p> {{ __('global.blogs') }} <i class="fas fa-angle-left right"></i></p></a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a class="nav-link {{ ! route::is('blog.index') ? : 'active'}}" href="{{ route('blog.index') }}"><i class="far fa-circle nav-icon"></i> {{__('global.list_blogs')}}</a></li>
                        <li class="nav-item"><a class="nav-link {{ ! route::is('blog.create') ? : 'active'}}" href="{{ route('blog.create') }}"><i class="far fa-circle nav-icon"></i> {{ __('global.create') }}</a></li>
                    </ul>
                </li>
                @endcan

                @can('category.index')
                <li class="nav-item">
                    <a class="nav-link {{ ! route::is('category.index') ? : 'active'}}" href="{{ route('category.index') }}"><i class="nav-icon fa fa-tag" aria-hidden="true"></i> <p>{{ __('global.categories') }}</p></a>
                </li>
                @endcan
                
                @can('media.index')
                <li class="nav-item">
                    <a class="nav-link {{ ! route::is('media.index') ? : 'active'}}" href="{{ route('media.index') }}"><i class="nav-icon far fa-image"></i> <p>{{ __('global.media') }}</p></a>
                </li>
                @endcan

                @can('theme.index')
                <li class="nav-item">
                    <a class="nav-link {{ ! route::is('themes.index') ? : 'active'}}" href="{{ route('themes.index') }}"><i class="nav-icon fas fa-paint-brush"></i> <p>{{ __('global.themes') }}</p></a>
                </li>
                @endcan

                @can('addons.index')
                <li class="nav-item">
                    <a class="nav-link {{ ! route::is('addons.index') ? : 'active'}}" href="{{ route('addons.index') }}"><i class="nav-icon fas fa-box-open"></i> <p>{{ __('global.modules') }}</p></a>
                </li>
                @endcan

                @can('menu.index')
                <li class="nav-item">
                    <a class="nav-link {{ ! route::is('menu.index') ? : 'active'}}" href="{{ route('menu.index') }}"><i class="nav-icon fa fa-bars" aria-hidden="true"></i> <p>{{ __('global.menu') }}</p></a>
                </li>
                @endcan

                @can('users.index')
                <li class="nav-item">
                    <a class="nav-link {{ ! route::is('users.index') ? : 'active'}}" href="{{ route('users.index') }}"><i class="nav-icon fa fa-users" aria-hidden="true"></i> <p>{{ __('global.users.title') }}</p></a>
                </li>
                @endcan

                @can('setting.index')
                <li class="nav-item">
                    <a class="nav-link {{ ! route::is('setting.index') ? : 'active'}}" href="{{ route('setting.index') }}"><i class="nav-icon fa fa-cogs" aria-hidden="true"></i> <p>{{ __('global.settings') }}</p></a>
                </li>	
                @endcan
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
@endauth