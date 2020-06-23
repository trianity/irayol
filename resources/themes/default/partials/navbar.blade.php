<nav class="navbar navbar-expand-md navbar-dark bg-danger">
    <a href="/" class="navbar-brand">{{ setting('site_name') }}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar6">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse justify-content-stretch" id="navbar6">
        <ul class="navbar-nav">
            
            @if($public_menu)
                @foreach($public_menu->items as $menu)
                <li class="nav-item {{ count($menu->child) > 0 ? 'dropdown' : '' }}">
                    <a class="nav-link {{ count($menu->child) > 0 ? 'dropdown-toggle' : '' }}" href="{{ $menu->link }}"  title="{{ $menu->label }}" id="{{$public_menu->name}}" role="button" data-toggle="{{ count($menu->child) > 0 ? 'dropdown' : '' }}" aria-haspopup="true" aria-expanded="false">{{ $menu->label }}</a>
                    
                    @if( $menu->child )            
                        <div class="dropdown-menu" aria-labelledby="{{$public_menu->name}}">
                            @foreach( $menu->child as $child )
                                <a class="dropdown-item" href="{{ $child->link }}" title="{{ $child->label }}">{{ $child->label }}</a>
                            @endforeach
                        </div>
                    @endif
                </li>
                @endforeach
            @endif

        </ul>
        <ul class="navbar-nav ml-auto">
            @auth
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
            @endauth
        </ul>
    </div>
</nav>