@extends('layouts.app')
@push('title', 'User')
@section('content')

    <div class="card">
        <div class="card-header container-fluid">
            <div class="float-left">
                Users
            </div>
            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="#item" class="btn btn-primary btn-sm" data-toggle="collapse"><i class="fa fa-filter" aria-hidden="true"></i> Number of items</a>
                <a href="#search" class="btn btn-primary btn-sm" data-toggle="collapse"><i class="fa fa-search" aria-hidden="true"></i> Search Page</a>
                <a href="{{ route('users.create') }}" class="btn btn-success" title="Create New Users"><i class="fa fa-user-plus" aria-hidden="true"></i> New User</a>
            </div>
        </div>
        
        <div class="card-body card-body-with-table">
            <div id="item" class="collapse">
                <form method="get" action="{{route('users.index')}}">
                    <div class="form-group">
                        <label for="edit_page_per_page">Number of items per page:</label>
                        <div class="input-group mb-3">            
                            <input min="1" max="999" class="form-control" name="number" id="number" maxlength="3" placeholder="10" type="number" />
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Apply</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
		
            <!--Search-->
            <div id="search" class="collapse">
                <form method="get" action="{{route('users.index')}}">
                    <div class="form-group">
                        <div class="input-group mb-3">            
                            <input class="form-control" name="search" id="search" placeholder="Search User" type="text" value="{{ old('search')}}" />
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--Search-->
            @if (count($usersObjects) > 0)
                <div class="table-responsive">
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Email Verified At</th>
                                <th>Name</th>
                                <th>Roles</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($usersObjects as $users)
                            <tr>
                                <td><a href="mailto:{{ $users->email }}">{{ $users->email }}</a></td>
                                <td>{{ $users->email_verified_at }}</td>
                                <td>{{ $users->name }}</td>
                                <td>
                                    @foreach ($users->roles()->pluck('name') as $role)
                                        <span class="label label-info label-many">{{ $role }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <form method="POST" action="{!! route('users.destroy', $users->id) !!}" accept-charset="UTF-8">
                                    <input name="_method" value="DELETE" type="hidden">
                                    {{ csrf_field() }}

                                        <div class="btn-group btn-group-xs float-right" role="group">
                                            <a href="{{ route('users.show', $users->id ) }}" class="btn btn-info btn-sm" title="Show Users">
                                                <i class="far fa-eye" aria-hidden="true"></i>
                                            </a>
                                            <a href="{{ route('users.edit', $users->id ) }}" class="btn btn-primary btn-sm" title="Edit Users">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>

                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Users" onclick="return confirm(&quot;Click Ok to delete Users.&quot;)">
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
            @elseif(count($usersObjects) == 0)
                <div class="alert alert-warning" role="alert">Sorry, we can't find your user. <a href="{{ route('user.index') }}">Reset search.</a></div>
            @else
                <div class="alert alert-warning" role="alert">Empty user! Please click Add User to add user.</div>
            @endif   
        </div>

        <div class="card-footer">
            {!! $usersObjects->appends(request()->input())->render() !!}
        </div>
        
    </div>
@endsection