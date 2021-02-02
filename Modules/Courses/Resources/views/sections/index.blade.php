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
                <a href="javascript:void(0)" class="btn btn-success" title="{{__('courses::global.create')}}" id="new-section" data-toggle="modal"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('courses::global.create')}}</a>
            </div>
        </div>
    </div>

    @if(count($sections) > 0)
        @foreach ($sections as $section)
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{$section->title}}</h3>

                    <div class="card-tools">
                        
                        <form method="POST" action="{!! route('sections.destroy', $section->id) !!}" accept-charset="UTF-8">
                            <input name="_method" value="DELETE" type="hidden">
                            {{ csrf_field() }}
                            
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool"><i class="fas fa-pencil-alt"></i></button>
                            <button type="submit" class="btn btn-tool" title="Delete Page" onclick="return confirm(&quot;Click Ok to delete Course.&quot;)">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>

                    </div>
                </div>
                <div class="card-body" style="display: block;">
                    The body of the card
                </div>
            </div>
        @endforeach
    @else
        <div class="alert alert-info" role="alert">Empty course! Please click Add Course to add course.</div>
    @endif

    <!-- Add and Edit section modal -->
    <div class="modal fade" id="crud-modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customerCrudModal"></h5>
                </div>
                <div class="modal-body">
                    <form name="sectionForm" id="sectionForm" action="{{route('sections.store')}}" method="POST">
                        @csrf
                        <input type="hidden" id="course_id" name="course_id" value="{{$course->id}}">
                        <div class="form-group">
                            <label for="title">{{__('courses::global.title')}}</label>
                            <input type="text" class="form-control" id="title" name="title">
                        </div>

                        <div class="form-group">
                            <button type="submit" id="btn-save" name="btnsave" class="btn btn-primary">{{__('courses::global.save')}}</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('courses::global.close')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{asset('modules/courses/js/main.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#sectionForm').validate({ 
                rules: {
                    title: {
                        required: true,
                        minlength: 2,
                    },
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                }
            });
        });
    </script> 
@endpush