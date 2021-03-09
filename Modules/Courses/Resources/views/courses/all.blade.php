@extends('layouts.frontend')

@section('content')
<div class="container mt-3 mb-3">
    <div class="row row-cols-1 row-cols-md-3">
        @foreach ($courses as $course)
            <div class="col mb-4 mt-3">
                <div class="card h-100">
                    <a href="{{route('course.view', $course->slug)}}"><img src="{{$course->image}}" class="img-fluid"></a>
                    <div class="card-body">
                        <a href="{{route('course.view', $course->slug)}}"><h5 class="card-title">{{$course->title}}</h5></a>
                        <p class="card-text">{{$course->description}}</p>
                        <div class="d-flex justify-content-center">
                            <a href="{{route('course.view', $course->slug)}}" class="btn btn-primary">{{__('courses::global.go_to_course')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection