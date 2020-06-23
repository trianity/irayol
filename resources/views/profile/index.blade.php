@extends('layouts.app')
@push('title', 'Profile')
@section('content')

@if(Session::has('success_message'))
    <div class="alert alert-success mt-3">
        <span class="glyphicon glyphicon-ok"></span>
        {!! session('success_message') !!}
        <button type="button" class="close" data-dismiss="alert" aria-label="close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

<div class="card mt-3">
        
    <div class="card-header clearfix">
        <span class="float-left">
            {{ $user->name }}
        </span>
        <div class="float-right">
            <div class="btn-group btn-group-sm" role="group">
                <a href="{{ route('profile.edit') }}" class="btn btn-primary" title="Edit Users">
                    <i class="fas fa-pencil-alt"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="card-body">
        <dl class="dl-horizontal"> 
            <dt>Name</dt>
            <dd>{{ $user->name }}</dd>           
            <dt>Email</dt>
            <dd>{{ $user->email }}</dd>
            <dt>Role</dt>
            <dd>
                @foreach ($user->roles()->pluck('name') as $role)
                    <span class="label label-info label-many">{{ $role }}</span>
                @endforeach
            </dd>
            
        </dl>
    </div>
</div>
@endsection
