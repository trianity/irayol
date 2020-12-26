@extends('layouts.app')
@push('title', 'Edit Category') 
@section('content')
    @foreach (['danger', 'warning', 'success', 'info'] as $key)
        @if(Session::has($key))
            <div class="alert alert-{{ $key }} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get($key) }}
            </div>
        @endif
    @endforeach

    <div class="card">
        <div class="card-header clearfix">
            <div class="float-left">
                {{ !empty($category->name) ? $category->name : 'Category' }}
            </div>
            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('category.index') }}" class="btn btn-primary" title="{{__('global.return_back')}}">
                    <i class="fa fa-undo" aria-hidden="true"></i> {{__('global.return_back')}}
                </a>
                <a href="{{ route('category.create') }}" class="btn btn-success" title="{{__('global.create')}}">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('global.create')}}
                </a>
            </div>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('category.update', $category->id) }}" id="edit_category_form" name="edit_category_form" accept-charset="UTF-8" class="form-horizontal">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            @include ('categories.form', ['category' => $category,])
                <div class="form-group">
                        <input class="btn btn-primary" type="submit" value="Update">
                </div>
            </form>
        </div>
    </div>
@endsection