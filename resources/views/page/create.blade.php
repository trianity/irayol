@extends('layouts.app') 
@push('title', 'Add Page') 
@section('content')
<div class="container">
    <form action="{{route('page.store')}}" method="POST" class="">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <div class="form-group">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">{{__('global.title')}}</span>
                                </div>
                                <input type="text" class="form-control" id="title" name="title"/>
                                @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <textarea id="summernote" name="content" hidden></textarea>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" id="accordionExample">
                    <a href="#" class="card-header" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        SEO <i class="float-right fa fa-circle" aria-hidden="true" style="margin-top: 2px;"></i>
                    </a>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="title">{{__('global.seo_title')}}</label>
                                <input type="text" class="form-control" id="titleseo" name="titleseo" placeholder="Title" />
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
                        <input type="submit" name="submit" value="{{__('global.save')}}" class="btn btn-primary btn-block" />
                    </div>
                    <div class="col-6 mt-3">
                        <a class="btn btn-secondary btn-block" href="{{route('page.index')}}">{{__('global.cancel')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<!--Modal-->
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
<!--Modal-->

@endsection 

@push('css')
<link href="{{ asset('manager/plugins/summernote/summernote-bs4.min.css')}}" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.css" />
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.css" />
@endpush 

@push('js')
<script src="{{ asset('manager/plugins/summernote/summernote-bs4.min.js')}}"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.js"></script>
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/2.36.0/formatting.js"></script>
<script>
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
