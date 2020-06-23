@extends('layouts.app')
@push('title', 'Edit User')
@section('content')

    <div class="card mt-3">
  
        <div class="card-header clearfix">

            <div class="float-left">
                {{ !empty($users->name) ? $users->name : 'Users' }}
            </div>
            <div class="btn-group btn-group-sm float-right" role="group">

                <a href="{{ route('users.index') }}" class="btn btn-primary" title="Show All Users">
                    <i class="fa fa-undo" aria-hidden="true"></i>
                </a>

                <a href="{{ route('users.create') }}" class="btn btn-success" title="Create New Users">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                </a>

            </div>
        </div>

        <div class="card-body">

            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form method="POST" action="{{ route('users.update', $users->id) }}" id="edit_users_form" name="edit_users_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('users.form', ['users' => $users, 'roles' => $roles])

                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Update">
                </div>
            </form>

        </div>
    </div>

@endsection