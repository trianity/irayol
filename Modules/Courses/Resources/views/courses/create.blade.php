@extends('layouts.app')
@push('title', 'Create Course') 
@section('content')
    @foreach (['danger', 'warning', 'success', 'info'] as $key)
        @if(Session::has($key))
            <div class="alert alert-{{ $key }} alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get($key) }}
            </div>
        @endif
    @endforeach
    
    <form method="POST" action="{{ route('courses.store') }}" accept-charset="UTF-8" id="create_category_form" name="create_category_form" class="form-horizontal">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-8">
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
					<div class="form-group">
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">{{__('courses::global.title')}}</span>
								</div>
                        		<input type="text" class="form-control" id="title" name="title" required />
							</div>
						</div>
					</div>
                </div>
                <div class="form-group">
                    <textarea id="description" name="description" class="form-control summernote" rows="20" name="content">Hello, World!</textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        {{__('courses::global.options')}}
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="category">{{__('courses::global.categories')}}</label>
                            <select class="form-control select2" id="category" name="category[]" multiple>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="level">{{__('courses::global.level')}}</label>
                            <select class="form-control" id="level" name="level" >
                                <option selected="" disabled>{{__('courses::global.select_level')}}</option>
                                @foreach ($data = array('basic' => __('courses::global.basic'), 'intermediate' => __('courses::global.intermediate'), 'advance' => __('courses::global.advance')); as $key => $level)                                    
                                    <option value="{{$key}}">{{$level}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect2">{{__('courses::global.visibility')}}</label>
                            <select class="custom-select" id="visibility" name="visibility">
                                <option selected="" disabled>{{__('courses::global.select_option')}}</option>
                                @foreach ($data = array('published' => __('courses::global.published'), 'draft' => __('courses::global.draft'), 'pending_review' => __('courses::global.pending_review')); as $key => $visibility)                                    
                                    <option value="{{$key}}">{{$visibility}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">{{__('courses::global.image')}}</label>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                <input type="text" class="form-control" id="main_image" name="image" readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#MainImageModal">Search</button>
                                </div>
                                </div>
                            </div>
                            <a href="#" data-toggle="modal" data-target="#MainImageModal">
                                <img class="img-fluid rounded" name="ImageMainSelect" id="ImageMainSelect" src="{{ asset('manager/images/placeholder.png') }}">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card mt-3" id="accordionSEO">
					<a href="#" class="card-header" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">					
						SEO <i class="float-right fa fa-circle" aria-hidden="true" style="margin-top: 2px;"></i>
					</a>					
					<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSEO">
						<div class="card-body">
                            <div class="form-group">
                                <label for="required">{{__('courses::global.requirements')}}</label> 
                                <textarea id="required" name="required" cols="40" rows="3" class="form-control"></textarea>
                            </div> 
                            <div class="form-group">
                                <label for="includes">{{__('courses::global.includes')}}</label> 
                                <textarea id="includes" name="includes" cols="40" rows="3" class="form-control"></textarea>
                            </div> 
							<div class="form-group">
                                <label for="keywords">{{__('courses::global.keywords')}}</label> 
                                <textarea id="keywords" name="keywords" cols="40" rows="3" class="form-control"></textarea>
                            </div> 
						</div>
					</div>
                </div>
                <div class="row">
					<div class="col-6 mt-3">
                        <button class="btn btn-primary btn-block">{{__('courses::global.save')}}</button>				
                    </div>
					<div class="col-6 mt-3">
						<a class="btn btn-secondary btn-block" href="{{route('courses.index')}}">{{__('courses::global.cancel')}}</a>
					</div>
				</div>
            </div>
        </div>
    </form>

<!--Main Image Modal-->
<div class="modal fade" id="MainImageModal" tabindex="-1" role="dialog" aria-labelledby="MainImageModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="MainImageModal">Image library</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach($medias as $media)
                    <div class="col-md-3 mt-3">
                        @if($media->extension == 'png' || $media->extension == 'jpg' || $media->extension == 'jpeg')
                        <a data-toggle="modal" data-target="#{{ $media->id }}">
                            <img class="thumbnail img-fluid rounded lazy loading filter image addMainImage" alt="" data-src="{{ $media->path }}" />
                        </a>
                        @endif
                    </div>
                    <!-- col-md-2 / end -->
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" data-id="" id="MainPhoto" type="button">Insert</button>
                <button class="btn btn-primary" data-dismiss="modal" type="button">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--Main Image Modal-->
@endsection

@push('css')
<link href="{{ asset('manager/plugins/summernote/summernote-bs4.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.css" />
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.css" />
@endpush 


@push('js')
<script src="{{ asset('manager/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/2.36.0/formatting.js"></script>
<script>

    $(function () {
        $('#published_at').datetimepicker({            
            date: moment($('#published_at').val()),
            format: 'YYYY-MM-DD HH:mm' 
        });
    });

    $(document).ready(function () {
        const FMButton = function (context) {
            const ui = $.summernote.ui;
            const button = ui.button({
                contents: '<i class="note-icon-picture"></i> ',
                tooltip: "File Manager",
                click: function () {
                    $("#MediaModal").modal("show");
                },
            });
            return button.render();
        };

        $(".summernote").summernote({
            height: 550,
            dialogsInBody: true,
            codemirror: {
                // codemirror options
                theme: "monokai",
            },
            callbacks: {
                onInit: function () {
                    $("body > .note-popover").hide();
                },
            },
            toolbar: [
                ["style", ["style"]],
                ["font", ["bold", "underline", "clear"]],
                ["fontname", ["fontname"]],
                ["color", ["color"]],
                ["para", ["ul", "ol", "paragraph"]],
                ["table", ["table"]],
                ["insert", ["link", "fm-button", ["fm"], "video"]],
                ["view", ["fullscreen", "codeview", "help"]],
            ],
            buttons: {
                fm: FMButton,
            },
        });
    });
</script>
@endpush
