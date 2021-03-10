@extends('layouts.app')
@push('title', 'Show Category') 
@section('content')
<div class="card">
    <div class="card-header clearfix">
        <span class="float-left">
            {{ isset($category->name) ? $category->name : 'Category' }}
        </span>
        <div class="float-right">
            <form method="POST" action="{!! route('category.destroy', $category->id) !!}" accept-charset="UTF-8">
                <input name="_method" value="DELETE" type="hidden">
                {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('category.index') }}" class="btn btn-primary" title="{{__('global.return_back')}}">
                        <i class="fa fa-undo" aria-hidden="true"></i> {{__('global.return_back')}}
                    </a>

                    <a href="{{ route('category.create') }}" class="btn btn-success" title="{{__('global.create')}}">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('global.create')}}
                    </a>
                    
                    <a href="{{ route('category.edit', $category->id ) }}" class="btn btn-primary" title="{{__('global.edit')}}">
                        <i class="fas fa-pencil-alt"></i> {{__('global.edit')}}
                    </a>

                    <button type="submit" class="btn btn-danger" title="{{__('global.delete')}}" onclick="return confirm(&quot;{{ __('global.confirm_delete') }}&quot;)">
                        <i class="fas fa-trash"></i> {{__('global.delete')}}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card-body">
        <dl class="dl-horizontal">
            <dt>{{__('global.title')}}</dt>
            <dd>{{ $category->name }}</dd>
            <dt>{{__('global.description')}}</dt>
            <dd>{{ $category->description }}</dd>
            <dt>{{__('global.status')}}</dt>
            <dd>{{ ($category->is_active) ? __('global.active') : __('global.inactive') }}</dd>
        </dl>
    </div>
</div>

@endsection