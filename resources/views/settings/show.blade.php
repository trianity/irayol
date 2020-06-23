@extends('layouts.app')
@push('title', 'Setting Show')
@section('content')

<div class="card mt-3">
    <div class="card-header clearfix">

        <span class="float-left">
            {{ isset($setting->label) ? $setting->label : 'Setting' }}
        </span>

        <div class="float-right">

            <form method="POST" action="{!! route('setting.destroy', $setting->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('setting.index') }}" class="btn btn-primary" title="Show All Setting">
                        <i class="fa fa-undo" aria-hidden="true"></i>
                    </a>

                    <a href="{{ route('setting.create') }}" class="btn btn-success" title="Create New Setting">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    </a>
                    
                    <a href="{{ route('setting.edit', $setting->id ) }}" class="btn btn-primary" title="Edit Setting">
                        <i class="fas fa-pencil-alt"></i>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Setting" onclick="return confirm(&quot;Click Ok to delete Setting.?&quot;)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="card-body">
        <dl class="dl-horizontal">
            <dt>Key</dt>
            <dd>{{ $setting->key }}</dd>
            <dt>Value</dt>
            <dd>{{ $setting->value }}</dd>
        </dl>

    </div>
</div>

@endsection