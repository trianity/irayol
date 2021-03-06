@extends('layouts.app')
@push('title', 'Courses')

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
                {{__('courses::global.courses')}}
            </div>
            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('courses.create') }}" class="btn btn-success" title="Create New Category"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('global.create')}}</a>
            </div>
        </div>
        <div class="card-body">
            @if(count($courses) > 0)
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
                            @foreach($courses as $course)
                            <tr>
                                <td>{{ $course->title }}</td>
                                <td><a href="{{ route('users.show', $course->user->id ) }}">{{ $course->user->name }}</a></td>
                                <td>{{\Carbon\Carbon::parse($course->updated_at)->diffForHumans() }}</td>
                                <td>
                                    @foreach ($course->categories as $category)
                                    <a href="{{ route('category.show', $category->id ) }}">{{$category->name}}</a>
                                    @endforeach
                                </td>
                                <td>
                                    <form method="POST" action="{!! route('courses.destroy', $course->id) !!}" accept-charset="UTF-8">
                                        <input name="_method" value="DELETE" type="hidden">
                                        {{ csrf_field() }}
                                        <div class="btn-group btn-group-xs float-right" role="group">
                                            <a href="{{ route('courses.show', $course->id) }}" class="btn btn-info btn-sm" title="Show Users">
                                                <i class="far fa-eye" aria-hidden="true"></i>
                                            </a>
                                            <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-primary btn-sm" title="Edit Page">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Page" onclick="return confirm(&quot;Click Ok to delete Course.&quot;)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <a href="{{ route('course.view', $course->slug) }}" class="btn btn-success btn-sm" title="Edit Page">
                                                <i class="fas fa-play"></i>
                                            </a>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-warning" role="alert">Empty course! Please click Add Course to add course.</div>
            @endif
        </div>
    </div>

@endsection
