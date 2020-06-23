@extends('layouts.app')
@push('title', 'Setting Edit')
@section('content')

    <div class="card mt-3">
  
        <div class="card-header clearfix">

            <div class="float-left">
                {{ !empty($setting->label) ? $setting->label : 'Setting' }}
            </div>
            <div class="btn-group btn-group-sm float-right" role="group">

                <a href="{{ route('setting.index') }}" class="btn btn-primary" title="Show All Setting">
                    <i class="fa fa-undo" aria-hidden="true"></i>
                </a>

                <a href="{{ route('setting.create') }}" class="btn btn-success" title="Create New Setting">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
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

            <form method="POST" action="{{ route('setting.update', $setting->id) }}" id="edit_setting_form" name="edit_setting_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('settings.form', ['setting' => $setting,])
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" value="Update">
                </div>
            </form>

        </div>
    </div>

@endsection