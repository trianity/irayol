@extends('layouts.app')
@push('title', 'Edit role')
@section('content')
    
    {!! Form::model($role, ['method' => 'PUT', 'route' => ['roles.update', $role->id]]) !!}
    <div class="card">
        <div class="card-header">
            {{__('global.edit')}}
        </div>

        <div class="card-body">
            <div class="form-group">
                {!! Form::label('name', __('global.roles.fields.name'), ['class' => 'control-label']) !!}
                {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                <p class="help-block"></p>
                @if($errors->has('name'))
                    <p class="help-block">
                        {{ $errors->first('name') }}
                    </p>
                @endif
            </div>

            <div class="form-group">
                {!! Form::label('permission', __('global.roles.fields.permission'), ['class' => 'control-label']) !!}
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
            {!! Form::submit(__('global.update'), ['class' => 'btn btn-success']) !!}
        </div>
    </div>

    {!! Form::close() !!}
@stop

