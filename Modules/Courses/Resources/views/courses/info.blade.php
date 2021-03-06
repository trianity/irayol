@extends('layouts.frontend')

@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="{{$course->image}}" class="img-fluid">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h2 class="card-title font-weight-bold text-center">{{$course->title}}</h2>
                            <p class="card-text">{{$course->description}}</p>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            @foreach ($sections as $section)
                <div class="accordion mt-3" id="accordion_{{$section->id}}">
                    <div class="card">
                        <div class="card-header" id="heading_{{$section->id}}">
                            <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapse_{{$section->id}}" aria-expanded="true" aria-controls="collapse_{{$section->id}}">
                                    {{$section->title}}
                                </button>
                            </h2>
                        </div>
    
                        <div id="collapse_{{$section->id}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion_{{$section->id}}">
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach($section->classes as $class)
                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-between">
                                                {{$class->title}}
                                                @if ($class->access == 'free')
                                                    <a href="{{route('course.play', [$course->slug, $class->id])}}" class="btn btn-success btn-sm"><i class="fas fa-play"></i></a>
                                                @else
                                                    <a href="#!" class="btn btn-primary btn-sm disable"><i class="fas fa-lock"></i></a>
                                                @endif
                                            </div>
                                        </li>
                                    @endforeach
                                  </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
