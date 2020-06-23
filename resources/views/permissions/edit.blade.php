@extends('layouts.app')
@push('title', 'Edit permissions')
@section('content')    
    {!! Form::model($permission, ['method' => 'PUT', 'route' => ['permissions.update', $permission->id]]) !!}

    <div class="card mt-3">
        <div class="card-header">
            @lang('global.app_edit')
        </div>

        <div class="card-body">

                    {!! Form::label('name', 'Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('title'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif

        </div>
        <div class="card-footer">
            {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-success']) !!}
        </div>
    </div>

    {!! Form::close() !!}
@stop

