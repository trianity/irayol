@extends('layouts.app')
@push('title', 'Edit role')
@section('content')
    
    {!! Form::model($role, ['method' => 'PUT', 'route' => ['roles.update', $role->id]]) !!}
    <div class="card mt-3">
        <div class="card-header">
            @lang('global.app_edit')
        </div>

        <div class="card-body">
            <div class="form-group">
                {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
                {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
            </div>

            <div class="form-group">
                {!! Form::label('permission', 'Permissions', ['class' => 'control-label']) !!}
                {!! Form::select('permission[]', $permissions, old('permission') ? old('permission') : $role->permissions()->pluck('name', 'name'), ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
                <p class="help-block"></p>
                @if($errors->has('permission'))
                    <p class="help-block">
                        {{ $errors->first('permission') }}
                    </p>
                @endif
            </div>            
        </div>
        <div class="card-footer">
            {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-success']) !!}
        </div>
    </div>

    {!! Form::close() !!}
@stop

