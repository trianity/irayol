@if (count($menu->children) == 0)
    <li class="nav-item">
        <a class="nav-link" href="{{ $menu->url }}">{{ $menu->label }}</a>
    </li>
@else
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ $menu->label }}</a>
        @if( $menu->children )            
            <div class="dropdown-menu sub-menu" aria-labelledby="{{$menu->name}}">
                @foreach( $menu->children as $child )

                        <a class="dropdown-item" href="{{ $child->url }}" title="{{ $child->label }}">{{ $child->label }}</a>

                @endforeach
            </div>
        @endif
    </li>
@endif