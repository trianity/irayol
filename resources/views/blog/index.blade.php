@extends('layouts.app')
@push('title', 'List Your Blog')
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
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                {{__('global.list_blogs')}}
            </div>
            <div class="col-md-6">
                <div class="btn-group btn-group-sm float-right" role="group">
                    <a href="#item" class="btn btn-primary btn-sm" data-toggle="collapse"><i class="fa fa-filter" aria-hidden="true"></i> {{__('global.number_of_items')}}</a>
                    <a href="#search" class="btn btn-primary btn-sm" data-toggle="collapse"><i class="fa fa-search" aria-hidden="true"></i> {{__('global.search')}}</a>
                    <a class="btn btn-success btn-sm" href="{{ route('blog.create') }}"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('global.create')}}</a>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body">

        <div id="item" class="collapse">
            <form method="get" action="{{route('blog.index')}}">
                <div class="form-group">
                    <label for="edit_page_per_page">{{__('global.number_of_items')}}</label>
                    <div class="input-group mb-3">
                        <input min="1" max="999" class="form-control" name="number" id="number" maxlength="3" placeholder="10" type="number" />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">{{__('global.apply')}}</button>
                        </div>
                    </div>
                </div>
            </form>
		</div>

        <!--Search-->
        <div id="search" class="collapse">
            <form method="get" action="{{route('blog.index')}}">
                <div class="form-group">
                    <div class="input-group mb-3">
                        <input class="form-control" name="search" id="search" placeholder="{{__('global.search')}}" type="text" value="{{ !empty(Request::get('search')) ?  Request::get('search') : '' }}" />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">{{__('global.apply')}}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!--Search-->

        @if(count($allblog) > 0)
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{__('global.title')}}</th>
                        <th>{{__('global.author')}}</th>
                        <th>{{__('global.update_at')}}</th>
                        <th>{{__('global.categories')}}</th>
                        <th colspan="3">{{__('global.action')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allblog as $blog)
                    <tr>
                        <td>{{ $blog->title }}</td>
                        <td><a href="{{ route('users.show', $blog->user->id ) }}">{{ $blog->user->name }}</a></td>
                        <td>
                            @foreach ($blog->categories as $category)
                               <a href="{{ route('category.show', $category->id ) }}">{{$category->name}}</a>
                            @endforeach
                        </td>
						<td>{{\Carbon\Carbon::parse($blog->updated_at)->diffForHumans() }}</td>
						<td>
							<form method="POST" action="{!! route('blog.destroy', $blog->id) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}
                                <div class="btn-group btn-group-xs float-right" role="group">
                                    <a href="{{ route('blog.show', $blog->slug) }}" target="_blank" class="btn btn-info btn-sm" title="Show Users">
                                        <i class="far fa-eye" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-primary btn-sm" title="Edit Page">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <button type="submit" class="btn btn-danger btn-sm" title="Delete Page" onclick="return confirm(&quot;Click Ok to delete Page.&quot;)">
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
        @elseif(count($allblog) < 1))
        	<div class="alert alert-warning" role="alert">Sorry, we can't find your blog. <a href="{{ route('blog.index') }}">Reset search.</a></div>
        @else
        	<div class="alert alert-warning" role="alert">Empty blog! Please click Add Blog to add blog.</div>
        @endif
    </div>
    <div class="card-footer">
        {!! $allblog->appends(request()->input())->links() !!}
    </div>
</div>
@endsection
