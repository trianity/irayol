@extends('layouts.app')
@push('title', 'Setting Create')
@section('content')

    <div class="card mt-3">
        <div class="card-header clearfix">
            <span class="float-left">
                Create New Setting
            </span>
            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('setting.index') }}" class="btn btn-primary" title="Show All Setting">
                    <i class="fa fa-undo" aria-hidden="true"></i>
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

            <form method="POST" action="{{ route('setting.store') }}" accept-charset="UTF-8" id="create_setting_form" name="create_setting_form" class="form-horizontal">
            {{ csrf_field() }}
            @include ('settings.form', ['setting' => null,])
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Add">
                </div>

            </form>

        </div>
    </div>

@endsection


