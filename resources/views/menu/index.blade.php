@extends('layouts.app')
@push('title', 'Menu')
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
            <div class="row">
                <div class="col">
                    <div class="float-left">
                        {{__('global.menus')}}
                    </div>
                </div>
                <div class="col ">
                    <div class="btn-group btn-group-sm float-right" role="group">
                        {{-- <a href="#item" class="btn btn-primary btn-sm" data-toggle="collapse"><i class="fas fa-filter" aria-hidden="true"></i> {{__('global.number_of_items')}}</a> --}}
                        {{-- <a href="#search" class="btn btn-primary btn-sm" data-toggle="collapse"><i class="fas fa-search" aria-hidden="true"></i> {{__('global.search')}}</a> --}}
                        <a href="#newMenu" class="btn btn-success" data-toggle="collapse"><i class="fas fa-plus" aria-hidden="true"></i> {{__('global.create')}}</a>
                    </div>
                </div>
            </div>                        
        </div>
        <div class="card-body">
            <div id="newMenu" class="collapse">
                <form method="post" action="{{route('menu.store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="edit_page_per_page">{{__('global.title')}}</label>
                        <div class="input-group mb-3">            
                            <input class="form-control" name="title" id="title" value="{{old('title')}}" type="text" required />
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">{{__('global.apply')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            @if (count($menus) > 0)
                <div class="table-responsive">
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th>{{__('global.title')}}</th>
                                <th>{{__('global.created_at')}}</th>
                                <th>{{__('global.status')}}</th>
                                <th class="text-center" colspan="3">{{__('global.action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($menus as $menu)
                            <tr>
                                <td>{{ $menu->title }}</td>
                                <td>{{\Carbon\Carbon::parse($menu->updated_at)->diffForHumans() }}</td>
                                <td>
                                    <form action="{{route('menu.active', $menu->id)}}" method="POST">
                                        @csrf
                                        <input type="hidden" name="main_menu" value="{{$menu->id}}">
                                        <button type="submit" class="btn btn-{{ $menu->id == setting('main_menu') ? 'success' : 'secondary' }} btn-sm">{{ $menu->id == setting('main_menu') ? __('global.active') : __('global.inactive') }}</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" action="{!! route('menu.destroy', $menu->id) !!}" accept-charset="UTF-8">
                                        @method('DELETE')
                                        @csrf

                                        <div class="btn-group btn-group-xs float-right" role="group">

                                            <a href="{{ route('menu.edit', $menu->id ) }}" class="btn btn-primary btn-sm" title="Edit Menu">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>

                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Menu" onclick="return confirm(&quot;Click Ok to delete Users.&quot;)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @elseif(count($menus) == 0)
                <div class="alert alert-warning" role="alert">{{__('global.no_results')}}</a></div>
            @else
                <div class="alert alert-warning" role="alert">{{__('global.empty_results')}}</div>
            @endif  
        </div>
    </div>
@endsection
