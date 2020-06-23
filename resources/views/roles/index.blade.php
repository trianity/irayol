@extends('layouts.app')
@push('title', 'Roles')
@section('content')

    <div class="card mt-3">
        <div class="card-header container-fluid">
            <div class="row">
                <div class="col-md-8">
                    @lang('global.app_list')
                </div>
                <div class="col-md-4">
                    <div class="btn-group btn-group-sm float-right" role="group">
                        <a href="{{ route('roles.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped {{ count($roles) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th>@lang('global.roles.fields.name')</th>
                        <th>@lang('global.roles.fields.permission')</th>
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
                                    <a href="{{ route('roles.edit',[$role->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['roles.destroy', $role->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
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
    </div>
@stop

@section('javascript') 
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('roles.mass_destroy') }}';
    </script>
@endsection