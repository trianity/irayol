@extends('layouts.app')
@push('title', 'Roles')
@section('content')

    <div class="card">
        <div class="card-header container-fluid">
            <div class="row">
                <div class="col-md-8">
                    {{__('global.roles.title')}}
                </div>
                <div class="col-md-4">
                    <div class="btn-group btn-group-sm float-right" role="group">
                        <a href="{{ route('roles.create') }}" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('global.create')}}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped {{ count($roles) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th>{{__('global.roles.fields.name')}}</th>
                        <th>{{__('global.roles.fields.permission')}}</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($roles) > 0)
                        @foreach ($roles as $role)
                            <tr data-entry-id="{{ $role->id }}">
                                <td>{{ $role->name }}</td>
                                <td>
                                    @foreach ($role->permissions()->pluck('name') as $permission)
                                        <span class="badge badge-secondary">{{ $permission }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <form method="POST" action="{!! route('roles.destroy', $role->id) !!}" accept-charset="UTF-8">
                                        @method('DELETE')
                                        @csrf
                                        <div class="btn-group btn-group-xs float-right" role="group">
                                            <a href="{{ route('roles.edit',[$role->id]) }}" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                            <button type="submit" class="btn btn-danger btn-sm" title="{{__('global.delete')}}" onclick="return confirm(&quot;Click Ok to delete Category.&quot;)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $roles->render() }}
        </div>
    </div>
@stop