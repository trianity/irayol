@extends('layouts.app') 
@push('title', 'Edit Blog') 
@section('content')
<div class="container mt-4">
    @if ($errors->any())
        <ul class="alert alert-danger mt-4">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <form action="{{ route('blog.update', $blog->id ) }}" method="POST" class="">
        <div class="row">
            <div class="col-md-8">

				<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
					<div class="form-group">
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">{{__('global.title')}}</span>
								</div>
                    			<input type="text" class="form-control" id="title" name="title" value="{{  old('title', $blog->title) }}" placeholder="Title" />
							</div>
						</div>
					</div>
                </div>

                <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
					<div class="form-group">
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">{{__('global.url')}}</span>
								</div>
                    			<input type="text" class="form-control" id="slug" name="slug" value="{{ $blog->slug }}" placeholder="URL" />
								@if ($errors->has('slug'))
								<span class="help-block">
									<strong>{{ $errors->first('slug') }}</strong>
								</span>
								@endif
							</div>
						</div>
					</div>
				</div>  

                <div class="form-group">
                    <textarea id="summernote" class="form-control" rows="3" name="content">{{ $blog->content }}</textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header">
                        {{__('global.options')}}
                    </div>
                    <div class="card-body">                        
                        <div class="form-group">
                            <label for="exampleSelect2">{{__('global.visibility')}}</label>
                            <select class="custom-select" id="visibility" name="visibility">
                                <option selected="" disabled>Open this select visibility</option>
                                @foreach ($data = array('published' => 'Published', 'draft' => 'Draft', 'pending_review' => 'Pending Review'); as $key => $visibility)                                    
                                    <option value="{{$key}}" {{ $blog->visibility == $key ? 'selected' : '' }}>{{$visibility}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect2">{{__('global.users.title')}}</label>
                            <select class="form-control" id="user_id" name="user_id">
                                @foreach ($users as $key => $user)
                                    <option value="{{$key}}" {{$key == $blog->user_id ? 'selected' : ''}}>{{$user}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">{{__('global.created_at')}}</label>
                            <div class="form-group">
                                <div class="input-group mb-3">                        
                                <input type="text" class="form-control datetimepicker-input" id="published_at" name="published_at" value="{{ $blog->published_at }}" data-toggle="datetimepicker" data-target="#published_at"/>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect2">{{__('global.categories')}}</label>
                            <select multiple="" class="form-control select2" id="category" name="category[]">
                                @foreach ($categories as $key => $category)
                                    <option value="{{$key}}" {{ collect(old('category', $blog->categories->pluck('id')))->contains($key) ? 'selected' : '' }}>{{$category}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">{{__('global.main_image')}}</label>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" id="main_image" name="main_image" value="{{ $blog->main_image }}" readonly>
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#MainImageModal">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <a href="#" data-toggle="modal" data-target="#MainImageModal">
                            <img class="img-fluid rounded" name="ImageMainSelect" id="ImageMainSelect" src="{{ $blog->main_image }}" >
                        </a>
                    </div>
                </div>
				<div class="card" id="accordionExample">					
					<a href="#" class="card-header" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">					
						SEO <i class="float-right fa fa-circle" aria-hidden="true" style="margin-top: 2px;"></i>
					</a>
					
					<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
						<div class="card-body">
							<div class="form-group">
								<label for="title">{{__('global.seo_title')}}</label>
								<input type="text" class="form-control" id="titleseo" name="titleseo" value="{{ $blog->titleseo }}" />
							</div>

							<div class="form-group">
								<label for="content">{{__('global.seo_description')}}</label>
								<textarea class="form-control" rows="3" name="descriptionseo">{{ $blog->descseo }}</textarea>
							</div>

							<div class="form-group">
								<label for="content">{{__('global.seo_keyword')}}</label>
								<textarea class="form-control" rows="3" name="keywordseo">{{ $blog->keywordseo }}</textarea>
							</div>
						</div>
					</div>
				</div>
                
                {{ csrf_field() }}
				<input type="hidden" name="_method" value="put" />				
				<div class="row">
					<div class="col-6 mt-3">
						<input type="submit" name="submit" value="{{__('global.save')}}" class="btn btn-primary btn-block" />
					</div>
					<div class="col-6 mt-3">
						<a class="btn btn-secondary btn-block" href="{{route('blog.index')}}">{{__('global.cancel')}}</a>
					</div>
				</div>
            </div>
        </div>
    </form>
</div>

<!--Post Image Modal-->
<div class="modal fade" id="MediaModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Image library</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach($media as $medias)
                    <div class="col-md-3 mt-3">
                        @if($medias->extension == 'png' || $medias->extension == 'jpg' || $medias->extension == 'jpeg')
                        <a data-toggle="modal" data-target="#{{ $medias->id }}">
                            <img class="thumbnail img-fluid rounded lazy loading filter image addimage" alt="" data-src="{{ $medias->path }}" />
                        </a>
                        @endif
                    </div>
                    <!-- col-md-2 / end -->
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" data-id="" id="InsertPhoto" type="button">Insert to post</button>
                <button class="btn btn-primary" data-dismiss="modal" type="button">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!--Post Image Modal-->

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
                    @foreach($media as $medias)
                    <div class="col-md-3 mt-3">
                        @if($medias->extension == 'png' || $medias->extension == 'jpg' || $medias->extension == 'jpeg')
                        <a data-toggle="modal" data-target="#{{ $medias->id }}">
                            <img class="thumbnail img-fluid rounded lazy loading filter image addMainImage" data-src="{{ $medias->path }}" />
                        </a>
                        @endif
                    </div>
                    <!-- col-md-2 / end -->
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" data-id="" id="MainPhoto" type="button">Insert to post</button>
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

        $("#summernote").summernote({
            height: 650,
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
