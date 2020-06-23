@extends('layouts.app')
@push('title', 'Category') 
@section('content')
    @if(Session::has('success_message'))
        <div class="alert alert-success mt-4">
            <i class="fas fa-check-circle"></i>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif
    <div class="card mt-4">
        <div class="card-header clearfix">
            <div class="float-left">
                Categories
            </div>
            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="#item" class="btn btn-primary btn-sm" data-toggle="collapse"><i class="fa fa-filter" aria-hidden="true"></i> Number of items</a>
                <a href="#search" class="btn btn-primary btn-sm" data-toggle="collapse"><i class="fa fa-search" aria-hidden="true"></i> Search Page</a>
                <a href="{{ route('category.create') }}" class="btn btn-success" title="Create New Category"><i class="fa fa-plus-circle" aria-hidden="true"></i> New Category</a>
            </div>
        </div>
        <div class="card-body ">
            <div id="item" class="collapse">
                <form method="get" action="{{route('category.index')}}">
                    <div class="form-group">
                        <label for="edit_page_per_page">Number of items per page:</label>
                        <div class="input-group mb-3">            
                            <input min="1" max="999" class="form-control" name="number" id="number" maxlength="3" placeholder="10" type="number" />
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Apply</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
		
            <!--Search-->
            <div id="search" class="collapse">
                <form method="get" action="{{route('category.index')}}">
                    <div class="form-group">
                        <div class="input-group mb-3">            
                            <input class="form-control" name="search" id="search" placeholder="Search Category" type="text" value="{{ old('search')}}" />
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!--Search-->

            @if (count($categories) > 0)
            <div class="table-responsive">
                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Is Active</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ ($category->is_active) ? 'Yes' : 'No' }}</td>
                            <td>
                                <form method="POST" action="{!! route('category.destroy', $category->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}
                                    <div class="btn-group btn-group-xs float-right" role="group">
                                        <a href="{{ route('category.show', $category->id ) }}" class="btn btn-info btn-sm" title="Show Category">
                                            <i class="far fa-eye" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ route('category.edit', $category->id ) }}" class="btn btn-primary btn-sm" title="Edit Category">
                                            <i class="fas fa-pencil-alt"></i>
                                        </a>

                                        <button type="submit" class="btn btn-danger btn-sm" title="Delete Category" onclick="return confirm(&quot;Click Ok to delete Category.&quot;)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            @elseif(count($categories) == 0)
                <div class="alert alert-warning" role="alert">Sorry, we can't find your category. <a href="{{ route('category.index') }}">Reset search.</a></div>
            @else
                <div class="alert alert-warning" role="alert">Empty category! Please click Add Category to add category.</div>
            @endif        
        </div>

        <div class="card-footer">
            {!! $categories->render() !!}
        </div>
            
    </div>
@endsection