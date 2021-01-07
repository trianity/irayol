@extends('layouts.app')
@push('title', 'Addons')
@section('content')
    @foreach (['danger', 'warning', 'success', 'info'] as $key)
        @if(Session::has($key))
            <div class="alert alert-{{ $key }} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get($key) }}
            </div>
        @endif
    @endforeach
    <div class="card">
        <div class="card-header container-fluid">
            <div class="float-left">
                {{__('global.modules')}}
            </div>
            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="#create" class="btn btn-success btn-sm" data-toggle="collapse"><i class="fas fa-box-open" aria-hidden="true"></i> {{__('global.create')}}</a>
            </div>
        </div>
        <div class="card-body">
            <div id="create" class="collapse">
                <form method="POST" action="{{route('addons.store')}}"  enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="addon" name="addon" accept='application/zip' required>
                            <label class="custom-file-label" for="addon">{{__('global.search')}}</label>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">{{__('global.upload')}}</button>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
            @if (count($modules) > 0)
            <div class="row">        
                @foreach($modules as $module)
                    <div class="col-md-3 mb-4">
                        <div class="card" id="addon-{{ $module->alias }}">
                            @if(module_enabled($module->alias))<a href="/addons/{{ $module->alias }}">@endif

                            <div class="card-body img-card-background" style="background-image: url('{{ $module->thumbnail ? $module->thumbnail : asset('manager/images/placeholder.png') }}'); height: 200px !important;">

                            </div>
                            @if(module_enabled($module->alias))</a>@endif
                            <div class="card-footer">
                                <h6 class="card-title"><b>{{ $module->name }}</b></h6>
                                <p class="card-text">{{ $module->description }}</p>
                                <div class="row">
                                    <div class="col-6">
                                        <form action="{{route('addons.active')}}" method="POST">
                                            @csrf
                                            <input type="text" hidden name="addons_name" id="addons_name" value="{{ $module->alias }}">
                                            <button type="submit" class="btn btn-{{ $module->enabled() ? 'success' : 'secondary' }}">{{ $module->enabled() ? __('global.active') : __('global.inactive') }}</button>
                                        </form>
                                    </div>
                                    <div class="col-6">
                                        <form method="POST" action="{!! route('addons.destroy', $module->name) !!}" accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}
                
                                            <div class="btn-group float-right" role="group">
                                                @if(module_enabled($module->alias))
                                                    <a href="{{ $module->alias }}" class="btn btn-primary"><i class="fas fa-sliders-h"></i></a>
                                                @else
                                                    <button type="button" class="btn btn-primary" disabled><i class="fas fa-sliders-h"></i></button>
                                                @endif
                                                <div class="btn-group " role="group">
                                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                                        <button type="submit" class="dropdown-item" title="Delete Theme" onclick="return confirm(&quot;{{ __('global.confirm_delete') }}&quot;)">
                                                            <i class="fas fa-trash"></i> {{ __('global.delete') }}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @elseif(count($modules) == 0)
                <div class="alert alert-warning" role="alert">{{__('global.no_results')}}</a></div>
            @else
                <div class="alert alert-warning" role="alert">{{__('global.empty_results')}}</div>
            @endif 
        </div>
    </div>
@stop

@push('js')
    <script>
        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).siblings('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
@endpush
