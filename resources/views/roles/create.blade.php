@extends('layouts.app')
@push('title', 'Create role')
@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['roles.store']]) !!}

    <div class="card mt-3">
        <div class="card-header">
            {{__('global.create')}}
        </div>
        
        <div class="card-body">

            {!! Form::label('name', __('global.roles.fields.name'), ['class' => 'control-label']) !!}
            {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
            <p class="help-block"></p>
            @if($errors->has('name'))
                <p class="help-block">
                    {{ $errors->first('name') }}
                </p>
            @endif

            {!! Form::label('permission', __('global.roles.fields.permission'), ['class' => 'control-label']) !!}
            {!! Form::select('permission[]', $permissions, old('permission'), ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
            <p class="help-block"></p>
            @if($errors->has('permission'))
                <p class="help-block">
                    {{ $errors->first('permission') }}
                </p>
            @endif
         
        </div>
        <div class="card-footer">
            {!! Form::submit(__('global.save'), ['class' => 'btn btn-success']) !!}
        </div>
    </div>

    {!! Form::close() !!}
@stop

