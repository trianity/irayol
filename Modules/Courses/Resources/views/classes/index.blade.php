@extends('layouts.app')

@push('title', 'Classes')

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
                {{$section->title}}
            </div>
            <div class="btn-group btn-group-sm float-right" role="group">
                <a href="{{ route('course.section', $section->course->id) }}" class="btn btn-primary" title="Create New Category"><i class="fa fa-undo" aria-hidden="true"></i> {{__('global.return_back')}}</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    {{__('courses::global.classes')}}
                </div>
                <div class="card-body">
                    <form action="{{route('classes.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="section_id" value="{{$section->id}}">

                        <div class="form-group">
                            <label for="title">{{__('courses::global.title')}}</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>

                        <div class="form-group">
                            <label for="notes">{{__('courses::global.notes')}}</label>
                            <textarea class="form-control" name="notes" id="notes" cols="30" rows="8"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="file">{{__('courses::global.url')}}</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="file" name="file" aria-describedby="myInput">
                                <label class="custom-file-label" for="myInput">Choose file</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="duration">{{__('courses::global.duration')}}</label>
                            <input type="number" class="form-control" id="duration" >
                        </div>

                        <div class="form-group">
                            <label for="exampleSelect2">{{__('courses::global.access')}}</label>
                            <select class="custom-select" id="access" name="access">
                                <option selected="" disabled>{{__('courses::global.select_option')}}</option>
                                @foreach ($data = array('pay' => __('courses::global.pay'), 'free' => __('courses::global.free')); as $key => $access)                                    
                                    <option value="{{$key}}">{{$access}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="{{__('global.save')}}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">

        </div>
    </div>
@endsection