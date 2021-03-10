@foreach (['danger', 'warning', 'success', 'info'] as $key) 
    @if(Session::has($key))
        <div class="alert alert-{{ $key }} alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ Session::get($key) }}
        </div>
    @endif 
@endforeach