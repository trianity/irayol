@extends('layouts.app')

@push('title', 'Sections')

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
                {{$course->title}}
            </div>
            <div class="btn-group-sm float-right" role="group">
                <a href="{{ route('courses.index') }}" class="btn btn-primary" title="{{__('global.return_back')}}"><i class="fa fa-undo" aria-hidden="true"></i> {{__('global.return_back')}}</a>
                <a href="javascript:void(0)" class="btn btn-success" title="{{__('courses::global.create')}}" id="new-section" data-toggle="modal"><i class="fas fa-folder" aria-hidden="true"></i> {{__('courses::global.new_section')}}</a>
                <a href="javascript:void(0)" class="btn btn-success disable" title="{{__('courses::global.create')}}" id="new-class" data-toggle="modal"><i class="fas fa-video" aria-hidden="true"></i> {{__('courses::global.new_class')}}</a>
            </div>
        </div>
    </div>

    <div id="section-loop">
        @foreach ($sections as $section)
            <div class="card" id="card_section_{{ $section->id }}">
                <div class="card-header" id="section_id_{{ $section->id }}">
                    <h3 class="card-title">{{$section->title}}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                        <a href="javascript:void(0)" id="edit-section" data-id="{{ $section->id }}" class="btn btn-tool"><i class="fas fa-pencil-alt"></i></a>
                        <a href="javascript:void(0)" id="delete-section" data-id="{{ $section->id }}" class="btn btn-tool"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    <div class="list-group sortabe" id="class_loop_{{ $section->id }}">
                        @foreach ($section->classes as $class)
                            <div class="list-group-item" data-id="{{ $class->id }}" id="list_class_{{ $class->id }}">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-arrows-alt handle mr-3"></i> {{$class->title}}
                                    </div>
                                    <div>
                                        <a href="javascript:void(0)" id="edit-class" data-id="{{ $class->id }}" class="btn btn-tool"><i class="fas fa-pencil-alt"></i></a>
                                        <a href="javascript:void(0)" id="delete-class" data-id="{{ $class->id }}" class="btn btn-tool"><i class="fas fa-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Add and Edit section modal -->
    <div class="modal fade" id="section-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sectionModal"></h5>
                </div>
                <div class="modal-body">
                    <form name="sectionForm" id="sectionForm">
                        <input type="hidden" id="course_id" name="course_id" value="{{$course->id}}">

                        <input type="hidden" name="section_id" id="section_id">

                        <div class="form-group">
                            <label for="title">{{__('courses::global.title')}}</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <div class="form-group float-right">
                            <button type="submit" id="btn-save" value="create" class="btn btn-primary">{{__('courses::global.save')}}</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('courses::global.close')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add and Edit classes modal -->
    <div class="modal fade" id="classes-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="classesModal"></h5>
                </div>
                <div class="modal-body">
                    <form name="classForm" id="classForm">

                        <input type="hidden" name="class_id" id="class_id">

                        <div class="form-group">
                            <label for="title_class">{{__('courses::global.title')}}</label>
                            <input type="text" class="form-control" id="title_class" name="title_class">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="section_class_id">{{__('courses::global.select_section')}}</label>
                                    <select class="form-control" id="section_class_id" name="section_class_id">
                                        <option selected="" disabled>{{__('courses::global.choose_an_option')}}</option>
                                        @foreach ($sections as $section)
                                            <option value="{{$section->id}}">{{$section->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="is_active">{{__('courses::global.is_active')}}</label>
                                    <select class="form-control" id="is_active" name="is_active">
                                        <option selected="" disabled>{{__('courses::global.choose_an_option')}}</option>
                                        @foreach ($data = array( 1 => __('courses::global.yes'), 0 => __('courses::global.no')) as $key => $is_active)
                                            <option value="{{$key}}">{{$is_active}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="media_type">{{__('courses::global.media_type')}}</label>
                                    <select class="form-control" id="media_type" name="media_type">
                                        <option selected="" disabled>{{__('courses::global.choose_an_option')}}</option>
                                        @foreach ($data = array('vimeo' => __('courses::global.video_src.vimeo'), 'youtube' => __('courses::global.video_src.youtube')) as $key => $media_type)
                                            <option value="{{$key}}">{{$media_type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="url">{{__('courses::global.url')}}</label>
                                    <input type="text" class="form-control" id="url" name="url">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="duration">{{__('courses::global.duration')}}</label>
                                    <input type="text" class="form-control" id="duration" name="duration">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="access">{{__('courses::global.access')}}</label>
                                    <select class="form-control" id="access" name="access">
                                        <option selected="" disabled>{{__('courses::global.choose_an_option')}}</option>
                                        @foreach ($data = array('pay' => __('courses::global.pay'), 'free' => __('courses::global.free')) as $key => $access)
                                            <option value="{{$key}}">{{$access}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="note">Nota</label>
                            <textarea class="form-control" name="note" id="note" cols="30" rows="5"></textarea>
                        </div>

                        <div class="form-group float-right">
                            <button type="submit" id="btn_save" value="create_class" class="btn btn-primary">{{__('courses::global.save')}}</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('courses::global.close')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-sortablejs@latest/jquery-sortable.js"></script>
    <script src="{{asset('modules/courses/js/main.js')}}"></script>
    <script src="{{asset('modules/courses/js/sections.js')}}"></script>
    <script src="{{asset('modules/courses/js/classes.js')}}"></script>
@endpush
