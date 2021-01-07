<nav class="navbar navbar-expand-md navbar-dark bg-danger">
    <a href="/" class="navbar-brand font-weight-bold">{{ setting('site_name') }}</a>
    <button type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div id="navbarContent" class="navbar-collapse collapse justify-content-stretch">
        <ul class="navbar-nav">
            @each('partials.menu-item', $primaryMenu, 'menu')
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