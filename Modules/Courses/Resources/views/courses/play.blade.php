@extends('layouts.frontend')

@section('content')
<div class="position-relative overflow-hidden text-center bg-light">

    <div class="row">
        <div class="col-md-8 p-0">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="{{$classe->url}}"></iframe>
            </div>
            <div class="card">
                <div class="card-body clearfix">
                    <h4>{{$classe->title}}</h4>
                    <p>{{$classe->note}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 p-0">
            <div class="card">
                <div class="card-header clearfix">
                    <div class="float-left">
                        {{$course->title}}
                    </div>
                    <div class="float-right">
                        <a href="{{route('course.view', $course->slug)}}" class="btn btn-primary btn-sm" title="{{__('global.return_back')}}"><i class="fa fa-undo" aria-hidden="true"></i> {{__('global.return_back')}}</a>
                    </div>
                </div>
                @foreach ($sections as $section)
                <div class="accordion" id="accordion_{{$section->id}}">
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
                                                <div>
                                                    {{$class->title}}
                                                </div>
                                                <div id="viewed_user_class_{{$class->id}}">

                                                    <a href="javascript:void(0)" id="viewedClass" data-id="{{ $class->id }}" class="btn btn-info btn-sm">
                                                        @if ($class->checkUserViewed())
                                                            <i class="fas fa-eye"></i>
                                                        @else
                                                            <i class="far fa-eye-slash"></i>
                                                        @endif
                                                    </a>

                                                    <a href="{{route('course.play', [$course->slug, $class->id])}}" class="btn btn-success btn-sm"><i class="fas fa-play"></i></a>
                                                </div>
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
</div>
@endsection

@push('js')
    <script src="{{asset('modules/courses/js/class_play.js')}}"></script>
@endpush
