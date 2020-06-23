@extends('layouts.app')
@push('title', 'Show Category') 
@section('content')

<div class="card mt-4">
    <div class="card-header clearfix">

        <span class="float-left">
            {{ isset($category->name) ? $category->name : 'Category' }}
        </span>

        <div class="float-right">

            <form method="POST" action="{!! route('category.destroy', $category->id) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('category.index') }}" class="btn btn-primary" title="Show All Category">
                        <i class="fa fa-undo" aria-hidden="true"></i>
                    </a>

                    <a href="{{ route('category.create') }}" class="btn btn-success" title="Create New Category">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    </a>
                    
                    <a href="{{ route('category.edit', $category->id ) }}" class="btn btn-primary" title="Edit Category">
                        <i class="fas fa-pencil-alt"></i>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Category" onclick="return confirm(&quot;Click Ok to delete Category.?&quot;)">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="card-body">
        <dl class="dl-horizontal">
            <dt>Name</dt>
            <dd>{{ $category->name }}</dd>
            <dt>Description</dt>
            <dd>{{ $category->description }}</dd>
            <dt>Is Active</dt>
            <dd>{{ ($category->is_active) ? 'Yes' : 'No' }}</dd>

        </dl>

    </div>
</div>

@endsection