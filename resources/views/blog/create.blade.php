@extends('layouts.app')
@push('title', 'Add Blog')
@section('content')

	<form action="{{route('blog.store')}}" method="POST" class="">
        <div class="row">
            <div class="col-md-8">
				<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
					<div class="form-group">
						<div class="form-group">
							<div class="input-group mb-3">
								<div class="input-group-prepend">
									<span class="input-group-text">{{__('global.title')}}</span>
								</div>
                        		<input type="text" class="form-control" id="title" name="title" placeholder="Title" />
							</div>
						</div>
					</div>
                </div>
                <div class="form-group">
                    <textarea id="summernote" class="form-control" rows="20" name="content">Hello, World!</textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        {{__('global.options')}}
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleSelect2">{{__('global.visibility')}}</label>
                            <select class="custom-select" id="visibility" name="visibility">
                                <option selected="" disabled>Open this select visibility</option>
                                @foreach ($data = array('published' => 'Published', 'draft' => 'Draft', 'pending_review' => 'Pending Review'); as $key => $visibility)
                                    <option value="{{$key}}">{{$visibility}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect2">{{__('global.categories')}}</label>
                            <select multiple="" class="form-control select2" id="category" name="category[]" multiple>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="title">{{__('global.created_at')}}</label>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                <input type="text" class="form-control datetimepicker-input" id="published_at" name="published_at" value="{{  date('Y-m-d h:m') }}" data-toggle="datetimepicker" data-target="#published_at"/>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label">{{__('global.main_image')}}</label>
                            <div class="form-group">
                                <div class="input-group mb-3">
                                <input type="text" class="form-control" id="main_image" name="main_image" readonly>
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
				<div class="card mt-3" id="accordionExample">
					<a href="#" class="card-header" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						SEO <i class="float-right fa fa-circle" aria-hidden="true" style="margin-top: 2px;"></i>
					</a>
					<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
						<div class="card-body">
							<div class="form-group">
								<label for="title">{{__('global.seo_title')}}</label>
								<input type="text" class="form-control" id="titleseo" name="titleseo" placeholder="Title SEO" />
							</div>

							<div class="form-group">
								<label for="content">{{__('global.seo_description')}}</label>
								<textarea class="form-control" rows="3" name="descriptionseo"></textarea>
							</div>

							<div class="form-group">
								<label for="content">{{__('global.seo_keyword')}}</label>
								<textarea class="form-control" rows="3" name="keywordseo"></textarea>
							</div>
						</div>
					</div>
				</div>

				{{ csrf_field() }}
				<div class="row">
					<div class="col-6 mt-3">
						<input type="submit" name="submit" value="Save" class="btn btn-primary btn-block" />					</div>
					<div class="col-6 mt-3">
						<a class="btn btn-secondary btn-block" href="{{route('blog.index')}}">Cancel</a>
					</div>
				</div>
            </div>
        </div>
    </form>


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
                            <img class="thumbnail img-fluid rounded filter image addimage" alt="" data-src="{{ $medias->path }}" />
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
                            <img class="thumbnail img-fluid rounded filter image addMainImage" alt="" data-src="{{ $medias->path }}" />
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
