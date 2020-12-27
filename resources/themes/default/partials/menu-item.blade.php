@if (count($menu->children) == 0)
    <li class="nav-item">
        <a class="nav-link" href="{{ $menu->url }}">{{ $menu->label }}</a>
    </li>
@else
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="{{ $menu->url }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $menu->label }}</a>
        @if( count($menu->children) > 0 )            
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                @foreach( $menu->children as $child )
                    @if (count($child->children) == 0)
                        <a class="dropdown-item" href="{{ $child->url }}" title="{{ $child->label }}">{{ $child->label }}</a>
                    @else 
                        <li class="dropright">
                            <a class="dropdown-item dropdown-toggle" href="{{ $child->url}}" data-toggle="dropdown">
                                {{ $child->label }}
                            </a>
                            <ul class="dropdown-menu">
                                @foreach ($child->children as $item)
                                    <a class="dropdown-item" href="{{ $item->url}}">
                                        {{ $item->label }}
                                    </a>
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            </ul>
        @endif
    </li>
@endif