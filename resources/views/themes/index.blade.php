@extends('layouts.app')
@push('title', 'Themes')
@section('content')

    <div class="card">
        <div class="card-header container-fluid">
            <div class="float-left">
                {{__('global.themes')}}
            </div>
            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="#create" class="btn btn-success btn-sm" data-toggle="collapse"><i class="fas fa-paint-brush" aria-hidden="true"></i> {{__('global.create')}}</a>
            </div>
        </div>
        <div class="card-body">
            <div id="create" class="collapse">
                <form method="POST" action="{{route('themes.store')}}"  enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="theme" name="theme" accept='application/zip' required>
                            <label class="custom-file-label" for="theme">{{__('global.search')}}</label>
                        </div>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">{{__('global.upload')}}</button>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
            @if (count($themes) > 0)
            <div class="row" id="themes">
                @foreach($themes as $theme)
                    <div class="col-md-3 mb-3">
                        <div class="card" id="theme-{{ $theme->name }}">
                            <div class="card-header">{{ ucfirst($theme->name) }}</div>
                            <div class="card-body img-card-background" style="background-image: url('{{ $theme->thumbnail }}'); height: 140px !important;">

                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-6">
                                        <form action="{{route('theme.active')}}" method="POST">
                                            @csrf
                                            <input type="text" hidden name="theme_name" id="theme_name" value="{{ $theme->name }}">
                                            <button type="submit" class="btn btn-{{ $theme->name == Theme::get() ? 'success' : 'secondary' }}">{{ $theme->name == Theme::get() ? __('global.active') : __('global.inactive') }}</button>
                                        </form>
                                    </div>
                                    <div class="col-6">
                                        <form method="POST" action="{!! route('themes.destroy', $theme->name) !!}" accept-charset="UTF-8">
                                            <input name="_method" value="DELETE" type="hidden">
                                            {{ csrf_field() }}                                            
                                            <div class="btn-group float-right" role="group">
                                                <a href="/?theme={{ $theme->name }}" class="btn btn-primary"><i class="far fa-eye" aria-hidden="true"></i></a>                                               
                                                <div class="btn-group " role="group">
                                                    <button id="btnGroupDrop1" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                                        <button type="submit" class="dropdown-item" title="{{__('global.delete')}}" onclick="return confirm(&quot;{{ __('global.confirm_delete') }}&quot;)">
                                                            <i class="fas fa-trash"></i> {{__('global.delete')}}
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
            @elseif(count($themes) == 0)
                <div class="alert alert-warning" role="alert">{{__('global.no_results')}}</a></div>
            @else
                <div class="alert alert-warning" role="alert">{{__('global.empty_results')}}</div>
            @endif 
        </div>
    </div>
@stop
