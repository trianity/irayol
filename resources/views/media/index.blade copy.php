@extends('layouts.app') 
@push('title', 'Media') 
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
    <div class="card-header">
        <div class="row">
            <div class="col-md-6">
                {{__('global.media')}}
            </div>
            <div class="col-md-6">
                <div class="btn-group btn-group-sm float-right" role="group">
                    <a href="#item" class="btn btn-primary btn-sm" data-toggle="collapse"><i class="fa fa-filter" aria-hidden="true"></i> {{__('global.number_of_items')}}</a>
                    <a href="#search" class="btn btn-primary btn-sm" data-toggle="collapse"><i class="fa fa-search" aria-hidden="true"></i> {{__('global.search')}}</a> 
                    <a href="#upload" class="btn btn-success btn-sm" data-toggle="collapse"><i class="fa fa-plus-circle" aria-hidden="true"></i> {{__('global.create')}}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">

        <div id="upload" class="collapse">
            {!! csrf_field() !!}
            <div class="form-group">
                <div class="file-loading">
                    <input type="file" id="media" name="media[]" placeholder="Soltar" multiple class="file" data-overwrite-initial="false" data-min-file-count="1" accept=".jpg, .jpeg, .gif, .png, .mp4, .mp3, .avi">
                </div>
            </div>
        </div>

        <div id="item" class="collapse">
            <form method="get" action="{{route('media.index')}}">
                <div class="form-group">
                    <label for="edit_page_per_page">{{__('global.number_of_items')}}</label>
                    <div class="input-group mb-3">            
                        <input min="1" max="999" class="form-control" name="number" id="number" maxlength="3" placeholder="10" type="number" />
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">{{__('global.apply')}}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!--Search-->
        <div id="search" class="collapse">
            <form method="get" action="{{route('media.index')}}">
                <div class="form-group">
                    <div class="input-group mb-3">            
                        <input class="form-control" name="search" id="search" placeholder="{{__('global.search')}}" type="text" value="{{ !empty(Request::get('search')) ?  Request::get('search') : '' }}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" type="button">{{__('global.apply')}}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        @if(count($media) >= 1)
        <a href="#" class="btn btn-primary filter-button btn-sm" data-filter="all">{{__('global.all')}}</a>
        <a href="#" class="btn btn-primary filter-button btn-sm" data-filter="image">{{__('global.images')}}</a>
        <a href="#" class="btn btn-primary filter-button btn-sm" data-filter="document">{{__('global.documents')}}</a>
        <a href="#" class="btn btn-primary filter-button btn-sm" data-filter="music">{{__('global.songs')}}</a>
        <a href="#" class="btn btn-primary filter-button btn-sm" data-filter="video">{{__('global.videos')}}</a>
        <a href="#" class="btn btn-primary filter-button btn-sm" data-filter="others">{{__('global.others')}}</a> 
        @endif

        @if(count($media) >= 1)
        <div class='list-group gallery col-md-12'>
            <div class="row">
                @foreach($media as $medias)
                    <div class="col-md-3 mt-3 show-image">                        
                        <a data-toggle="modal" data-target="#media_{{ $medias->id }}">                            
                            @if($medias->extension == 'png' || $medias->extension == 'jpg' || $medias->extension == 'jpeg')
                                <div class="card-body img-card-background loading filter image" style="background-image: url('{{ $medias->path }}'); ">
                            @elseif($medias->extension == 'txt')
                                <div class="card-body img-card-background loading filter document" style="background-image: url('{{ asset('extension/txt.png') }}'); ">
                            @elseif($medias->extension == 'pdf')
                                <div class="card-body img-card-background loading filter document" style="background-image: url('{{ asset('extension/pdf.png') }}'); ">
                            @elseif($medias->extension == 'mp4')
                                <div class="card-body img-card-background loading filter video" style="background-image: url('{{ asset('extension/mp4.png') }}'); ">
                            @elseif($medias->extension == 'mp3')
                                <div class="card-body img-card-background loading filter music" style="background-image: url('{{ asset('extension/mp3.png') }}'); ">
                            @else
                                <div class="card-body img-card-background loading filter others" style="background-image: url('{{ asset('extension/other.png') }}'); ">
                            @endif
                            </div>
                        </a>
                    </div>
                    <div class="modal fade" id="media_{{ $medias->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            @if($medias->extension == 'png' || $medias->extension == 'jpg' || $medias->extension == 'jpeg')
                                            <img class="img-fluid" alt="" src="{{ $medias->path }}" /> 
                                            @elseif($medias->extension == 'txt')
                                            <img class="img-fluid" alt="" src="{{ asset('extension/txt.png') }}" /> 
                                            @elseif($medias->extension == 'pdf')
                                            <img class="img-fluid" alt="" src="{{ asset('extension/pdf.png') }}" /> 
                                            @elseif($medias->extension == 'mp4')
                                            <div class="embed-responsive embed-responsive-16by9">
                                                <video class="embed-responsive-item" controls>
                                                    <source src="{{asset('storage/uploads/'. $medias->image_name)  }}" type="video/{{$medias->extension}}">
                                                </video>
                                            </div>
                                            @elseif($medias->extension == 'mp3')
                                            <audio controls>
                                                <source src="{{asset('storage/uploads/'. $medias->image_name)  }}" type="video/{{$medias->extension}}">
                                            </audio>
                                            @else
                                            <img class="img-fluid" alt="" src="{{ asset('extension/other.png') }}" /> 
                                            @endif
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row mb-4">
                                                <div class="col-6 mt-3">
                                                    <form action="{{route('media.destroy', $medias->id )}}" method="POST">
                                                        {{ method_field('delete') }} {!! csrf_field() !!}
                                                        <button class="delete btn btn-danger btn-block" type="submit" onclick="return confirm(&quot;¿Borrar item?&quot;)">DELETE <i class="fa fa-times-circle" aria-hidden="true"></i></button>
                                                    </form>
                                                </div>
                                                <div class="col-6 mt-3">
                                                    <button type="button" class="btn btn-primary btn-block" data-dismiss="modal">Close</button>
                                                </div>                                        
                                            </div>  

                                            <p><b>{{__('global.title')}} :</b> {{ $medias->file }}</p>
                                            <p><b>{{__('global.type')}} :</b> Image/{{ $medias->extension }}</p>
                                            <p><b>{{__('global.size')}} :</b> {{ filesize("storage/uploads/".$medias->image_name) / 1024 }} KB</p>
                                            <p><b>{{__('global.created_at')}} :</b> {{ $medias->created_at }}</p> 
                                            
                                                                                                
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @elseif(count($media) == 0 )
            <div class="alert alert-warning" role="alert">{{__('global.no_results')}}</a></div>
        @else
            <div class="alert alert-warning" role="alert">{{__('global.empty_results')}}</div>
        @endif
    </div>
    <div class="card-footer">
        {!! $media->appends(request()->input())->render() !!}
    </div>
</div>
@endsection 

@push('css')
    <link href="{{asset('manager/css/fileinput.css')}}" media="all" rel="stylesheet" type="text/css"/>
    <style type="text/css">

        .show-image {
            position: relative;
            float:left;

        }
        .show-image:hover {
            opacity:0.5;
        }
        div.show-image:hover form {
            display: block;
        }
        div.show-image form {
            position:absolute;
            display:none;
            top:0;
            left:79%;
        }
    </style>
@endpush

@push('js')
    <script src="{{asset('manager/js/fileinput.js')}}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.5.2/js/locales/es.js"></script>
    <script type="text/javascript">
        $("#media").fileinput({
            language: "es",
            theme: 'fa',
            uploadUrl: "{{ route('media.store') }}",
            uploadExtraData: function() {
                return {
                    _token: $("input[name='_token']").val(),
                };
            },
            allowedFileExtensions: ['jpg', 'jpeg', 'png', 'gif', 'mp3', 'mp4', 'avi'],
            overwriteInitial: false,
            maxFileSize:5000,
            maxFilesNum: 10,
            slugCallback: function (filename) {
                return filename.replace('(', '_').replace(']', '_');
            }
        }).on('filesorted', function(e, params) {
            console.log('file sorted', e, params);
        }).on('fileuploaded', function(e, params) {
            console.log('file uploaded', e, params);
        });
    </script>
@endpush