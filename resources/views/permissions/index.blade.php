@extends('layouts.app')
@push('title', 'Permissions')
@section('content')
    <div class="card mt-3">
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    @lang('global.permissions.title')
                </div>
                <div class="col-md-2">
                    <a href="{{ route('permissions.create') }}" class="btn btn-success btn-sm float-right">@lang('global.app_add_new')</a>
                </div>
            </div>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-striped {{ count($permissions) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th>@lang('global.permissions.fields.name')</th>
                        <th>Options</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($permissions) > 0)
                        @foreach ($permissions as $permission)
                            <tr data-entry-id="{{ $permission->id }}">
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <a href="{{ route('permissions.edit',[$permission->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['permissions.destroy', $permission->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('permissions.mass_destroy') }}';
    </script>
@endsection