@extends('layouts.app')
@push('title', 'Menu')
@section('content')
    @if(Session::has('success_message'))
        <div class="alert alert-success mt-3">
            <i class="fa fa-check-circle" aria-hidden="true"></i>
            {!! session('success_message') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="card mt-3">
        <div class="card-header container-fluid">
            <div class="row">
                <div class="col">
                    <div class="float-left">
                        Menus
                    </div>
                </div>
                <div class="col ">
                    <div class="btn-group btn-group-sm float-right" role="group">
                        <a href="#item" class="btn btn-primary btn-sm" data-toggle="collapse"><i class="fas fa-filter" aria-hidden="true"></i> Number of items</a>
                        <a href="#search" class="btn btn-primary btn-sm" data-toggle="collapse"><i class="fas fa-search" aria-hidden="true"></i> Search Menu</a>
                        <a href="#newMenu" class="btn btn-success" data-toggle="collapse"><i class="fas fa-plus" aria-hidden="true"></i> New Menu</a>
                    </div>
                </div>
            </div>                        
        </div>
        <div class="card-body">
            <div id="newMenu" class="collapse">
                <form method="post" action="{{route('menu.create')}}">
                    @csrf
                    <div class="form-group">
                        <label for="edit_page_per_page">Menu Title:</label>
                        <div class="input-group mb-3">            
                            <input class="form-control" name="menu_name" id="menu_name" value="{{old('menu_name')}}" type="text" placeholder="Menu Title" />
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Create</button>
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
                                <th>Title</th>
                                <th>Create At</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($menus as $menu)
                            <tr>
                                <td>{{ $menu->name }}</td>
                                <td>{{ $menu->created_at }}</td>
                                <td>
                                    <form action="{{route('menu.active')}}" method="POST">
                                        @csrf
                                        <input type="text" hidden name="main_menu" id="main_menu" value="{{ $menu->id }}">
                                        <button type="submit" class="btn btn-{{ $menu->id == setting('main_menu') ? 'success' : 'secondary' }} btn-sm">{{ $menu->id == setting('main_menu') ? 'Active' : 'Inactive' }}</button>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" action="{!! route('hdeletemenug', $menu->id) !!}" accept-charset="UTF-8">
                                    <input name="_method" value="DELETE" type="hidden">
                                    {{ csrf_field() }}

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
                <div class="alert alert-warning" role="alert">Sorry, we can't find your user. <a href="{{ route('menu.index') }}">Reset search.</a></div>
            @else
                <div class="alert alert-warning" role="alert">Empty user! Please click Add User to add user.</div>
            @endif
        </div>
    </div>
@endsection
