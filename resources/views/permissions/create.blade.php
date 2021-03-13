@extends('layouts.app')
@push('title', 'Create permissions')
@section('content')

    {!! Form::open(['method' => 'POST', 'route' => ['permissions.store']]) !!}

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
        </div>
        <div class="card-footer">
            {!! Form::submit(__('global.save'), ['class' => 'btn btn-success']) !!}
        </div>
    </div>

    {!! Form::close() !!}
@stop

